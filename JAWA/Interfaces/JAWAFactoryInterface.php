<?php
namespace JAWA\Interfaces;


interface JAWAFactoryInterface
{
    public function getModel(): object;
    public function setModel($model);
    public function generateModels(int $count);
}