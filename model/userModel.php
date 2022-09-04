<?php

class User {
    public $id;
    public $username;
    public $password;
    public $created_at;

    function __construct($id, $username, $password, $created_at) {
        $this->$id=$id;
        $this->$username=$username;
        $this->$password=$password;
        $this->$created_at=$created_at;
        
    }
}

?>