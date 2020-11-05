<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = "")
        {
            /*require_once(VIEWS_PATH."movie-list.php");*/
            if(!isset($_SESSION["loginUser"])){
                require_once(VIEWS_PATH."login.php");
            }
            else{
                require_once(VIEWS_PATH."movie-list.php");
            }
        }        
        public function MostrarHome($message = "")
        {
            require_once(VIEWS_PATH."movie-list.php");
        }
    }
?>