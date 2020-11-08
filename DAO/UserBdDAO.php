<?php 

namespace DAO;
use DAO\Connection as Connection;
use Exception as GlobalException;
use FFI\Exception;
use Models\User as User;

class UserBdDAO{

    private $connection;
    private $tableName = "user";

    public function GetByUserName($userName)
    {

        $query = "SELECT * FROM " . $this->tableName . " WHERE (username = :username) ";

        $parameters["username"] = $userName;

        try{

            $this->connection = Connection::GetInstance();
            $resultStat = $this->connection->Execute($query, $parameters);
        
        } catch (Exception $ex) {
            throw $ex;
        }

        if (!empty($resultStat)){
            return $this->mapear($resultStat);
        }
        else
            return false;
    }  

    public function SaveUserInDB($user) {

        $sql = "INSERT INTO " .$this->tableName. " (userName, password, role) VALUES (:userName, :password, :role)";

        $parameters["userName"] = $user->GetUserName();
        $parameters["password"] = $user->GetPassword();
        $parameters["role"] = 2;

        try {
            $this->connection = Connection::GetInstance();
            return $this->connection->ExecuteNonQuery($sql, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    protected function mapear($value) {
        
        $value = is_array($value) ? $value : [];

        $resp = array_map(function($p){
            $user = new User($p['username'], $p['password'], $p['role']);
            $user->setUserId($p["user_id"]);
            return $user;
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];
    }
    
}
