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

            $comment = new Comment($id_comment);

            return $comment;
        }
    }

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
        //condition
        if (!empty($_POST['add_comment'])) {

            //Je récupère les post dans des variables
            $add_comment = $_POST['add_comment'];
            $content_comment = htmlspecialchars($_POST['content_comment']);
            $name_comment = htmlspecialchars($_POST['name_comment']);

            //Connexion à la bdd 
            global $db;

            //requete préparée
            $addComment = $db->prepare(
                'INSERT INTO comment (content_comment, date_comment, name_comment, valid_comment, id_article)
             VALUES (:content_comment, NOW(), :name_comment, false, :id_article)'
            );

            //J'execute la requete
            $addComment->execute(array(
                ':content_comment' => $content_comment,
                ':name_comment' => $name_comment,
                ':id_article' => $add_comment
            ));

            //Message flash 
            $_SESSION['message'] = "Le commentaire à été soumis, il est en attente de validation par l'administrateur";

            //Redirection de la page
            header('Location: post-list');
            exit;
        }
    }

    /**
     * Fonction qui permet de modifier un commentaire
     *
     * @return void
     */
    public static function editComment()
    {

        //condition
        if (!empty($_POST['edit_comment'])) {

            //Je stock le post dans des variables
            $edit_comment = $_POST['edit_comment'];
            $content_comment = htmlspecialchars($_POST['content_comment']);
            $name_comment = htmlspecialchars($_POST['name_comment']);

            //Connexion à la bdd 
            global $db;

            //Requete préparée 
            $editArticle = $db->prepare('UPDATE comment 
                                    SET content_comment = ?, name_comment = ?   
                                    WHERE id_pk_comment = ?');

            //J'execute la requete
            $editArticle->execute(array($content_comment, $name_comment, $edit_comment));

            //Message flash 
            $_SESSION['message'] = "Le commentaire à bien été modifié !";

            //Redirection de la page
            //Si role admin alors...
            if ($_SESSION['role'] == 'admin') {
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
     * Fonction qui permet de valider un commentaire
     *
     * @return void
     */
    public static function validComment()
    {

        //Condition
        if (!empty($_GET['valid_comment'])) {

            //Je récupère le get dans une variable 
            $valid_comment = $_GET['valid_comment'];

            //Connexion à la bdd 
            global $db;

            //Requete préparée 
            $reqValid = $db->prepare('UPDATE comment SET valid_comment = true WHERE id_pk_comment = ?');

            //J'execute la requete 
            $reqValid->execute(array($valid_comment));

            //Message flash 
            $_SESSION['message'] = "Le commentaire à bien été validé !";

            // Redirection 
            header('Location: comment-list');
            exit;
        }
    }


    /**
     * fonction qui permet d'effacer un commentaire 
     *
     * @param Comment $comment
     * @return void
     */
    public static function deleteComment()
    {

        if (!empty($_GET['id_delete_comment'])) {

            //Je récupère l'id 
            $id_delete = $_GET['id_delete_comment'];
            //Je crée un nouvel objet 
            $comment = new Comment($id_delete);
            //connexion à la base de données
            global $db;
            //Requete préparée
            $delete = $db->prepare('DELETE FROM comment WHERE id_pk_comment = ?');

            //J'execute la Requete
            $delete->execute(array($comment->getId_pk_comment()));

            //Message flash 
            $_SESSION['message'] = "Le commentaire à bien été supprimé !";

            //Redirection de la page 
            //si admin alors...
            if ($_SESSION['role'] == 'admin') {
                header('Location: comment-list');
                exit;
            } else {
                header('Location: comment-list-member');
                exit;
            }
        }
    }
}
