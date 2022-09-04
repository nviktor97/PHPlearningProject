<?php

class Submits {
    public $id;
    public $username;
    public $filename;
    public $aimid;
    public $ownerid;

    function __construct($id, $username, $filename, $aimid, $ownerid) {
        $this->$id=$id;
        $this->$username=$username;
        $this->$filename=$filename;
        $this->$aimid=$aimid;
        $this->$ownerid=$ownerid;
    }
}

?>