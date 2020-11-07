<?php

    namespace Controllers;

    use DAO\CinemaBdDao;
    use DAO\MovieBdDao as MovieBdDao;
    use Models\Screening as Screening;
    use DAO\ScreeningBdDao as ScreeningBdDao;

    class ScreeningController {

        private $screeningBdDAO;
/*     <li><a href="<?php echo FRONT_ROOT."Screening/ShowAddScreeningView" ?>">Add Screening</a></li>
    <li><a href="<?php echo FRONT_ROOT."Screening/ShowListScreeningView" ?>">Show List</a></li> */
    
        public function ShowAddScreeningView($message = "") {
            if(!isset($_SESSION["loginUser"])){
                $message = "";
                require_once(VIEWS_PATH."login.php");
            }
            else {
            $id_movie = $message;
            $message = "";
            require_once(VIEWS_PATH."screening-add.php");
            }
        }

        public function modifyANDremover($id){

            if(isset($_POST['id_remove'])){

            $this->screeningBdDAO->DeleteScreeningInDB($id);
            
            }
            else if (isset($_POST['id_modify'])) {
               
                $_SESSION['id'] = $id;
                $this->ShowModififyView();
             
            }
        }

        private function ShowModififyView($message =""){
            
            if(!isset($_SESSION["loginUser"])){
                $message = "";
                require_once(VIEWS_PATH."login.php");
            }
            else {
            $id_movie = $message;
            $message = "";
            require_once(VIEWS_PATH."screening-modify.php");
            }
        }

        public function ShowListScreeningView($message = "") {

            $this->screeningBdDAO = new ScreeningBdDao();
            $screeningList = $this->screeningBdDAO->getAllScreening();

            
            
            if(!isset($_SESSION["loginUser"]) && $_SESSION["loginUser"]->getRole() != 1){
               
                $message = "";
                require_once(VIEWS_PATH."login.php");
            }
            else {
                
                $id_movie = $message;
                if(!is_array($screeningList)) {
                    $message = $screeningList;
                }
                
                require_once(VIEWS_PATH."screening-list.php");
            
            }
        }

        public function ApplyFilters() 
        {

        }

        public function AddScreening($id_movie, $cinema_screening, /* $room_screening */ $date_screening, $hour_screening) {

            /* Mapeo un cine con el id recibido */
            $cinema = CinemaBdDao::GetInstance();
            $cinema = $cinema->GetCinemaById($cinema_screening);
            /* Mapeo una movie con el id recibido */
            $movie = MovieBdDao::MapearMovie($id_movie);   

            /* Cargo un Screening */
            $newScreening = new Screening($date_screening, $hour_screening, $movie /* $room_screening */, $cinema);
            /* Cargo el screen en la BD*/
            $this->screeningBdDAO = new ScreeningBdDao();
            $result = $this->screeningBdDAO->SaveScreeningInBd($newScreening);

            if($result == 1) {
                $message = "Screening added succesfully!";
                require_once(VIEWS_PATH."screening-add.php");
            }
            else {

                $message = "Screening added FAIL!";
                require_once(VIEWS_PATH."screening-add.php");           
            }

        }

        





}



?>