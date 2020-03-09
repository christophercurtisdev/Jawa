<?php


namespace JAWA\Interfaces;


interface JAWARouterInterface
{
    public static function get($route);
    public static function post($route, $data);
}