<?php
namespace Application\Models;

use JAWA\JAWAModel;

class ExampleModel extends JAWAModel
{
    private $fields;

    public function __construct(array $fields)
    {
        self::columns([
            'title' => 'VARCHAR(50) NOT NULL DEFAULT \'Some Title\'',
            'author' => 'VARCHAR(50) NOT NULL DEFAULT \'Some Author\'',
            'type' => 'VARCHAR(50) NOT NULL DEFAULT \'Fiction\'',
            'publisher' => 'VARCHAR(50) NOT NULL DEFAULT \'Some Publisher\'',
            'publishDate' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()',
        ]);
        self::tablePrefix('b_');
        self::tableName('books');

        //If any of the fields dont match the static columns, the model will return empty.
        $this->fields($fields);
    }

    function fields(array $array = null): ?array
    {
        if(!empty($array)){
            if($this->validateFields($array)){
                $this->fields = $array;
                return null;
            }
        } else {
            return $this->fields;
        }
    }
}