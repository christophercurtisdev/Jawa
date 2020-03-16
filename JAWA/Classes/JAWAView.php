<?php
namespace JAWA;

use JAWA\Interfaces\JAWAViewInterface;

abstract class JAWAView implements JAWAViewInterface
{
    public function getView($action, $uriData = null)
    {
        if($uriData){
            require($this->getViewDir() . $action . ".php");
        } else {
            require($this->getViewDir() . $action . ".php");
        }
    }

    public function getViewDir(): string
    {
        $array = explode('\\',substr(get_class($this), 0, -4));
        return 'views'.DIRECTORY_SEPARATOR.strtolower($array[count($array)-1]).DIRECTORY_SEPARATOR;
    }
}