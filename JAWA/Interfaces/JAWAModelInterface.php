<?php
namespace JAWA\Interfaces;

interface JAWAModelInterface 
{
    static function columns() : array;
    static function setColumns(array $array) : void;
    static function tablePrefix() : string;
    static function setTablePrefix(string $prefix) : void;
    static function tableName(): string;
    static function setTableName(string $string): void;
    function fields(): array;
    function setFields(array $array): void;
    function validateFields(array $array): bool;
}