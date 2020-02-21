<?php 
namespace Src\Utils;
require_once 'vendor/autoload.php';


class Http{

/**
 * redirection
 * 
 */

    public static function redirect($url){
        header("Location:$url");
        exit();

    }       


}