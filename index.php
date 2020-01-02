<?php
session_start(); 

/********************Include*************************** */
//Appel des fichiers de config
require '_config/config.php';
require '_config/db.php';

//Ajout des classes
require 'src/Model/Author.php';
require 'src/Model/Article.php';
require 'src/Model/Comment.php';


//Ajout du controller 
require 'src/Controller/ArticleController.php';
require 'src/Controller/AuthorController.php';
require 'src/Controller/CommentController.php';



require 'vendor/autoload.php';


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
require '_config/route.php';


    
   
 