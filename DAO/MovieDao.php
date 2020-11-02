<?php
namespace DAO;

use Models\Movie as Movie;
use DAO\Imovie as Imovie;
use FFI\Exception;

class MovieDao implements Imovie{

    private $listMovie = array();
    private $fileJsonMovie;
 
    public function __construct(){

        $this->fileJsonMovie = ROOT."/Data/Movie.json";
    }

    public function addMovie(Movie $movie){
        $this->retrieveData();
        array_push($this->listMovie,$movie);
        $this->saveData();
    }

    public function deleteMovie($id_Movie){
        $this->retrieveData();
		$newList = array();
		foreach ($this->listMovie as $movie ) {
			if( $movie->getId_movie() != $id_Movie){
				array_push($newList,$movie);
			}
		}
		$this->listMovie = $newList;
		$this->saveData();
    }
    
    public function getAllMovies(){
        $this->retrieveData();
        return $this->listMovie;
    
    }

 private function retrieveData(){

       $this->listMovie = array();

       if (file_exists($this->fileJsonMovie)){
           $jsonContent = file_get_contents($this->fileJsonMovie);

           $arrayToDecode = ($jsonContent) ? json_decode($jsonContent,true):array();

           foreach($arrayToDecode as $movie){
            $movie = new Movie($movie["id"], $movie["original_title"], $movie["original_language"], $movie["poster_path"], $movie["overview"], $movie["duration"]);
               array_push($this->listMovie, $movie);
           }

       }
    }

    public function getAPI() {
        $this->retrieveAPI();
        return $this->listMovie;
    }

    private function retrieveAPI() //Trae las peliculas "now_playing" de la API
    {
        
        $moviesWithDuration = [];

        $movieList = array();

        $jsonContent = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=1b6861e202a1e52c6537b73132864511&language=en-US&page=1");

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            $arrayDePelis = $arrayToDecode["results"]; // Decodifico el array de resultados, porque la api trae otro que se llama "DATA"

            //Lo recorro y cargo una movie en un array por cada posicion del array
            foreach ($arrayDePelis as $movie) 
            {       
                    $movieDuration = $this->GetMovieDuration($movie["id"]);
                    $movie["duration"] = $movieDuration;
                    array_push($moviesWithDuration, $movie);
            
                    $movie = new Movie($movie["id"], $movie["original_title"], $movie["original_language"], $movie["poster_path"], $movie["overview"], $movieDuration);               
                    array_push($movieList, $movie);
                    $this->listMovie = $movieList;

            }
            //Cambio el array que trae la api por uno con la duracion como atributo añadido
            $arrayToDecode["results"] = $moviesWithDuration;
            //Al finalizar guardo el array que traje al principio en un json
            $jsonContent = json_encode($arrayToDecode, JSON_PRETTY_PRINT);
            file_put_contents($this->fileJsonMovie, $jsonContent);

    }

    private function GetMovieDuration($idMovie) {
        $jsonContent = file_get_contents("https://api.themoviedb.org/3/movie/".$idMovie."?api_key=1b6861e202a1e52c6537b73132864511&language=en-US");
        $movie = ($jsonContent) ? json_decode($jsonContent, true) : array();
        return $movie["runtime"];
    }


    private function saveData(){

		$arrayToEncode = array();

		foreach ($this->listMovie as $movie) {
			$valueArray['id_movie'] =$movie->getId_movie();
			$valueArray['title'] =$movie->getTitle() ;
			$valueArray['language'] =$movie->getLanguage();
			$valueArray['overview'] = $movie->getOverview();
			$valueArray['imagen'] = $movie->getImage();
			$valueArray['duration'] = $movie->getDuration();
			array_push($arrayToEncode, $valueArray);
			
        }
        
		$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
		file_put_contents($this->fileJsonMovie, $jsonContent);
    }

    /* Funciones de BDD */

    /* id_movie BIGINT UNSIGNED not null unique,
    title VARCHAR(50) not null ,
    language TINYTEXT not null,
    url_image LONGBLOB not null ,
    overview varchar(200) not null,
    duration VARCHAR(10) ,
    constraint pk_idmovie primary key(id_movie); */
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
        $this->retrieveAPI();
        foreach($this->listMovie as $movie) {
            $numberOfMovies = $this->SaveMovieInDB($movie);
        }
        return $numberOfMovies;
    }
    

    protected function mapear($value) {

        $value = is_array($value) ? $value : [];

        $resp = array_map(function($p){
            return new Movie($p['id_movie'], $p['title'], $p['language'], $p['url_image'], $p['overview'], $p['duration']);
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];
    }
	
}

?>