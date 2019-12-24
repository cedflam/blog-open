<?php

class Article
{

    //propriétés
    private $id_pk_article;
    private $title;
    private $sentence;
    private $content_article;
    private $date_article;
    private $id_author;


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
        $this->id_pk_article = $id;
        $this->title = $data['title'];
        $this->sentence = $data['sentence'];
        $this->content_article = $data['content_article'];
        $this->date_article = $data['date_article'];
        $this->id_author = $data['id_author'];
    }

    /**
     * Fonction qui permet de récupérer tous les articles
     *
     * @return void
     */
    public static function addArticles()
    {
        //Variable globale qui permet de se connecter à la bdd 
        global $db;
        // Requete préparée
        $reqArticles = $db->prepare('SELECT * FROM article ORDER BY date_article DESC');
        //J'exécute la requete
        $reqArticles->execute();
        //Je retourne le résultat
        return $reqArticles->fetchAll();
    }

    /**
     * Fonction qui permet de modifier un article
     *
     * @param int $id_article
     * @return void
     */
    public static function editArticle($id_article){
        //Connexion à la base de données
        global $db;
        //requete préparée
        $editArticle = $db->prepare(
            'UPDATE title, sentence, firstName, lastName , content_article 
            FROM article
            INNER JOIN author ON article.id_author = author.id_pk_author
            WHERE id_pk_article = ?');
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
     * Get the value of id_author
     */
    public function getId_author()
    {
        return $this->id_author;
    }

    /**
     * Get the value of date_article
     */
    public function getDate_article()
    {
        return $this->date_article;
    }

    /**
     * Set the value of date_article
     *
     * @return  self
     */
    public function setDate_article($date_article)
    {
        $this->date_article = $date_article;

        return $this;
    }

    /**
     * Get the value of content_article
     */
    public function getContent_article()
    {
        return $this->content_article;
    }

    /**
     * Set the value of content_article
     *
     * @return  self
     */
    public function setContent_article($content_article)
    {
        $this->content_article = $content_article;

        return $this;
    }

    /**
     * Get the value of id_pk_article
     */
    public function getId_pk_article()
    {
        return $this->id_pk_article;
    }
}
