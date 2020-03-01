<?php
namespace JAWA;

use JAWA\Interfaces\JAWAModelInterface;

class JAWAModel implements JAWAModelInterface
{
    protected $datapoints;
    protected $relationships;

    public function getAll()
    {
        return true;
    }
}