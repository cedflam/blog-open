<?php 

class ManagerArticleController {

     /*******************CONTROLES ARTICLE***************** */


    /**
     * Fonction qui permet d'effectuer les controles
     * lors de l'ajout d'un article
     *
     * @return void
     */
    public function addArticleControls()
    {
        //Controles
        if (
            !empty($_POST['add_article']) and
            !empty($_POST['title']) and
            !empty($_POST['sentence']) and
            !empty($_POST['content_article']) and
            $_SESSION['role'] == 'user' |
            $_SESSION['role'] == 'admin'
        ) {

            //J'ajoute le nouvel article
            $articleController = new ArticleController();
            $articleController->addArticle();
        }
    }

    /**
     * Fonction qui permet d'effectuer les controles 
     * lors de la modification d'un article
     *
     * @return void
     */
    public function editArticleControls()
    {
        $flashController = new FlashController();

        //Controles
        if (
            !empty($_POST['edit_article']) and
            !empty($_POST['title']) and
            !empty($_POST['sentence']) and
            !empty($_POST['id_author']) and
            !empty($_POST['content_article']) and
            $_SESSION['role'] == 'admin' |
            $_SESSION['role'] == 'user'
        ) {

            //Alors je modifie l'article
            $articleController = new ArticleController();
            $articleController->editArticle();


            //Redirection en fonction du role 
            if ($_SESSION['role'] == 'admin') {
                header('Location: articles-list');
                $flashController->stabilizeFlash();

            } else {
                header('Location: articles-list-member');
                $flashController->stabilizeFlash();
            }
        }
    }

    /**
     * Fonction qui permet d'effectuer les controles 
     * lors de la suppression d'un article
     *
     * @return void
     */
    public function deleteArticleControls()
    {
        $flashController = new FlashController();
        //Controles
        if (
            !empty($_GET['id_delete_article']) and
            $_SESSION['role'] == 'admin' |
            $_SESSION['role'] == 'user'
        ) {

            //Alors je supprime l'article
            $articleController = new ArticleController();
            $articleController->deleteArticle();



            //Redirection en fonction du role
            if ($_SESSION['role'] == 'admin') {
                header('Location: articles-list');
                $flashController->stabilizeFlash();
            } else {
                header('Location: articles-list-member');
                $flashController->stabilizeFlash();

            }
        }
    }

    /**
     * Fonction qui permet d'effectuer les controles
     * lors de la validation d'un article
     *
     * @return void
     */
    public function validArticleControls()
    {
        //Condition
        if (
            !empty($_GET['valid_article']) and
            $_SESSION['role'] == 'admin'
        ) {
            //alors je valide l'article concerné
            $articleController = new ArticleController();
            $articleController->validArticle();

        }
    }



}