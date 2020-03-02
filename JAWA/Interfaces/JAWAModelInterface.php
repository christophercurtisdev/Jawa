<?php
namespace JAWA\Interfaces;

interface JAWAModelInterface 
{
    public function getAll() : ?array;
    public function getById(int $id) : ?self;
    public function getWhere(string $sql) : ?array;
    public function insert(array $array) : ?string;
    public function insertMany(array $array) : ?string;
    public function update(int $id, array $array) : bool;
    public function getColumns() : array;
}