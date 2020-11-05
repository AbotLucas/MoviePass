<?php
namespace DAO;

use Models\Room as Room;
use DAO\Iroom as Iroom;
use FFI\Exception;

class RoomBdDAO {

    private $roomList = $array();
   # private $movieDAO;
    private $tableName = "Room";
    private $connection;

   
    public function __construct(){
        
    }
    public function getRoomFromDB(){
        
        $query = "SELECT * FROM " . $this->tableName;
        try {
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);

        } catch (Exception $ex) {
            throw $ex;
        }
        
        return $result;
    
    }

    protected function mapear($value) {

        $value = is_array($value) ? $value : [];

        $resp = array_map(function($p){
            $room = new Room($p['name'], $p['capacity'],$p[''],$p['ticketValue'],$p['cinema']);
            $room->setId_room($p['id_room']);
            return $room;

        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];
    }
    

    public function getAllRoom() {

        $roomArray = $this->getRoomFromDB();
        if(!empty($roomArray)) {
            
            $result = $this->mapear($roomArray);
            if(is_array($result)) {
                $this->roomList = $result;
            }
            else {
                $arrayResult[0] = $result;
                $this->roomList = $arrayResult;
            }
            return $this->roomList;
        }
        else {
            return $errorArray[0] = "Error al leer la base de datos.";
        }

    }
   
    public function addRoom($Room) {
    
      $sql = "INSERT INTO room (name, capacity,ticketvalue,idcinema) VALUES (:name, :capacity ,:ticketvalue , idcinema)";
    
            $parameters["name"] = $Room->getName();
            $parameters["capacity"] = $Room->getCapacity();
            $parameters["ticketvalue"] = $Room->getTicketvalue();
            $parameters["idcinema"] = $Room->getCinema();
            try {
                $this->connection = Connection::GetInstance();
                return $this->connection->ExecuteNonQuery($sql, $parameters);
            } catch (Exception $ex) {
                throw $ex;
            }
        }
       
    

    

    
    

    

}