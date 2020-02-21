<?php 
namespace Src\Models;

use Src\Utils\Bdd;
require_once 'vendor/autoload.php';



/**
 * abstract class
 * return values request
 * 
 */


abstract class Model{

    protected $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = Bdd::getPdo();
    }

    /**
     * Récupération un article
     *@array
     * 
     */
    public function find(int $id){

        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id"); 
        $query->execute(['id' => $id]);
        $item = $query->fetch();
        return  $item;
    }

    /**
    * Réelle suppression 
    */
    public function delete(int $id) :void{

        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id =:id");
        $query->execute(['id' => $id]);

    }

    /**
     * find with or whitout order
     */
    public function findAll(?string $order =""){

        $sql = "SELECT * FROM {$this->table}";
        if($order){
            $sql.= " ORDER BY ".$order;
        }
        $resultats = $this->pdo->query($sql);
        $articles = $resultats->fetchAll();
        return $articles;
        
        }

}