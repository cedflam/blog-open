<?php

class CommentController
{

    /**
     * Fonction qui permet de récupérer tous les commentaires
     *
     * @return void
     */
    public static function findComments()
    {
        //Variable globale qui permet de se connecter à la bdd 
        global $db;

        // Requete préparée
        $reqComments = $db->prepare('SELECT * FROM comment ORDER BY id_pk_comment DESC');

        //J'exécute la requete
        $reqComments->execute();

        //Je retourne le résultat
        return $reqComments->fetchAll();


    }

    /**
     * Fonction qui permet de récupérer un commentaire
     *
     * @return Article
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
     * fonction qui permet de récupérer les auteurs et les commentaires liés
     *
     * @return void
     */
    public static function findAuthorComment()
    {
        $id = $_SESSION['id'];
        //connexion à la bdd 
        global $db;
        // Requete préparée 
        $reqAuthorComment = $db->prepare(
            'SELECT * FROM `comment` 
        left join article on comment.id_article = id_article
        left join author on article.id_author = author.id_pk_author
        where id_pk_author = ?'
        );
        //J'execute la requete 
        $reqAuthorComment->execute(array($id));
        //Je retourne le résultat 
        return $reqAuthorComment->fetchAll();
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

        //Connexion à la bdd 
        global $db;

        //requete préparée
        $addComment = $db->prepare(
            'INSERT INTO comment (content_comment, date_comment, name_comment, valid_comment, id_article, id_author_comment)
             VALUES (:content_comment, NOW(), :name_comment, false, :id_article, :id_author_comment)'
        );

        //J'execute la requete
        $addComment->execute(array(
            ':content_comment' => $content_comment,
            ':name_comment' => $name_comment,
            ':id_article' => $add_comment,
            ':id_author_comment' => $id_author_comment
        ));

        //Message flash 
        FlashController::addFlash(
            "Le commentaire à été soumis, il est en attente de validation par l'administrateur", 
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
        


        //Connexion à la bdd 
        global $db;

        //Requete préparée 
        $editArticle = $db->prepare('UPDATE comment 
                                    SET content_comment = ?, name_comment = ?, valid_comment = ?   
                                    WHERE id_pk_comment = ?');

        //J'execute la requete
        $editArticle->execute(array($content_comment, $name_comment, 0, $edit_comment));

        //Message flash 
        FlashController::addFlash(
            "Le commentaire à bien été modifié ! Il sera de nouveau valide sous 48H", 
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

        //Connexion à la bdd 
        global $db;

        //Requete préparée 
        $reqValid = $db->prepare('UPDATE comment SET valid_comment = true WHERE id_pk_comment = ?');

        //J'execute la requete 
        $reqValid->execute(array($valid_comment));

        //Message flash 
        FlashController::addFlash(
            "Le commentaire à bien été validé !", 
            'success');
        
    }


    /**
     * fonction qui permet d'effacer un commentaire 
     *
     * @param Comment $comment
     * @return void
     */
    public static function deleteComment()
    {

        //Je récupère l'id 
        $id_delete = $_GET['id_delete_comment'];
        //Je crée un nouvel objet 
        $comment = new Comment($id_delete);
        //connexion à la base de données
        global $db;
        //Requete préparée
        $delete = $db->prepare('DELETE FROM comment WHERE id_pk_comment = ?');

        //J'execute la Requete
        $delete->execute(array($comment->getIdPkComment()));
        
        //Message flash 
        FlashController::addFlash(
            "Le commentaire à bien été supprimé !", 
            'success');

    }
}
