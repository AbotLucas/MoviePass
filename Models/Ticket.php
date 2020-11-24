<?php 
namespace Models;
use Models\Screening as Screening;
use Models\User as User;

class Ticket{

   private $id_ticket;
   private $screening;
   private  $user;

   public function __construct( $screening ,$user)
   {       
    $this->screening = $screening;
   $this->user = $user;
  }
   public function getId_ticket(){ return $this->id_ticket;}
   public function setId_ticket($id_ticket){ $this->id_ticket = $id_ticket;}
   public function getScreening(){ return $this->screening;}
   public function setScreening($screening){ $this->screening = $screening;}
   public function getUser() { return $this->user; }
   public function setUser($user){ $this->user = $user;}
}
?>