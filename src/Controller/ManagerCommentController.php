<?php 

class ManagerCommentController{

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
                FlashController::stabilizeFlash();
                //Sinon...
            } else {
                header('Location: comment-list-member');
                FlashController::stabilizeFlash();
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
            $_SESSION['role'] == 'admin' | 
            $_SESSION['role'] == 'user'
        ) {

            //Alors je supprime le commentaire
            CommentController::deleteComment();
            //Redirection de la page 
            //si admin alors...
            if ($_SESSION['role'] == 'admin') {
                header('Location: comment-list');
                FlashController::stabilizeFlash();
            } else {
                header('Location: comment-list-member');
                FlashController::stabilizeFlash();
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