<?php 
namespace Src\Controllers;
use Src\Models\Post;

require_once 'vendor/autoload.php';




class ContrComment extends Controller {


    protected $modelName= \Src\Models\Comment::class;
    
    

    /**
     * insert comment
     */
    public function insert(){

        $articleModel =new Post();

        $author = null;
        if (!empty($_POST['author'])) {
            $author = $_POST['author'];
        }
        
        // Ensuite le contenu
        $content = null;
        if (!empty($_POST['content'])) {
            
            $content = htmlspecialchars($_POST['content']);
        }
        
        // Enfin l'id de l'article
        $article_id = null;
        if (!empty($_POST['article_id']) && ctype_digit($_POST['article_id'])) {
            $article_id = $_POST['article_id'];
        }
        
        // Vérification finale des infos envoyées dans le formulaire (donc dans le POST)
        if (!$author || !$article_id || !$content) {
            die("Votre formulaire a été mal rempli !");
        }
        
        
        $article=$articleModel->find($article_id);
        // Si rien n'est revenu, on fait une erreur
        if (!$article) {
            die("Ho ! L'article $article_id n'existe pas boloss !");
        }
        
        //Insertion du commentaire
        $this->model->insert($author,$content,$article_id);
        
        //Redirection vers l'article en question :
       Http::redirect("index.php?controller=article&task=show&id=".$article_id);
       
    }


    public function delete(){

        
        //Récupération du paramètre "id" en GET
        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            die("Ho ! Fallait préciser le paramètre id en GET !");
        }
        $id = $_GET['id'];
        
        //Vérification de l'existence du commentaire
        $commentaire=$this->model->find($id);
        if (!$commentaire) {
            die("Aucun commentaire n'a l'identifiant $id !");
        }
            

        //Suppression réelle du commentaire
        //On récupère l'identifiant de l'article avant de supprimer le commentaire

        $article_id = $commentaire['article_id'];
        $this->model->delete($id);
        
            


        // redirection
        Http::redirect("index.php?controller=article&task=show&id=".$article_id);



    }
}