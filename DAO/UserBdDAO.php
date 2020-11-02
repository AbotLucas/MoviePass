<?php 

namespace DAO;
use DAO\Connection as Connection;
use Models\User as User;

class UserBdDAO{

    private $connection;
    private $tableName = "user";

    public function GetByUserName($userName)
    {
        $user = null;

        $query = "SELECT user_id ,username, password ,role FROM ".$this->tableName." WHERE (username = :username) ";

        $parameters["username"] = $userName;

        $this->connection = Connection::GetInstance();

        $results = $this->connection->Execute($query, $parameters);

        foreach($results as $users)
        {
           $user = new User($users['user_id'],$users["username"],$users["password"],$users['role']);
          #$user = $this->mapear($user);
           
        }

        return $user;
    }  
    protected function mapear($value) {

        $value = is_array($value) ? $value : [];

        $resp = array_map(function($p){
            return new User($p['user_id'], $p['username'], $p['password'], $p['role']);
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];
    }
    
}
?>