<?php
namespace JAWA;


use JAWA\Interfaces\JAWAControllerInterface;

abstract class JAWAController implements JAWAControllerInterface
{
    protected array $routes;
    protected JAWAModel $model;
    protected JAWAView $view;

    public function action($action, $data = null)
    {
        if(in_array($action, $this->routes)) {
            $this->view->getView($action, $data);
        } else {
            return "Unauthorised root for this controller";
        }
    }

    public static function resourcefulRoutes()
    {
        return ["index", "create", "show", "store", "edit", "update", "destroy"];
    }

    public function routes()
    {
        return $this->routes;
    }
}