<?php
namespace JAWA;


use JAWA\Interfaces\JAWAControllerInterface;

abstract class JAWAController implements JAWAControllerInterface
{
    protected $routes;
    protected JAWAModel $model;
    protected JAWAView $view;

    public function action($viewName, $data = null)
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