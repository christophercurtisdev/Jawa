<?php
namespace JAWA;


use JAWA\Interfaces\JAWAControllerInterface;

abstract class JAWAController implements JAWAControllerInterface
{
    protected $routes;
    protected JAWAModel $model;
    protected JAWAView $view;

    public function index()
    {
        $this->view->getView('index');
    }

    public function show(int $id)
    {
        $this->view->getView('show', $id);
    }

    public function showFiltered(string $sql)
    {
        // TODO: Implement showFiltered() method.
    }

    public function update(int $id, array $array)
    {
        $this->view->getView('update', $array);
    }

    public function edit(int $id)
    {
        $this->view->getView('edit', $id);
    }

    public function store(array $array)
    {
        $this->view->getView('store', $array);
    }

    public function create()
    {
        $this->view->getView('create');
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
        $this->view->getView('destroy', $id);
    }

    public function custom($viewName, $data = null)
    {
        $this->view->getView($viewName, $data);
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