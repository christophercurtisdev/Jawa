<?php
namespace JAWA;

use PDO;
use PDOException;

class JAWAConnection
{
    private static PDO $pdo;
    private static $instance = null;
    private static $existingPrefixes;

    private function __construct()
    {
        try{
            $dsn = 'mysql:dbname='.getenv('DEFAULT_SCHEMA').';host='.getenv('DB_HOST').';port='.getenv('DB_PORT');
            JAWAConnection::$pdo = new PDO($dsn,getenv('DB_USERNAME'),getenv('DB_PASSWORD'));
        } catch (PDOException $e){
            echo "Failed to connect: ".$e->getMessage();
        }
    }

    public function setup()
    {
        $stmt = self::$pdo->prepare('CREATE TABLE IF NOT EXISTS `existing_table_prefixes` (`etp_id` int(11) NOT NULL AUTO_INCREMENT, `etp_prefix` VARCHAR(10) NOT NULL, `etp_table` VARCHAR(50) NOT NULL, PRIMARY KEY (`etp_id`));');
        $stmt->execute();
        $stmt = self::$pdo->prepare('CREATE TABLE IF NOT EXISTS `table_cache` (`tc_id` int(11) NOT NULL AUTO_INCREMENT, `tc_table_name` VARCHAR(50) NOT NULL, `tc_table_columns` VARCHAR(200) NOT NULL, `tc_column_prefix` VARCHAR(10), PRIMARY KEY (`tc_id`));');
        $stmt->execute();

        $data = self::$pdo->query('SELECT * FROM existing_table_prefixes');

        if(empty(self::allWhere("existing_table_prefixes", "etp_prefix = 'etp_'"))) {
            $this->insertRow("existing_table_prefixes", ["etp_prefix" => "etp_", "etp_table" => "existing_table_prefixes"]);
            $this->insertRow("existing_table_prefixes", ["etp_prefix" => "tc_", "etp_table" => "table_cache"]);
        }

        if($data) {
            foreach ($data->fetchAll(PDO::FETCH_ASSOC) as $row) {
                self::$existingPrefixes[] = $row['etp_prefix'];
            }
        }
    }

    public function getPrefixes()
    {
        return self::$existingPrefixes;
    }

    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new JAWAConnection();
        }
        return self::$instance;
    }

    public function dropAll()
    {
        $db = getenv('DEFAULT_SCHEMA');
        $tables = $this->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = '{$db}';");
        foreach ($tables as $table) {
            $stmt = self::$pdo->prepare("DROP TABLE {$table['TABLE_NAME']}");
            $stmt->execute();
        }
    }

    public function makeTable(string $tableName, array $columns, string $columnPrefix = null, bool $cache = true)
    {
        // Is prefix specified, should it be, and does it already exist
        if(!empty(self::$existingPrefixes))
        {
            if(!$columnPrefix) {
                return "Prefix missing";
            }

            if(in_array($columnPrefix, self::$existingPrefixes)){
                return "Prefix already exists.";
            }
        }
        // Columns: ['columnName' => 'int(11) NOT NULL default '20', 'columnName' => 'specs'...]
        $sql = 'CREATE TABLE IF NOT EXISTS ' . $tableName . ' (';
        $sql .= '`' . $columnPrefix . 'id` int(11) NOT NULL auto_increment, ';
        foreach ($columns as $columnName => $columnSpecs) {
            $sql .= '`' . $columnPrefix . $columnName . '` ' . $columnSpecs . ', ';
        }
        $sql .= '`' . $columnPrefix . 'created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, ';
        $sql .= '`' . $columnPrefix . 'updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, ';
        $sql .= 'PRIMARY KEY (`' . $columnPrefix . 'id`));';
        $stmt = self::$pdo->prepare($sql);
        if($stmt->execute() == 1){
            // Add prefix to prefixes table
            self::$existingPrefixes[] = $columnPrefix;
            $etp = self::$pdo->prepare('INSERT INTO existing_table_prefixes (etp_prefix, etp_table) VALUES (\''.$columnPrefix.'\', \''.$tableName.'\');');
            $etp->execute();
        }

        if($cache){
            $this->addTableCache($columns, $tableName, $columnPrefix);
        }
    }

    public function addTableCache($columns, $tableName, $columnPrefix)
    {
        $string = '';
        foreach ($columns as $key => $value){
            $string.= $key.":".$value."|";
        }
        $string = urlencode(substr_replace($string, "", -1));

        $stmt = self::$pdo->prepare("INSERT INTO table_cache (tc_table_name, tc_table_columns, tc_column_prefix) VALUES ('{$tableName}', '{$string}', '{$columnPrefix}');");
        $stmt->execute();
    }

    public function updateTableCache($columns, $tableName)
    {
        $string = '';
        foreach ($columns as $key => $value){
            $string.= $key.":".$value."|";
        }
        $string = urlencode(substr_replace($string, "", -1));

        $stmt = self::$pdo->prepare("UPDATE table_cache SET tc_table_columns=? WHERE tc_table_name=?;");
        $stmt->execute([$string, $tableName]);
    }

    public function dropTable($tableName)
    {
        $stmt = self::$pdo->prepare('DROP TABLE IF EXISTS '.$tableName);
        if($stmt->execute() != 1){
            return 'Drop Failed';
        }
        $stmt = self::$pdo->prepare("DELETE FROM existing_table_prefixes WHERE etp_table = '".$tableName."'");
        return $stmt->execute();
    }

    public function insertModel(JAWAModel $model)
    {
        if(!empty($model->fields())) {
            $columns = [];
            foreach ($model->fields() as $key => $value){
                $columns[$model::tablePrefix().$key] = $value;
            }
            $this->insertRow($model->tableName(), $columns);
        }
    }

    public function emptyTableCache()
    {
        $stmt = self::$pdo->prepare('DROP TABLE `table_cache`');
        $stmt->execute();
        $stmt = self::$pdo->prepare('CREATE TABLE `table_cache` (`tc_id` int(11) NOT NULL AUTO_INCREMENT, `tc_table_name` VARCHAR(50) NOT NULL, `tc_table_columns` VARCHAR(200) NOT NULL, `tc_column_prefix` VARCHAR(10), PRIMARY KEY (`tc_id`));');
        $stmt->execute();
    }

    public function refreshTableCache()
    {
        $this->emptyTableCache();
        $string = '';

        $sql = "INSERT INTO table_cache (tc_table_name, tc_table_columns, tc_column_prefix) VALUES ";

        foreach (get_declared_classes() as $class) {
            if (strpos($class, DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR)) {
                $object = new $class([]);
                foreach ($object::columns() as $key => $value){
                    $string.= $key.":".$value.",";
                }
                $string = substr_replace($string, "", -1);

                $sql.= "('{$object::tableName()}', '{$string}', '{$object::tablePrefix()}'),";
            }
        }
        $sql = substr_replace($sql, "", -1);
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute();
    }

    public function insertRow($table, $columns)
    {
        $keys = [];
        $values = [];
        foreach ($columns as $key => $value){
            $keys[] = $key;
            $values[] = $value;
        }
        $valuesString = implode("', '", $values);
        $keysString = implode(", ", $keys);
        $stmt = self::$pdo->prepare("INSERT INTO {$table} ({$keysString}) VALUES ('{$valuesString}');");
        $stmt->execute();
    }

    public function deleteRow(int $id): ?string
    {
        if($id > 0) {
            $stmt = self::$pdo->prepare("DELETE FROM news WHERE id =:id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }
    }

    public function query($sql)
    {
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function allTables()
    {
        $db = getenv('DEFAULT_SCHEMA');
        $stmt = self::$pdo->prepare("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = '{$db}'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function all($table): array
    {
        $data = self::$pdo->query('SELECT * FROM '.$table);
        if($data){
            return $data->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    public function allWhere($table, $where): array
    {
        $data = self::$pdo->query('SELECT * FROM '.$table.' WHERE '.$where);
        if($data){
            return $data->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    public function applyNotNull($table, $column, $datatype)
    {
        $sql = "ALTER TABLE {$table} MODIFY {$column} {$datatype} NOT NULL;";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute();
    }

    public function applyUnique($table, $column)
    {
        $sql = "ALTER TABLE {$table} ADD UNIQUE ({$column});";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute();
    }

    public function applyCheck($table, $column)
    {
        $sql = "ALTER TABLE {$table} ADD CHECK ({$column});";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute();
    }

    public function applyDefault($table, $column, $value)
    {
        $sql = "ALTER TABLE {$table} ALTER {$column} SET DEFAULT {$value};";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute();
    }

    public function applyForeignKey($table, $column, $referenceTable, $referenceColumn, $fkName)
    {
        $sql = "ALTER TABLE {$table} ADD CONSTRAINT {$fkName} FOREIGN KEY ({$column}) REFERENCES {$referenceTable}({$referenceColumn});";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute();
    }
}