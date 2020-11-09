<?php

    namespace Controllers;

    use DAO\CinemaBdDao;
use DAO\GenreBdDAO;
use DAO\MovieBdDao as MovieBdDao;
    use DAO\RoomBdDAO;
    use Models\Screening as Screening;
    use DAO\ScreeningBdDao as ScreeningBdDao;
use DateTime;

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
            
            if(isset($_POST["filter_radio"])){
                if(($_POST["filter_radio"]=="date")&&(!empty($_POST["date"]))){
                    $this->listMoviesWithFilter("date", $_POST["date"]);
                }
                else if (($_POST["filter_radio"]=="genre")&&(!empty($_POST["genre"]))){
                    $this->listMoviesWithFilter("genre", $_POST["genre"]);
                }
                else {
                    $movieController = new MovieController();
                    $message = "Si desea filtrar las peliculas en cartelera<br>Recuerde asignar correctamente los filtros.<br>(Date->Date // Genre->Genre)";
                    $movieController->listMovies($message);
                }
            }

        }
        
        public function listMoviesWithFilter($filter, $value) {

            $MovieList = [];
            $MovieController = new MovieController();
            $allMoviesWithScreening = $MovieController->getMoviesList();

            

            if($filter == "date") {

                $allScreenings = $this->screeningBdDAO->GetScreeningsFromDate($value);
                foreach($allScreenings as $screening) {
                    array_push($MovieList, $screening->getMovie());
                }
                $filterMessage = " || Date: " .  $value;

            }
            else if($filter == "genre") {
                foreach($allMoviesWithScreening as $movie) {
                    if($movie->getGenre()->getId_genre() == $value){
                        array_push($MovieList, $movie);
                    }
                }
                $value = GenreBdDAO::MapearGenre($value);
                $filterMessage = " || Genre: " .  $value->getGenreName();
            }

            $screeningController = new ScreeningController();
            $genresOfScreenings = $screeningController->GetGenresOfScreenings();
            $datesOfScreenings = $screeningController->GetDatesOfScreenings();
    
            $upcomingList = $MovieController->GetUpcomingMoviesFromAPI();

            $count = 0;
            if(is_array($MovieList) && !empty($MovieList)) {
            $cantidadDeMovies = count($MovieList);
            }
            require_once(VIEWS_PATH. "movie-list.php");
        }

        public function ValidateDateAndHour($id_movie, $id_cinema, $id_room, $date_screening, $hour_screening) { 
            
            $screeningsOfRoom = $this->screeningBdDAO->getScreeningsFromARoom($id_room);

            $screeningsOfRoomOnDate = [];

            if(!empty($screeningsOfRoom)) {

                foreach($screeningsOfRoom as $screening) {
                    if($screening->getDate_screening()==$date_screening) {

                        array_push($screeningsOfRoomOnDate, $screening);

                    }
                }

                if(!empty($screeningsOfRoomOnDate)) {

                    /* Traigo la hora de el nuevo screening y lo formateo en DateTime */
                    $newScreeningHour = date("H:i:s", strtotime($hour_screening));
                    $newScreeningHour = new DateTime($newScreeningHour);
                    $newScreeningEndHour = $newScreeningHour;
                    $newScreeningHour = strval($newScreeningHour->format("H:i"));
                    /* Calculo la hora de finalizacion del  nuevo screening*/
                    $newScreeningEndHour->modify("+". MovieBdDao::MapearMovie($id_movie)->getDuration() . " min");
                    $newScreeningEndHour = strval($newScreeningEndHour->format("H:i"));

                    $flag = false;

                    foreach($screeningsOfRoomOnDate as $screeningOnDate) {
                        
                        /* Por cada screening calculo la hora de funcion en DateTime*/
                        $hourOfScreening = date("H:i:s", strtotime($screeningOnDate->getHour_screening()));
                        $hourOfScreening = new DateTime($hourOfScreening);
                        $hourOfEndScreening = $hourOfScreening;
                        $hourOfScreening = strval($hourOfScreening->format("H:i"));
                        /* Por cada screening calculo la hora de finalizacion de la funcion en DateTime*/
                        $hourOfEndScreening->modify('+15 min');
                        $hourOfEndScreening->modify("+" . $screeningOnDate->getMovie()->getDuration() . "min");
                        $hourOfEndScreening = strval($hourOfEndScreening->format("H:i"));
                        /* Si la hora de comienozo de nuestra nueva screening esta entre el comienzo y final de otra screening, flag = true */
                        if($this->hourIsBetween($hourOfScreening, $hourOfEndScreening, $newScreeningHour)) {
                            $message = "Inicio de movie: " . $hourOfScreening . "|| Inicio Nueva Movie:" . $newScreeningHour . "|| Fin de Movie:" . $hourOfEndScreening .
                            " <br>Movie Conflictiva: " . $screeningOnDate->getMovie()->getTitle();
                            $flag = true;
                        }
                        else
                        {   
                            /* Si la hora de final de nustra nueva screening esta entre el comienzo y final de otra screening, flag = true */
                            if($this->hourIsBetween($hourOfScreening, $hourOfEndScreening, $newScreeningEndHour)){
                                $message = "Inicio de movie: " . $hourOfScreening . "|| Fin Nueva Movie:" . $newScreeningEndHour . "|| Fin de Movie:" . $hourOfEndScreening . 
                                " <br>Movie Conflictiva: " . $screeningOnDate->getMovie()->getTitle();
                                $flag = true;
                            }
                            else {
                                $flag = false;
                            }
                        }
                        

                    }

                    if($flag == false) {

                        $this->AddScreening($id_movie, $id_cinema, $id_room, $date_screening, $hour_screening);
                    }
                    else {

                        $this->ShowScreeningsOfRoom("No se pudo cargar la screening, hay otras funciones en ese horario."."<br>".$message, $id_cinema, $id_room);

                    }

                }
                else {
                    $this->AddScreening($id_movie, $id_cinema, $id_room, $date_screening, $hour_screening);
                }

            } else {
                $this->AddScreening($id_movie, $id_cinema, $id_room, $date_screening, $hour_screening);
            }


        }


    private function hourIsBetween($from, $to, $input)
    {
        $dateFrom = DateTime::createFromFormat('!H:i', $from);
        $dateTo = DateTime::createFromFormat('!H:i', $to);
        $dateInput = DateTime::createFromFormat('!H:i', $input);
        if ($dateFrom > $dateTo
        ) $dateTo->modify('+1 day');
        return ($dateFrom <= $dateInput && $dateInput <= $dateTo) || ($dateFrom <= $dateInput->modify('+1 day') && $dateInput <= $dateTo);
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

        public function GetGenresOfScreenings() {
           return $this->screeningBdDAO->GetGenresOfScreenings();
        }

        public function GetDatesOfScreenings() {
            return $this->screeningBdDAO->GetDatesOfScreenings();
        }

}



?>