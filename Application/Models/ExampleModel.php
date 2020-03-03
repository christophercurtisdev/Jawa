<?php
namespace Application\Models;

use JAWA\JAWAModel;

class ExampleModel extends JAWAModel
{
    private $fields;

    public function __construct(array $fields)
    {
        self::setColumns([
            'title' => 'VARCHAR(50) NOT NULL DEFAULT \'Some Title\'',
            'author' => 'VARCHAR(50) NOT NULL DEFAULT \'Some Author\'',
            'type' => 'VARCHAR(50) NOT NULL DEFAULT \'Fiction\'',
            'publisher' => 'VARCHAR(50) NOT NULL DEFAULT \'Some Publisher\'',
            'publishDate' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()',
        ]);
        self::setTablePrefix('b_');
        self::setTableName('books');

        //If any of the fields dont match the static columns, the model will return empty.
        $this->setFields($fields);
    }

    function fields(): array
    {
        return $this->fields;
    }

    function setFields(array $array): void
    {
        if($this->validateFields($array)){
            $this->fields = $array;
        }
    }
}