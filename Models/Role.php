<?php 
namespace Models;

class Role{
    private $id_role;
    private $preority;

    public function __construct($id_role , $preority){
        $this->id_role = $id_role;
        $this->preority = $preority;
    }


    public function getId_role()
    {
        return $this->id_role;
    }

    public function setId_role($id_role)
    {
        $this->id_role = $id_role;

    }


    public function getPreority()
    {
        return $this->preority;
    }


    public function setPreority($preority)
    {
        $this->preority = $preority;
    }
}