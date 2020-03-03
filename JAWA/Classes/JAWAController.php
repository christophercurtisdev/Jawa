<?php
namespace JAWA;


use JAWA\Interfaces\JAWAControllerInterface;

abstract class JAWAController implements JAWAControllerInterface
{
    protected static $routes;

    public function index(): ?JAWAView
    {
        // TODO: Implement index() method.
    }

    public function show(int $id): ?JAWAView
    {
        // TODO: Implement show() method.
    }

    public function showFiltered(string $sql): ?array
    {
        // TODO: Implement showFiltered() method.
    }

    public function update(int $id, array $array): ?JAWAView
    {
        // TODO: Implement update() method.
    }

    public function edit(int $id): ?JAWAView
    {
        // TODO: Implement edit() method.
    }

    public function store(array $array): ?JAWAView
    {
        // TODO: Implement store() method.
    }

    public function create(): ?JAWAView
    {
        // TODO: Implement create() method.
    }

    public function storeMany(array $array): ?array
    {
        // TODO: Implement storeMany() method.
    }

    public function createMany(): ?JAWAView
    {
        // TODO: Implement createMany() method.
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