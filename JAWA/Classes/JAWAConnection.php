<?php
namespace JAWA;

use PDO;
use PDOException;

class JAWAConnection
{
    private static PDO $pdo;
    private static $instance = null;

    private function __construct()
    {
        try{
            $dsn = 'mysql:dbname='.getenv('DEFAULT_SCHEMA').';host='.getenv('DB_HOST').';port='.getenv('DB_PORT');
            JAWAConnection::$pdo = new PDO($dsn,getenv('DB_USERNAME'),getenv('DB_PASSWORD'));
        } catch (PDOException $e){
            echo "Failed to connect: ".$e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new JAWAConnection();
        }

        return self::$instance;
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