<?php
// Initialize the session
session_start();
 

?>

<?php include '../config.php'; ?>

<!DOCTYPE HTML>  
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="../css/substyle.css">
<link rel="stylesheet" href="../css/styles.css">
<title>Submit job</title>
</head>
<body>

<?php
include_once 'nav.php';
?>

    <div class="container" style="margin-top:30px">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
              <strong>Upload PDF</strong>
                <form method="post" enctype="multipart/form-data">
                    <?php
                        // If submit button is clicked
                        if (isset($_POST['submit']))
                        {
                          // get name from the form when submitted
                          //$name = $_POST['name']; 
                          $name = htmlspecialchars($_SESSION["username"]);
                          $mainid = $_GET['jid'];
                          $owner = $_GET['oid'];                   
 
                          if (isset($_FILES['pdf_file']['name']))
                          {  
                          // If the ‘pdf_file’ field has an attachment
                            $file_name = $_FILES['pdf_file']['name'];
                            $file_tmp = $_FILES['pdf_file']['tmp_name'];
                             
                            // Move the uploaded pdf file into the pdf folder
                            move_uploaded_file($file_tmp,"../pdf/".$file_name);
                            // Insert the submitted data from the form into the table

                            include(dirname(__DIR__).'\\controller\\cvController.php');

                            $cvController = new cvController();
                            $deed = $cvController->insertCVFunct($name, $file_name, $mainid, $owner);    
 
                                if ($deed)
                               {                            
                    ?>                                             
                                  <div class=
                                "alert alert-success alert-dismissible fade show text-center">
                                    <a class="close" data-dismiss="alert" aria-label="close">
                                      ×
                                    </a>
                                    <strong>Success!</strong> Data submitted successfully.
                                  </div>
                                <?php
                                }
                                else
                                {
                                ?>
                                  <div class=
                                "alert alert-danger alert-dismissible fade show text-center">
                                    <a class="close" data-dismiss="alert" aria-label="close">
                                      ×
                                    </a>
                                    <strong>Failed!</strong> Try Again!
                                  </div>
                                <?php
                                }
                            }
                            else
                            {
                              ?>
                                <div class=
                                "alert alert-danger alert-dismissible fade show text-center">
                                  <a class="close" data-dismiss="alert" aria-label="close">
                                      ×
                                  </a>
                                  <strong> File must be uploaded in PDF format!</strong>
                                </div>
                              <?php
                            }// end if
                        }// end if
                    ?>
                     
                    <div class="form-input py-2">                              
                        <div class="form-group">
                            <input type="file" name="pdf_file"
                                   class="form-control" accept=".pdf" required/>
                        </div>
                        <div class="form-group">
                            <input type="submit"
                                  class="btnRegister" name="submit" value="Submit">
                        </div>
                    </div>
                </form>
            </div>           
             
        
    </div>
</body>
</html>