<?php 

//Liste des templates
switch ($page) {

    case 'home':
        //J'affiche le template
        echo $twig->render('templates/home.html.twig', []);
        break;

    case 'post-list':
        //J'affiche le template
        echo $twig->render('templates/post-list.html.twig', [
            'authors' => $allDdb,
        ]);
        break;

    case 'post-detail':           
        
        //J'affiche le template
        echo $twig->render('templates/post-detail.html.twig', [
            'article' => findArticle(),
            'author' => findAuthor(),
            'comments' => $allDdb
        ]);
        break;

    case 'articles-list':
        ///J'affiche le template
        echo $twig->render('templates/admin/articles-list.html.twig', [
            'authors' => $allDdb
        ]);
        break;

    case 'article-edit':        
        //J'affiche le template
        echo $twig->render('templates/admin/article-edit.html.twig', [
            'article' => findArticle(),
            'author' => findAuthor(),
            'authors' => $authors
        ]);
        break;

    case 'article-add':
        echo $twig->render('templates/admin/article-add.html.twig', [
            'authors' => $authors
        ]);
        break;

  
        
    default:
        //J'affiche le template
        echo $twig->render('templates/partials/404.html.twig');
        break;
}


