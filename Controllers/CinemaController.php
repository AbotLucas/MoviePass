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
        public function ShowModififyView($message =""){
            
            if(!isset($_SESSION["loginUser"])){
                $message = "";
                require_once(VIEWS_PATH."login.php");
            }
            else {
            $id_movie = $message;
            $message = "";
            require_once(VIEWS_PATH."cinema-modify.php");
            }
        }
        public function ShowListCinemaView($message="")
        {   
            $this->cinemaBdDAO = new CinemaBdDAO();
            $cinemaList = $this->cinemaBdDAO->getAllCinema();
            
            if(!isset($_SESSION["loginUser"])){
                $message = "";
                require_once(VIEWS_PATH."login.php");
            }
            else {
            $message = "";
            require_once(VIEWS_PATH."cinema-list.php");
            }
        }
        public function ShowLisSceening(){
            require_once(VIEWS_PATH."screening-list.php");
        }
        public function ShowAddRoom($message = ""){
            if(!isset($_SESSION["loginUser"])){
                $message = "";
                require_once(VIEWS_PATH."login.php");
            }
            else {
            $id_cinema = $message;
            $message = "";
            require_once(VIEWS_PATH."room-add.php");
            }
            
        }

        public function button($id){

            if(isset($_POST['id_remove'])){

            $this->RemoveCinemaFromDB($id);

              }elseif(isset($_POST['id_modify'])){
               $_SESSION['id'] = $id;
               $this->ShowModififyView();
               
                }elseif(isset($_POST['add_room'])){
                    $_SESSION['id'] = $id;
                    $this->ShowAddRoom();

                     }else {
                         $_SESSION['id'] = $id;
                          $this->ShowLisSceening();
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
    
    

    public function modify($name,$address,$capacity,$ticketValue){
        $id = $_SESSION['id'];
      $this->cinemaDAO->modifyCinema($id,$name,$address,$capacity,$ticketValue);
      $this->ShowListCinemaView("Cinema modify succesfully!");
        }
    
}
    
?>