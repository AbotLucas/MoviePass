<?php
    namespace Controllers;

    use Models\BuyUp as BuyUp;
    use DAO\BuyUpBdDAO as BuyUpBdDAO;
    use DAO\TicketBdDAO as TicketBdDAO;
    use Models\Ticket as Ticket;
    use Controllers\TicketController as TicketController;
    use Controllers\Functions;
    use PDOException;

   class BuyUpController
    {      
        private $buyUpBdDAO;

        public function __construct() {
               
            $this->buyUpBdDAO = new BuyUpBdDAO();
           
        }
       public function ShowListbuyUpView($message ="", $id_ticket){

            $listBuyUpUser = $this->buyUpBdDAO->GetBuyUpByfromticket($id_ticket);
            var_dump($listBuyUpUser);
            require_once(VIEWS_PATH."buyUp-list.php");
            
        }

        public function ShowlistsTicket($message, $user){

            $ticketShow = new TicketController();

            $ticketShow->ShowListTicketView($message ,$user);
        }

        public function TicketPayAdd($ticketquantity,$id_ticket){

                $user = $_SESSION['loginUser'];
                $buyUpBdDAO = new BuyUpBdDAO();
                try{
                    $result = $buyUpBdDAO->SaveBuyUpInBd($id_ticket , $ticketquantity);

                    if($result == 1) {

                        $message = "add buyUp";
                         var_dump($id_ticket);
                        $this->ShowListBuyUpView($message,$id_ticket);

                     }
                    else
                    {
                        $message = "ERROR: System error, reintente";
                        
                    }
                } catch (PDOException $ex){
                    $message = $ex->getMessage();
                    if(Functions::contains_substr($message, "Duplicate entry")){
                        $message = "I already add it !! you have to add another ticket ";
                        $this->ShowlistsTicket($message, $user);
                    }
                }
            }
        }
             
        


?>