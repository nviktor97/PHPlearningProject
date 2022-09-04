<?php

class jobLang {
    public $jobid;
    public $langid;

    function __construct($jobid, $langid) {
        $this->$jobid=$jobid;
        $this->$langid=$langid;
    }
}

?>