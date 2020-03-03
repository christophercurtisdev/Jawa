<?php

namespace JAWA;

use JAWA\Interfaces\JAWAModelInterface;

abstract class JAWAModel implements JAWAModelInterface
{
    protected static $columns;
    protected static $tablePrefix;
    protected static $tableName;

    public static function columns(): array
    {
        return self::$columns;
    }

    public static function setColumns(array $array): void
    {
        self::$columns = $array;
    }

    public static function tablePrefix(): string
    {
        return self::$tablePrefix;
    }

    public static function setTablePrefix(string $prefix): void
    {
        self::$tablePrefix = $prefix;
    }

    public static function tableName(): string
    {
        return self::$tableName;
    }

    public static function setTableName(string $string): void
    {
        self::$tableName = $string;
    }

    public function validateFields(array $array): bool
    {
        if(count($array) != count($this->columns())){
            return false;
        }
        foreach ($array as $key => $value)
        {
            if(!in_array($key, array_keys($this->columns())))
            {
                return false;
            }
        }
        return true;
    }
}