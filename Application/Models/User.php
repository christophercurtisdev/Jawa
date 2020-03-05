<?php
namespace Application\Models;


use JAWA\JAWAModel;

class User extends JAWAModel
{
    protected $fields;

    public function __construct(array $fields)
    {
        self::columns([
            'username' => 'VARCHAR(50)',
            'password' => 'VARCHAR(255)',
        ]);
        self::tablePrefix('u_');
        self::tableName('users');

        //If any of the fields dont match the static columns, the model will return empty.
        $this->fields($fields);
    }
}