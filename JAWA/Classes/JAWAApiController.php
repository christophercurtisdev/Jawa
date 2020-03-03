<?php
namespace JAWA;

use JAWA\Interfaces\JAWAApiControllerInterface;

abstract class JAWAApiController implements JAWAApiControllerInterface
{
    public function index(): ?array
    {
        // TODO: Implement index() method.
    }

    public function get(int $id): ?JAWAModel
    {
        // TODO: Implement get() method.
    }

    public function getWhere(string $sql): ?array
    {
        // TODO: Implement getWhere() method.
    }

    public function update(int $id, array $array): ?JAWAModel
    {
        // TODO: Implement update() method.
    }

    public function store(array $array): ?JAWAModel
    {
        // TODO: Implement store() method.
    }

    public function storeMany(array $array): ?array
    {
        // TODO: Implement storeMany() method.
    }

    public function destroy(int $id): ?string
    {
        // TODO: Implement destroy() method.
    }

    public function listRoutes(): array
    {
        // TODO: Implement listRoutes() method.
    }

    public function defineRoutes(): array
    {
        // TODO: Implement defineRoutes() method.
    }
}