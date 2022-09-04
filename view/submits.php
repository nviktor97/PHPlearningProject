<?php
// Initialize the session
session_start();

include(dirname(__DIR__).'\\controller\\cvController.php');

        $cvController = new cvController();
        $result = $cvController->cvlistfunct();
?>



<!DOCTYPE html>
<html>
<head>
    <title>Upload View & Download file in PHP and MySQL | Demo</title>
    
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<?php
include_once 'nav.php';
?>

<br/>
<div class="container">
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>File Name</th>
                        <th>View</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                while($row = mysqli_fetch_array($result)) { ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['filename']; ?></td>
                    <td><a href="../pdf/<?php echo $row['filename']; ?>" target="_blank">View</a></td>
                    <td><a href="../pdf/<?php echo $row['filename']; ?>" download>Download</td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>