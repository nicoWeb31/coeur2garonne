<?php 
namespace Src\Controllers;
require_once 'vendor/autoload.php';



abstract class Controller{


    protected $model;
    protected $modelName;

    public function __construct()

    {
    $this->model = new $this->modelName();   
    }



}