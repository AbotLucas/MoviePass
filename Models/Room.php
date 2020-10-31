<?php 

    namespace Models;

    class Room {


        private $id_room;
        private $name;
        private $capacity;
        private $ticketValue;
        private Cinema $cinema;

        public function __construct($id_room, $name, $capacity, $ticketValue, $cinema)
	{
        $this->id_room = $id_room;
        $this->name = $name;
        $this->capacity = $capacity;
        $this->ticketValue = $ticketValue;
    }


    }



?>