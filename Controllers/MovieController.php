<?php

    namespace Controllers;

use DAO\CinemaBdDao;
use DAO\GenreBdDAO;
use DAO\MovieBdDao as MovieBdDao;
    use Models\Movie as Movie;
    use DAO\MovieDao as MovieDAO;
    use DAO\ScreeningBdDAO;
use Models\Genre;

class MovieController { 

    private $movieDAO;
    private $movieBdDao;

    public function __construct() {
        $this->movieDAO = new MovieDAO(); 
        $this->movieBdDao = new MovieBdDao(); 
    }

    public function getMoviesList() {

        /* $genreBdDao = new GenreBdDAO();
        $listGenres = $genreBdDao->GetGenresFromAPI(); */

        return $this->movieBdDao->getAllMoviesWithScreening();
    }

    public function listMovies($message = "") {
        $MovieController = new MovieController();
        $MovieList = $MovieController->getMoviesList();
        $count = 0;
        $count2 = 0;
        require_once(VIEWS_PATH. "movie-list.php");
    }
    
    public function ShowMovieSheet($id_movie) {
        //$screeningList = ScreeningBdDAO::GetScreeningsFromMovie($id_movie);
        $movie = MovieBdDao::MapearMovie($id_movie);

        $screeningController = new ScreeningController();
        $screeningList = $screeningController->GetAllScreeningsFromMovie($id_movie);
        $cinemaName = $screeningList[0]->getRoom()->getCinema()->getName();

        require_once(VIEWS_PATH. "movie-sheet.php");
    }

    public function GetMoviesWithoutScreening($id_room) {
        return $this->movieBdDao->GetMoviesWithOutScreening($id_room);
    }

}
