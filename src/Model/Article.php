<?php

class Article
{

    //propriétés
    private $idPkArticle;
    private $title;
    private $sentence;
    private $contentArticle;
    private $dateArticle;
    private $idAuthor;


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
        $reqAuthor = $db->prepare(
            'SELECT * 
            FROM article 
            WHERE id_pk_article = ?'
        );
        //J'exécute la requete
        $reqAuthor->execute([$id]);
        // Je stocke le résultat dans une variable 
        $data = $reqAuthor->fetch();

        //Je paramètre les propriétés du nouvel objet
        $this->idPkArticle = $id;
        $this->title = $data['title'];
        $this->sentence = $data['sentence'];
        $this->contentArticle = $data['content_article'];
        $this->dateArticle = $data['date_article'];
        $this->idAuthor = $data['id_author'];
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of sentence
     */
    public function getSentence()
    {
        return $this->sentence;
    }

    /**
     * Set the value of sentence
     *
     * @return  self
     */
    public function setSentence($sentence)
    {
        $this->sentence = $sentence;

        return $this;
    }   

    /**
     * Get the value of idPkArticle
     */ 
    public function getIdPkArticle()
    {
        return $this->idPkArticle;
    }

    /**
     * Get the value of contentArticle
     */ 
    public function getContentArticle()
    {
        return $this->contentArticle;
    }

    /**
     * Set the value of contentArticle
     *
     * @return  self
     */ 
    public function setContentArticle($contentArticle)
    {
        $this->contentArticle = $contentArticle;

        return $this;
    }

    /**
     * Get the value of dateArticle
     */ 
    public function getDateArticle()
    {
        return $this->dateArticle;
    }

    /**
     * Set the value of dateArticle
     *
     * @return  self
     */ 
    public function setDateArticle($dateArticle)
    {
        $this->dateArticle = $dateArticle;

        return $this;
    }

    /**
     * Get the value of idAuthor
     */ 
    public function getIdAuthor()
    {
        return $this->idAuthor;
    }

    /**
     * Set the value of idAuthor
     *
     * @return  self
     */ 
    public function setIdAuthor($idAuthor)
    {
        $this->idAuthor = $idAuthor;

        return $this;
    }
}
