<?php 

namespace Models;
 
class User{

    private $user_id;
    private $userName ;
    private $password;
    private $role;

    public function __construct($user_id, $userName, $password, $role)
    {
        $this->userName = $userName;
        $this->password = $password;
        $this->user_id = $user_id;
        $this->role = $role;
    }

    public function getUserId(){ return $this->user_id;}
    public function setUserId($user_id){  $this->user_id = $user_id; }
    public function getUserName(){  return $this->userName; }
    public function setUserName($userName){$this->userName = $userName;}
    public function getPassword(){  return $this->password;}
    public function setPassword($password) { $this->password = $password;}
    public function getRole(){  return $this->role;}
    public function setRole($role) { $this->role = $role;}
}
?>