<?php

//Liste des templates
switch ($page) {

        //Page d'accueil
    case 'home':
        //J'affiche le template
        echo $twig->render('templates/home.html.twig', [
            'session' => $_SESSION,
            'resetFlash' => FlashController::purgeFlash()
        ]);
        break;

        //Page de connexion
    case 'login':
        echo $twig->render('templates/member/login.html.twig', [
            'userConnect' => ManagerAuthorController::loginControls(),
            'session' => $_SESSION,
            'resetFlash' => FlashController::purgeFlash()
           

        ]);
        break;

        //Page d'inscription
    case 'registration':
        echo $twig->render('templates/member/registration.html.twig', [
            'addAuthor' => ManagerAuthorController::addAuthorControls(),
            'authors' => AuthorController::allDatabase(), 
            'session' => $_SESSION,
            'resetFlash' => FlashController::purgeFlash()
        ]);
        break;

        //Liste des articles 
    case 'post-list':
        //J'affiche le template
        echo $twig->render('templates/post-list.html.twig', [
            'authors' => ArticleController::findArticleAuthor(), 
            'session' => $_SESSION,
            'resetFlash' => FlashController::purgeFlash()
        ]);
        break;

        //Affiche un article
    case 'post-detail':
        //J'affiche le template
        echo $twig->render('templates/post-detail.html.twig', [
            'addComment' => ManagerCommentController::addCommentControls(),
            'article' => ArticleController::findArticle(), 
            'author' => AuthorController::findAuthor(),
            'comments' => AuthorController::allDatabase(), 
            'session' => $_SESSION,
            'resetFlash' => FlashController::purgeFlash()

        ]);
        break;

        //Admin - liste des articles
    case 'articles-list':
        ///J'affiche le template
        echo $twig->render('templates/admin/articles-list.html.twig', [
            'validArticle' => ManagerArticleController::validArticleControls(),
            'deleteArticle' => ManagerArticleController::deleteArticleControls(),
            'authors' => ArticleController::findArticleAuthor(),
            'session' => $_SESSION,
            'resetFlash' => FlashController::purgeFlash()
        ]);
        break;

        //Admin - Modification d'un article
    case 'article-edit':
        //J'affiche le template
        echo $twig->render('templates/admin/article-edit.html.twig', [
            'article' => ArticleController::findEditArticle(),
            'editArticle' => ManagerArticleController::editArticleControls(),
            'author' => AuthorController::findAuthor(),
            'authors' => AuthorController::findAuthors(),
            'session' => $_SESSION,
            'resetFlash' => FlashController::purgeFlash()
        ]);
        break;

        //Admin - Ajout d'un article
    case 'article-add':
        echo $twig->render('templates/admin/article-add.html.twig', [
            'authors' => AuthorController::findAuthors(),
            'addArticle' => ManagerArticleController::addArticleControls(),
            'session' => $_SESSION,
            'resetFlash' => FlashController::purgeFlash()
        ]);
        break;

        //Admin - liste des commentaires
    case 'comment-list':
        echo $twig->render('templates/admin/comment-list.html.twig', [

            'comments' => AuthorController::allDatabase(),
            'validComment' => ManagerCommentController::validCommentControls(),
            'deleteComment' => ManagerCommentController::deleteCommentControls(),
            'session' => $_SESSION,
            'resetFlash' => FlashController::purgeFlash()

        ]);
        break;

        //Admin - Modification d'un commentaire
    case 'comment-edit':
        echo $twig->render('templates/admin/comment-edit.html.twig', [
            'editComment' => ManagerCommentController::editCommentControls(),
            'comment' => CommentController::findComment(),
            'articles' => ArticleController::findArticles(),
            'session' => $_SESSION,
            'resetFlash' => FlashController::purgeFlash()
        ]);
        break;

        //Admin - Accueil de la page d'administration
    case 'admin-home':
        echo $twig->render('templates/admin/admin-home.html.twig', [
            'session' => $_SESSION,
            'resetFlash' => FlashController::purgeFlash()
        ]);
        break;

        //Admin - Validation des nouvelles inscriptions
    case 'registration-valid':
        echo $twig->render('templates/admin/registration-valid.html.twig', [
            'validAuthor' => ManagerAuthorController::validAuthorControls(),
            'deleteAuthor' => ManagerAuthorController::deleteAuthorControls(),
            'authors' => AuthorController::findAuthors(),
            'session' => $_SESSION,
            'resetFlash' => FlashController::purgeFlash()
        ]);
        break;

        //Admin member - Page d'administration des membres 
    case 'admin-home-member':
        echo $twig->render('templates/member/admin-home-member.html.twig', [
            'session' => $_SESSION,
            'resetFlash' => FlashController::purgeFlash()
        ]);
        break;

        //Admin member - Page de gestion des articles d'un auteur
    case 'articles-list-member':
        echo $twig->render('templates/member/articles-list-member.html.twig', [            
            'deleteArticle' => ManagerArticleController::deleteArticleControls(),
            'authors' => ArticleController::findArticleAuthor(),
            'session' => $_SESSION,
            'resetFlash' => FlashController::purgeFlash()
        ]);
        break;

        //Admin member - Page qui permet d'ajouter un article pour un user
    case 'article-add-member':
        echo $twig->render('templates/member/article-add-member.html.twig', [
            'author' => AuthorController::findAuthor(),
            'addArticle' => ManagerArticleController::addArticleControls(),
            'session' => $_SESSION,
            'resetFlash' => FlashController::purgeFlash()
        ]);
        break;

     //Admin - Modification d'un article
     case 'article-edit-member':
        //J'affiche le template
        echo $twig->render('templates/member/article-edit-member.html.twig', [
            'article' => ArticleController::findEditArticle(),
            'editArticle' => ManagerArticleController::editArticleControls(),
            'authors' => AuthorController::findAuthors(),
            'session' => $_SESSION,
            'resetFlash' => FlashController::purgeFlash()
        ]);
        break;
        

    case 'comment-list-member':
        echo $twig->render('templates/member/comment-list-member.html.twig', [            
            'comments' => AuthorController::allDatabase(),
            'validComment' => ManagerCommentController::validCommentControls(),
            'deleteComment' => ManagerCommentController::deleteCommentControls(),
            'session' => $_SESSION,
            'resetFlash' => FlashController::purgeFlash()

        ]);
        break;

        //Admin - Modification d'un commentaire
    case 'comment-edit-member':
        echo $twig->render('templates/member/comment-edit-member.html.twig', [
            'editComment' => ManagerCommentController::editCommentControls(),
            'comment' => CommentController::findComment(),
            'articles' => ArticleController::findArticles(),
            'session' => $_SESSION,
            'resetFlash' => FlashController::purgeFlash()
        ]);
        break;


        //Page d'erreur 404
    default:
        //J'affiche le template
        echo $twig->render('templates/partials/404.html.twig', [
            'session' => $_SESSION,
            'resetFlash' => FlashController::purgeFlash()
        ]);
        break;
}
