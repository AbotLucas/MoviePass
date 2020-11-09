<?php
    namespace Controllers;

    use Models\Room as Room;
    use DAO\RoomBdDAO as RoomBdDAO;
    use Controllers\CinemaController as CinemaController;
    use DAO\CinemaBdDAO as CinemaBdDAO;
use PDOException;

class RoomController
    {       
        
        private $roomBdDAO;

        public function __construct() {
            
            $this->roomBdDAO = new RoomBdDAO();
        }

        public function ShowRoomListCinemas($id_cinema="") {


            if (!isset($_SESSION["loginUser"]) || ($_SESSION["loginUser"]->getRole() != 1)) {

                if (isset($_SESSION["loginUser"])) {
                    $message = "Upps, needs to be Admin! ;)";
                } else {
                    $message = "Upps, needs to be logged! ;)";
                }
    
                require_once(VIEWS_PATH . "login.php");
            } else {
                $this->ShowListRoomView(" ", $id_cinema);
            }

            
        }

    public function ShowListRoomALLView($message = "")
    {
        $this->roomBdDAO = new RoomBdDAO();

        $roomList = $this->roomBdDAO->getAllRoom();

        if (!isset($_SESSION["loginUser"]) || ($_SESSION["loginUser"]->getRole() != 1)) {

            if (isset($_SESSION["loginUser"])) {
                $message = "Upps, needs to be Admin! ;)";
            } else {
                $message = "Upps, needs to be logged! ;)";
            }

            require_once(VIEWS_PATH . "login.php");
        } else {
            if ($roomList) {
                require_once(VIEWS_PATH . "cinemaANDroom-list.php");
            }
        }
    }

        public function ShowListRoomView($message="", $id_cinema)
        {   
            $this->roomBdDAO = new RoomBdDAO();
            $cinema = CinemaBdDAO::MapearCinema($id_cinema);

            
            $roomList = $this->roomBdDAO->GetRoomsFromCinema($id_cinema);
            
            if(!isset($_SESSION["loginUser"])){
                $message = "Upps, needs to be logged! ;)";
                require_once(VIEWS_PATH."login.php");
            }
            else {
                if(!is_array($roomList)) {
                    
                }
                require_once(VIEWS_PATH."room-list.php");
            }
        }
       
        public function Addroom($name, $capacity , $ticketValue, $id_cinema)
        {   
            if(isset($_POST["cancel"])){

                $cinemaController = new CinemaController();
                $cinemaController->ShowListCinemaView();

            }
            else
            {
            $newRoom = new Room($name, $capacity, $ticketValue,CinemaBdDao::MapearCinema($id_cinema));
            $newShowListCinema = new CinemaController();

                try{
                    $result = $this->roomBdDAO->SaveRoomInBd($newRoom);
                    if($result == 1) {
                        $message = "Room added succesfully!";
                        $this->ShowListRoomView($message, $id_cinema);
                     }
                    else
                    {
                        $message = "ERROR: System error, reintente";
                        $newShowListCinema->ShowListCinemaView($message);
                    }
                } catch (PDOException $ex){
                    $message = $ex->getMessage();
                    if(Functions::contains_substr($message, "Duplicate entry")) {
                        $message = "some of the data entered";
                        $newShowListCinema->ShowListCinemaView($message);
                    }
                }
            }
        }  
        
        public function RemoveRoomFromDB($id_cinema, $id_room)
        {   
            $result = $this->roomBdDAO->DeleteRoomInDB($id_room);

            if($result == 1) {
                $message = "Room Deleted Succefully!";
                $this->ShowListRoomView($message, $id_cinema); 
            }
            else
            {
                $message = "ERROR: Failed in room delete, reintente";
                $this->ShowListRoomView($message, $id_cinema);
            }
        }
       
   public function modifyANDremover($id_cinema, $id_room){

            
            if(isset($_POST['id_remove'])){

                $this->RemoveRoomFromDB($id_cinema, $id_room);
            
            }
            else if (isset($_POST['id_modify'])) {
               
                $this->ShowModififyView($id_room);
             
            }
            else if (isset($_POST['id_add_screenings'])) {

                $screeningController = new ScreeningController();
                $screeningController->AddScreeningFromRoom($id_cinema, $id_room);

            }
            else if (isset($_POST['id_show_screenings'])) {
                 
                $screeningController = new ScreeningController();
                $screeningController->ShowScreeningsOfRoom(" ", $id_cinema, $id_room);

            }
        }

        public function ShowModififyView($id_room){
            $room = RoomBdDAO::MapearRoom($id_room);
            $cinema = CinemaBdDAO::MapearCinema($room->getCinema()->getId_Cinema());
            
            if(!isset($_SESSION["loginUser"])){
                $message = "Upps, needs to be logged! ;)";
                require_once(VIEWS_PATH."login.php");
            }
            else {
                require_once(VIEWS_PATH."room-modify.php");
            }
        }
        
        public function modify($name, $capacity, $ticketValue, $id_room){

            try{

            $this->roomBdDAO->ModifyRoomInBd($name, $capacity, $ticketValue, $id_room);
            $room = RoomBdDAO::MapearRoom($id_room);
            $this->ShowListRoomView("Room modify succesfully!", $room->getCinema()->getId_Cinema());

              }catch (PDOException $ex){
                   $message = $ex->getMessage();
                   if(Functions::contains_substr($message, "Duplicate entry")) {
                       $message = "some of the data entered (Address/Name) already exists . repeated";
                       $this->ShowListRoomView("Room modify succesfully!", $room->getCinema()->getId_Cinema());
                   }else{
                    $this->ShowListCinemaView("Failed in cinema adding!");
                   }
           } 
        }

        public function ShowAddRoomView($id_cinema) {
            $cinema = CinemaBdDAO::MapearCinema($id_cinema);
            require_once(VIEWS_PATH."room-add.php");
        }

        

        
      
    } 
    
?>