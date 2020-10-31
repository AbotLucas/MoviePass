<?php
namespace DAO;

use Models\Movie as Movie;
use DAO\Imovie as Imovie;

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

        $movieList = array();

        $jsonContent = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=1b6861e202a1e52c6537b73132864511&language=en-US&page=1");

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            $arrayDePelis = $arrayToDecode["results"]; // Decodifico el array de resultados, porque la api trae otro que se llama "DATA"

            //Lo recorro y cargo una movie en un array por cada posicion del array
            foreach ($arrayDePelis as $movie) 
            {
                    $movie = new Movie($movie["id"], $movie["original_title"], $movie["original_language"], $movie["poster_path"], $movie["overview"], 0);               
                    array_push($movieList, $movie);
                    $this->listMovie = $movieList;
            }
            //Al finalizar guardo el array que traje al principio en un json
            $jsonContent = json_encode($arrayToDecode, JSON_PRETTY_PRINT);
            file_put_contents($this->fileJsonMovie, $jsonContent);

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
    

    protected function mapear($value) {

        $value = is_array($value) ? $value : [];

        $resp = array_map(function($p){
            return new Movie($p['id_movie'], $p['title'], $p['language'], $p['overview'], $p['imagen'], $p['duration']);
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];
    }
	
}

?>