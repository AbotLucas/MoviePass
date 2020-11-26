<?php 

namespace Models;
use Models\Ticket as Ticket;


class BuyUp{
    
   private $id_buyUp;
   private $ticket ;
   private $ticketquantity;
   private $date_buy ;
   private $total;
    

    public function __construct()
    {
        
    }

   public function getId_buyUp(){ return $this->id_buyUp;}
   public function setId_buyUp($id_buyUp){ $this->id_buyUp = $id_buyUp;}
   public function getTicket(){ return $this->ticket;}
   public function setTicket( $ticket) {$this->ticket = $ticket;}
   public function getTicketquantity() {return $this->ticketquantity;}
   public function setTicketquantity($ticketquantity){ $this->ticketquantity = $ticketquantity;}
   public function getDate_buy(){  return $this->date_buy;}
   public function setDate_buy($date_buy){ $this->date_buy = $date_buy;}
   public function getTotal(){ return $this->total;}
   public function setTotal($total){  $this->total = $total; }
}



?>