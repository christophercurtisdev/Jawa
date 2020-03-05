<?php
namespace JAWA;

abstract class JAWACrypt
{
    private static $cryptionary = [
        '$5$rounds=5000$',
        '$6$rounds=5000$'
    ];

    public static function strongCrypt($data, $salt)
    {
        $hash = $data;
        $hashCount = str_split(str_pad(decbin(getenv('JAWACRYPT_SECRET')), 10, '0', STR_PAD_LEFT));
        foreach ($hashCount as $iteration) {
            $hash = crypt($hash, self::$cryptionary[$iteration] . $salt . '$');
        }
        return $hash;
    }
}