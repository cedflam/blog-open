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
        if (!empty($_SESSION['message'])) {

            unset($_SESSION['message']);
        }
    }
    

    /**
     * fonction permet l'affichage et la suppression des messages flashs
     * 
     *
     * @return void
     */
    public static function stabilizeFlash(){
        try{
            exit(1);
        }catch(Exception $e){
            echo 'Erreur de redirection : '.$e->getMessage();
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
            ArticleController::editArticle();

            //Redirection en fonction du role 
            if ($_SESSION['role'] == 'admin') {
                header('Location: articles-list');
                ManagerController::stabilizeFlash();
            } else {
                header('Location: articles-list-member');
                ManagerController::stabilizeFlash();
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
        //Controles
        if (
            !empty($_GET['id_delete_article']) and
            $_SESSION['role'] == 'admin' |
            $_SESSION['role'] == 'user'
        ) {

            //Alors je supprime l'article 
            ArticleController::deleteArticle();


            //Redirection en fonction du role
            if ($_SESSION['role'] == 'admin') {
                header('Location: articles-list');
                ManagerController::stabilizeFlash();
            } else {
                header('Location: articles-list-member');
                ManagerController::stabilizeFlash();
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

        //controles 
        //Condition
        if (
            !empty($_GET['valid_article']) and
            $_SESSION['role'] == 'admin'
        ) {

            //alors je valide l'article concerné
            ArticleController::validArticle();
        }
    }

    /***********************CONTROLES AUTHOR*************** */

    /**
     * Fonction qui permet de controler les champs 
     * du formaulaire de connexion 
     *
     * @return void
     */
    public static function loginControls(){
        //Controles 
        if (!empty($_POST['hash']) and !empty($_POST['email'])) {
            //Alors je lance la connexion
            AuthorController::login();
        }
    }


    /**
     * Fonction qui permet de comparer le mot de passe saisi
     * avec le mot de passe crypté en bdd 
     *
     * @param string $password
     * @param string $hash
     * @param Author $data
     * @return void
     */
    public static function passwordVerify($password, $hash, $data){
        //Je vérifie le password saisi avec le hash en bdd
        if (password_verify($password, $hash)) {
            //Je crée un nouvel auteur 
            $authorSession = new Author($data['id_pk_author']);
            //J'attribue les valeurs à la session
            $_SESSION['valid'] = $authorSession->getValid();

            //Je test si l'auteur est validé 
            if ($_SESSION['valid'] == true) {
                //Attribution des variables de session
                $_SESSION = [
                    'role' => $authorSession->getRole(),
                    'firstName' => $authorSession->getFirstName(),
                    'lastName' => $authorSession->getLastName(),
                    'id' => $authorSession->getId_pk_author(),
                    'message' => 'Vous êtes connecté !'
                ];

                //Redirection
                header('Location: home');
                //Permet l'affichage et la suppression du message flash
                ManagerController::stabilizeFlash();
            } else {
                //Message flash
                $_SESSION['message'] = "Votre compte n'a pas encore été validé !
                                             Vous pouvez contacter l'administrateur 
                                             via la formulaire de contact si le délais 
                                             est > 48H";
            }
        } else {
            //Message flash
            $_SESSION['message'] = 'Le mot de passe saisi est incorrect !';
        }
    
    }

    /**
     * Fonction qui permet d'effectuer les controles
     * lors de l'ajout d'un nouvel auteur
     *
     * @return void
     */
    public static function addAuthorControls()
    {
        //Controles 
        if (
            !empty($_POST['add_author']) and
            !empty($_POST['password']) and
            !empty($_POST['firstName']) and
            !empty($_POST['lastName'])
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

        //Controles 
        if (
            !empty($_GET['delete_author']) and
            $_SESSION['role'] == 'admin'
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

        //Controles
        if (
            !empty($_GET['valid_author']) and
            $_SESSION['role'] == 'admin'
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

        //Controles 
        //condition
        if (
            !empty($_POST['add_comment']) and
            !empty($_POST['name_comment']) and
            !empty($_POST['content_comment']) and
            $_SESSION['role'] == 'user' | $_SESSION['role'] == 'admin'
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

        //Controles 
        //condition
        if (
            !empty($_POST['edit_comment']) and
            !empty($_POST['name_comment']) and
            !empty($_POST['content_comment']) and
            $_SESSION['role'] == 'user' | $_SESSION['role'] == 'admin'
        ) {

            //Alors je modifie le commentaire
            CommentController::editComment();
            //Redirection de la page
            //Si role admin alors...
            if ($_SESSION['role'] == 'admin') {
                header('Location: comment-list');
                ManagerController::stabilizeFlash();
                //Sinon...
            } else {
                header('Location: comment-list-member');
                ManagerController::stabilizeFlash();
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

        //Controles 
        if (
            !empty($_GET['id_delete_comment']) and
            $_SESSION['role'] == 'admin'
        ) {

            //Alors je supprime le commentaire
            CommentController::deleteComment();
            //Redirection de la page 
            //si admin alors...
            if ($_SESSION['role'] == 'admin') {
                header('Location: comment-list');
                ManagerController::stabilizeFlash();
            } else {
                header('Location: comment-list-member');
                ManagerController::stabilizeFlash();
            }
        }
    }
    /**
     * Permet d'effectuer les controles lors de la 
     * validation d'un commentaire par l'administrateur
     *
     * @return void
     */
    public static function validCommentControls()
    {

        //Controles 
        //Condition
        if (
            !empty($_GET['valid_comment']) and
            $_SESSION['role'] == 'admin'
        ) {

            //Alors je valide le commentaire
            CommentController::validComment();
        }
    }



   
}
