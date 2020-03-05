<?php

namespace JAWA;

use JAWA\Interfaces\JAWAModelInterface;

abstract class JAWAModel implements JAWAModelInterface
{
    protected static $columns;
    protected static $tablePrefix;
    protected static $tableName;

    public static function columns(array $array = null): ?array
    {
        if(!empty($array)){
            self::$columns = $array;
            return null;
        } else {
            return self::$columns;
        }
    }

    public static function tablePrefix(string $string = null): ?string
    {
        if($string){
            self::$tablePrefix = $string;
            return null;
        } else {
            return self::$tablePrefix;
        }
    }

    public static function tableName(string $string = null): ?string
    {
        if($string){
            self::$tableName = $string;
            return null;
        } else {
            return self::$tableName;
        }
    }

    public function validateFields($array): bool
    {
        if(is_array($array)) {
            if (count($array) != count($this->columns())) {
                return false;
            }
            foreach ($array as $key => $value) {
                if (!in_array($key, array_keys($this->columns()))) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }

    public function fields(array $array = null): ?array
    {
        if($this->validateFields($array)){
            $this->fields = $array;
        }
        return $this->fields;
    }
}