<?php
namespace JAWA\Interfaces;


interface JAWAViewInterface
{
    function getView($actions);
    function getViewDir(): string;
}