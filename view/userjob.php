<?php
// Initialize the session
session_start();
?>

<!DOCTYPE HTML>  
<html>
<head>
<link rel="stylesheet" href="../css/styles.css">
<title>User's job</title>
</head>

<?php
include_once 'nav.php';
?>

<div>

<?php

include(dirname(__DIR__).'\\controller\\jobController.php');

$jobController = new jobController();
$usid = htmlspecialchars($_SESSION["id"]);
       

// Get all advertisements
$result = $jobController->findUserJobsFunct($usid);

if ($result->num_rows > 0) {
    echo "<table id='main'><tr><th>ID</th><th>Company name</th><th>Email</th><th>Action</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
       $act = $row["id"];
        echo "<tr><td>" . $row["id"]. "</td><td onclick= document.location='http://localhost/works/sec/view/details.php?actId=$act'>" . $row["names"]. "</td><td>" . $row["email"]. "</td><td><a href='http://localhost/works/sec/view/deletejob.php?hello=$act'>DELETE</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}


?>
</div>

</body>
</html>