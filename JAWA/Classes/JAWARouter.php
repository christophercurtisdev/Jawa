<?php
namespace JAWA;

use JAWA\Interfaces\JAWARouterInterface;

abstract class JAWARouter implements JAWARouterInterface
{
    public static function processURI(array $uri)
    {
        $uriParamCount = count($uri);
        switch ($uriParamCount){
            case 1:
                $controller = ucfirst($uri[1])."Controller";
                $controller = "Application\\Controllers\\{$controller}";
                if(class_exists($controller)){
                    $controller = new $controller;
                    return $controller->action("index");
                } else {
                    return "Controller not found.";
                }
                break;
            case 2:
                $controller = ucfirst($uri[1])."Controller";
                $controller = "Application\\Controllers\\{$controller}";
                if(class_exists($controller)){
                    $controller = new $controller;
                    return $controller->action($uri[2]);
                } else {
                    return "Controller not found.";
                }
                break;
            case 3:
                $controller = ucfirst($uri[1])."Controller";
                $controller = "Application\\Controllers\\{$controller}";
                if(class_exists($controller)){
                    $controller = new $controller;
                    return $controller->action($uri[2], $uri[3]);
                } else {
                    return "Controller not found.";
                }
                break;
        }
    }
}