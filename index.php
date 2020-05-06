<?php
//Début de la session
session_start(); 



/********************Include*************************** */
//Appel des fichiers de config
require_once '_config/config.php';
require_once '_config/db.php';

//Ajout des classes
require_once 'src/Model/Author.php';
require_once 'src/Model/Article.php';
require_once 'src/Model/Comment.php';


//Ajout des managers
require_once 'src/Controller/ManagerArticleController.php';
require_once 'src/Controller/ManagerAuthorController.php';
require_once 'src/Controller/ManagerCommentController.php';
//Ajout des Controllers
require_once 'src/Controller/FlashController.php';
require_once 'src/Controller/ArticleController.php';
require_once 'src/Controller/AuthorController.php';
require_once 'src/Controller/CommentController.php';



require_once 'vendor/autoload.php';


/***********************Page courante********** */

//Je définis la page courante
if (isset($_GET['page']) and !empty($_GET['page'])) {
    $page = trim(strtolower($_GET['page']));
} else {
    $page = 'home';
}

/*************************TWIG***********************************/

// Rendu du template
$loader = new \Twig\Loader\FilesystemLoader(__DIR__, '/templates');

// Activation de l'environnement
$twig = new \Twig\Environment($loader, [
    'cache' => false, // __DIR__, '/tmp'
    'debug' => true,
]);

//Ajout de l'extension de debug twig (dump)
$twig->addExtension(new \Twig\Extension\DebugExtension());

//Ajout du fichier contenant les routes
require_once '_config/route.php';


    
   
 