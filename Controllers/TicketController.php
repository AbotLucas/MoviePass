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

        public function removerTicket($id_screening){

            $this->GetTicket($id_screening);

            if(isset($_POST['id_remove'])){

               

            
            }
        }
        

        public function GetTicket($id_screening) {

            $userName = $_SESSION['loginUser']->getUserName();
            
            $userDao = new UserBdDAO();

            $user = $userDao->GetByUserName($userName);
            
            if(!empty($user)){

            $this->AddTicket($id_screening,$user);
            
           
            $this->ticketBdDAO = new TicketBdDAO();

            $ticketList = $this->ticketBdDAO->GetTicketFromUser($user->getUserId());

            require_once(VIEWS_PATH."ticket-list.php");   

            }else{

                $message ="no esta logueado ";

               require_once(VIEWS_PATH."login.php");   
            }
        }



       
   }
   ?>