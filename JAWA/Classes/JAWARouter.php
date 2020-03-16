<?php
namespace JAWA;

use JAWA\Interfaces\JAWARouterInterface;

abstract class JAWARouter implements JAWARouterInterface
{
    public static function processURI(array $uri)//add $_SESSION['logged'] to method
    {
        $controllerName = ucfirst($uri[1])."Controller";
        $controller = "Application\\Controllers\\{$controllerName}";
        if(class_exists($controller)){
            $controller = new $controller;
        } else {
            return "404: {$uri[1]} not found";
        }
        $action = isset($uri[2]) ? $uri[2] : "index";
        if(!$uri[2]){
            header("Location: /{$uri[1]}/index");
        }
        $data = isset($uri[3]) ? array_splice($uri, 3, count($uri) - 1) : null;
        $controller->action($action, $data);
    }
}