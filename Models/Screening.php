<?php 

    namespace Models;

    //Class Screening, represent the screening of the movies

    class Screening {

        private $id_screening; //Screening ID
        private $date_screening; //Screening Date
        private $hour_screening; //Screening Hour
        private Movie $movie;//Movie to be screened 
        private Room $room; //Cinema_ID where it gonna be screened the movie

        public function __construct($date_screening, $hour_screening, $movie, $room) {
           
            $this->id_screening = 0;
            $this->date_screening = $date_screening;
            $this->hour_screening = $hour_screening;
            $this->movie = $movie;
            $this->room = $room;
        }


        
        public function getId_screening()
        {
                return $this->id_screening;
        }

        
        public function setId_screening($id_screening)
        {
                $this->id_screening = $id_screening;

        }

        
        public function getDate_screening()
        {
                return $this->date_screening;
        }

        
        public function setDate_screening($date_screening)
        {
                $this->date_screening = $date_screening;

        }

       
        public function getHour_screening()
        {
                return $this->hour_screening;
        }

        
        public function setHour_screening($hour_screening)
        {
                $this->hour_screening = $hour_screening;

        }

        public function getMovie()
        {
                return $this->movie;
        }

        
        public function setMovie($movie)
        {
                $this->movie = $movie;

        }

        public function getRoom()
        {
                return $this->room;
        }

       
        public function setRoom($room)
        {
                $this->room = $room;

        }
     }





?>