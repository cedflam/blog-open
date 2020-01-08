<?php

class ArticleController
{

    /**
     * Fonction qui permet de récupérer un article
     * et de l'afficher pour consultation
     *
     * @return void
     */
    public static function findArticle()
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
     * @return void
     */
    public static function findEditArticle(){
        //Je récupère un article
        if (!empty($_GET['id_article'])) {
            //Je stocke l'article dans une variable 
            $id_article = $_GET['id_article'];
            //Je crée un nouvel objet Article
            $article = new Article($id_article);

            //Si id_author de article = l'id de session ou que le role est admin alors...
            if ($article->getId_author() == $_SESSION['id'] | $_SESSION['role'] == 'admin') {
                //Je retourne l'article demandé
                return $article;
            } else {
                //Sinon redirection avec message d'erreur
                ManagerController::addFlash(
                    "Accès refusé ! Vous essayez d'accéder à un article dont vous n'êtes pas l'auteur !", 
                    'danger');
                //Redirection
                header('Location:articles-list-member');
                //affichage du message avant de le vider
                ManagerController::stabilizeFlash();
            }
        }
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
     * Fonction qui permet de récupérer l'ensemble des articles et leurs auteurs
     *
     * @return void
     */
    public static function findArticleAuthor()
    {
        //Connexion à la bdd
        global $db;
        //Requete préparée 
        $reqArticleAuthor = $db->prepare(
            'SELECT * FROM article
        LEFT JOIN author ON article.id_author = author.id_pk_author '
        );
        //J'execute la requete
        $reqArticleAuthor->execute();
        //Je retourne le résultat 
        return $reqArticleAuthor->fetchAll();
    }

    /**
     * Fonction qui permet d'ajouter un article 
     *
     * @return void
     */
    public static function addArticle()
    {

        //Je récupère le post dans des variables 
        $title = htmlspecialchars($_POST['title']);
        $sentence = htmlspecialchars($_POST['sentence']);
        $content_article = htmlspecialchars($_POST['content_article']);
        $id_author = $_SESSION['id'];


        //Connexion à la bdd 
        global $db;

        //Requete préparée 
        $addArticle = $db->prepare(
            'INSERT INTO article (title, sentence, content_article, date_article, id_author, valid_article)
            VALUES (:title, :sentence, :content_article, NOW(), :id_author, false)'
        );

        //J'execute la requete
        $addArticle->execute(array(
            ':title' => $title,
            ':sentence' => $sentence,
            ':content_article' => $content_article,
            ':id_author' => $id_author
        ));

        //Message flash 
        ManagerController::addFlash(
            "L'article à bien été ajouté !, la validation peut prendre 48h !", 
            'success'
        );
        //Redirection de la page
        header('Location: post-list');
        //Affichage du message avant de le vider
        ManagerController::stabilizeFlash();
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
        $id_author = htmlspecialchars($_POST['id_author']);
        $id_article = htmlspecialchars($_POST['edit_article']);

        //Connexion à la bdd 
        global $db;

        //Requete préparée 
        $editArticle = $db->prepare('UPDATE article 
                                    SET title = ?, sentence = ?, content_article = ?, id_author = ?, date_article = NOW(), valid_article = false  
                                    WHERE id_pk_article = ?');

        //J'execute la requete
        $editArticle->execute(array($title, $sentence, $content_article, $id_author, $id_article));

        //Message flash 
        ManagerController::addFlash(
            "L'article à bien été modifié !, La validation peut prendre 48h", 
            'success'
        );

    }

    /**
     * Fonction qui permet de valider un article
     *
     * @return void
     */
    public static function validArticle()
    {
        //Je récupère le get dans une variable 
        $valid_article = $_GET['valid_article'];

        //Connexion à la bdd 
        global $db;

        //Requete préparée 
        $reqValid = $db->prepare('UPDATE article SET valid_article = true WHERE id_pk_article = ?');

        //J'execute la requete 
        $reqValid->execute(array($valid_article));

        //Message flash 
        ManagerController::addFlash(
            "L'article à bien été validé et publié !", 
            'success'
        );

    }

    /**
     * Fonction qui permet de supprimer un article 
     *
     * @return void
     */
    public static function deleteArticle()
    {
        //Je récupère l'id dans une variable 
        $id_delete_article = $_GET['id_delete_article'];
        //Je crée un nouvel objet article 
        $article = new Article($id_delete_article);
        //connexion à la base de données
        global $db;
        //Requete préparée

        $delete = $db->prepare('DELETE FROM article WHERE id_pk_article = ?');

        //J'execute la Requete
        $delete->execute(array($article->getId_pk_article()));

        //Message flash 
        ManagerController::addFlash(
            "L'article à bien été supprimé !", 
            'success'
        );
    }
}
