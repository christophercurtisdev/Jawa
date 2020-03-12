<?php
namespace JAWA\Interfaces;


use JAWA\JAWAModel;

interface JAWAApiControllerInterface
{
    function action($viewName, $data = null);
    function routes();
}