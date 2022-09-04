<?php
	class UserService {
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

        public function register(){

			$this->open_db();


			$username = $password = $confirm_password = "";
			$username_err = $password_err = $confirm_password_err = "";
 
			// Processing form data when form is submitted
			if($_SERVER["REQUEST_METHOD"] == "POST"){
			
				// Validate username
				if(empty(trim($_POST["username"]))){
					$username_err = "Please enter a username.";
				} elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
					$username_err = "Username can only contain letters, numbers, and underscores.";
				} else{
					// Prepare a select statement
					$sql = "SELECT id FROM users WHERE username = ?";
					
					if($stmt = mysqli_prepare($this->connection, $sql)){
						// Bind variables to the prepared statement as parameters
						mysqli_stmt_bind_param($stmt, "s", $param_username);
						
						// Set parameters
						$param_username = trim($_POST["username"]);
						
						// Attempt to execute the prepared statement
						if(mysqli_stmt_execute($stmt)){
							/* store result */
							mysqli_stmt_store_result($stmt);
							
							if(mysqli_stmt_num_rows($stmt) == 1){
								$username_err = "This username is already taken.";
							} else{
								$username = trim($_POST["username"]);
							}
						} else{
							echo "Oops! Something went wrong. Please try again later.";
						}

						// Close statement
						mysqli_stmt_close($stmt);
					}
				}
				
				// Validate password
				if(empty(trim($_POST["password"]))){
					$password_err = "Please enter a password.";     
				} elseif(strlen(trim($_POST["password"])) < 6){
					$password_err = "Password must have atleast 6 characters.";
				} else{
					$password = trim($_POST["password"]);
				}
				
				// Validate confirm password
				if(empty(trim($_POST["confirm_password"]))){
					$confirm_password_err = "Please confirm password.";     
				} else{
					$confirm_password = trim($_POST["confirm_password"]);
					if(empty($password_err) && ($password != $confirm_password)){
						$confirm_password_err = "Password did not match.";
					}
				}
				
				// Check input errors before inserting in database
				if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
					
					// Prepare an insert statement
					$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
					
					if($stmt = mysqli_prepare($this->connection, $sql)){
						// Bind variables to the prepared statement as parameters
						mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
						
						// Set parameters
						$param_username = $username;
						$param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
						
						// Attempt to execute the prepared statement
						if(mysqli_stmt_execute($stmt)){
							// Redirect to login page
							header("location: login.php");
						} else{
							echo "Oops! Something went wrong. Please try again later.";
						}

						// Close statement
						mysqli_stmt_close($stmt);

					
					}
				}
				$res[0] = $username_err;
				$res[1] = $password_err;
				$res[2] = $confirm_password_err;
				// Close connection
				$this->close_db();
				return $res;
			}
		}

        public function login(){
			try {
                $this->open_db();


				$username = $password = "";
				$username_err = $password_err = $login_err = "";
 
				// Processing form data when form is submitted
				if($_SERVER["REQUEST_METHOD"] == "POST"){
				
					// Check if username is empty
					if(empty(trim($_POST["username"]))){
						$username_err = "Please enter username.";
					} else{
						$username = trim($_POST["username"]);
					}
					
					// Check if password is empty
					if(empty(trim($_POST["password"]))){
						$password_err = "Please enter your password.";
					} else{
						$password = trim($_POST["password"]);
					}
					
					// Validate credentials
					if(empty($username_err) && empty($password_err)){
						// Prepare a select statement
						$sql = "SELECT id, username, password FROM users WHERE username = ?";
						
						if($stmt = mysqli_prepare($this->connection, $sql)){
							// Bind variables to the prepared statement as parameters
							mysqli_stmt_bind_param($stmt, "s", $param_username);
							
							// Set parameters
							$param_username = $username;
							
							// Attempt to execute the prepared statement
							if(mysqli_stmt_execute($stmt)){
								// Store result
								mysqli_stmt_store_result($stmt);
								
								// Check if username exists, if yes then verify password
								if(mysqli_stmt_num_rows($stmt) == 1){                    
									// Bind result variables
									mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
									if(mysqli_stmt_fetch($stmt)){
										if(password_verify($password, $hashed_password)){
											// Password is correct, so start a new session
											session_start();
											
											// Store data in session variables
											$_SESSION["loggedin"] = true;
											$_SESSION["id"] = $id;
											$_SESSION["username"] = $username;                            
											
											// Redirect user to welcome page
											header("location: http://localhost/works/sec/");
										} else{
											// Password is not valid, display a generic error message
											$login_err = "Invalid username or password.";
										}
									}
								} else{
									// Username doesn't exist, display a generic error message
									$login_err = "Invalid username or password.";
								}
							} else{
								echo "Oops! Something went wrong. Please try again later.";
							}

							// Close statement
							mysqli_stmt_close($stmt);
						}
						}
						$res[0] = $username_err;
						$res[1] = $password_err;
						$res[2] = $login_err;

					}



				$this->close_db();
				return $res; 

			}
			catch(Exception $e) {
				$this->close_db();
				throw $e; 	
			}

		}


		public function logout(){
			// Initialize the session
			session_start();
			
			// Unset all of the session variables
			$_SESSION = array();
			
			// Destroy the session.
			session_destroy();
			
			// Redirect to login page
			header("location: ../index.php");
			exit;
		}

    }

?>