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
        $this->valid = $data['valid'];
    }

    /**
     * fonction qui permet de s'inscrire 
     *
     * @return void
     */
    public static function addAuthor()
    {
        //Connexion à la bdd 
        global $db;

        //Si les mots de passes sont identiques alors...
        if ($_POST['password'] == $_POST['confirmPassword']) {

            //Je récupère les auteurs 
            $authors = Author::findAuthors();
            //J'initialise la varible $existe
            $existe = false;
            //Je boucle sur les auteurs 
            foreach ($authors as $author) {
                if ($_POST['email'] == $author['email']) {
                    echo 'Cet email existe déjà !';
                    $existe = true;
                }
            }
            //Si $existe = false alors j'enregistre le nouvel auteur
            if ($existe == false) {

                //Requete préparée 
                $addArticle = $db->prepare(

                    'INSERT INTO author (firstName,lastName, hash, email, role, valid)
              VALUES (:firstName, :lastName, :hash, :email, :role, false)'
                );

                //J'execute la requete
                $addArticle->execute(array(
                    ':firstName' => htmlspecialchars($_POST['firstName']),
                    ':lastName' => htmlspecialchars($_POST['lastName']),
                    ':hash' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    ':email' => htmlspecialchars($_POST['email']),
                    ':role' => 'user'
                ));
                //Redirection de la page
                header('Location: home');
            }
        } else {

            //Affiche un message d'erreur si la condition n'est pas remplie
            echo 'Les mots de passes saisis sont différents, essayez à nouveau !';
        }
    }

    /**
     * Fonction qui permet de valider un auteur
     *
     * @return void
     */
    public static function validAuthor($id)
    {

        //Connexion à la bdd 
        global $db;

        //Requete préparée 
        $reqValid = $db->prepare('UPDATE author SET valid = true WHERE id_pk_author = ?');

        //J'execute la requete 
        $reqValid->execute(array($id));

        //Redirection 
        header('Location: registration-valid');
    }

    /**
     * fonction qui permet de supprimer un auteur
     *
     * @param Comment $comment
     * @return void
     */
    public static function deleteAuthor($id)
    {

        //connexion à la base de données
        global $db;
        //Requete préparée
        $delete = $db->prepare('DELETE FROM author WHERE id_pk_author = ?');

        //J'execute la Requete
        $delete->execute(array($id->getId_pk_author()));

        //Redirection de la page 
        header('Location: registration-valid');
    }

    /**
     * fonction qui permet de se connecter 
     *
     * @param String $mail
     * @param String $pass
     * @return String $role
     */
    public static function login($mail, $pass)
    {
        
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
        //Je vérifie le password saisi avec le hash en bdd
        if (password_verify($pass, $hash)) {

            // Je crée un nouvel objet Author
            $authorSession = new Author($data['id_pk_author']);
            //Redirection
            header('Location: home');
            //Je retourne le nouvel objet
            return $authorSession;
        } else {
            //Redirection
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
}
