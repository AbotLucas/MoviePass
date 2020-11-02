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
        $user = null;

        $query = "SELECT user_id ,username, password ,role FROM " . $this->tableName . " WHERE (username = :username) ";

        $parameters["username"] = $userName;

        try{

            $this->connection = Connection::GetInstance();
            $results = $this->connection->Execute($query, $parameters);
        
        } catch (Exception $ex) {
            throw $ex;
        }

        foreach($results as $user)
        {
           $userReturn = $this->mapear($user);
        }

        return $userReturn;
    }  

    public function SaveUserInDB($user) {

        $sql = "INSERT INTO user (userName, password, role) VALUES (:userName, :password, :role)";

        $parameters["userName"] = $user->GetUserName();
        $parameters["password"] = $user->GetPassword();
        $parameters["role"] = 1;

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
            return new User($p['username'], $p['password'], $p['role']);
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];
    }
    
}
