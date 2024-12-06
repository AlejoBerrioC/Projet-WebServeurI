<?php
class User{
    private $id;
    private $username;
    private $email;
    private $password;
    private $role;
    private $date_inscription;

    public function __construct($id, $username, $email, $password, $role, $date_inscription){
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->date_inscription = $date_inscription;
    }

    public function getId(){
        return $this->id;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getEmail(){
        return $this->email;
    }   

    public function getPassword(){
        return $this->password;
    }
    
    public function getRole(){
        return $this->role;
    }
    public function getDateInscription(){
        return $this->date_inscription;
    }

    public function setUsername($username){
        $this->username = $username;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function setRole($role){
        $this->role = $role;
    }

    public function setDateInscription($date_inscription){
        $this->date_inscription = $date_inscription;
    }
}
?>