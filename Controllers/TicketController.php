<?php
    namespace Controllers;

    use Models\Ticket as Ticket;
    use DAO\TicketBdDAO as TicketBdDAO;
    use PDOException;

    class TicketController
    {       
        
        private $ticketBdDAO;

        public function __construct() {
            
            $this->ticketBdDAO = new TicketBdDAO();
        }


        public function AddTicket($id_screening)
        {   
            if(isset($_POST["cancel"])){

                $cinemaController = new CinemaController();
                $cinemaController->ShowListCinemaView();

            }
            else
            {
            $newTicket = new Ticket($name, $capacity, $ticketValue,CinemaBdDao::MapearCinema($id_cinema));
            $newShowListCinema = new CinemaController();

                try{
                    $result = $this->TicketBdDAO->SaveTicketInBd($newTicket);
                    if($result == 1) {
                        $message = "Ticket added succesfully!";
                        $this->ShowListTicketView($message, $id_cinema);
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
       
   }
   ?>