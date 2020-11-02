<?php
    namespace Controllers;

    use Models\Cinema as Cinema;
    use DAO\CinemaDao as CinemaDAO;
    use DAO\CinemaBdDao as CinemaBdDAO;

    class CinemaController
    {       
        private $cinemaDAO;
        private $cinemaBdDAO;

        public function __construct() {
            $this->cinemaDAO = new CinemaDAO(); 
            $this->cinemaBdDAO = new CinemaBdDAO();
        }

        public function ShowAddCinemaView($message = "") {
            
            require_once(VIEWS_PATH."cinema-add.php");
        }
        public function ShowModififyView($message =""){
            
            require_once(VIEWS_PATH."cinema-modify.php");
        }
        public function ShowListCinemaView()
        {   
            $this->cinemaBdDAO = new CinemaBdDAO();
            $cinemaList = $this->cinemaBdDAO->getAllCinema();
            
            require_once(VIEWS_PATH."cinema-list.php");
        }

        

        public function AddCinema($name, $address)
        {
            $newCinema = new Cinema($name, $address);
            
            if($_POST) {
                $result = $this->cinemaBdDAO->SaveCinemaInDB($newCinema);
                if($result == 1) {
                $message = "Cinema added succesfully!";
                $this->ShowAddCinemaView($message);
                }
                else
                {
                    $message = "ERROR: System error, reintente";
                    $this->ShowAddCinemaView($message);
                }
            }
            else
            {
                $this->ShowAddCinemaView("Failed in cinema adding!");
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

            return $this->cinemaDAO->getAllCinema();
        }
    
    public function modifyANDremover($id){

        if(isset($_POST['id_remove'])){
        $this->RemoveCinemaFromDB($id);
        }elseif(isset($_POST['id_modify'])){
           $_SESSION['id'] = $id;
           $this->ShowModififyView();
         }
    }

    public function modify($name,$address,$capacity,$ticketValue){
        $id = $_SESSION['id'];
      $this->cinemaDAO->modifyCinema($id,$name,$address,$capacity,$ticketValue);
      $this->ShowListCinemaView("Cinema modify succesfully!");
        }
    
}
    
?>