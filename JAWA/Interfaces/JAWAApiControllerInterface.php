<?php
namespace JAWA\Interfaces;


use JAWA\JAWAModel;

interface JAWAApiControllerInterface
{
    function action($action, $data = null);
    function routes();
}