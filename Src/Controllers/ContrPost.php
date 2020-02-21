<?php 
namespace Src\Controllers ; 
require_once 'vendor/autoload.php';

class ContrPost extends Controller {


    public $modelName = \Src\Models\Post::class;




    public function index(){
        
        /**
         * recupération des atricles
         */
        $articles = $this->model->findAll("created_at DESC");
        
        /**
         *  Affichage
         */
        
        $pageTitle = "Accueil";
        Render::render('Articles/indexView',compact('pageTitle','articles'));

    }

    public function show(){
        
        
        $CommetModel = new Comment;

        $article_id = null;
        
        // Mais si il y'en a un et que c'est un nombre entier, alors c'est cool
        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $article_id = $_GET['id'];
        }
        
        // On peut désormais décider : erreur ou pas ?!
        if (!$article_id) {
            die("Vous devez préciser un paramètre `id` dans l'URL !");
        }
        $article = $this->model->find($article_id);

        $commentaires = $CommetModel->findAllByArticle($article_id);
        
        /**
         * 5. On affiche 
         */
        $pageTitle = $article['title'];
        Render::render('Articles/showOne',compact('pageTitle', 'article','commentaires','article_id'));


    }

    public function delete(){

        /**
         * On vérifie que le GET possède bien un paramètre "id" (delete.php?id=202) et que c'est bien un nombre
         */
        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            die("Ho ?! Tu n'as pas précisé l'id de l'article !");
        }
        
        $id = $_GET['id'];
        
        
        /**
         * Vérification que l'article existe bel et bien
         */
        $article = $this->model->find($id);
        if (!$article) {
            die("L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !");
        }
        
        $this->model->delete($id);
        
        /**
         * Redirection vers la page d'accueil
         */
        header("Location:index.php");
        exit();

    }



}

?>