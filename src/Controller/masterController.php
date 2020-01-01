<?php

/**********************************CONNEXION UTILISATEUR**************** */
if (!empty($_POST['login'])) {
    $authorSession =  Author::login(htmlspecialchars($_POST['email']), htmlspecialchars($_POST['hash']));
    //Je récupère la variable de compte validé ou non 
    $_SESSION['valid'] = $authorSession->getValid();
    //Vérifie si le compte utilisateur à été validé
    if ($_SESSION['valid'] == true) {
        //Si le compte est valide alors...
        $_SESSION['role'] = $authorSession->getRole();
        $_SESSION['firstName'] = $authorSession->getFirstName();
        $_SESSION['lastName'] = $authorSession->getLastName();

    }else{

        echo "Votre compte n'a pas encore été validé !";
    }
}

/**************************ACCES A LA BASE DE DONNEES********************* */

//Je récupère tous les articles
$articles = Article::findArticles();
//Je récupère un article
if (!empty($_GET['id_article'])) {
    $article = Article::findArticle();
}

//Je récupère tous les auteurs
$authors = Author::findAuthors();
//Je récupère un auteur
if (!empty($_GET['id_author'])) {
    $author = Author::findAuthor();
}

//Je récupère tous les commentaires
$comments = Comment::findComments();
//Je récupère un commentaire
if (!empty($_GET['id_comment'])) {
    $comment = Comment::findComment();
}

//Je récupère l'ensemble de la bdd
$allDdb = Author::allDatabase();


/**********************************CRUD****************************** */

/***Articles***/

//Déclenche la modification d'un article
if (!empty($_POST['editArticle'])) {
    Article::editArticle();
}

//Déclenche l'ajout d'un article
if (!empty($_POST['addArticle'])) {
    Article::addArticle();
}

//Déclenche la suppression d'un article
if (!empty($_GET['id_delete_article'])) {
    $article = new Article($_GET['id_delete_article']);
    Article::deleteArticle($article);
}

/***Commentaires***/

//Déclenche l'ajout d'un commentaire 
if (!empty($_POST['addComment'])) {
    Comment::addComment();
}

//Déclenche la validation d'un commentaire
if (!empty($_GET['idComment'])) {
    Comment::validComment($_GET['idComment']);
}

//Déclenche la modification d'un commentaire 
if (!empty($_POST['modComment'])) {
    Comment::editComment($_POST['modComment']);
}

//Déclenche la suppression d'un commentaire
if (!empty($_GET['id_delete_comment'])) {
    $comment = new Comment($_GET['id_delete_comment']);
    Comment::deleteComment($comment);
}

/***Auteur***/

//Déclenche l'ajout d'un auteur
if (!empty($_POST['addAuthor'])) {
    Author::addAuthor();
}

//Déclenche la validation d'un auteur
if (!empty($_GET['validAuthor'])) {
    Author::validAuthor($_GET['validAuthor']);
}

//Déclenche la suppression d'un auteur
if (!empty($_GET['deleteAuthor'])) {
    $author = new Author($_GET['deleteAuthor']);
   Author::deleteAuthor($author);
}