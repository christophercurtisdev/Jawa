<?php
namespace JAWA\Interfaces;

interface JAWAModelInterface 
{
    static function columns(array $array = null) : ?array;
    static function tablePrefix(string $prefix) : ?string;
    static function tableName(string $string = null): ?string;
    function fields(array $array = null): ?array;
    function validateFields(array $array): bool;
}