<?php
namespace JAWA;

use JAWA\Interfaces\JAWAModelInterface;

class JAWAModel implements JAWAModelInterface
{
    protected $datapoints;
    protected $relationships;

    public function getAll(): ?array
    {
        // TODO: Implement getAll() method.
    }

    public function getById(int $id): ?self
    {
        // TODO: Implement getById() method.
    }

    public function getWhere(string $sql): ?array
    {
        // TODO: Implement getWhere() method.
    }

    public function insert(array $array): ?string
    {
        // TODO: Implement insert() method.
    }

    public function insertMany(array $array): ?string
    {
        // TODO: Implement insertMany() method.
    }

    public function update(int $id, array $array): bool
    {
        // TODO: Implement update() method.
    }

    public function getColumns(): array
    {
        // TODO: Implement getColumns() method.
    }
}