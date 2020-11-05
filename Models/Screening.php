<?php 

    namespace Models;

    //Class Screening, represent the screening of the movies

    class Screening {

        private $id_screening; //Screening ID
        private  $room; //Cinema_ID where it gonna be screened the movie
        private $movie;//Movie to be screened 
        private $date_screening; //Screening Date
        private $hour_screening; //Screening Hour
        
        
        public function __construct( Movie $movie,Room $room ,$hour_screening) {
           
            $this->room = $room;
            $this->movie = $movie;
            $this->date_screening = $date_screening;
            $this->hour_screening = $hour_screening;
        }

    public function getId_screening(){return $this->id_screening;}
    public function setId_screening($id_screening) {  $this->id_screening = $id_screening;}
    public function getDate_screening() { return $this->date_screening; }
    public function setDate_screening($date_screening){$this->date_screening = $date_screening;}
    public function getHour_screening(){ return $this->hour_screening;}
    public function setHour_screening($hour_screening){  $this->hour_screening = $hour_screening;}
    public function getMovie(){ return $this->movie;}
    public function setMovie($movie) { $this->movie = $movie;}
    public function getRoom() { return $this->room; }
    public function setRoom($room){ $this->room = $room;}
    public function getCinema() { return $this->cinema;}
    public function setCinema($cinema) {   $this->cinema = $cinema; return $this;}

}





?>