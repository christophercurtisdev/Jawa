<?php
namespace Application\Models;

use JAWA\JAWAModel;

class ExampleModel extends JAWAModel
{
    //If entity is mapping books
    public function whereAgeOver($age)
    {
        return $this->getWhere("age > $age");
    }

    public function whereTypeIs($type)
    {
        return $this->getWhere("type='$type'");
    }

    public function whereTypeIsNot($type)
    {
        return $this->getWhere("type!='$type'");
    }

    public function whereTypeIn(array $types)
    {
        $typeString = "";
        foreach ($types as $type) {
            $typeString .= "'${type}',";
        }
        $typeString = rtrim($typeString, ",");
        return $this->getWhere("type IN ($typeString)");
    }

    //So in the view/ api endpoint it could be:

    //foreach($book->whereTypeIs('Fiction') as $book)
    //{
    //  ...CODE HERE...
    //}
}