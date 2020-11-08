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

        public function __construct()
        {
            $this->screeningBdDAO = new ScreeningBdDao();
        }
    
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

        public function modifyANDremove($id_room, $id_screening){

            if(isset($_POST['id_remove'])){

                $this->RemoveScreeningFromDB($id_room, $id_screening);

            
            }
            else if (isset($_POST['id_modify'])) {

                $this->ShowModififyView();
             
            }
        }


        public function RemoveScreeningFromDB($id_room, $id_screening)
        {   
            $result = $this->screeningBdDAO->DeleteScreeningInDB($id_screening);
            $room = RoomBdDao::MapearRoom($id_room);

            if($result == 1) {
                
                $message = "Screening Deleted Succefully!";
                $this->ShowScreeningsOfRoom($message, $room->getCinema()->getId_Cinema(), $id_room); 
            }
            else
            {
                $message = "ERROR: Failed in screening delete, reintente";
                $this->ShowScreeningsOfRoom($message, $room->getCinema()->getId_Cinema(), $id_room); 
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

            /* Mapeo un room con el id recibido */
            $room = RoomBdDAO::MapearRoom($id_room);
            /* Mapeo una movie con el id recibido */
            $movie = MovieBdDao::MapearMovie($id_movie);   
            /* Mapeo un cine con el id recibido */
            $cinema = CinemaBdDao::MapearCinema($id_cinema); 

            /* Cargo un Screening */
            $newScreening = new Screening($date_screening, $hour_screening, $movie, $room);
            /* Cargo el screen en la BD*/
            $this->screeningBdDAO = new ScreeningBdDao();
            $result = $this->screeningBdDAO->SaveScreeningInBd($newScreening);

            $screeningList = $this->screeningBdDAO->GetScreeningsFromARoom($id_room);

            if($result == 1) {
                $message = "Screening added succesfully!";
                require_once(VIEWS_PATH."screening-list-from-room.php");
            }
            else {

                $message = "Screening added FAIL!";
                require_once(VIEWS_PATH."screening-list-from-room.php");           
            }

        }

        

        public function AddScreeningFromRoom($id_cinema, $id_room) {

            $movieController = new MovieController();
            $movieList = $movieController->GetMoviesWithoutScreening($id_room);
            $room = RoomBdDAO::MapearRoom($id_room);
            $cinema = CinemaBdDao::MapearCinema($id_cinema);
            $actualDate = date("Y-m-d");
            $maxDate = date("Y-m-d", strtotime($actualDate."+2 month"));

            require_once(VIEWS_PATH."screening-add-from-room.php");

        }
        
        public function ShowScreeningsOfRoom($message="",$id_cinema,$id_room) {
            
            $cinema = CinemaBdDao::MapearCinema($id_cinema);
            $room = RoomBdDAO::MapearRoom($id_room);

            $this->screeningBdDAO = new ScreeningBdDao();
            $screeningList = $this->screeningBdDAO->GetScreeningsFromARoom($id_room);

            require_once(VIEWS_PATH."screening-list-from-room.php");   
        }

        public function GetAllScreeningsFromMovie($id_movie) {

            return $this->screeningBdDAO->GetScreeningsFromAMovie($id_movie);

        }

        





}



?>