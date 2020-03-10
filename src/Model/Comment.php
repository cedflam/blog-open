<?php

class Comment
{

    //Propriétés 
    private $idPkComment;
    private $contentComment;
    private $dateComment;
    private $nameComment;
    private $validComment;
    private $idArticle;
    private $idAuthorComment;

    /**
     * Constructeur
     *
     * @param int $id
     */
    function __construct($id)
    {
        //Variable globale qui permet de se connecter à la bdd 
        global $db;
        //Requete préparée
        $reqComment = $db->prepare(
            'SELECT * 
            FROM comment 
            WHERE id_pk_comment = ?'
        );
        //J'exécute la requete
        $reqComment->execute([$id]);
        // Je stocke le résultat dans une variable 
        $data = $reqComment->fetch();

        //Je paramètre les propriétés du nouvel objet
        $this->idPkComment = $id;
        $this->contentComment = $data['content_comment'];
        $this->dateComment = $data['date_comment'];
        $this->nameComment = $data['name_comment'];
        $this->validComment = $data['valid_comment'];
        $this->idArticle = $data['id_article'];
        $this->idAuthorComment = $data['id_author_comment'];
    }





    /**
     * Get the value of idPkComment
     */
    public function getIdPkComment()
    {
        return $this->idPkComment;
    }

    /**
     * Get the value of idArticle
     */
    public function getIdArticle()
    {
        return $this->idArticle;
    }

    /**
     * Get the value of idAuthorComment
     */
    public function getIdAuthorComment()
    {
        return $this->idAuthorComment;
    }

    /**
     * Get the value of contentComment
     */
    public function getContentComment()
    {
        return $this->contentComment;
    }

    /**
     * Set the value of contentComment
     *
     * @param $contentComment
     * @return  self
     */
    public function setContentComment($contentComment)
    {
        $this->contentComment = $contentComment;

        return $this;
    }

    /**
     * Get the value of dateComment
     */
    public function getDateComment()
    {
        return $this->dateComment;
    }

    /**
     * Set the value of dateComment
     *
     * @param $dateComment
     * @return  self
     */
    public function setDateComment($dateComment)
    {
        $this->dateComment = $dateComment;

        return $this;
    }

    /**
     * Get the value of nameComment
     */
    public function getNameComment()
    {
        return $this->nameComment;
    }

    /**
     * Set the value of nameComment
     *
     * @param $nameComment
     * @return  self
     */
    public function setNameComment($nameComment)
    {
        $this->nameComment = $nameComment;

        return $this;
    }

    /**
     * Get the value of validComment
     */
    public function getValidComment()
    {
        return $this->validComment;
    }

    /**
     * Set the value of validComment
     *
     * @param $validComment
     * @return  self
     */
    public function setValidComment($validComment)
    {
        $this->validComment = $validComment;

        return $this;
    }


    /**
     * Requete qui permet d'ajouter un commentaire dans la base de donnée
     *
     * @param $content_comment
     * @param $name_comment
     * @param $add_comment
     * @param $id_author_comment
     */
    public static function requestAddComment($content_comment, $name_comment, $add_comment, $id_author_comment)
    {
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
    }

    /**
     * Requete qui permet de modifier un commentaire en BDD
     *
     * @param $content_comment
     * @param $name_comment
     * @param $edit_comment
     */
    public static function requestEditComment($content_comment, $name_comment, $edit_comment)
    {
        //Connexion à la bdd
        global $db;

        //Requete préparée
        $editArticle = $db->prepare('UPDATE comment 
                                    SET content_comment = ?, name_comment = ?, valid_comment = ?   
                                    WHERE id_pk_comment = ?');
        //J'execute la requete
        $editArticle->execute(array($content_comment, $name_comment, 0, $edit_comment));
    }

    /**
     * requete qui permet de rendre valide un commentaire en BDD
     *
     * @param $valid_comment
     */
    public static function requestValidComment($valid_comment)
    {
        //Connexion à la bdd
        global $db;

        //Requete préparée
        $reqValid = $db->prepare('UPDATE comment SET valid_comment = true WHERE id_pk_comment = ?');

        //J'execute la requete
        $reqValid->execute(array($valid_comment));
    }

    /**
     * Requete qui permet de supprimer un commentaire de la BDD
     *
     * @param $comment
     *
     */
    public static function requestDeleteComment($comment)
    {
        //connexion à la base de données
        global $db;
        //Requete préparée
        $delete = $db->prepare('DELETE FROM comment WHERE id_pk_comment = ?');

        //J'execute la Requete
        $delete->execute(array($comment->getIdPkComment()));
    }




}
