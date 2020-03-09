<?php
namespace Application\Controllers;

use Application\Views\ExampleView;
use JAWA\JAWAController;
use JAWA\JAWAView;

class ExampleController extends JAWAController
{
    protected JAWAView $view;

    public function __construct()
    {
        $this->view = new ExampleView();
    }

}