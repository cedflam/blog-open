<?php


class AuthorController
{
    /**
     * fonction qui permet de se connecter
     *
     * @return void
     */
    public static function login()
    {
        //J'attribue les valeurs aux variables 
        $mail = htmlspecialchars($_POST['email']);
        $pass = htmlspecialchars($_POST['hash']);
        //Je lance la requete et je stocke le résultat
        $data = Author::requestLogin($mail);
        //Je stocke le hash de l'objet 
        $hash = $data['hash'];

        //J'appelle la fonction de vérification du password en bdd
        ManagerAuthorController::passwordVerify($pass, $hash, $data);
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

            //Je stock le post dans une variable
            $email = $_POST['email'];
            //Appel de la requete
            $exist = Author::requestEmail($db, $email);
                
            //Si $existe est différent de $email je continue l'inscription
            if ($exist['email'] != $email) {

                //J'ajoute le nouvel Author
                Author::requestAddAuthor($db);

                //Message flash
                FlashController::addFlash(
                    'Votre inscription a réussie, comptez 48h pour que celle-ci soit valide',
                    'success'
                );
                //Redirection de la page
                header('Location: home');
                //Affichage du message avant de le vider
                FlashController::stabilizeFlash();
            }else{
                //Message flash
                FlashController::addFlash(
                    "Cet auteur existe déjà ! Rendez-vous sur la page de connexion", 
                    'danger'
                );
            }
        } else {
            //Message flash
            FlashController::addFlash(
                "Echec ! Les mots de passes doivent être identiques !", 
                'danger'
            );
            
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

        //Je valide le nouvel Author
        Author::requestValidAuthor($id);

        //Message flash 
        FlashController::addFlash("Le nouvel auteur a été validé !", 'success');
        //Redirection 
        header('Location: registration-valid');
        //affichage du message avant de le vider
        FlashController::stabilizeFlash();
    }

    /**
     * fonction qui permet de supprimer un auteur
     *
     * @return void
     */
    public static function deleteAuthor()
    {
        //Je stocke l'id dans une variable 
        $id = $_GET['delete_author'];

        //Je lance la suppression de l'Author
        Author::requestDeleteAuthor($id);

        //Message flash 
        FlashController::addFlash("L'auteur a été supprimé !", 'success');
        //Redirection de la page 
        header('Location: registration-valid');
        //Affichage du message avant de le vider
        FlashController::stabilizeFlash();
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




}
