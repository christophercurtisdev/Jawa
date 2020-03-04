<?php
namespace JAWA\Interfaces;


use JAWA\JAWAModel;

interface JAWAFactoryInterface
{
    public static function getModel(): string;
    public static function setModel($model);
    public function generateModel();
    public function commitModel(JAWAModel $model);
    public function generateModels(int $count);
    public function commitModels(array $array);
}