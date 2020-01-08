<?php


class AuthorController
{
    /**
     * fonction qui permet de se connecter 
     *
     * @param String $mail
     * @param String $pass
     * @return Author 
     */
    public static function login()
    {
        //J'attribue les valeurs aux variables 
        $mail = htmlspecialchars($_POST['email']);
        $pass = htmlspecialchars($_POST['hash']);
        //Connexion à la bdd 
        global $db;
        //Requete préparée 
        $req = $db->prepare('SELECT * FROM author WHERE email = ?');
        //J'execute la requete 
        $req->execute([$mail]);
        //Je stocke le résultat 
        $data = $req->fetch();
        //Je stocke le hash de l'objet 
        $hash = $data['hash'];

        //J'appelle la fonction de vérification du password en bdd
        ManagerController::passwordVerify($pass, $hash, $data);

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
        if (htmlspecialchars($_POST['password']) === htmlspecialchars($_POST['confirmPassword'])) {

           
            $email = htmlspecialchars($_POST['email']);
            $existe = $db->prepare('SELECT email FROM author WHERE email = ?');
            $existe->execute(array($email));
               
            //Si $existe est vide je crée le nouvel author
            if ($existe != $email) {

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
                //Message flash
                $_SESSION['message'] = 'Votre inscription à réussie, comptez 48h pour que celle-ci soit valide';
                //Redirection de la page
                header('Location: home');
                exit;
            }
        } else {
            //Message flash
            $_SESSION['message'] = "Echec ! Les mots de passes doivent être identiques !";
        }
    }

    /**
     * Fonction qui permet de valider l'inscription d'un nouvel auteur
     *
     * @return void
     */
    public static function validAuthor()
    {
        //Je stocke l'id dans une variable
        $id = $_GET['valid_author'];

        //Connexion à la bdd 
        global $db;

        //Requete préparée 
        $reqValid = $db->prepare('UPDATE author SET valid = true WHERE id_pk_author = ?');

        //J'execute la requete 
        $reqValid->execute(array($id));

        //Message flash 
        $_SESSION['message'] = 'Le nouvel auteur à été validé !';

        //Redirection 
        header('Location: registration-valid');
        exit;
    }

    /**
     * fonction qui permet de supprimer un auteur
     *
     * @param Comment $comment
     * @return void
     */
    public static function deleteAuthor()
    {
        //Je stocke l'id dans une variable 
        $id = $_GET['delete_author'];

        //connexion à la base de données
        global $db;

        //Requete préparée
        $delete = $db->prepare('DELETE FROM author WHERE id_pk_author = ?');

        //J'execute la Requete
        $delete->execute(array($id));

        //Message flash 
        $_SESSION['message'] = "L'auteur à été supprimé !";

        //Redirection de la page 
        header('Location: registration-valid');
        exit;
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
        if (!empty($_GET['id_author'])) {

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
}
