<?php
namespace Application\Models;

use JAWA\JAWAModel;

class ExampleModel extends JAWAModel
{
    protected $fields;

    public function __construct(array $fields = [])
    {
        self::columns([
            'title' => 'VARCHAR(50)',
            'author' => 'VARCHAR(50)',
            'type' => 'VARCHAR(50)',
            'publisher' => 'VARCHAR(50)',
            'publish_date' => 'DATE',
        ]);
        self::tablePrefix('b_');
        self::tableName('books');

        //If any of the fields dont match the static columns, the model will return empty.
        $this->fields($fields);
    }
}