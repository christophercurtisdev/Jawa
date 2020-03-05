<?php
namespace Application\Security;

use JAWA\JAWAConnection;
use JAWA\JAWACrypt;

abstract class Login
{
    public static function tryLogin($username, $password)
    {
        return self::checkPassword($username, $password);
    }

    private static function checkPassword($username, $password)
    {
        $conn = JAWAConnection::getInstance();
        $user = $conn->allWhere("users", "u_username = '$username'");
        if(!$user){
            return $username." not found";
        }
        //return $user;
        $hash = JAWACrypt::strongCrypt($password, strtotime($user[0]["u_created_at"]));
        if($hash == $user[0]["u_password"]){
            return "Login Successful";
        }
        return "Login Failed";
    }
}