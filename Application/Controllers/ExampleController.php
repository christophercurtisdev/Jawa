<?php
namespace Application\Controllers;

use Application\Views\ExampleView;
use JAWA\JAWAController;

class ExampleController extends JAWAController
{
    public function __construct()
    {
        $this->view = new ExampleView();
        $this->routes = self::resourcefulRoutes();
    }
}