<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = "")
        {
            $MovieController = new MovieController();
            $MovieList = $MovieController->getMoviesList();
            $count = 0;
            $count2 = 0;
            require_once(VIEWS_PATH."movie-list.php");
            /* if(!isset($_SESSION["loginUser"])){
                require_once(VIEWS_PATH."login.php");
            }
            else{
                require_once(VIEWS_PATH."movie-list.php");
            } */
        }  
    }
