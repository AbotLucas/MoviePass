<?php
    namespace Controllers;

    use Models\Room as Room;
    use DAO\RoomBdDAO as RoomBdDAO;

    class RoomController
    {       
        
        private $roomBdDAO;

        public function __construct() {
            
            $this->roomBdDAO = new RoomBdDAO();
        }

        public function ShowAddRoomView($message = "") {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."room-add.php");
        }
        public function ShowAddScreeningView($message = "") {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."screening-add.php");
        }
        public function ShowListRoomView()
        {   
           $roomList = $this->roomBdDAO->getAllRoom();
            require_once(VIEWS_PATH."Room-list.php");
        }
        public function AddRoom($name, $capacity ,$ticketValue,$idcinema)
        {
            require_once(VIEWS_PATH."validate-session.php");
             $newRoom = new Room($name, $capacity ,$ticketValue,$idcinema);
             $this->roomBdDAO->addRoom($newRoom);
             $message = "Room added succesfully!";
             $this->ShowAddScreeningView($message);
        } 

      
    } 
    
?>