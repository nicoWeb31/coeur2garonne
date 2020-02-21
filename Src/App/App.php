<?php 
namespace Src\App;
use Src\Controllers\Controller;
use Src\Controllers\ContrUser;
use Src\Controllers\ContrPost;
use Src\Controllers\ContrComment;


require_once "vendor/autoload.php";

/**
 * class App gere la recriture et la redirection des pages
 * 
 */
class App{

public static function process(){

    $controllerName = "Post";
    $task = "index";

    if(!empty($_GET['controller'])){

        $controllerName = ucfirst($_GET['controller']);
    }


    if(!empty($_GET['task'])){

        $task = $_GET['task'];
    }

    $controllerName = "\Src\Controller\\" . $controllerName;  // \Libraries\Controllers\Articles on instancie 
    $controller = new $controllerName();                              // on instanceis la class Article
    dump($controller);

    $controller->$task();                                             // j'appelle la tache demander

}


}