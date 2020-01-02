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
        if (!empty($_GET['id_comment'])) {

            $id_comment = $_GET['id_comment'];
            $comment = new Comment($id_comment);

            return $comment;
        }
    }

    /**
     * Fonction qui permet d'ajouter un commentaire
     *
     * @return void
     */
    public static function addComment()
    {
        if (!empty($_POST['add_comment'])) {
            //Connexion à la bdd 
            global $db;
            //requete préparée
            $addComment = $db->prepare(
                'INSERT INTO comment (content_comment, date_comment, name_comment, valid, id_article)
             VALUES (:content_comment, NOW(), :name_comment, false, :id_article)'
            );


            //J'execute la requete
            $addComment->execute(array(
                ':content_comment' => htmlspecialchars($_POST['content_comment']),
                ':name_comment' => htmlspecialchars($_POST['name_comment']),
                ':id_article' => $_POST['add_comment']
            ));
            
                    //Redirection de la page
                    header('Location: post-list');
        }
    }

    /**
     * Fonction qui permet de modifier un commentaire
     *
     * @return void
     */
    public static function editComment()
    {
        if (!empty(($_POST['edit_comment']))) {

            //Je récupère l'id 
            $id_comment = $_POST['edit_comment'];
            //J'attribue les valeurs des champs aux variables
            $content_comment = htmlspecialchars($_POST['content_comment']);
            $name_comment = htmlspecialchars($_POST['name_comment']);
            $id_comment = htmlspecialchars($_POST['edit_comment']);


            //Connexion à la bdd 
            global $db;

            //Requete préparée 
            $editArticle = $db->prepare('UPDATE comment 
                                    SET content_comment = ?, name_comment = ?   
                                    WHERE id_pk_comment = ?');

            //J'execute la requete
            $editArticle->execute(array($content_comment, $name_comment, $id_comment));
            //Redirection de la page
            header('Location: comment-list');
        }
    }

    /**
     * Fonction qui permet de valider un commentaire
     *
     * @return void
     */
    public static function validComment()
    {
        if (!empty($_GET['idComment'])) {

            $id = $_GET['idComment'];
            //Connexion à la bdd 
            global $db;

            //Requete préparée 
            $reqValid = $db->prepare('UPDATE comment SET valid = true WHERE id_pk_comment = ?');

            //J'execute la requete 
            $reqValid->execute(array($id));
            // Redirection 
            header('Location: comment-list');
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
        if(!empty($_GET['id_delete_comment'])){

            //Je récupère l'id 
            $id = $_GET['id_delete_comment'];
            //Je crée un nouvel objet 
            $comment = new Comment($id);
            //connexion à la base de données
            global $db;
            //Requete préparée
            $delete = $db->prepare('DELETE FROM comment WHERE id_pk_comment = ?');
            
            //J'execute la Requete
            $delete->execute(array($comment->getId_pk_comment()));
            
            
            //Redirection de la page 
            header('Location: comment-list');
        }
    }
}
