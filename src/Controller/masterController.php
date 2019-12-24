<?php



//Je récupère tous les articles
$articles = Article::addArticles();
//Je récupère tous les auteurs
$authors = Author::addAuthors();
//Je récupère tous les commentaires
$comments = Comment::addComments();
//Je récupère l'ensemble de la bdd
$allDdb = Author::allDatabase();


/**
 * Fonction qui permet de récupérer un auteur
 *
 * @return Author
 */
function addAuthor()
{     
    if ($_GET['id_author']) {
        
        $id_author = $_GET['id_author'];
        $author = new Author($id_author);

        return $author;
    }
}

/**
 * Fonction qui permet de récupérer un article
 *
 * @return Article
 */
function addArticle()
{
    if ($_GET['id_article']) {

        $id_article = $_GET['id_article'];
        $article = new Article($id_article);

        return $article;
    }
}

