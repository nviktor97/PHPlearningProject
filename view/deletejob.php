<?php
// Initialize the session
session_start();

function runMyFunction() {
       
    include(dirname(__DIR__).'\\controller\\jobController.php');

    $jobController = new jobController();
    $del = $_GET['hello'];
    $jobController->deleteJobFunct($del);
  }

  $count = 0;

  if (isset($_GET['hello'])) {
    if($count == 0){
    $count++;
    runMyFunction();
    header("Location: http://localhost/works/sec/view/userjob.php");
    exit();}
  }
?>