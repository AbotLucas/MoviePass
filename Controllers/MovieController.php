<?php

    namespace Controllers;

use DAO\MovieBdDao;
use Models\Movie as Movie;
    use DAO\MovieDao as MovieDAO;
use DAO\ScreeningBdDAO;

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
    
    public function ShowMovieSheet($id_movie) {
        $screeningList = ScreeningBdDAO::GetScreeningsFromMovie($id_movie);
        $movie = MovieBdDao::MapearMovie($id_movie);

        $movieInArray = $this->movieDAO->GetFullMovieInfoFromJson($id_movie);


        /* $movieVideo = 


        https://www.youtube.com/watch?v= */
        require_once(VIEWS_PATH. "movie-sheet.php");
    }

}

?>