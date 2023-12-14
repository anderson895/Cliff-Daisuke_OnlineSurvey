<?php
require 'controllers/connection.php';
session_start();
//truncute the   answerby surveyanswer ccanswer
$sql = "TRUNCATE TABLE surveyanswer";
$result = mysqli_query($conn,$sql);
$sql = "TRUNCATE TABLE ccanswer";
$result = mysqli_query($conn,$sql);
//truncate the surveyquestion and ccquestion
$sql = "TRUNCATE TABLE answerby ";
$result = mysqli_query($conn,$sql);
$sql = "TRUNCATE TABLE comments";
$result = mysqli_query($conn,$sql);

$_SESSION['sq'] = 'ubos';
header('location: dashboard');


?>