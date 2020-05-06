<?php
//Je lance une nouvelle session
session_start();
//Je détruit la session actuelle
session_destroy();
//Je redirige vers la page de connexion
header('Location: ../login');
exit;
