<?php
namespace JAWA;

use JAWA\Interfaces\JAWAFactoryInterface;

abstract class JAWAFactory implements JAWAFactoryInterface
{
    protected static $model;

    public static function getModel(): string
    {
        return self::$model;
    }

    public static function setModel($model)
    {
        self::$model = $model;
    }

    public function generateModel()
    {
        $model = self::getModel();
        return new $model([]);
    }

     public function commitModel(JAWAModel $model)
     {
         // TODO: Implement commitModel() method.
     }

     public function generateModels(int $count)
     {
         $i = 0;
         $modelArray = [];
         while($i < $count){
             $model = self::getModel();
             $modelArray[] = new $model([]);
             $i++;
         }
         return $modelArray;
     }

     public function commitModels(array $array)
     {
         // TODO: Implement commitModels() method.
     }
 }