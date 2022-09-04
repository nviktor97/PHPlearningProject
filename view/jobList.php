<?php
// Initialize the session
session_start();
include_once 'nav.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job list</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1 style='text-align: center;'>Job List</h1>
    <?php
        include(dirname(__DIR__).'\\controller\\jobController.php');

        $jobController = new jobController();
       

        // Get all advertisements
        $jobList = $jobController->listAllJobs();

        // Check if there any records found
        if($jobList->num_rows > 0){
            // Display the table that contains the advertisements
            
            echo "<table id='main'>";
                echo "<thead>";
                    echo "<tr>";
                        echo "<th>ID</th>";
                        echo "<th>Name</th>";
                        echo "<th>Email</th>";
                    echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while ($job = $jobList->fetch_object()) {
                    // Fetching the actual user object for display the username
                    
                    echo "<tr onclick= document.location='http://localhost/works/sec/view/details.php?actId=$job->id'>";
                        echo "<td>" . $job->id . "</td>";
                        echo "<td>" . $job->names . "</td>";
                        echo "<td>" . $job->email . "</td>";
                       
                    echo "</tr>";
                }
                echo "</tbody>";
            echo "</table>";

            // Free the result set
            mysqli_free_result($jobList);
        } else {
            echo "<p>No records found.</p>";
        }

    ?>

</body>
</html>