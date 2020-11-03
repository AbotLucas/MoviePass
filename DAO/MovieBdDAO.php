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

    public function SaveMovieInDB($movie) {

        $sql = "INSERT INTO movie (id_movie, title, language, url_image, overview, duration) VALUES (:id_movie, :title, :language, :url_image, :overview, :duration)";

        $parameters["id_movie"] = $movie->getId_movie();
        $parameters["title"] = $movie->getTitle();
        $parameters["language"] = $movie->getLanguage();
        $parameters["url_image"] = $movie->getUrlImage();
        $parameters["overview"] = $movie->getOverview();
        $parameters["duration"] = $movie->getDuration();

        try {
            $this->connection = Connection::GetInstance();
            return $this->connection->ExecuteNonQuery($sql, $parameters);
        } catch (Exception $ex) {
            throw $ex;
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
            return new Movie($p['id_movie'], $p['title'], $p['language'], $p['url_image'], $p['overview'], $p['duration']);
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];
    }

}