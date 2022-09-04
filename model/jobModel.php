<?php

class Job {
    public $id;
    public $names;
    public $email;
    public $website;
    public $comment;
    public $worktype;
    public $experience;
    public $salary;
    public $diploma;
    public $userid;
    

    function __construct($id, $names, $email, $website, $comment, $worktype, $experience, $salary, $diploma, $userid) {
        $this->$id=$id;
        $this->$names=$names;
        $this->$email=$email;
        $this->$website=$website;
        $this->$comment =$comment;
        $this->$worktype=$worktype;
        $this->$experience=$experience;
        $this->$salary=$salary;
        $this->$diploma=$diploma;
        $this->$userid=$userid;
    }
}

?>