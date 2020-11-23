<?php
    namespace Controllers;

    use Models\Ticket as Ticket;
    use DAO\TicketBdDAO as TicketBdDAO;
    use DAO\ScreeningBdDAO as ScreeningBdDAO;
    use DAO\UserBdDAO as UserBdDAO;
    use Models\User as User;
    use PDOException;

    class TicketController
    {       
        
        private $ticketBdDAO;

        public function __construct() {
            
            $this->ticketBdDAO = new TicketBdDAO();
        }


        public function AddTicket($id_screening,User $user) {

            
            $screening = ScreeningBdDAO::MapearScreening($id_screening);
           
            $newTicket = new Ticket($screening,$user);
        
            $this->TicketBdDAO = new TicketBdDAO();
            $result = $this->TicketBdDAO->SaveTicketInBd($newTicket);

            if($result == 1) {
                $message = "";
               # require_once(VIEWS_PATH."");
            }
            else {

                $message = "Ticket added FAIL!";
               # require_once(VIEWS_PATH."");           
            }

        }

        #Ticket/GetTicket/?id_screening=" . $screening->getId_screening(); */

        public function GetTicket($id_screening) {

            $userName = $_SESSION['loginUser']->getUserName();
            
            $userDao = new UserBdDAO();

            $user = $userDao->GetByUserName($userName);
            
            if(!empty($user)){

            $this->AddTicket($id_screening,$user);
            
            $screening = ScreeningBdDao::MapearScreening($id_screening);
            #$user= UserBdDAO::MapearUser($id_user);

            #$this->ticketBdDAO = new TicketBdDAO();
            #$screeningList = $this->ticketBdDAO->getTickesFromAUserDB($id_user);

            require_once(VIEWS_PATH."ticket-list.php");   

            }else{
                $message ="";

            }
        }



       
   }
   ?>