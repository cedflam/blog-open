<?php


class ManagerController
{

    /******************MESSAGES FLASHS *********************/

    /**
     * Fonction qui permet de réinitialiser les messages flashs
     *
     * @return void
     */
    public static function purgeFlash()
    {
        //Propriété
        $message = $_SESSION['message'];
        //Condition
        if (!empty($message)) {

            unset($_SESSION['message']);
        }
    }

    /*******************CONTROLES ARTICLE***************** */


    /**
     * Fonction qui permet d'effectuer les controles
     * lors de l'ajout d'un article
     *
     * @return void
     */
    public static function addArticleControls()
    {
        //Propriétés
        $add_article = $_POST['add_article'];
        $title = $_POST['title'];
        $sentence = $_POST['sentence'];
        $content_article = $_POST['content_article'];
        //Controles
        if (
            !empty($add_article) and
            !empty($title) and
            !empty($sentence) and
            !empty($content_article) and
            $_SESSION['role'] == 'user' |
            $_SESSION['role'] == 'admin'
        ) {

            //J'ajoute le nouvel article
            ArticleController::addArticle();
        }
    }

    /**
     * Fonction qui permet d'effectuer les controles 
     * lors de la modification d'un article
     *
     * @return void
     */
    public static function editArticleControls()
    {
        //Propriétés
        $edit_article = $_POST['edit_article'];
        $title = $_POST['title'];
        $sentence = $_POST['sentence'];
        $id_author = $_POST['id_author'];
        $content_article = $_POST['content_article'];
        $role = $_SESSION['role'];

        //Controles
        if (
            !empty($edit_article) and
            !empty($title) and
            !empty($sentence) and
            !empty($id_author) and
            !empty($content_article) and
            $role == 'admin' |
            $role == 'user'
        ) {

            //Alors je modifie l'article 
            ArticleController::editArticle();

            //Redirection en fonction du role 
            if ($_SESSION['role'] == 'admin') {
                header('Location: articles-list');
                exit;
            } else {
                header('Location: articles-list-member');
                exit;
            }
        }
    }

    /**
     * Fonction qui permet d'effectuer les controles 
     * lors de la suppression d'un article
     *
     * @return void
     */
    public static function deleteArticleControls()
    {

        //Propriétés
        $id_delete_article = $_GET['id_delete_article'];
        $role = $_SESSION['role'];

        //Controles
        if (
            !empty($id_delete_article) and
            $role == 'admin' |
            $role == 'user'
        ) {

            //Alors je supprime l'article 
            ArticleController::deleteArticle();


            //Redirection en fonction du role
            if ($role == 'admin') {
                header('Location: articles-list');
                exit;
            } else {
                header('Location: articles-list-member');
                exit;
            }
        }
    }

    /**
     * Fonction qui permet d'effectuer les controles
     * lors de la validation d'un article
     *
     * @return void
     */
    public static function validArticleControls()
    {

        //Propriétés 
        $valid_article = $_GET['valid_article'];
        $role = $_SESSION['role'];
        //Condition
        if (
            !empty($valid_article) and
            $role == 'admin'
        ) {

            //alors je valide l'article concerné
            ArticleController::validArticle();
        }
    }

    /***********************CONTROLES AUTHOR*************** */

    /**
     * Fonction qui permet d'effectuer les controles
     * lors de l'ajout d'un nouvel auteur
     *
     * @return void
     */
    public static function addAuthorControls()
    {
        //Propriétés 
        $add_author = $_POST['add_author'];
        $password = $_POST['password'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        //Controles 
        if (
            !empty($add_author) and
            !empty($password) and
            !empty($firstName) and
            !empty($lastName)
        ) {

            //Alors j'ajoute un nouvel autheur
            AuthorController::addAuthor();
        }
    }

    /**
     * Fonction qio permet d'effectuer les controles
     * lors de la suppression d'un auteur
     *
     * @return void
     */
    public static function deleteAuthorControls()
    {
        //Propriétés 
        $delete_author = $_GET['delete_author'];
        $role = $_SESSION['role'];
        //Controles 
        if (
            !empty($delete_author) and
            $role == 'admin'
        ) {
            //Alors je supprime l'auteur 
            AuthorController::deleteAuthor();
        }
    }

    /**
     * Fonction qui permet d'effectuer les controles
     * lors de lma validation d'une inscription par l'admin
     *
     * @return void
     */
    public static function validAuthorControls()
    {

        //Propriétés 
        $valid_author = $_GET['valid_author'];
        $role = $_SESSION['role'];
        //Controles
        if (
            !empty($valid_author) and
            $role == 'admin'
        ) {
            //Alors je valide l'inscription
            AuthorController::validAuthor();
        }
    }


    /********************CONTROLES COMMENT************** */

    /**
     * Fonction qui permet d'effectuer les controles
     * lors de l'ajout d'un commentaire
     *
     * @return void
     */
    public static function addCommentControls()
    {

        //Propriétés 
        $add_comment = $_POST['add_comment'];
        $name_comment = $_POST['name_comment'];
        $content_comment = $_POST['content_comment'];
        $role = $_SESSION['role'];
        //condition
        if (
            !empty($add_comment) and
            !empty($name_comment) and
            !empty($content_comment) and
            $role == 'user' | $role == 'admin'
        ) {

            //Alors j'ajoute le nouveau commentaire 
            CommentController::addComment();
        }
    }


    /**
     * Fonction qui permet d'effectuer les controles
     * lors de la modification d'un commentaire
     *
     * @return void
     */
    public static function editCommentControls()
    {

        //Propriétés 
        $edit_comment = $_POST['edit_comment'];
        $name_comment = $_POST['name_comment'];
        $content_comment = $_POST['content_comment'];
        $role = $_SESSION['role'];
        
        //condition
        if (
            !empty($edit_comment) and
            !empty($name_comment) and
            !empty($content_comment) and
            $role == 'user' | $role == 'admin'
        ) {

            //Alors je modifie le commentaire
            CommentController::editComment();
            //Redirection de la page
            //Si role admin alors...
            if ($role == 'admin') {
                header('Location: comment-list');
                exit;
                //Sinon...
            } else {
                header('Location: comment-list-member');
                exit;
            }
        }
    }


    /**
     * Fonction qui permet d'effectuer les controles
     * lors de la suppression d'un commentaire
     *
     * @return void
     */
    public static function deleteCommentControls()
    {

        //Propriétés 
        $id_delete_comment = $_GET['id_delete_comment'];
        $role = $_SESSION['role'];
        //Controles 
        if (
            !empty($id_delete_comment) and
            $role == 'admin'
        ) {

            //Alors je supprime le commentaire
            CommentController::deleteComment();
            //Redirection de la page 
            //si admin alors...
            if ($role == 'admin') {
                header('Location: comment-list');
                exit;
            } else {
                header('Location: comment-list-member');
                exit;
            }
        }
    }

    public static function validCommentControls()
    {

        //Propriétés
        $valid_comment = $_GET['valid_comment'];
        $role = $_SESSION['role'];
        //Condition
        if (
            !empty($valid_comment) and
            $role == 'admin'
        ) {

            //Alors je valide le commentaire
            CommentController::validComment();
        }
    }
}
