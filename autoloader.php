<?php

class Autoloader
{
    private static $envArray;

    public static function register()
    {
        //SET ENVIRONMENT VARIABLES
        include 'env.php';
        Autoloader::$envArray = $env;

        foreach (Autoloader::$envArray as $key => $value) {
            putenv("$key=$value");
        }

        //IMPORT JAWA
        foreach (glob(__DIR__.'/JAWA/Interfaces/*.php') as $filename)
        {
            include $filename;
        }

        foreach (glob(__DIR__.'/JAWA/Classes/*.php') as $filename)
        {
            include $filename;
        }

        //IMPORT USER DEFINED CLASSES
        foreach (glob(__DIR__.'/Application/*/*.php') as $filename)
        {
            include $filename;
        }
    }
}