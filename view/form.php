<?php
// Initialize the session
session_start();
?>



<?php
include(dirname(__DIR__).'\\controller\\jobController.php');

        $jobController = new jobController();
        $nameErr = $emailErr = $worktypeErr = $websiteErr = $salaryErr = $boxErr = $diplomaErr = "";
        $name = $email = $worktype = $comment = $website = $exp = $salary = $box = $diploma = "";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
        $errs = $jobController->formfunct();
        $nameErr = $errs[0];
        $emailErr = $errs[1];
        $worktypeErr = $errs[2];
        $websiteErr = $errs[3];
        $salaryErr = $errs[4];
        $boxErr = $errs[5];
        $diplomaErr = $errs[6];
        }

?>

<!DOCTYPE HTML>  
<html>
<head>
<link rel="stylesheet" href="../css/formlook.css">
<title>Job form</title>
</head>
<body>  

<?php
include_once 'nav.php';
?>

<div id="cont">

<form id="myform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<h2>Job description form</h2>
<p><span class="error">* required field</span></p>

  <div class="col-25">
  <label><b> Company: </b> </label>
  </div> 
  
  <div class="col-75">
  <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  </div>

  <div class="col-25">
  <label> <b> E-mail: </b> </label>
  </div>

  <div class="col-75">
  <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  </div>

  <div class="col-25">
  <label> <b> Website: </b> </label>
  </div>
  
  <div class="col-75">
  <input type="text" name="website" value="<?php echo $website;?>">
  <span class="error"><?php echo $websiteErr;?></span>
  </div>

  <div class="col-25">
  <label> <b> Description: </b> </label>
  </div>
  
  <div class="col-75">
  <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
  </div>

  <div class="col-26">
  <label><b> Work type: </b> </label>
  </div>

  <div class="col-76">
  <input type="radio" name="worktype" <?php if (isset($worktype) && $worktype=="onsite") echo "checked";?> value="onsite">Onsite
  <input type="radio" name="worktype" <?php if (isset($worktype) && $worktype=="remote") echo "checked";?> value="remote">Remote
  <input type="radio" name="worktype" <?php if (isset($worktype) && $worktype=="hybrid") echo "checked";?> value="hybrid">Hybrid  
  <span class="error">* <?php echo $worktypeErr;?></span>
  </div>
  
  <div class="col-26">
  <label><b> Experience: </b> </label>
  </div>
  
  <div class="col-76">
  <select id="exp" name="exp">
  <option value="nothing">Nothing</option>
  <option value="one">1</option>
  <option value="two">2</option>
  <option value="three">3</option>

  <?php echo $exp;?>
  </select>
  </div>

  <div class="col-25">
  <label> <b> Salary: </b> </label>
  </div>
  
  <div class="col-75">
  <input type="text" name="salary" value="<?php echo $salary;?>">
  <span class="error">* <?php echo $salaryErr;?></span>
  </div>

  <div class="col-26">
  <label> <b>Languages:</b> </label>
  </div>

  <div class="col-76">
  <input type="checkbox" name="languageBox[]" value="java" />Java<br/>
  <input type="checkbox" name="languageBox[]" value="c" />C<br/>
  <input type="checkbox" name="languageBox[]" value="c++" />C++<br/>
  <input type="checkbox" name="languageBox[]" value="c#" />C#<br/>
  <input type="checkbox" name="languageBox[]" value="python" />Python
  <span class="error">* <?php echo $boxErr;?></span>
  </div>

  <div class="col-26">
  <label> <b> Diploma: </b> </label>
  </div>

  <div class="col-76">
  <input type="radio" name="diploma" <?php if (isset($diploma) && $diploma=="1") echo "checked";?> value="1">Required
  <input type="radio" name="diploma" <?php if (isset($diploma) && $diploma=="2") echo "checked";?> value="2">Not required
  <span class="error">* <?php echo $diplomaErr;?></span>
  </div>
  <br><br>

  <input type="submit" name="submit" value="Submit">  
</form>

</div>
</body>
</html>