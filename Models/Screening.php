<?php 

    namespace Models;

    //Class Screening, represent the screening of the movies

    class Screening {

        private $id_screening; //Screening ID
        private $date_screening; //Screening Date
        private $hour_screening; //Screening Hour
        private Movie $movie;//Movie to be screened 
        private Room $room; //Cinema_ID where it gonna be screened the movie

        public function __construct($id_screening, $date_screening, $hour_screening, $movie, $room) {
           
            $this->id_screening = $id_screening;
            $this->date_screening = $date_screening;
            $this->hour_screening = $hour_screening;
            $this->movie = $movie;
            $this->room = $room;
        }

     }





?>