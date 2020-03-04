<?php
namespace JAWA;


class JAWATableManager
{
    private $tables;

    public function __construct()
    {
        $this->tables = self::getTables();
    }

    private static function getTables(){
        $conn = JAWAConnection::getInstance();
        $conn->all("tableCache");
    }

    private function rebuildFromCachedTables()
    {
        var_dump($this->tables);
    }
}