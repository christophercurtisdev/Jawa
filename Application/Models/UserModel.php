<?php
namespace Application\Models;


use JAWA\JAWAModel;

class UserModel extends JAWAModel
{
    protected $fields;

    public function __construct(array $fields)
    {
        self::columns([
            //'system' => 'VARCHAR(50)', //FOR SEVERAL SYSTEMS IN ONE APP, CHANGE THE JAWACRYPT SECRET AND CONTAIN ALL USERS IN ONE TABLE
            'username' => 'VARCHAR(50)',
            'password' => 'VARCHAR(255)',
            'auth_level' => "ENUM('root', 'admin', 'basic')" //ADD TO OR ADJUST TO APPROPRIATE USER GROUPS
        ]);
        self::tablePrefix('u_');
        self::tableName('users');

        //If any of the fields dont match the static columns, the model will return with empty fields.
        $this->fields($fields);
    }
}