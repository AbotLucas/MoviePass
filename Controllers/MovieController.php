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
        /* Levanto los genres y dates de las screening para el filterform */
        $screeningController = new ScreeningController();
        $genresOfScreenings = $screeningController->GetGenresOfScreenings();
        $datesOfScreenings = $screeningController->GetDatesOfScreenings();

        $upcomingList = $this->movieBdDao->GetUpcomingMoviesFromAPI();

        $MovieController = new MovieController();
        $MovieList = $MovieController->getMoviesList();
        $count = 0;
        if(is_array($MovieList) && !empty($MovieList)) {
        $cantidadDeMovies = count($MovieList);
        }
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

    public function GetNowPlayingFromAPI() {
        $this->movieBdDao->GetNowPlayingFromAPI();
    }

    public function GetUpComingMoviesFromAPI() {
        return $this->movieBdDao->GetUpcomingMoviesFromAPI();
    }

    public function ShowIncomingInfo($id_movie) {
        
        $url = $this->movieBdDao->GetPageOfIncomingMovieFromAPI($id_movie);

        if(!empty($url)){
            header('location:' . $url);
        }
        else {
            $this->listMovies("We havent info about that movie yet! Sorry!");
        }
    }

}
