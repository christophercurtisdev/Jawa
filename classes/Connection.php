<?php
namespace JAWA\Classes;

use JAWA\JAWABase;
use PDO;
use PDOException;

class Connection extends JAWABase
{
    private $pdo;

    public function __construct()
    {
        try{
            $dsn = 'mysql:dbname='.getenv('DEFAULT_SCHEMA').';host='.getenv('DB_HOST').';port='.getenv('DB_PORT');
            $this->pdo = new PDO($dsn,getenv('DB_USERNAME'),getenv('DB_PASSWORD'));
        } catch (PDOException $e){
            echo "Failed to connect: ".$e->getMessage();
        }
    }
}

?>