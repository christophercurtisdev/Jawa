<?php
namespace Application\Controllers;

use Application\Views\ExampleView;
use JAWA\JAWAController;
use JAWA\JAWAView;

class ExampleController extends JAWAController
{
    public function __construct()
    {
        $this->view = new ExampleView();
        $this->routes = self::resourcefulRoutes();
    }
}