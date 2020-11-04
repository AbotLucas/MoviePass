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
            
            require_once(VIEWS_PATH."room-add.php");
        }

        public function ShowListRoomView()
        {   
           # $this->roomBdDAO = new RoomBdDAO();
           $roomList = $this->roomBdDAO->getAllRoom();
             require_once(VIEWS_PATH."Room-list.php");
        }

        public function AddRoom($name, $capacity ,$ticketValue,$cinema)
        {
            $newRoom = new Room($name, $capacity ,$ticketValue,$cinema);
            
            if($_POST) {
                $result = $this->roomBdDAO->addRoom($newRoom);
                if($result == 1) {
                $message = "Room added succesfully!";
                $this->ShowListRoomView(($message);
                }
                else
                {
                    $message = "ERROR: System error, reintente";
                    $this->ShowAddRoomView($message);
                }
            }
            else
            {
                $this->ShowAddRoomView("Failed in cinema adding!");
            }
        }       
        
       
    
?>