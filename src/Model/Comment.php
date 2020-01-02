<?php

class Comment
{

    //Propriétés 
    private $id_pk_comment;
    private $content_comment;
    private $date_comment;
    private $name_comment;
    private $valid;
    private $id_article;


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
        $this->id_pk_comment = $id;
        $this->content_comment = $data['content_comment'];
        $this->date_comment = $data['date_comment'];
        $this->name_comment = $data['name_comment'];
        $this->valid = $data['valid'];
        $this->id_article = $data['id_article'];
    }



    /**
     * Get the value of id_article
     */
    public function getId_article()
    {
        return $this->id_article;
    }

    /**
     * Get the value of content_comment
     */
    public function getContent_comment()
    {
        return $this->content_comment;
    }

    /**
     * Set the value of content_comment
     *
     * @return  self
     */
    public function setContent_comment($content_comment)
    {
        $this->content_comment = $content_comment;

        return $this;
    }

    /**
     * Get the value of date_comment
     */
    public function getDate_comment()
    {
        return $this->date_comment;
    }

    /**
     * Set the value of date_comment
     *
     * @return  self
     */
    public function setDate_comment($date_comment)
    {
        $this->date_comment = $date_comment;

        return $this;
    }

    /**
     * Get the value of id_pk_comment
     */
    public function getId_pk_comment()
    {
        return $this->id_pk_comment;
    }

    /**
     * Get the value of name_comment
     */
    public function getName_comment()
    {
        return $this->name_comment;
    }

    /**
     * Set the value of name_comment
     *
     * @return  self
     */
    public function setName_comment($name_comment)
    {
        $this->name_comment = $name_comment;

        return $this;
    }
}
