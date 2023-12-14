<?php
require 'admin/controllers/connection.php';
session_start();
if(isset($_POST['submitanswer'])){
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $region = mysqli_real_escape_string($conn, $_POST['region']);
    $gender = mysqli_real_escape_string($conn,$_POST['gender']);
    $service = mysqli_real_escape_string($conn,$_POST['service']);
    $age = mysqli_real_escape_string($conn,$_POST['age']);
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $comment = mysqli_real_escape_string($conn,$_POST['comment']);

    //generate 8 digit number
    $id = mt_rand(10000000, 99999999);
    $ansql = "INSERT INTO `answerby`(`ID`, `NAME`, `CLIENTTYPE`, `GENDER`, `AGE`, `REGION`, `SERVICEAVAIL`,`ATT`) VALUES (NULL,'$name','$type','$gender','$age','$region','$service','$id')";
    $ansqlresult = mysqli_query($conn,$ansql);
    $selectedChoices = $_POST['answers'];

    foreach ($selectedChoices as $questionId => $selectedChoiceId) {
        $addccsql = "INSERT INTO `ccanswer`(`ID`, `DATEANSWER`, `CHOICEANSWER`, `QUE`, `ANSWERBY`) VALUES (NULL,CURRENT_TIMESTAMP,'$selectedChoiceId','$questionId','$id')";
        $addccsqlresult = mysqli_query($conn,$addccsql);
    }
    // Retrieve the selected answers and question IDs from the form
    $questionIds = $_POST['questionId'];

    // Loop through the submitted data and process it
    foreach ($questionIds as $questionId) {
        // Get the answer for the current question
        $answer = isset($_POST["question_$questionId"]) ? $_POST["question_$questionId"] : 'No answer';

        $sqsql = "INSERT INTO `surveyanswer`(`ID`, `DATEANSWER`, `CHOICESCORE`, `QUESTION`, `ANSWERBY`) VALUES (NULL,CURRENT_TIMESTAMP,'$answer','$questionId','$id')";
        $sqsqlresult = mysqli_query($conn,$sqsql);
        // You can also insert the data into your database or perform other actions as needed
        // Example: mysqli_query($conn, "INSERT INTO answers (question_id, user_answer) VALUES ('$questionId', '$answer')");
    }


    if($comment){
        $csql = "INSERT INTO comments (`ANSID`, `COMMENT`) VALUES ('$id','$comment')";
        $csqlresult = mysqli_query($conn,$csql);
    }
  

    $_SESSION['success'] = "success";
     header("location: answersheet.php");
} 
?>