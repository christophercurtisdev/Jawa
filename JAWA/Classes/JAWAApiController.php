<?php
namespace JAWA;

use JAWA\Interfaces\JAWAApiControllerInterface;

abstract class JAWAApiController implements JAWAApiControllerInterface
{
    protected array $routes;
    protected JAWAView $view;

    function action($action, $data = null)
    {
        if(in_array($action, $this->routes)) {
            $this->view->getView($action, $data);
        } else {
            return "Unauthorised route for this controller";
        }
    }

    public static function resourcefulRoutes()
    {
        return ["index", "show", "store", "update", "destroy"];
    }

     function routes()
     {
         return $this->routes;
     }
 }