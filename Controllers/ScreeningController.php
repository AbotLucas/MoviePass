<?php

    namespace Controllers;

    use DAO\CinemaBdDao;
    use DAO\MovieBdDao as MovieBdDao;
use DAO\RoomBdDAO;
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
            
            if(!isset($_SESSION["loginUser"])){
               
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

        public function AddScreening($id_movie, $id_cinema, $id_room, $date_screening, $hour_screening) {

            
            /* Mapeo un cine con el id recibido */
            $room = RoomBdDAO::MapearRoom($id_room);
            /* Mapeo una movie con el id recibido */
            $movie = MovieBdDao::MapearMovie($id_movie);   

            /* Cargo un Screening */
            $newScreening = new Screening($date_screening, $hour_screening, $movie, $room);
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

        

        public function AddScreeningFromRoom($id_cinema, $id_room) {

            $movieController = new MovieController();
            $movieList = $movieController->GetMoviesWithoutScreening();
            $room = RoomBdDAO::MapearRoom($id_room);
            $cinema = CinemaBdDao::MapearCinema($id_cinema);

            require_once(VIEWS_PATH."screening-add-from-room.php");



        }

        





}



?>