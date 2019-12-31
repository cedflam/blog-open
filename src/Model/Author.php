<?php

class Author
{

    //Propriétés
    private $id_pk_author;
    private $firstName;
    private $lastName;
    private $hash;
    private $email;
    private $role;


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
            FROM author 
            WHERE id_pk_author = ?'
        );
        //J'exécute la requete
        $reqAuthor->execute([$id]);
        // Je stocke le résultat dans une variable 
        $data = $reqAuthor->fetch();

        //Je paramètre les propriétés du nouvel objet
        $this->id_pk_author = $id;
        $this->firstName = $data['firstName'];
        $this->lastName = $data['lastName'];
        $this->hash = $data['hash'];
        $this->email = $data['email'];
        $this->role = $data['role'];
    }

    /**
     * fonction qui permet de se connecter 
     *
     * @param String $mail
     * @param String $pass
     * @return String $role
     */
    public static function login($mail, $pass){

        //Connexion à la bdd 
        global $db;
        //Requete préparée 
        $req = $db->prepare('SELECT * FROM author WHERE email = ?');
        //J'execute la requete 
        $req->execute([$mail]);
        //Je stocke le résultat 
        $data = $req->fetch();
        //Je stocke les valeurs de l'objet dans des variables
        $hash = $data['hash'];

        if ($hash == $pass){
            
            $role = $data['role'];
            header('Location: admin-home');
            return $role;
            
        }else{
                    
            header('Location: login');
        }

        
    }

    /**
     * Fonction qui permet de récupérer tous les auteurs
     *
     * @return void
     */
    public static function findAuthors()
    {
        //Variable globale qui permet de se connecter à la bdd 
        global $db;
        // Requete préparée
        $reqAuthors = $db->prepare('SELECT * FROM author');
        //J'exécute la requete
        $reqAuthors->execute();
        //Je retourne le résultat
        return $reqAuthors->fetchAll();
    }

    /**
     * Fonction qui permet de récupérer un auteur
     *
     * @return Author
     */
    public static function findAuthor()
    {
        if ($_GET['id_author']) {

            $id_author = $_GET['id_author'];
            $author = new Author($id_author);

            return $author;
        }
    }


    /**
     * Fonction qui permet de récupérer les données
     * de l'ensemble des tables de la bdd
     *
     * @return void
     */
    public static function allDatabase()
    {
        //Variable globale qui permet de se connecter à la bdd
        global $db;
        // Requete préparée 
        $reqAllDatabase = $db->prepare('SELECT * FROM author 
        LEFT JOIN article ON author.id_pk_author = article.id_author
        LEFT JOIN comment ON comment.id_article = article.id_pk_article 
        ORDER BY date_article DESC');
        //J'éxecute la requete
        $reqAllDatabase->execute();
        //Je retourne le résultat
        return $reqAllDatabase->fetchAll();
    }






    /**
     * Get the value of firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @return  self
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @return  self
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of hash
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set the value of hash
     *
     * @return  self
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of id_pk_author
     */
    public function getId_pk_author()
    {
        return $this->id_pk_author;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }
}
