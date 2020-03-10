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
     * @param $title
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
     * @param $sentence
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
     * @param $contentArticle
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
     * @param $dateArticle
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
     * @param $idAuthor
     * @return  self
     */
    public function setIdAuthor($idAuthor)
    {
        $this->idAuthor = $idAuthor;

        return $this;
    }

    /**
     * requete qui permet de récupérer l'ensembles des articles
     * @return array
     */
    public static function findArticles()
    {
        //Variable globale qui permet de se connecter à la bdd
        global $db;
        // Requete préparée
        $reqArticles = $db->prepare('SELECT 
                                                id_pk_article,
                                                title,
                                                sentence,
                                                content_article,
                                                date_article,
                                                id_author,
                                                valid_article
                                               FROM article 
                                               ORDER BY date_article DESC');
        //J'exécute la requete
        $reqArticles->execute();
        //Je retourne le résultat
        return $reqArticles->fetchAll();
    }


    /**
     * Requete qui permet de récupérer un Article lié à un Author
     * @return array
     */
    public static function findArticleAuthor()
    {
        //Connexion à la bdd
        global $db;
        //Requete préparée
        $reqArticleAuthor = $db->prepare(
            'SELECT id_pk_article,
                              title,
                              sentence,
                              content_article,
                              date_article,
                              id_author,
                              valid_article
                        FROM article
                        LEFT JOIN author ON article.id_author = author.id_pk_author '
        );
        //J'execute la requete
        $reqArticleAuthor->execute();
        //Je retourne le résultat
        return $reqArticleAuthor->fetchAll();
    }

    /**
     * Requete qui permet d'ajouter un nouvel article dans la BDD
     *
     * @param $title
     * @param $sentence
     * @param $content_article
     * @param $id_author
     */
    public static function requestInsertArticle($title, $sentence, $content_article, $id_author)
    {
        //Connexion à la bdd
        global $db;
        //Requete préparée
        $addArticle = $db->prepare(
            'INSERT INTO article (title, sentence, content_article, date_article, id_author, valid_article)
            VALUES (:title, :sentence, :content_article, NOW(), :id_author, false)'
        );
        //J'execute la requete
        $addArticle->execute(array(
            ':title' => $title,
            ':sentence' => $sentence,
            ':content_article' => $content_article,
            ':id_author' => $id_author
        ));
    }

    /**
     * Requete qui permet de modifier un article en BDD
     *
     * @param $title
     * @param $sentence
     * @param $content_article
     * @param $id_author
     * @param $id_article
     */
    public static function requestEditArticle($title, $sentence, $content_article, $id_author, $id_article)
    {
        //Connexion à la bdd
        global $db;
        //Requete préparée
        $editArticle = $db->prepare('UPDATE article 
                                    SET title = ?, sentence = ?, content_article = ?, id_author = ?, date_article = NOW(), valid_article = false  
                                    WHERE id_pk_article = ?');
        //J'execute la requete
        $editArticle->execute(array($title, $sentence, $content_article, $id_author, $id_article));
    }

    /**
     * Requete qui permetr de valider un article en BDD
     *
     * @param $valid_article
     */
    public static function requestValidArticle($valid_article)
    {
        //Connexion à la bdd
        global $db;

        //Requete préparée
        $reqValid = $db->prepare('UPDATE article SET valid_article = true WHERE id_pk_article = ?');

        //J'execute la requete
        $reqValid->execute(array($valid_article));
    }

    /**
     * Requete qui permet de supprimer un article en BDD
     *
     * @param $article
     */
    public static function requestDeleteArticle($article)
    {
        //connexion à la base de données
        global $db;
        //Requete préparée
        $delete = $db->prepare('DELETE FROM article WHERE id_pk_article = ?');

        //J'execute la Requete
        $delete->execute(array($article->getIdPkArticle()));
    }
}
