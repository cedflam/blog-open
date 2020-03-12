<?php

class Author
{

    //Propriétés
    private $idPkAuthor;
    private $firstName;
    private $lastName;
    private $hash;
    private $email;
    private $role;
    private $valid;

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
            'SELECT id_pk_author, firstName, lastName, hash, email, role, valid 
            FROM author 
            WHERE id_pk_author = ?'
        );
        //J'exécute la requete
        $reqAuthor->execute([$id]);
        // Je stocke le résultat dans une variable 
        $data = $reqAuthor->fetch();

        //Je paramètre les propriétés du nouvel objet
        $this->idPkAuthor = $id;
        $this->firstName = $data['firstName'];
        $this->lastName = $data['lastName'];
        $this->hash = $data['hash'];
        $this->email = $data['email'];
        $this->role = $data['role'];
        $this->valid = $data['valid'];
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

    /**
     * Get the value of valid
     */
    public function getValid()
    {
        return $this->valid;
    }

    /**
     * Set the value of valid
     *
     * @return  self
     */
    public function setValid($valid)
    {
        $this->valid = $valid;

        return $this;
    }

    /**
     * Get the value of idPkAuthor
     */
    public function getIdPkAuthor()
    {
        return $this->idPkAuthor;
    }

    /**
     * Requete qui permet de récupérer un Author par son email
     *
     * @param $mail
     * @return mixed
     */
    public function requestLogin($mail)
    {
        //Connexion à la bdd
        global $db;
        //Requete préparée
        $req = $db->prepare('
        SELECT id_pk_author, firstName, lastName, hash, email, role, valid
        FROM author WHERE email = ?
        ');
        //J'execute la requete
        $req->execute([$mail]);
        //Je stocke le résultat
        $data = $req->fetch();
        //Je retourne l'auteur
        return $data;
    }

    /**
     * Requete qui permet de récupérer un email
     *
     * @param $db
     * @param $email
     * @return mixed
     */
    public static function requestEmail($db, $email)
    {
        //Requete préparée
        $exist = $db->prepare('SELECT email FROM author WHERE email = ?');
        //J'execute la requete
        $exist->execute(array($email));
        //Je stocke le résultat
        $exist = $exist->fetch();

        return $exist;
    }

    /**
     * Requete qui permet d'ajouter un nouvel Author
     *
     * @param $db
     */
    public static function requestAddAuthor($db)
    {
        //Requete préparée
        $addArticle = $db->prepare(
            'INSERT INTO author (firstName,lastName, hash, email, role, valid)
                         VALUES (:firstName, :lastName, :hash, :email, :role, false)'
        );

        //J'execute la requete
        $addArticle->execute(array(
            ':firstName' => htmlspecialchars($_POST['firstName']),
            ':lastName' => htmlspecialchars($_POST['lastName']),
            ':hash' => password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT),
            ':email' => filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL),
            ':role' => 'user'
        ));
    }

    /**
     * Requete qui permet de valider un nouvel Author
     *
     * @param $id
     */
    public function requestValidAuthor($id)
    {
        //Connexion à la bdd
        global $db;

        //Requete préparée
        $reqValid = $db->prepare('UPDATE author SET valid = true WHERE id_pk_author = ?');

        //J'execute la requete
        $reqValid->execute(array($id));
    }

    /**
     * Requete qui permet de supprimer un Author
     *
     * @param $id
     */
    public function requestDeleteAuthor($id)
    {
        //connexion à la base de données
        global $db;

        //Requete préparée
        $delete = $db->prepare('DELETE FROM author WHERE id_pk_author = ?');

        //J'execute la Requete
        $delete->execute(array($id));
    }

    /**
     * Fonction qui permet de récupérer tous les auteurs
     *
     * @return array
     */
    public static function findAuthors()
    {

        //Variable globale qui permet de se connecter à la bdd
        global $db;
        // Requete préparée
        $reqAuthors = $db->prepare('
        SELECT id_pk_author, firstName, lastName, hash, email, role, valid FROM author');
        //J'exécute la requete
        $reqAuthors->execute();
        //Je retourne le résultat
        return $reqAuthors->fetchAll();
    }

    /**
     * Fonction qui permet de récupérer les données
     * de l'ensemble des tables de la bdd
     *
     * @return array
     */
    public static function allDatabase()
    {
        //Variable globale qui permet de se connecter à la bdd
        global $db;
        // Requete préparée
        $reqAllDatabase = $db->prepare('
        SELECT id_pk_author, firstName, lastName, hash, email, role, valid, 
               id_pk_comment, content_comment, date_comment, name_comment, valid_comment, id_article, id_author_comment, 
               id_pk_article, title, sentence, content_article, date_article, id_author, valid_article
        FROM author 
        LEFT JOIN article ON author.id_pk_author = article.id_author
        LEFT JOIN comment ON comment.id_article = article.id_pk_article 
        ORDER BY date_article DESC');
        //J'éxecute la requete
        $reqAllDatabase->execute();
        //Je retourne le résultat
        return $reqAllDatabase->fetchAll();
    }
}
