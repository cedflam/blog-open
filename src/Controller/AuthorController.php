<?php


class AuthorController
{
    /**
     * fonction qui permet de se connecter
     *
     * @return void
     */
    public function login()
    {
        //J'attribue les valeurs aux variables 
        $mail = htmlspecialchars($_POST['email']);
        $pass = htmlspecialchars($_POST['hash']);
        //Je lance la requete et je stocke le résultat
        $author = new Author(null);
        $data = $author->requestLogin($mail);
        //Je stocke le hash de l'objet 
        $hash = $data['hash'];

        //J'appelle la fonction de vérification du password en bdd
        $managerAuthorController = new ManagerAuthorController();
        $managerAuthorController->passwordVerify($pass, $hash, $data);
    }



    /**
     * fonction qui permet de s'inscrire 
     *
     * @return void
     */
    public function addAuthor()
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
                $flashController = new FlashController();
                $flashController->addFlash(
                    'Votre inscription a réussie, comptez 48h pour que celle-ci soit valide',
                    'success'
                );
                //Redirection de la page
                header('Location: home');
                //Affichage du message avant de le vider
                $flashController->stabilizeFlash();
            }else{
                //Message flash
                $flashController = new FlashController();
                $flashController->addFlash(
                    "Cet auteur existe déjà ! Rendez-vous sur la page de connexion", 
                    'danger'
                );
            }
        } else {
            //Message flash
            $flashController = new FlashController();
            $flashController->addFlash(
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
    public function validAuthor()
    {
        //Je stocke l'id dans une variable
        $id = $_GET['valid_author'];

        //Je valide le nouvel Author
        $author = new Author($id);
        $author->requestValidAuthor($id);

        //Message flash
        $flashController = new FlashController();
        $flashController->addFlash("Le nouvel auteur a été validé !", 'success');
        //Redirection 
        header('Location: registration-valid');
        //affichage du message avant de le vider
        $flashController->stabilizeFlash();
    }

    /**
     * fonction qui permet de supprimer un auteur
     *
     * @return void
     */
    public function deleteAuthor()
    {
        //Je stocke l'id dans une variable 
        $id = $_GET['delete_author'];

        //Je lance la suppression de l'Author
        $author = new Author($id);
        $author->requestDeleteAuthor($id);

        //Message flash
        $flashController = new FlashController();
        $flashController->addFlash("L'auteur a été supprimé !", 'success');
        //Redirection de la page 
        header('Location: registration-valid');
        //Affichage du message avant de le vider
        $flashController->stabilizeFlash();
    }



    /**
     * Fonction qui permet de récupérer un auteur
     *
     * @return Author
     */
    public function findAuthor()
    {
        if (!empty($_GET['id_author'])) {

            $id_author = $_GET['id_author'];
            $author = new Author($id_author);

            return $author;
        }
    }




}
