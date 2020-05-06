<?php

//Controllers
$authorController = new AuthorController();
$articleController = new ArticleController();
$commentController = new CommentController();
$flashController = new FlashController();
//ManagerControllers
$managerAuthorController = new ManagerAuthorController();
$managerArticleController = new ManagerArticleController();
$managerCommentController = new ManagerCommentController();


//Liste des templates
switch ($page) {

        //Page d'accueil
    case 'home':
    //J'affiche le template
    echo $twig->render('templates/home.html.twig', [
        'sendMail' => $commentController->sendMail(),
        'session' => $_SESSION,
        'resetFlash' => $flashController->purgeFlash()
    ]);
    break;

        //Page de connexion
    case 'login':
        echo $twig->render('templates/member/login.html.twig', [
            'userConnect' => $managerAuthorController->loginControls(),
            'session' => $_SESSION,
            'resetFlash' => $flashController->purgeFlash()

        ]);
        break;

        //Page d'inscription
    case 'registration':
        echo $twig->render('templates/member/registration.html.twig', [
            'addAuthor' => $managerAuthorController->addAuthorControls(),
            'authors' => Author::allDatabase(),
            'session' => $_SESSION,
            'resetFlash' => $flashController->purgeFlash()
        ]);
        break;

        //Liste des articles 
    case 'post-list':
        //J'affiche le template
        echo $twig->render('templates/post-list.html.twig', [
            'authors' => Article::findArticleAuthor(),
            'session' => $_SESSION,
            'resetFlash' => $flashController->purgeFlash()
        ]);
        break;

        //Affiche un article
    case 'post-detail':
        //J'affiche le template
        echo $twig->render('templates/post-detail.html.twig', [
            'addComment' => $managerCommentController->addCommentControls(),
            'article' => $articleController->findArticle(),
            'author' => $authorController->findAuthor(),
            'comments' => Author::allDatabase(),
            'session' => $_SESSION,
            'resetFlash' => $flashController->purgeFlash()

        ]);
        break;

        //Admin - liste des articles
    case 'articles-list':
        ///J'affiche le template
        echo $twig->render('templates/admin/articles-list.html.twig', [
            'validArticle' => $managerArticleController->validArticleControls(),
            'deleteArticle' => $managerArticleController->deleteArticleControls(),
            'authors' => Article::findArticleAuthor(),
            'session' => $_SESSION,
            'resetFlash' => $flashController->purgeFlash()
        ]);
        break;

        //Admin - Modification d'un article
    case 'article-edit':
        //J'affiche le template
        echo $twig->render('templates/admin/article-edit.html.twig', [
            'article' => $articleController->findEditArticle(),
            'editArticle' => $managerArticleController->editArticleControls(),
            'author' => $authorController->findAuthor(),
            'authors' => Author::findAuthors(),
            'session' => $_SESSION,
            'resetFlash' => $flashController->purgeFlash()
        ]);
        break;

        //Admin - Ajout d'un article
    case 'article-add':
        echo $twig->render('templates/admin/article-add.html.twig', [
            'authors' => Author::findAuthors(),
            'addArticle' => $managerArticleController->addArticleControls(),
            'session' => $_SESSION,
            'resetFlash' => $flashController->purgeFlash()
        ]);
        break;

        //Admin - liste des commentaires
    case 'comment-list':
        echo $twig->render('templates/admin/comment-list.html.twig', [

            'comments' => Author::allDatabase(),
            'validComment' => $managerCommentController->validCommentControls(),
            'deleteComment' => $managerCommentController->deleteCommentControls(),
            'session' => $_SESSION,
            'resetFlash' => $flashController->purgeFlash()

        ]);
        break;

        //Admin - Modification d'un commentaire
    case 'comment-edit':
        echo $twig->render('templates/admin/comment-edit.html.twig', [
            'editComment' => $managerCommentController->editCommentControls(),
            'comment' => $commentController->findComment(),
            'articles' => Article::findArticles(),
            'session' => $_SESSION,
            'resetFlash' => $flashController->purgeFlash()
        ]);
        break;

        //Admin - Accueil de la page d'administration
    case 'admin-home':
        echo $twig->render('templates/admin/admin-home.html.twig', [
            'session' => $_SESSION,
            'resetFlash' => $flashController->purgeFlash()
        ]);
        break;

        //Admin - Validation des nouvelles inscriptions
    case 'registration-valid':
        echo $twig->render('templates/admin/registration-valid.html.twig', [
            'validAuthor' => $managerAuthorController->validAuthorControls(),
            'deleteAuthor' => $managerAuthorController->deleteAuthorControls(),
            'authors' => Author::findAuthors(),
            'session' => $_SESSION,
            'resetFlash' => $flashController->purgeFlash()
        ]);
        break;

        //Admin member - Page d'administration des membres 
    case 'admin-home-member':
        echo $twig->render('templates/member/admin-home-member.html.twig', [
            'session' => $_SESSION,
            'resetFlash' => $flashController->purgeFlash()
        ]);
        break;

        //Admin member - Page de gestion des articles d'un auteur
    case 'articles-list-member':
        echo $twig->render('templates/member/articles-list-member.html.twig', [            
            'deleteArticle' => $managerArticleController->deleteArticleControls(),
            'authors' => Article::findArticleAuthor(),
            'session' => $_SESSION,
            'resetFlash' => $flashController->purgeFlash()
        ]);
        break;

        //Admin member - Page qui permet d'ajouter un article pour un user
    case 'article-add-member':
        echo $twig->render('templates/member/article-add-member.html.twig', [
            'author' => $authorController->findAuthor(),
            'addArticle' => $managerArticleController->addArticleControls(),
            'session' => $_SESSION,
            'resetFlash' => $flashController->purgeFlash()
        ]);
        break;

     //Admin - Modification d'un article
     case 'article-edit-member':
        //J'affiche le template
        echo $twig->render('templates/member/article-edit-member.html.twig', [
            'article' => $articleController->findEditArticle(),
            'editArticle' => $managerArticleController->editArticleControls(),
            'authors' => Author::findAuthors(),
            'session' => $_SESSION,
            'resetFlash' => $flashController->purgeFlash()
        ]);
        break;
        

    case 'comment-list-member':
        echo $twig->render('templates/member/comment-list-member.html.twig', [            
            'comments' => Author::allDatabase(),
            'validComment' => $managerCommentController->validCommentControls(),
            'deleteComment' => $managerCommentController->deleteCommentControls(),
            'session' => $_SESSION,
            'resetFlash' => $flashController->purgeFlash()

        ]);
        break;

        //Admin - Modification d'un commentaire
    case 'comment-edit-member':
        echo $twig->render('templates/member/comment-edit-member.html.twig', [
            'editComment' => $managerCommentController->editCommentControls(),
            'comment' => $commentController->findComment(),
            'articles' => Article::findArticles(),
            'session' => $_SESSION,
            'resetFlash' => $flashController->purgeFlash()
        ]);
        break;


        //Page d'erreur 404
    default:
        //J'affiche le template
        echo $twig->render('templates/partials/404.html.twig', [
            'session' => $_SESSION,
            'resetFlash' => $flashController->purgeFlash()
        ]);
        break;
}
