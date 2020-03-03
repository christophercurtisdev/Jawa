<?php
namespace JAWA;

use PDO;
use PDOException;

class JAWAConnection
{
    private static $pdo;
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
        $stmt = self::$pdo->prepare('CREATE TABLE IF NOT EXISTS `existing_table_prefixes` (`etp_id` int(11) NOT NULL AUTO_INCREMENT, `etp_prefix` VARCHAR(10) NOT NULL, `etp_table` VARCHAR(50) NOT NULL, PRIMARY KEY (`etp_id`));');
        $stmt->execute();
        $data = self::$pdo->query('SELECT * FROM existing_table_prefixes');
        if($data) {
            foreach ($data->fetchAll(PDO::FETCH_ASSOC) as $row){
                self::$existingPrefixes[] = $row['etp_prefix'];
            }
        } else {
            self::$existingPrefixes = [];
        }
    }

    public static function getPrefixes()
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

    public static function makeTable(string $tableName, array $columns, string $columnPrefix = null)
    {
        // Is prefix specified, should it be, and does it already exist
        if(!getenv('DISABLE_COLUMN_PREFIXING') && !empty(self::$existingPrefixes))
        {
            if(!$columnPrefix) {
                return "Prefix missing, disable force column prefixing by adding 'DISABLE_COLUMN_PREFIXING = true' to env.php file";
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
    }

    public function dropTable($tableName)
    {
        $stmt = self::$pdo->prepare('DROP TABLE IF EXISTS '.$tableName);
        $stmt->execute();
        if($stmt != 1){
            return 'Drop Failed';
        }
        $stmt = self::$pdo->prepare('DELETE FROM existing_table_prefixes WHERE etp_table = '.$tableName);
        return $stmt->execute();
    }

    public function addRow(JAWAModel $model)
    {

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
        return $stmt->execute();
    }

    public function all($table): array
    {
        $data = self::$pdo->query('SELECT * FROM '.$table);
        if($data){
            return $data->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return ["JAWA failed to retrieve any data from the '".$table."' table :("];
        }
    }

    public function allWhere($table, $where): array
    {
        $data = self::$pdo->query('SELECT * FROM '.$table.' '.$where);
        if($data){
            return $data->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return ["JAWA failed to retrieve any data from the '".$table."' table :("];
        }
    }

    public function applyConstraint($type, $table, $column, $data)
    {
        $sql = '';
        switch ($type){
            case "NOT NULL":
                $sql = "ALTER TABLE {$table} MODIFY {$column} {$data} NOT NULL;";
                break;
            case "UNIQUE":
                $sql = "ALTER TABLE {$table} ADD UNIQUE ({$column});";
                break;
            case "CHECK":
                $sql = "ALTER TABLE {$table} ADD CHECK ({$column});";
                break;
            case "DEFAULT":
                $sql = "ALTER TABLE {$table} ALTER {$column} SET DEFAULT {$data};";
                break;
            default:
                break;
        }
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