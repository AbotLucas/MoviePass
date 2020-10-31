<?php
    namespace Controllers;

    use Models\Cinema as Cinema;
    use DAO\CinemaDao as CinemaDAO;

    class CinemaController
    {       
        private $cinemaDAO;

        public function __construct() {
            $this->cinemaDAO = new CinemaDAO(); 
        }

        public function ShowAddCinemaView($message = "") {
            
            require_once(VIEWS_PATH."cinema-add.php");
        }
        public function ShowModififyView($message =""){
            
            require_once(VIEWS_PATH."cinema-modify.php");
        }
        public function ShowListCinemaView()
        {
            $cinemaList = $this->cinemaDAO->getAllCinema();
            
            require_once(VIEWS_PATH."cinema-list.php");
        }

        public function AddCinema($name, $address, $capacity, $ticketValue)
        {
            $newCinema = new Cinema(0, $name, $address, $capacity, $ticketValue);
            
            if($_POST) {
                $this->cinemaDAO->addCinema($newCinema);
                $message = "Cinema added succesfully!";
                $this->ShowAddCinemaView($message);
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

        public function getCinemasList() {

            return $this->cinemaDAO->getAllCinema();
        }
    
    public function modifyANDremover($id){

        if(isset($_POST['id_remove'])){
        $this->Remove($id);
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