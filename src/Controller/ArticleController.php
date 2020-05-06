<?php

class ArticleController
{

    /**
     * Fonction qui permet de récupérer un article
     * et de l'afficher pour consultation
     *
     * @return Article
     */
    public function findArticle()
    {
        //Je récupère un article
        if (!empty($_GET['id_article'])) {
            //Je stocke le GET dans une variable
            $id_article = $_GET['id_article'];
            //Je crée un nouvel objet Article
            $article = new Article($id_article);
            //Je retourne l'article
            return $article;

        }
    }

    /**
     * fonction qui permet de récupérer un article pour la modification
     * avec des controles sur le role de l'utilisateur connecté
     *
     *
     * @return Article
     */
    public function findEditArticle()
    {
        //Je récupère un article
        if (!empty($_GET['id_article'])) {
            //Je stocke l'article dans une variable 
            $id_article = $_GET['id_article'];
            //Je crée un nouvel objet Article
            $article = new Article($id_article);

            //Si id_author de article = l'id de session ou que le role est admin alors...
            if ($article->getIdAuthor() == $_SESSION['id'] | $_SESSION['role'] == 'admin') {
                //Je retourne l'article demandé
                return $article;
            } else {
                //Sinon redirection avec message d'erreur
                $flashController = new FlashController();
                $flashController->addFlash(
                    "Accès refusé ! Vous essayez d'accéder à un article dont vous n'êtes pas l'auteur !",
                    'danger');
                //Redirection
                header('Location:articles-list-member');
                //affichage du message avant de le vider
                $flashController->stabilizeFlash();
            }
        }
    }


    /**
     * Fonction qui permet d'ajouter un article
     *
     * @return void
     */
    public function addArticle()
    {
        //Je récupère le post dans des variables 
        $title = htmlspecialchars($_POST['title']);
        $sentence = htmlspecialchars($_POST['sentence']);
        $content_article = htmlspecialchars($_POST['content_article']);
        $id_author = $_SESSION['id'];

        //J'appel la requete
        $article = new Article($id_author);
        $article->requestInsertArticle($title, $sentence, $content_article, $id_author);

        //Message flash
        $flashController = new FlashController();
        $flashController->addFlash(
            "L'article a bien été ajouté !, la validation peut prendre 48h !",
            'success'
        );
        //Redirection de la page
        header('Location: post-list');
        //Affichage du message avant de le vider
        $flashController->stabilizeFlash();
    }

    /**
     * Fonction qui permet de modifier un article
     *
     * @return void
     */
    public function editArticle()
    {
        //J'attribue les valeurs des champs aux variables
        $title = htmlspecialchars($_POST['title']);
        $sentence = htmlspecialchars($_POST['sentence']);
        $id_author = htmlspecialchars($_POST['id_author']);
        $content_article = htmlspecialchars($_POST['content_article']);
        $id_article = htmlspecialchars($_POST['edit_article']);

        //Appel de la requete
        $article = new Article($id_article);
        $article->requestEditArticle($title, $sentence, $id_author, $content_article, $id_article);

        //Message flash
        $flashController = new FlashController();
        $flashController->addFlash(
            "L'article a bien été modifié !, La validation peut prendre 48h",
            'success'
        );

    }

    /**
     * Fonction qui permet de valider un article
     *
     * @return void
     */
    public function validArticle()
    {
        //Je récupère le get dans une variable 
        $valid_article = $_GET['valid_article'];


        //Appel de la requete
        $article = new Article($valid_article);
        $article->requestValidArticle($valid_article);

        //Message flash
        $flashController = new FlashController();
        $flashController->addFlash(
            "L'article a bien été validé et publié !",
            'success'
        );

    }

    /**
     * Fonction qui permet de supprimer un article
     *
     * @return void
     */
    public function deleteArticle()
    {
        //Je récupère l'id dans une variable 
        $id_delete_article = $_GET['id_delete_article'];
        //Je crée un nouvel objet article 
        $article = new Article($id_delete_article);
        //appel de la requete
        $article->requestDeleteArticle($article);

        //Message flash
        $flashController = new FlashController();
        $flashController->addFlash(
            "L'article a bien été supprimé !",
            'success'
        );
    }
}
