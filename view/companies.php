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
    <title>Company list</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1 style='text-align: center;'>Company List</h1>
    <?php
        include(dirname(__DIR__).'\\controller\\jobController.php');

        $jobController = new jobController();
       

        // Get all advertisements
        $companyList = $jobController->listAllCompanies();

        // Check if there any records found
        if($companyList->num_rows > 0){
            // Display the table that contains the advertisements
            
            echo "<table id='main'><tr><th>Company name</th></tr>";
                while ($company = $companyList->fetch_object()) {
                    // Fetching the actual user object for display the username
                    
                    echo "<tr onclick= document.location='http://localhost/works/sec/view/companyjob.php?actName=$company->names'><td>" . $company->names. "</td></tr>";
                }
                ;
            echo "</table>";

            // Free the result set
            mysqli_free_result($companyList);
        } else {
            echo "<p>No records found.</p>";
        }

    ?>
</body>
</html>