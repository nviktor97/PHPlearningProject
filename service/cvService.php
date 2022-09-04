<?php
	class CvService {
		// set database config for mysql
		function __construct($conn) {
			$this->host = $conn->host;
			$this->user = $conn->user;
			$this->pass =  $conn->pass;
			$this->db = $conn->db;            					
		}
		// open mysql data base
		public function open_db() {
			$this->connection = new mysqli($this->host, $this->user, $this->pass, $this->db);
			if ($this->connection->connect_error) {
    			die("Erron in connection: " . $this->connection->connect_error);
			}
		}
		// close database connection
		public function close_db() {
			$this->connection->close();
		}	


        function cvlist(){
			$this->open_db();
			$idee = htmlspecialchars($_SESSION["id"]);

			// fetch files
			$sql = "select filename from submits where ownerid=$idee";
			$result = mysqli_query($this->connection, $sql);

			$this->close_db();
			return $result;
		}

        public function insertCV($name, $file_name, $mainid, $owner){
			$this->open_db();

			$sql1 = "INSERT INTO submits(username,filename,aimid,ownerid) VALUES('$name','$file_name','$mainid','$owner')";
        	$smt = $this->connection->query($sql1);

			$this->close_db();
			return true;

		}

    }


?>