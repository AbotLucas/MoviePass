<?php

    namespace Controllers;

    use Models\Movie as Movie;
    use DAO\MovieDao as MovieDAO;

class MovieController { 

    private $movieDAO;

    public function __construct() {
        $this->movieDAO = new MovieDAO(); 
    }

    public function getAPIList() {
        return $this->movieDAO->getAPI();
    }

    public function listMovies($message = "") {
        require_once(VIEWS_PATH. "movie-list.php");
    }   

}

?>