<?php
namespace JAWA\Interfaces;

interface JAWAModelInterface 
{
    public function __construct(array $fields);
    public static function columns(array $array = null) : ?array;
    public static function tablePrefix(string $prefix) : ?string;
    public static function tableName(string $string = null): ?string;
    public function fields(array $array = null): ?array;
    public function validateFields(array $array): bool;
    public function references(array $reference, string $column);
}