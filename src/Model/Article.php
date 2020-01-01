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
    public static function findArticles()
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
     * Fonction qui permet de récupérer un article
     *
     * @return Article
     */
    public static function findArticle()
    {
        if ($_GET['id_article']) {

            $id_article = $_GET['id_article'];
            $article = new Article($id_article);

            return $article;
        }
    }

    /**
     * Fonction qui permet d'ajouter un article 
     *
     * @return void
     */
    public static function addArticle()
    {
        //Connexion à la bdd 
        global $db;
        
        //Requete préparée 
        $addArticle = $db->prepare(
            'INSERT INTO article 
                        (title,
                        sentence, 
                        content_article,
                        date_article,
                        id_author)
            VALUES (
                        :title, 
                        :sentence, 
                        :content_article, 
                        NOW(), 
                        :id_author)'
                    );


        //J'execute la requete
        $addArticle->execute(array(
            ':title' => htmlspecialchars($_POST['title']),
            ':sentence' => htmlspecialchars($_POST['sentence']),
            ':content_article' => htmlspecialchars($_POST['content_article']),
            ':id_author' => $_POST['id_author']

        ));



        //Redirection de la page
        header('Location: post-list');
    }

    /**
     * Fonction qui permet de modifier un article
     *
     * @return void
     */
    public static function editArticle()
    {
        //J'attribue les valeurs des champs aux variables
        $title = htmlspecialchars($_POST['title']);
        $sentence = htmlspecialchars($_POST['sentence']);
        $id_author = htmlspecialchars($_POST['id_author']);
        $content_article = htmlspecialchars($_POST['content_article']);
        $id_article = htmlspecialchars($_POST['id_article']);


        //Connexion à la bdd 
        global $db;

        //Requete préparée 
        $editArticle = $db->prepare('UPDATE article 
                                    SET title = ?, sentence = ?, content_article = ?, id_author = ?, date_article = NOW()  
                                    WHERE id_pk_article = ?');

        //J'execute la requete
        $editArticle->execute(array($title, $sentence, $content_article, $id_author, $id_article));

        //Redirection de la page
        header('Location: articles-list');
    }

    /**
     * Fonction qui permet de supprimer un article 
     *
     * @return void
     */
    public static function deleteArticle($article)
    {
        //connexion à la base de données
        global $db;
        //Requete préparée

        $delete = $db->prepare('DELETE FROM article WHERE id_pk_article = ?');

        //J'execute la Requete
        $delete->execute(array($article->getId_pk_article()));

        //Redirection de la page 
        header('Location: articles-list');
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
