<?php
class Config  {	
	// This class contains the informations needed to connect to the database.
	function __construct() {
		$this->host = "localhost";
		$this->user  = "root";
		$this->pass = "";
		$this->db = "formtest";
	}
}
?>