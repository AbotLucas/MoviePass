<?php
    namespace Controllers;

    use Models\Room as Room;
    use DAO\RoomBdDAO as RoomBdDAO;
    use Controllers\CinemaController as CinemaController;
    use DAO\CinemaBdDAO as CinemaBdDAO;

    class RoomController
    {       
        
        private $roomBdDAO;

        public function __construct() {
            
            $this->roomBdDAO = new RoomBdDAO();
        }
        public function ShowListRoomView($message ="")
        {   

           $roomList = $this->roomBdDAO->getAllRoom();
            require_once(VIEWS_PATH."Room-list.php");
        }
       
        public function Addroom($name, $capacity , $ticketValue)
        {
            $id_cinema = $_SESSION['id'];

            $newRoom = new Room($name,$capacity,$ticketValue,CinemaBdDao::MapearCinema($id_cinema));
            $newShowListCinema = new CinemaController();
            if($_POST) {
                try{
                    $result = $this->roomBdDAO->SaveRoomInBd($newRoom);
                    if($result == 1) {
                        $message = "Room added succesfully!";
                        $this->ShowListRoomView($message);
                     }
                    else
                    {
                        $message = "ERROR: System error, reintente";
                        $newShowListCinema->ShowListCinemaView($message);
                    }
                } catch (PDOException $ex){
                    $message = $ex->getMessage();
                    if(Functions::contains_substr($message, "Duplicate entry")) {
                        $message = "Alguno de los datos ingresados ya existe en la BD. Reintente.";
                        $newShowListCinema->ShowListCinemaView($message);
                    }
                }
            }
            else
            {
                $newShowListCinema->ShowListCinemaView("Failed in cinema adding!");
            }
        }  
        
        public function RemoveRommFromDB($id)
        {
    
            $result = $this->roomBdDAO->DeleteRoomInDB($id);

            if($result == 1) {
                $message = "Room Deleted Succefully!";
                $this->ShowListRoomView($message); 
            }
            else
            {
                $message = "ERROR: Failed in room delete, reintente";
                $this->ShowListRoomView($message);
            }
        }
       
   public function modifyANDremover($id){

            if(isset($_POST['id_remove'])){

            $this->RemoveRommFromDB($id);
            
            }
            else if (isset($_POST['id_modify'])) {
               
                $_SESSION['id'] = $id;
                $this->ShowModififyView();
             
            }
        }
        
        public function modify($name,$address,$capacity,$ticketValue){
            $id = $_SESSION['id'];
          $this->cinemaDAO->modifyCinema($id,$name,$address,$capacity,$ticketValue);
          $this->ShowListCinemaView("Cinema modify succesfully!");
            }
        public function ShowAddRoomView($message = "") {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."room-add.php");
        }
        public function ShowAddScreeningView($message = "") {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."screening-add.php");
        }
        
      
    } 
    
?>