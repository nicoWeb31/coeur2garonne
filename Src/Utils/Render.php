<?php 
namespace Src\Utils;
require_once 'vendor/autoload.php';



/**
 * fait le rendu //recuperer les variables// ouvre le tempon 
 * //le ferme et appelle le layout
 * 
 */

class Render {



    public static function render(string $path,array $variables = []){

        extract($variables);    //extract variables d'un tableau associatif
        ob_start();
        require('Views/'.$path.'.php');
        $pageContent = ob_get_clean();
        
        require('Templates/layout.php');


    }



}