<?php 

class Session{

    public function __construct(){

    }

    public function setflash($message){
        $_SESSION['message'] = $message;
    }

    public function flash(){
        if(isset($_SESSION['message'])){

            unset($_SESSION['message']);
        }
    }

    /**
     * Fonction qui permet de réinitialiser les messages flashs
     *
     * @return void
     */
    public static function purgeFlash()
    {
        if (!empty($_SESSION['message'])) {

            unset($_SESSION['message']);
        }
    }

    
}