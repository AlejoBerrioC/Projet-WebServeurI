<?php
class User{
    public $id;
    public $username;
    public $email;
    public $password;
    public $role;
    public $date_inscription;

    public function __construct($id, $username, $email, $password, $role, $date_inscription){
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->date_inscription = $date_inscription;
    }
}
?>