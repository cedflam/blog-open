<?php

//Liste des templates
switch ($page) {

    case 'home':
        //J'affiche le template
        echo $twig->render('templates/home.html.twig', [
            'session'=> $_SESSION
        ]);
        break;

    case 'post-list':
        //J'affiche le template
        echo $twig->render('templates/post-list.html.twig', [
            'authors' => $allDdb           
        ]);
        break;

    case 'post-detail':

        //J'affiche le template
        echo $twig->render('templates/post-detail.html.twig', [
            'article' => $article,
            'author' => $author,
            'comments' => $allDdb,
            
        ]);
        break;

    case 'articles-list':
        ///J'affiche le template
        echo $twig->render('templates/admin/articles-list.html.twig', [
            'authors' => $allDdb,
            'session'=> $_SESSION
        ]);
        break;

    case 'article-edit':
        //J'affiche le template
        echo $twig->render('templates/admin/article-edit.html.twig', [
            'article' => $article,
            'author' => $author,
            'authors' => $authors,
            'session'=> $_SESSION
            
        ]);
        break;

    case 'article-add':
        echo $twig->render('templates/admin/article-add.html.twig', [
            'authors' => $authors,
            'session'=> $_SESSION
        ]);
        break;

    case 'comment-list':
        echo $twig->render('templates/admin/comment-list.html.twig', [
            'comments' => $allDdb,
            'session'=> $_SESSION

        ]);
        break;
    case 'comment-edit':
        echo $twig->render('templates/admin/comment-edit.html.twig', [
            'comment' => $comment,
            'articles' => $articles,
            'session'=> $_SESSION
        ]);
        break;

    case 'admin-home':
        echo $twig->render('templates/admin/admin-home.html.twig',[
            'session'=> $_SESSION
        ]);
        break;

    case 'login':
        echo $twig->render('templates/member/login.html.twig',[
           
        ]);
        break;

    case 'registration':
        echo $twig->render('templates/member/registration.html.twig');
        break;


    default:
        //J'affiche le template
        echo $twig->render('templates/partials/404.html.twig');
        break;
}
