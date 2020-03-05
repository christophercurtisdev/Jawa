<?php


namespace JAWA\Interfaces;


interface JAWARouterInterface
{
    public function get($route);
    public function post($route, $data);
}