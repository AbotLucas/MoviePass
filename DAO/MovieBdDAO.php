<?php
namespace DAO;

use Models\Movie as Movie;
use DAO\Imovie as Imovie;
use FFI\Exception;

class MovieBdDao {

    private $listMovie = array();
    private $movieDAO;
    private $tableName = "movie";
    private $connection;
    private static $instance = null;
    private $fileJsonMovie = ROOT."/Data/Movie.json";

    /* id_movie BIGINT UNSIGNED not null unique,
    title VARCHAR(50) not null ,
    language TINYTEXT not null,
    url_image LONGBLOB not null ,
    overview varchar(200) not null,
    duration VARCHAR(10) ,
    constraint pk_idmovie primary key(id_movie); */
 

/*     public static function MapearMovie($idMovieAMapear) {
        $movieBdDAOAux = new MovieBdDao();
        return $movieBdDAOAux->GetMovieById($idMovieAMapear);

    } */

    public function GetMovieById($idMovieABuscar)
    {
        $movie = null;

        $query = "SELECT * FROM " . $this->tableName . " WHERE (id_movie = :id_movie) ";

        $parameters["id_movie"] = $idMovieABuscar;

        try{

            $this->connection = Connection::GetInstance();
            $results = $this->connection->Execute($query, $parameters);
        
        } catch (Exception $ex) {
            throw $ex;
        }
        
        $return = $this->mapear($results);


        return $return;
    }  

    public function getAllMovies() {

        $moviesArray = $this->getMoviesFromDB();
        if(!empty($moviesArray)) {
            $result = $this->mapear($moviesArray);
            if(is_array($result)) {
                $this->listMovie = $result;
            }
            else {
                $arrayResult[0] = $result;
                $this->listMovie = $arrayResult;
            }
            return $this->listMovie;
        }
        else {
            return $errorArray[0] = "Error al leer la base de datos.";
        }

    }

    protected function getMoviesFromDB() {
        
        $query = "SELECT * FROM " . $this->tableName;
        try {
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);

        } catch (Exception $ex) {
            throw $ex;
        }
        
        return $result;
    
    }

    public function getAllMoviesWithScreening() {

        $moviesArray = $this->getMoviesWithScreeningFromDB();
        if(!empty($moviesArray)) {
            
            $result = $this->mapear($moviesArray);
            if(is_array($result)) {
                $this->listMovie = $result;
            }
            else {
                $arrayResult[0] = $result;
                $this->listMovie = $arrayResult;
            }
            return $this->listMovie;
        }
        else {
            return $errorArray[0] = "Error al leer la base de datos.";
        }

    }

    
    protected function getMoviesWithScreeningFromDB() {
        
        $query = "SELECT DISTINCT m.id_movie, m.title, m.language, m.url_image, m.duration, m.overview, m.idgenre FROM " . $this->tableName . " m INNER JOIN SCREENING ON SCREENING.idmovie = m.id_movie";
        try {
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);

        } catch (Exception $ex) {
            throw $ex;
        }
        
        return $result;
    
    }

    public function SaveMovieInDB($movie) {

        $sql = "INSERT INTO movie (id_movie, title, language, url_image, overview, duration, idgenre) VALUES (:id_movie, :title, :language, :url_image, :overview, :duration, :idgenre)";

        $parameters["id_movie"] = $movie->getId_movie();
        $parameters["title"] = $movie->getTitle();
        $parameters["language"] = $movie->getLanguage();
        $parameters["url_image"] = $movie->getUrlImage();
        $parameters["overview"] = $movie->getOverview();
        $parameters["duration"] = $movie->getDuration();
        $parameters["idgenre"] = $movie->getGenre()->getId_genre();

        try {
            $this->connection = Connection::GetInstance();
            return $this->connection->ExecuteNonQuery($sql, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetMoviesWithOutScreeningFromDb($id_room) {
        /*CONSULTO LAS PELICULAS QUE NO TIENEN SCREENING O QUE SI TIENEN PERTENECEN A ESTE ROOM (A-a1)*/ 
        $query =    "SELECT DISTINCT m.id_movie, m.title, m.language, m.url_image, m.duration, m.overview, m.idgenre
                     FROM movie m
                     LEFT JOIN screening s
                     ON m.id_movie = s.idmovie
                     WHERE (s.idmovie is null) OR (s.idroom = :id_room);";

        $parameters["id_room"] = $id_room;

        try {
            $this->connection = Connection::GetInstance();
            return $this->connection->Execute($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }

    }

    public function GetMoviesWithOutScreening($id_room) {

        $moviesArray = $this->GetMoviesWithOutScreeningFromDb($id_room);

        if(!empty($moviesArray)) {
                
            $result = $this->mapear($moviesArray);
            
            if(is_array($result)) {
                
                $this->listMovie = $result;
            }
            else {
                
                $arrayResult[0] = $result;
                $this->listMovie = $arrayResult;
            }
            
            return $this->listMovie;
        }
        else {
            return $errorArray[0] = "Error al leer la base de datos.";
        }
        
    }

    public function MigrateMoviesToDB() {
        $this->movieDAO = new MovieDao();
        $this->listMovie = $this->movieDAO->getAPI();
        foreach($this->listMovie as $movie) {
            $numberOfMovies = $this->SaveMovieInDB($movie);
        }
        return $numberOfMovies;
    }

    public static function GetInstance()
        {
            if(self::$instance == null)
                self::$instance = new CinemaBdDao();

            return self::$instance;
        }
    
        public static function MapearMovie($idMovieAMapear) {
            $movieDAOBdAux = new MovieBdDao();
            return $movieDAOBdAux->GetMovieById($idMovieAMapear);
        }
    

    protected function mapear($value) {

        $value = is_array($value) ? $value : [];

        $resp = array_map(function($p){
            return new Movie($p['id_movie'], $p['title'], $p['language'], $p['url_image'], $p['overview'], $p['duration'], GenreBdDAO::MapearGenre($p['idgenre']));
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];
    }

    public function GetNowPlayingFromAPI() {
        $this->retrieveAPI();
        return $this->listMovie;
    }

    private function GetMovieDuration($idMovie) {
        $jsonContent = file_get_contents("https://api.themoviedb.org/3/movie/".$idMovie."?api_key=1b6861e202a1e52c6537b73132864511&language=en-US");
        $movie = ($jsonContent) ? json_decode($jsonContent, true) : array();
        return $movie["runtime"];
    }

    private function retrieveAPI() //Trae las peliculas "now_playing" de la API
    {
        
        $moviesWithDuration = [];

        $listMovies = array();

        $jsonContent = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=1b6861e202a1e52c6537b73132864511&language=en-US&page=1");

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            $arrayDePelis = $arrayToDecode["results"]; // Decodifico el array de resultados, porque la api trae otro que se llama "DATA"

            //Lo recorro y cargo una movie en un array por cada posicion del array
            foreach ($arrayDePelis as $movie) 
            {        
                    $movieDuration = $this->GetMovieDuration($movie["id"]);
                    $movie["duration"] = $movieDuration;
                    array_push($moviesWithDuration, $movie);

                    $genres = $movie["genre_ids"];
                    $genre = $genres[0];
                    
                    $movie = new Movie($movie["id"], $movie["original_title"], $movie["original_language"], $movie["poster_path"], $movie["overview"], $movieDuration, GenreBdDAO::MapearGenre($genre));               
                    array_push($listMovies, $movie);
                    $this->listMovie = $listMovies;
                    $this->SaveMovieInDB($movie);

            }
            //Cambio el array que trae la api por uno con la duracion como atributo añadido
            $arrayToDecode["results"] = $moviesWithDuration;
            //Al finalizar guardo el array que traje al principio en un json
            $jsonContent = json_encode($arrayToDecode, JSON_PRETTY_PRINT);
            file_put_contents($this->fileJsonMovie, $jsonContent);

    }

}