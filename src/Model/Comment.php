<?php 

class Comment{

    //Propriétés 
    private $id_pk_comment;
    private $content_comment;
    private $date_comment;
    private $name_comment;
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
        $this->name_comment = $data['name'];
        $this->id_article = $data['id_article'];        
    }

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
        $reqComments = $db->prepare('SELECT * FROM comment ORDER BY date_comment DESC');
        //J'exécute la requete
        $reqComments->execute();
        //Je retourne le résultat
        return $reqComments->fetchAll();
    }

    public static function addComment(){

        //Connexion à la bdd 
        global $db;
        //requete préparée
        $addComment = $db->prepare('INSERT INTO comment 
                                            (content_comment, 
                                            date_comment, 
                                            name_comment, 
                                            id_article)

                                    VALUES (
                                        :content_comment,
                                        NOW(),
                                        :name_comment,
                                        :id_article)'
                                        );
         

        //J'execute la requete
        $addComment->execute(array(
        ':content_comment'=> htmlspecialchars($_POST['content_comment']),
        ':name_comment'=> htmlspecialchars($_POST['name_comment']),
        ':id_article'=> $_POST['id_article']
         ));
            
            
        //Redirection de la page
        header('Location: post-list');
       
    }

   


    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
}