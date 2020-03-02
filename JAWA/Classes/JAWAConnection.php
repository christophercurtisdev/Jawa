<?php
namespace JAWA;

use PDO;
use PDOException;

class JAWAConnection
{
    private PDO $pdo;

    public function __construct()
    {
        try{
            $dsn = 'mysql:dbname='.getenv('DEFAULT_SCHEMA').';host='.getenv('DB_HOST').';port='.getenv('DB_PORT');
            $this->pdo = new PDO($dsn,getenv('DB_USERNAME'),getenv('DB_PASSWORD'));
        } catch (PDOException $e){
            echo "Failed to connect: ".$e->getMessage();
        }
    }

    public function makeTable(string $tableName, array $columns)
    {

    }

    public function dropTable($tableName)
    {

    }

    public function addRow(JAWAModel $model)
    {

    }

    public function deleteRow(int $id)
    {

    }
}

?>