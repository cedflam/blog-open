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
     * @return  self
     */ 
    public function setValidComment($validComment)
    {
        $this->validComment = $validComment;

        return $this;
    }
}
