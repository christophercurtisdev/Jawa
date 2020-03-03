<?php
namespace JAWA;

use JAWA\Interfaces\JAWAFactoryInterface;

abstract class JAWAFactory implements JAWAFactoryInterface
{
    protected static $model;

    public function getModel(): object
    {
        // TODO: Implement getModel() method.
    }

    public function setModel($model)
    {
        // TODO: Implement setModel() method.
    }

    public function generateModels(int $count)
    {
        // TODO: Implement generateModels() method.
    }
}