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
            $movie = new Movie($movie["id"], $movie["original_title"], $movie["original_language"], $movie["poster_path"], $movie["overview"], $movie["duration"], $movie->genres[0]);
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
            
                    $movie = new Movie($movie["id"], $movie["original_title"], $movie["original_language"], $movie["poster_path"], $movie["overview"], $movieDuration, $movie->genres[0]);               
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

    //Devuelve un Array con toda la info de la movie
    public function GetFullMovieInfoFromJson($id_Movie) {

        if(file_exists($this->fileJsonMovie)) {
            
            $jsonContent = file_get_contents($this->fileJsonMovie);
            $arrayDePelis = ($jsonContent) ? json_decode($jsonContent, true) : array();
            $arrayDePelis = $arrayDePelis["results"];

            foreach($arrayDePelis as $peli) {
                if($peli["id"] == $id_Movie) {
                    return $peli;
                }
            }
        
        }

    }

    
    
	
}

?>