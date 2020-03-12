<?php
namespace JAWA;

use JAWA\Interfaces\JAWARouterInterface;

abstract class JAWARouter implements JAWARouterInterface
{
    public static function processURI(array $uri)
    {
        $controller = ucfirst($uri[1])."Controller";
        $controller = "Application\\Controllers\\{$controller}";
        if(class_exists($controller)){

        }
    }
}