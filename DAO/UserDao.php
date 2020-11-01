<?php 
namespace DAO;

use Exception as GlobalException;
use FFI\Exception;
use Models\User as User;
use PDOException;

class UserDAO {
   
    private $nameFileUser = ROOT."Data/user.json";
    private $listUser = array();
    private $connection;

    public function retrieveData(){

        $this->listUser = array();
        if(file_exists($this->nameFileUser)){
          
            $contentFile = file_get_contents($this->nameFileUser);
            $contenDecode = ($contentFile)? json_decode($contentFile,true): array();
            foreach ($contenDecode as $value) {
               $user = new User($value['idUser'],$value['userName'], $value['password'], $value['role']);
               $user->setUserName($value['userName']);
               $user->setPassword($value['password']);
               array_push($this->listUser,$user);
            }
        }

    }
    public function GetUserName($userName)
    {
        $user = null;
        $this->RetrieveData();
        $users = array_filter($this->listUser, function($user) use($userName){
            return $user->getUserName() == $userName;
        });
        $users = array_values($users);
        return (count($users) > 0) ? $users[0] : null;
    }

    public function getAllUser(){
        $this->retrieveData();
        return $this->listUser;
    }

    /* FUNCIONES DE DATABASE */

    /* Retorna false o la instancia encontrada*/
    public function SearchEmailInDB($email) {

        $sql = "SELECT * FROM Users WHERE userName = :userName";

        $parameters["userName"] = $email;

        try {

            $this->connection = Connection::GetInstance();
            $resultStat = $this->connection->Execute($sql, $parameters);

        } catch (Exception $ex) {
            throw $ex;
        }

        if (!empty($resultStat)){
            return $this->mapear($resultStat);
        }
        else
            return false;

    }

    public function GetLastIdUserInDB() {

        $sql = "SELECT user_id FROM users ORDER BY user_id DESC LIMIT 1";

        try {
            $this->connection = Connection::GetInstance();
            $resultStat = $this->connection->Execute($sql);
        } catch (Exception $ex) {
            throw $ex;
        }
        return $resultStat;
    }

    public function SaveUserInDB($user) {

        $sql = "INSERT INTO users (user_id, email, password, role) VALUES (:user_id, :userName, :password, :role)";

        $parameters["user_id"] = $this->GetLastIdUserInDB() + 1;
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
            return new User($p['user_id'], $p['userName'], $p['password'], $p['role']);
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];
    }
}


?>