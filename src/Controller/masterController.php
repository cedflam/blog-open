<?php



//Je récupère tous les articles
$articles = Article::findArticles();
//Je récupère tous les auteurs
$authors = Author::findAuthors();
//Je récupère tous les commentaires
$comments = Comment::findComments();
//Je récupère l'ensemble de la bdd
$allDdb = Author::allDatabase();



/**
 * Fonction qui permet de récupérer un auteur
 *
 * @return Author
 */
function findAuthor()
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
function findArticle()
{
    if ($_GET['id_article']) {

        $id_article = $_GET['id_article'];
        $article = new Article($id_article);

        return $article;
    }
}

//Déclenche la modification d'un article
if (!empty($_POST['editArticle'])) {
    Article::editArticle();
}

//Déclenche l'ajout d'un article
if (!empty($_POST['addArticle'])) {
    Article::addArticle();
}

//Déclenche l'ajout d'un commentaire
if (!empty($_POST['addComment'])) {
    Comment::addComment();
}

//Déclenche la suppression d'un article
if (!empty($_GET['id_delete_article'])) {
    $article = new Article($_GET['id_delete_article']);
    Article::deleteArticle($article);     
}