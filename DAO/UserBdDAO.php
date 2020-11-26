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

        $query = "SELECT * FROM " . $this->tableName . " WHERE (username = :username) LIMIT 1";

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

    public function GetUserById($searchidUser)
    {
        $User = null;

        $query = "SELECT * FROM " . $this->tableName . " WHERE (user_id = :user_id) ";

        $parameters["user_id"] = $searchidUser;

        try{

            $this->connection = Connection::GetInstance();
            $results = $this->connection->Execute($query, $parameters);
        
        } catch (Exception $ex) {
            throw $ex;
        }
        
        $return = $this->mapear($results);

    }
    public static function MapearUser($idUserToMapear) {
        $userDAOBdAux = new UserBdDAO();
        return $userDAOBdAux->GetUserById($idUserToMapear);
    }

    

}
