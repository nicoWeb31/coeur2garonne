<?php 
namespace Src\Models;
require_once 'vendor/autoload.php';

class Comment extends Model{



    protected $table = "comments";

    /**
     * find all by post
     */
    public function findAllByPost(int $id){


        $query = $this->pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
        $query->execute(['article_id' => $id]);
        $commentaires = $query->fetchAll();
        return $commentaires;

    }

    /**
     * insert comment
     */
    public function insert(string $author,string $content , int $article_id ) :void{

        $query = $this->pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
        $query->execute(compact('author', 'content', 'article_id'));

    }






}