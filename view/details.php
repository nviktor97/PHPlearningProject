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
    <title>Job details</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1 style='text-align: center;'>Job details</h1>
    <?php
        include(dirname(__DIR__).'\\controller\\jobController.php');

        $jobController = new jobController();

        $mainid = $_GET['actId'];
       

        // Get all advertisements
        $jobDetails = $jobController->listOneJob($mainid);

        // Check if there any records found
        if($jobDetails->num_rows > 0){
            // Display the table that contains the advertisements
            
            $job = $jobDetails->fetch_object();
            echo "<table><thead><tr><th colspan='2'>ID: $mainid </th></tr></thead>";
            echo "<tr><td style='font-weight:bold'>".'Company name:'."</td><td>" . $job->names. "</td></tr>";
            echo "<tr><td style='font-weight:bold'>".'Email:'."</td><td>" . $job->email. "</td></tr>";
            echo "<tr><td style='font-weight:bold'>".'Website:'."</td><td>" . $job->website. "</td></tr>";
            echo "<tr><td style='font-weight:bold'>".'Description:'."</td><td>" . $job->comment. "</td></tr>";
            echo "<tr><td style='font-weight:bold'>".'Work type:'."</td><td>" . $job->worktype. "</td></tr>";
            echo "<tr><td style='font-weight:bold'>".'Experience:'."</td><td>" . $job->experience. "</td></tr>";
            echo "<tr><td style='font-weight:bold'>".'Salary:'."</td><td>" . $job->salary. "</td></tr>";

            $owner = $job->userid;

            if($job->diploma == 1)
                echo "<tr><td style='font-weight:bold'>".'Diploma:'."</td><td>" . "Required!". "</td></tr>";
            else
                echo "<tr><td style='font-weight:bold'>".'Diploma:'."</td><td>" . "Not required!". "</td></tr>";

            // Free the result set
            mysqli_free_result($jobDetails);

            $jobLangs = $jobController->listLangs($mainid);
            

            $length = count($jobLangs);
            $langs = "";
            for($j = 0; $j < $length; $j++)
            {
                $langs .= $jobLangs[$j];
                $langs .= ", ";
            }

            echo "<tr><td style='font-weight:bold'>".'Languages:'."</td><td>" . $langs. "</td></tr>";
   
            echo "</table>";

            if(isset($_SESSION["loggedin"]))
            {
            echo "<br><br>";
            echo "<form method='POST' action='http://localhost/works/sec/view/submitjob.php?jid=$mainid&oid=$owner' style='text-align: center;'>
            <input type='submit' class='btn btn-primary' name='submit' value='submit' />
            </form>";
            }


        } else {
            echo "<p>No records found.</p>";
        }

    ?>

</body>
</html>