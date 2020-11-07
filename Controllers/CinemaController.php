<?php
    namespace Controllers;

    use Models\Cinema as Cinema;
    use DAO\CinemaBdDao as CinemaBdDAO;
    use Controllers\Functions;
    use PDOException;

   class CinemaController
    {      
        private $cinemaBdDAO;

        public function __construct() {

            $this->cinemaBdDAO = new CinemaBdDAO();
        }

        public function ShowAddCinemaView($message = "") {
            
            if(!isset($_SESSION["loginUser"])){
                $message = "";
                require_once(VIEWS_PATH."login.php");
            }
            else {
            require_once(VIEWS_PATH."cinema-add.php");
            }
        }

        public function ShowModififyView($id_cinema){

            $cinema = CinemaBdDAO::MapearCinema($id_cinema);
            
            if(!isset($_SESSION["loginUser"])){
                $message = "Upps, needs to be logged! ;)";
                require_once(VIEWS_PATH."login.php");
            }
            else {
                require_once(VIEWS_PATH."cinema-modify.php");
            }
        }

        public function ShowListCinemaView($message="")
        {   
            $this->cinemaBdDAO = new CinemaBdDAO();
            $cinemaList = $this->cinemaBdDAO->getAllCinema();
            
            if(!isset($_SESSION["loginUser"])){
                $message = "Upps, needs to be logged! ;)";
                require_once(VIEWS_PATH."login.php");
            }
            else {
            require_once(VIEWS_PATH."cinema-list.php");
            }
        }

        public function ShowLisSceening(){
            require_once(VIEWS_PATH."screening-list.php");
        }

        public function ShowAddRoom($id_cinema){

            $cinema = CinemaBdDAO::MapearCinema($id_cinema);
            
            if(!isset($_SESSION["loginUser"])){
                $message = "Upps, needs to be logged! ;)";
                require_once(VIEWS_PATH."login.php");
            }
            else {
                require_once(VIEWS_PATH."room-add.php");
            }
            
        }

        public function button($id_cinema){

            if(isset($_POST['id_remove'])){

                $this->RemoveCinemaFromDB($id_cinema);

            }elseif(isset($_POST['id_modify'])){
               
                $this->ShowModififyView($id_cinema);
               
            }elseif(isset($_POST['add_room'])){

                $this->ShowAddRoom($id_cinema);

            }else if(isset($_POST['show_rooms'])){
                
                $roomController = new RoomController();
                $roomController->ShowRoomListCinemas($id_cinema);

            }else {
                
              $this->ShowListCinemaView("No pudimos ver que habias presionado!");
                    
            }
        }

        public function AddCinema($name, $address)
        {
            $newCinema = new Cinema($name, $address);
            
            if($_POST) {
                try{
                    $result = $this->cinemaBdDAO->SaveCinemaInDB($newCinema);
                    if($result) {
                        $message = "Cinema added succesfully!";
                        $this->ShowListCinemaView($message);
                     }
                    else
                    {
                        $message = "ERROR: System error, reintente";
                        $this->ShowListCinemaView($message);
                    }
                } catch (PDOException $ex){
                    $message = $ex->getMessage();
                    if(Functions::contains_substr($message, "Duplicate entry")) {
                        $message = "Alguno de los datos ingresados (Address/Name) ya existe en la BD. Reintente.";
                        $this->ShowAddCinemaView($message);
                    }
                }
            }
            else
            {
                $this->ShowListCinemaView("Failed in cinema adding!");
            }
        }       
        
        public function Remove($id)
        {
            $this->cinemaDAO->deleteCinema($id);
            $this->ShowListcinemaView();
        }
        
        public function RemoveCinemaFromDB($id)
        {
            $result = $this->cinemaBdDAO->DeleteCinemaInDB($id);

            if($result == 1) {
                $message = "Cinema Deleted Succefully!";
                $this->ShowListcinemaView($message);
            }
            else
            {
                $message = "ERROR: Failed in cinema delete, reintente";
                $this->ShowListcinemaView();
            }
        }

        public function getCinemasList() {

            return $this->cinemaBdDAO->getAllCinema();
        }
    
    

    public function modify($name, $address){

        if(isset($_POST["cancel"])){

            $this->ShowListCinemaView();

        }
        else {

            $id = $_SESSION['id'];
            $this->cinemaBdDAO->ModifyCinemaInBd($_SESSION["id"], $name, $address);
            $this->ShowListCinemaView("Cinema modify succesfully!");

        }
    }
    
}
    
    
?>