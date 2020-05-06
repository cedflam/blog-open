<?php 

class ManagerAuthorController{

    
    /***********************CONTROLES AUTHOR*************** */

    /**
     * Fonction qui permet de controler les champs 
     * du formaulaire de connexion 
     *
     * @return void
     */
    public function loginControls()
    {
        $authorController = new AuthorController();

        $hash = filter_input(INPUT_POST, 'hash', FILTER_SANITIZE_STRING );
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING );
        //Controles 
        if (!empty($hash) and !empty($email)) {
            //Alors je lance la connexion
            $authorController->login();

        }
    }


    /**
     * Fonction qui permet de comparer le mot de passe saisi
     * avec le mot de passe crypté en bdd 
     *
     * @param string $password
     * @param string $hash
     * @param Author $data
     * @return void
     */
    public function passwordVerify($password, $hash, $data)
    {
        $flashController = new FlashController();

        //Je vérifie le password saisi avec le hash en bdd
        if (password_verify($password, $hash)) {
            //Je crée un nouvel auteur 
            $authorSession = new Author($data['id_pk_author']);
            //J'attribue les valeurs à la session
            $_SESSION['valid'] = $authorSession->getValid();

            //Je test si l'auteur est validé 
            if ($_SESSION['valid'] == true) {
                //Attribution des variables de session
                $_SESSION = [
                    'role' => $authorSession->getRole(),
                    'firstName' => $authorSession->getFirstName(),
                    'lastName' => $authorSession->getLastName(),
                    'id' => $authorSession->getIdPkAuthor(),
                                        
                ];
                //Message flash
                FlashController::addFlash('Vous êtes connecté !', 'success');
                //Redirection
                header('Location: home');
                //Permet l'affichage et la suppression du message flash
                $flashController->stabilizeFlash();
            } else {
                //Message flash
                $flashController->addFlash(
                    "Votre compte n'a pas encore été validé !
                    Vous pouvez contacter l'administrateur 
                    via la formulaire de contact si le délais 
                    est > 48H", 
                    'danger'
                );              
            }

        } else {
            //Message flash
            $flashController->addFlash(
                "Le mot de passe saisi est incorrect !", 
                'danger'
            );
        }
    }

    /**
     * Fonction qui permet d'effectuer les controles
     * lors de l'ajout d'un nouvel auteur
     *
     * @return void
     */
    public function addAuthorControls()
    {
        $flashController = new FlashController();
        //Controles sur les champs
        if (
            !empty($_POST['add_author']) and
            !empty($_POST['password']) and
            !empty($_POST['confirmPassword']) and
            !empty($_POST['firstName']) and
            !empty($_POST['lastName'])
        ) {
            //Je stocke le mot de passe dans une variable
            $lengthPass = $_POST['password'];
            //Si le mot de passe contient moins de 6 caractères
            if (strlen($lengthPass) < 6) {
                //Message flash
                $flashController->addFlash(
                    "Le mot de passe doit contenir au moins 6 caractères !", 
                    'danger'
                );
    
            } else {
                //Sinon j'ajoute un nouvel autheur
                $authorController = new AuthorController();
                $authorController->addAuthor();
            }
        }
    }

    /**
     * Fonction qio permet d'effectuer les controles
     * lors de la suppression d'un auteur
     *
     * @return void
     */
    public function deleteAuthorControls()
    {

        //Controles 
        if (
            !empty($_GET['delete_author']) and
            $_SESSION['role'] == 'admin'
        ) {
            //Alors je supprime l'auteur
            $authorcontroller = new AuthorController();
            $authorcontroller->deleteAuthor();

        }
    }

    /**
     * Fonction qui permet d'effectuer les controles
     * lors de lma validation d'une inscription par l'admin
     *
     * @return void
     */
    public function validAuthorControls()
    {

        //Controles
        if (
            !empty($_GET['valid_author']) and
            $_SESSION['role'] == 'admin'
        ) {
            //Alors je valide l'inscription
            $authorController = new AuthorController();
            $authorController->validAuthor();

        }
    }

}