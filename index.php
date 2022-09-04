<?php
// Initialize the session
session_start();
 

?>

<!DOCTYPE HTML>  
<html>
<head>
<link rel="stylesheet" href="./css/styles.css">
<title>Home</title>
</head>
<body>  


<h1 style="text-align: center; overflow: hidden; ">HOME</h1>


<?php
include_once './view/nav.php';
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
  echo "<h1 style='text-align: center;'> You are logged out!</h1>";
}
else
{
  $name = htmlspecialchars($_SESSION["username"]);
  echo "<h1 style='text-align: center;'> Hi $name</h1>";
}
?>

</body>
</html>