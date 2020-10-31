<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = "")
        {
            /*require_once(VIEWS_PATH."movie-list.php");*/
            require_once(VIEWS_PATH."login.php");
        }        
        public function MostrarHome($message = "")
        {
            require_once(VIEWS_PATH."movie-list.php");
        }
    }
?>