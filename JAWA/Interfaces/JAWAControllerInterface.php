<?php
namespace JAWA\Interfaces;

interface JAWAControllerInterface
{
    function action($action, $data = null);
    function routes();
    static function readOnlyRoutes();
    static function resourcefulRoutes();
    function guestRoutes();
    function userRoutes();
}