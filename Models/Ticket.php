<?php 
namespace Models;
use Models\Screening as Screening;

class Ticket{

   private $id_ticket;
   private $screening;

   public function __construct(Screening $screening) {
           
    $this->screening = $screening;
   
}
   public function getId_ticket(){ return $this->id_ticket;}
   public function setId_ticket($id_ticket){ $this->id_ticket = $id_ticket;}
   public function getScreening(){ return $this->screening;}
   public function setScreening($screening){ $this->screening = $screening;}
   
}
?>