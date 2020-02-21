<?php
namespace Src\Utils;
require_once "vendor/autoload.php";
use PDO;


/**
 * retourne une connection a la bdd
 * 
 */
class Bdd {

    private static $inst = null;

    public static function getPdo():PDO{
    

        if(self::$inst === null){   //sigleton si deja ouvert on reouvre pas une instance
            self::$inst =  new PDO('mysql:host=localhost;dbname=blogpoo;charset=utf8', 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        
    
        }

        return self::$inst;
    }
}