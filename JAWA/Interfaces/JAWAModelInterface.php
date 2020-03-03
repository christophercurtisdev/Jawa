<?php
namespace JAWA\Interfaces;

interface JAWAModelInterface 
{
    function getColumns() : array;
    function setColumns(array $array) : void;
    function getTablePrefix() : string;
    function setTablePrefix(string $prefix) : void;
    function getTableName(): string;
    function setTableName(string $string): void;
    function getFields(): array;
    function setFields(array $array): void;
    function getField($var);
    function setField($field, $value): void;
    function makeTable(): void;
}