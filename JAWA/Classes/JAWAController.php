<?php
namespace JAWA;


use JAWA\Interfaces\JAWAControllerInterface;

abstract class JAWAController implements JAWAControllerInterface
{
    protected array $guestRoutes;
    protected array $userRoutes;
    protected JAWAView $view;

    public function action($action, $data = null)
    {
        if(in_array($action, $this->routes())) {
            $this->view->getView($action, $data);
        } else {
            return "Unauthorised route for this controller";
        }
    }

    public static function resourcefulRoutes()
    {
        return ["index", "create", "show", "store", "edit", "update", "destroy"];
    }

    public static function readOnlyRoutes()
    {
        return ["index", "show"];
    }

    public function routes()
    {
        return array_unique(array_merge($this->guestRoutes, $this->userRoutes));
    }

    public function guestRoutes()
    {
        return $this->guestRoutes;
    }

    public function userRoutes()
    {
        return $this->userRoutes;
    }
}