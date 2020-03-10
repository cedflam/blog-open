<?php

class CommentController
{




    /**
     * Fonction qui permet de récupérer un commentaire
     *
     * @return Comment
     */
    public static function findComment()
    {
        //Je récupère le get dans une variable
        $id_comment = $_GET['id_comment'];

        //condition
        if (!empty($id_comment)) {

            //Nouvel objet Comment
            $comment = new Comment($id_comment);

            //condition si id_author_comment = l'id de session ou role = admin alors...
            if ($comment->getIdAuthorComment() == $_SESSION['id'] | $_SESSION['role'] == 'admin') {
                //Je retourne le commentaire demandé
                return $comment;
            } else {
                //Sinon redirection avec message d'erreur
                FlashController::addFlash(
                    "Accès refusé ! Vous essayez d'accéder à un commentaire dont vous n'êtes pas l'auteur !", 
                    'danger');

                //redirection
                header('Location:comment-list-member');
                //Affichage du message avant de le vider
                FlashController::stabilizeFlash();

            }
        }
    }

    /**
     * Fonction qui permet d'ajouter un commentaire
     *
     * @return void
     */
    public static function addComment()
    {
        //Je récupère les post dans des variables
        $add_comment = $_POST['add_comment'];
        $content_comment = htmlspecialchars($_POST['content_comment']);
        $name_comment = htmlspecialchars($_POST['name_comment']);
        $id_author_comment = $_SESSION['id'];

        //J'appel la requete
        Comment::requestAddComment($content_comment, $name_comment, $add_comment, $id_author_comment);

        //Message flash 
        FlashController::addFlash(
            "Le commentaire a été soumis, il est en attente de validation par l'administrateur",
            'success');

        //Redirection de la page
        header('Location: post-list');
        //Affichage du message avant de le vider
        FlashController::stabilizeFlash();
    }


    /**
     * Fonction qui permet de modifier un commentaire
     *
     * @return void
     */
    public static function editComment()
    {
        //Je stock le post dans des variables
        $edit_comment = $_POST['edit_comment'];
        $content_comment = htmlspecialchars($_POST['content_comment']);
        $name_comment = htmlspecialchars($_POST['name_comment']);

        //J'appel la requete
        Comment::requestEditComment($content_comment, $name_comment, $edit_comment);

        //Message flash 
        FlashController::addFlash(
            "Le commentaire a bien été modifié ! Il sera de nouveau valide sous 48H",
            'success');
    }


    /**
     * Fonction qui permet de valider un commentaire
     *
     * @return void
     */
    public static function validComment()
    {
        //Je récupère le get dans une variable 
        $valid_comment = $_GET['valid_comment'];

        //Je lance la requete
        Comment::requestValidComment($valid_comment);

        //Message flash 
        FlashController::addFlash(
            "Le commentaire a bien été validé !",
            'success');
        
    }


    /**
     * fonction qui permet d'effacer un commentaire
     *
     * @return void
     */
    public static function deleteComment()
    {

        //Je récupère l'id 
        $id_delete = $_GET['id_delete_comment'];
        //Je crée un nouvel objet 
        $comment = new Comment($id_delete);

        //J'appelle la requete de suppression du commentaire
        Comment::requestDeleteComment($comment);
        
        //Message flash 
        FlashController::addFlash(
            "Le commentaire a bien été supprimé !",
            'success');

    }

    /**
     * fonction qui permet d'envoyer un mail depuis le formulaire de contact
     * @return void
     */
    public static function sendMail()
    {
        //condition
        if (isset($_POST['sendMail']) and
            !empty($_POST['name']) and
            !empty($_POST['email']) and
            !empty($_POST['message']))
        {
            //Je récupère les informations postées
            $name = htmlspecialchars($_POST['name']);
            $message = htmlspecialchars($_POST['message']);
            $from = htmlspecialchars($_POST['email']);
            //Paramétrage des autres variables
            $to = 'cedflam@gmail.com';
            $subject = "Vous avez une nouvelle demande d'information de votre Blog";
            $message = "Message de : ". $name . "\r\nEmail : ".$from. "\r\nMessage : ".$message;
            //Envoi de l'email
            mail($to, $subject, $message);

            //Message flash
            FlashController::addFlash(
                "Votre email a bien été envoyé !",
                'success');
        }


    }
}
