<?php 
namespace DAO;

use Models\User as User;

class UserDAO {
   
    private $nameFileUser = ROOT."Data/user.json";
    private $listUser = array();

    public function retrieveData(){

        $this->listUser = array();
        if(file_exists($this->nameFileUser)){
          
            $contentFile = file_get_contents($this->nameFileUser);
            $contenDecode = ($contentFile)? json_decode($contentFile,true): array();
            foreach ($contenDecode as $value) {
               $user = new User($value['id_User'],$value['userName'], $value['password'], $value['role']);
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

   
}


?>