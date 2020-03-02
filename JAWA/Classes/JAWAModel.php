<?php
namespace JAWA;

use JAWA\Interfaces\JAWAModelInterface;

abstract class JAWAModel implements JAWAModelInterface
{
    public function getAll(): ?array
    {
        // TODO: Implement getAll() method.
        $conn = JAWAConnection::getInstance();
    }

    public function getById(int $id): ?self
    {
        // TODO: Implement getById() method.
        $conn = JAWAConnection::getInstance();
    }

    public function getWhere(string $sql): ?array
    {
        // TODO: Implement getWhere() method.
        $conn = JAWAConnection::getInstance();
    }

    public function insert(array $array): ?string
    {
        // TODO: Implement insert() method.
        $conn = JAWAConnection::getInstance();
    }

    public function insertMany(array $array): ?string
    {
        // TODO: Implement insertMany() method.
        $conn = JAWAConnection::getInstance();
    }

    public function update(int $id, array $array): bool
    {
        // TODO: Implement update() method.
        $conn = JAWAConnection::getInstance();
    }

    public function getColumns(): array
    {
        // TODO: Implement getColumns() method.
        $conn = JAWAConnection::getInstance();
    }
}