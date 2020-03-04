<?php
namespace Application\Factory;

use Application\Models\ExampleModel;
use JAWA\JAWAFactory;

class ExampleFactory extends JAWAFactory
{
    public function __construct()
    {
        self::setModel(ExampleModel::class);
    }
}