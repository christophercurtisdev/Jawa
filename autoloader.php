<?php

class Autoloader
{
    private static $envArray;

    public static function register()
    {
        include 'env.php';
        Autoloader::$envArray = $env;

        foreach (Autoloader::$envArray as $key => $value) {
            putenv("$key=$value");
        }

        foreach (glob(__DIR__.'/JAWA/*.php') as $filename)
        {
            include $filename;
        }

        foreach (glob(__DIR__.'/classes/*.php') as $filename)
        {
            include $filename;
        }
    }
}