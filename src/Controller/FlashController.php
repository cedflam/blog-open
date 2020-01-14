<?php 

class FlashController{

     /******************MESSAGES FLASHS *********************/    

    /**
     * Fonction qui permet de parametrer un message flash
     *
     * @param string $message
     * @param string $type
     * @return void
     */
    public static function addFlash($message, $type){
        //J'attribue les variables reçues à la session
        $_SESSION['message'] = $message;
        $_SESSION['type'] = $type;  

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


    /**
     * fonction permet l'affichage des messages flash
     * 
     *
     * @return void
     */
    public static function stabilizeFlash()
    {
        try {
            exit;
        } catch (Exception $e) {
            echo 'Erreur de redirection : ' . $e->getMessage();
        }
    }

}