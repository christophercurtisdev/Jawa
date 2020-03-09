<?php
namespace JAWA\Interfaces;


use JAWA\JAWAView;

interface JAWAControllerInterface
{
    function action($viewName, $data = null);
    function listRoutes();
    function defineRoutes();
}