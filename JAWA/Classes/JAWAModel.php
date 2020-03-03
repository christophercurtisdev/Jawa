<?php

namespace JAWA;

use JAWA\Interfaces\JAWAModelInterface;

abstract class JAWAModel implements JAWAModelInterface
{
    protected static $fields;
    protected static $columns;
    protected static $tablePrefix;
    protected static $tableName;

    public function getColumns(): array
    {
        return self::$columns;
    }

    public function setColumns(array $array): void
    {
        self::$columns = $array;
    }

    public function getTablePrefix(): string
    {
        return self::$tablePrefix;
    }

    public function setTablePrefix(string $prefix): void
    {
        self::$tablePrefix = $prefix;
    }

    public function getTableName(): string
    {
        return self::$tableName;
    }

    public function setTableName(string $string): void
    {
        self::$tableName = $string;
    }


    public function getFields(): array
    {
        return self::$fields;
    }

    public function setFields(array $array): void
    {
        $canAssignValues = true;
        foreach ($array as $key => $value)
        {
            if(!in_array($key, self::getColumns()))
            {
                $canAssignValues = false;
            }
        }
        if($canAssignValues)
        {
            self::$fields = $array;
        }
    }

    public function getField($var)
    {
        return self::$fields[$var];
    }

    public function setField($field, $value): void
    {
        if(in_array($field, self::getColumns()))
        {
            self::$fields[$field] = $value;
        }
    }

    public function makeTable(): void
    {
        $conn = JAWAConnection::getInstance();
        $conn->makeTable(self::getTableName(), self::getColumns(), self::getTablePrefix());
    }
}