<?php
include(dirname(__DIR__).'\\controller\\userController.php');

$userController = new userController();
$userController->logoutfunct();
?>