<?php
	class JobService {
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

        // select all advertisements from database    
		public function findAll() {
			try {
                $this->open_db();

                $query = $this->connection->prepare("SELECT id, names, email FROM job");
				$query->execute();
				$res = $query->get_result();	

				$query->close();				
				$this->close_db();                
                return $res;
			}
			catch(Exception $e) {
				$this->close_db();
				throw $e; 	
			}
			
		}


		public function findOne($oneId) {
			try {
                $this->open_db();

                $query = $this->connection->prepare("SELECT names, email, website, comment, worktype, experience, salary, diploma, userid FROM job WHERE id = $oneId");
				$query->execute();
				$res = $query->get_result();	

				$query->close();				
				$this->close_db();                
                return $res;
			}
			catch(Exception $e) {
				$this->close_db();
				throw $e; 	
			}
			
		}

		public function findLangIds($oneId) {
			try {
                $this->open_db();

                $query = $this->connection->prepare("SELECT languageid FROM jobid WHERE jobid = $oneId");
				$query->execute();
				$res = $query->get_result();	

				$query->close();				
				$this->close_db();                
                return $res;
			}
			catch(Exception $e) {
				$this->close_db();
				throw $e; 	
			}
			
		}

		public function findLangs($oneId) {
			try {
                $this->open_db();

                $query = $this->connection->prepare("SELECT name FROM languages WHERE id = $oneId");
				$query->execute();
				$res = $query->get_result();	

				$query->close();				
				$this->close_db();                
                return $res;
			}
			catch(Exception $e) {
				$this->close_db();
				throw $e; 	
			}
			
		}


		public function findCompanies() {
			try {
                $this->open_db();

                $query = $this->connection->prepare("SELECT DISTINCT names FROM job");
				$query->execute();
				$res = $query->get_result();	

				$query->close();				
				$this->close_db();                
                return $res;
			}
			catch(Exception $e) {
				$this->close_db();
				throw $e; 	
			}
			
		}


		public function findCompanyJobs($companyName) {
			try {
                $this->open_db();

                $query = $this->connection->prepare("SELECT id, names, email FROM job WHERE names='$companyName'");
				$query->execute();
				$res = $query->get_result();	

				$query->close();				
				$this->close_db();                
                return $res;
			}
			catch(Exception $e) {
				$this->close_db();
				throw $e; 	
			}
			
		}


		public function form(){

			$this->open_db();

			$nameErr = $emailErr = $worktypeErr = $websiteErr = $salaryErr = $boxErr = $diplomaErr = "";
			$name = $email = $worktype = $comment = $website = $exp = $salary = $box = $diploma = "";


			if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST["name"])) {
				$nameErr = "Name is required";
			} else {
				$name = $this->test_input($_POST["name"]);
				// check if name only contains letters and whitespace
				if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
				$nameErr = "Only letters and white space allowed";
				}
			}
			
			if (empty($_POST["email"])) {
				$emailErr = "Email is required";
			} else {
				$email = $this->test_input($_POST["email"]);
				// check if e-mail address is well-formed
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$emailErr = "Invalid email format";
				}
			}
				
			if (empty($_POST["website"])) {
				$website = "";
			} else {
				$website = $this->test_input($_POST["website"]);
				// check if URL address syntax is valid (this regular expression also allows dashes in the URL)
				if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
				$websiteErr = "Invalid URL";
				}
			}

			if (empty($_POST["comment"])) {
				$comment = "";
			} else {
				$comment = $this->test_input($_POST["comment"]);
			}


			if (empty($_POST["diploma"])) { 
				$diplomaErr = "Diploma requirements have to be checked!";
			} else {
				$diploma = $this->test_input($_POST["diploma"]);
			}

			if (empty($_POST["worktype"])) {
				$worktypeErr = "Work type is required";
			} else {
				$worktype = $this->test_input($_POST["worktype"]);
			}



			$exp = $this->test_input($_POST["exp"]);

			if (empty($_POST["salary"])) {
				$salaryErr = "Salary is required";
			} else {
				$salary = $this->test_input($_POST["salary"]);
				$salary = str_replace(' ', '', $salary);
				// check if salaryis well-formed
				if (!is_numeric($salary)) {
				$salaryErr = "Invalid salary format";
				}
			}

			$box = $_POST['languageBox'];
			if(empty($box)) 
			{
				$boxErr = "You didn't select any languages";
			} 

			

			}

			$res[0] = $nameErr;
			$res[1] = $emailErr;
			$res[2] = $worktypeErr;
			$res[3] = $websiteErr;
			$res[4] = $salaryErr;
			$res[5] = $boxErr;
			$res[6] = $diplomaErr;


			if($nameErr == "" && $emailErr == "" && $worktypeErr == "" && $salaryErr == "" && !empty($box) && $diplomaErr == "" && $websiteErr == "")
			{

			try {
			

			$usid = htmlspecialchars($_SESSION["id"]);
			$sql = "INSERT INTO job (names, email, website, comment, worktype, experience, salary, diploma, userid)
			VALUES ('$name', '$email','$website', '$comment', '$worktype', '$exp', '$salary', '$diploma', '$usid')";
			// use exec() because no results are returned
			$smt = $this->connection->query($sql);

			

			
			$sql2 = "SELECT MAX(id) FROM job";
			$ID = $this->connection->query($sql2);
			while ($row = $ID->fetch_row()) {
				$one = $row[0];
			}
			$N = count($box);
			for($i=0; $i < $N; $i++)
				{
				$sql3 =  "SELECT id FROM languages WHERE name = '$box[$i]'";
				/*echo "<br>";
				echo $box[$i];*/

				$ID2 = $this->connection->query($sql3);

				while ($row2 = $ID2->fetch_row()) {
					$two = $row2[0];
				}

				$sql4 = "INSERT INTO jobid (jobid, languageid) VALUES ('$one', '$two')";
				$smt2 = $this->connection->query($sql4);
						
				}

				echo "New record created successfully";
			


			} catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
			}

			

			//mysqli_close($this->connection);
			

			}

			$this->close_db();
			return $res;

		}

		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
			}


		public function findUserJobs($oneId) {
			try {
                $this->open_db();

                
				$query =  $this->connection->prepare("SELECT id, names, email FROM job WHERE userid='$oneId'");
				$query->execute();
				$res = $query->get_result();	

				$query->close();				
				$this->close_db();                
                return $res;
			}
			catch(Exception $e) {
				$this->close_db();
				throw $e; 	
			}
			
		}
		
		public function deleteJob($jobid){
			$this->open_db();

			$sql1 = "DELETE FROM job WHERE id='$jobid'";
        	$smt = $this->connection->query($sql1);

			$this->close_db();

		}


	}

?>