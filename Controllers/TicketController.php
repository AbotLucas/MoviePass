<?php
    namespace Controllers;

    use Models\Ticket as Ticket;
    use DAO\TicketBdDAO as TicketBdDAO;
    use DAO\ScreeningBdDAO as ScreeningBdDAO;
    use DAO\UserBdDAO as UserBdDAO;
    use PDOException;

    class TicketController
    {       
        
        private $ticketBdDAO;

        public function __construct() {
            
            $this->ticketBdDAO = new TicketBdDAO();
        }


        public function AddTicket($id_screening, $id_user) {

            
            $screening = ScreeningBdDAO::MapearScreening($id_screening);
            $user = UserBdDao::MapearUser($id_user);   
    
            $newTicket = new Ticket($screening,$user);
        
            $this->TicketBdDAO = new TicketBdDAO();
            $result = $this->TicketBdDAO->SaveTicketInBd($newTicket);

            if($result == 1) {
                $message = "";
                require_once(VIEWS_PATH."");
            }
            else {

                $message = "Ticket added FAIL!";
                require_once(VIEWS_PATH."");           
            }

        }
       
   }
   ?>