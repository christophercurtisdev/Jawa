<?php
namespace JAWA;


use JAWA\Interfaces\JAWAControllerInterface;

abstract class JAWAController implements JAWAControllerInterface
{
    protected static $routes;
    protected static JAWAModel $model;
    protected static JAWAView $view;

    public function index()
    {
        return $this->view->getView('index');
    }

    public function show(int $id)
    {
        return $this->view->getView('show/'.$id);
    }

    public function showFiltered(string $sql)
    {
        // TODO: Implement showFiltered() method.
    }

    public function update(int $id, array $array)
    {
        // TODO: Implement update() method.
    }

    public function edit(int $id)
    {
        // TODO: Implement edit() method.
    }

    public function store(array $array)
    {
        // TODO: Implement store() method.
    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function storeMany(array $array)
    {
        // TODO: Implement storeMany() method.
    }

    public function createMany()
    {
        // TODO: Implement createMany() method.
    }

    public function destroy(int $id)
    {
        // TODO: Implement destroy() method.
    }

    public function listRoutes()
    {
        // TODO: Implement listRoutes() method.
    }

    public function defineRoutes()
    {
        // TODO: Implement defineRoutes() method.
    }
}