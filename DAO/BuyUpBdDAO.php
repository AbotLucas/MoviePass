<?php
namespace DAO;

use Models\BuyUp as BuyUp;
use DAO\IbuyUp as IbuyUp;
use DAO\Connection as Connection;
use FFI\Exception;

class BuyUpBdDAO implements IbuyUp{

   # private $tableName = "buyUp";
    private $connection;
    private $buyUpList = [];
   
    public function __construct(){
        
    }

    public function SaveBuyUpInBd(BuyUp $BuyUp) {
    
        $sql = "call addbuyUp(". $BuyUp->getTicket()->getId_ticket() . "," . $BuyUp->getTicketquantity() .")";
      
              $parameters["id_buyUp"] = $BuyUp->getId_buyUp();
              $parameters["idticket"] = $BuyUp->getTicket()->getId_ticket();
              $parameters["ticketquantity"] = $BuyUp-getTicketquantity()>;
              $parameters["date_buy"] = $BuyUp->getDate_buy();
              $parameters["total"] = $BuyUp->getTotal();
              try {
                  $this->connection = Connection::GetInstance();
                  return $this->connection->ExecuteNonQuery($sql, $parameters);
              } catch (Exception $ex) {
                  throw $ex;
              }
          }

          
    public function getBdBuyUpFromBD(){
        
        $query = "call getallbuyUp()";
        try {
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);

        } catch (Exception $ex) {
            throw $ex;
        }
        
        return $result;
    
    }

   
    public function getAllBuyUp() {

        $buyUpArray = $this->getBdBuyUpFromBD();
        if(!empty($buyUpArray)) {
            
            $result = $this->mapear($buyUpArray);
            if(is_array($result)) {
                $this->buyUpList = $result;
            }
            else {
                $arrayResult[0] = $result;
                $this->buyUpList = $arrayResult;
            }
            return $this->buyUpList;
        }
        else {
            return $errorArray[0] = "ERROR while reading the database.";
        }
    }

    protected function mapear($value) {
        
        $value = is_array($value) ? $value : [];

        $resp = array_map(function($p){
            $buyUp = new BuyUp();
            $buyUp->setId_buyUp($p['id_buyUp']);
            $buyUp->setTicket(TicketBdDAO::MapearTicket($p['idticket']));
            $buyUp->setTicketquantity($p['ticketquantity']);
            $buyUp->setDate_buy($p['date_buy']);
            $buyUp->setTotal($p['total']);
        
            return $buyUp;

        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];
    }

  
        public function GetBuyUpById($searchidBuyUp)
        {
    
            $query = "call getbuyUp(" . $searchidBuyUp .")";
           
            $parameters["id_BuyUp"] = $searchidBuyUp;
    
            try{
    
                $this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, $parameters);


            } catch (Exception $ex) {
                throw $ex;
            }
            $buyUp = new BuyUp();
            $buyUp  = $this->mapear($results);

            return $buyUp ;
    
        }  

        public function deleteBuyUp($id_buyUp){

            $sql ="deleteBuyUp(" . $id_buyUp .")" ;
      
            $parameters["id_buyUp"] = $id_buyUp;
    
            try {
    
                $this->connection = Connection::GetInstance();
                $result = $this->connection->ExecuteNonQuery($sql, $parameters);
                return $result;

            }catch (Exception $ex){
                throw $ex;
            }
        }
        
        public static function MapearBuyUp($idBuyUpToMapear) {

            $BuyUpDAOBdAux = new BuyUpBdDAO();

            return $BuyUpDAOBdAux->GetBuyUpById($idBuyUpToMapear);
        }      
        
    

}