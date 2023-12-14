<?php
require 'connection.php';
session_start();


if(isset($_POST['addsq'])){
    $question = mysqli_real_escape_string($conn,$_POST['question']);
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $sql = "INSERT INTO surveyquestion(TITLE,QUESTION) VALUES('$title','$question')";
    if(mysqli_query($conn,$sql)){
        $_SESSION['sq'] = "Success";
        header('location:../question.php');
    }else{
        $_SESSION['sq'] = "Failed";
        header('location:../question.php');
    }

}


if(isset($_POST['updateSQ'])){
    $question = mysqli_real_escape_string($conn, $_POST['editSQQuestionField']);
    $title = mysqli_real_escape_string($conn, $_POST['editSQTitleField']);
    $id = mysqli_real_escape_string($conn, $_POST['editSQID']);

    $sql = "UPDATE surveyquestion SET TITLE='$title', QUESTION='$question' WHERE ID='$id'";

    if(mysqli_query($conn, $sql)){
        $_SESSION['sq'] = "Success";
        header('location:../question.php');
    } else {
        $_SESSION['sq'] = "Failed";
        header('location:../question.php');
    }
}




if (isset($_POST['updatecc'])) {
    $question = mysqli_real_escape_string($conn, $_POST['editCCQuestionField']);
    $title = mysqli_real_escape_string($conn, $_POST['editCCTitleField']);
    $id = mysqli_real_escape_string($conn, $_POST['editCCID']); // Assuming you have a form field for the ID

    $sql = "UPDATE questioncc SET `TITLE`='$title', `DESCRIPTION`='$question' WHERE ID='$id'";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['sq'] = "Success";
        header('location:../question.php');
    } else {
        $_SESSION['sq'] = "Failed";
        header('location:../question.php');
    }
}



if(isset($_POST['addcc'])){
    $question = mysqli_real_escape_string($conn,$_POST['question']);
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $sql = "INSERT INTO questioncc(`TITLE`,`DESCRIPTION`) VALUES('$title','$question')";
    if(mysqli_query($conn,$sql)){
        $_SESSION['sq'] = "Success";
        header('location:../question.php');
    }else{
        $_SESSION['sq'] = "Failed";
        header('location:../question.php');
    }
}


if(isset($_POST['add_cc_choices'])){
    $qid = $_POST['qid'];
    $choice = mysqli_real_escape_string($conn,$_POST['choice']);
    $sql = "INSERT INTO choicecc(`ccid`,`CHOICE`) VALUES('$qid','$choice')";
    if(mysqli_query($conn,$sql)){
        $_SESSION['sq'] = "Success";
        header('location:../edit_question.php?id='.$qid);
    }else{
        $_SESSION['sq'] = "Failed";
        header('location:../edit_question.php?id='.$qid);
    }
    
}



if(isset($_POST['choice'])){
    $id = mysqli_real_escape_string($conn,$_POST['choice']);
    $sql = "DELETE FROM choicecc WHERE ID = '$id'";
    if(mysqli_query($conn,$sql)){
        echo 'success';
    }else{
        echo 'error';
    }
}
if(isset($_POST['deletecc'])){
    $id = mysqli_real_escape_string($conn,$_POST['deletecc']);
    $sql = "DELETE FROM questioncc WHERE ID = '$id'";
    if(mysqli_query($conn,$sql)){
        echo 'success';
    }else{
        echo 'error';
    }
}
if(isset($_POST['deletesq'])){
    $id = mysqli_real_escape_string($conn,$_POST['deletesq']);
    $sql = "DELETE FROM surveyquestion WHERE ID = '$id'";
    if(mysqli_query($conn,$sql)){
        echo 'success';
    }else{
        echo 'error';
    }
}
if(isset($_POST['loginadmin'])){
   $email = mysqli_real_escape_string($conn,$_POST['email']);
   $pass = mysqli_real_escape_string($conn,$_POST['pass']);
   $sql = "SELECT * FROM adminaccount WHERE EMAIL = '$email'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($pass,$row['PASSWORD'])){
            $_SESSION['admin'] = $row['ID'];
            $_SESSION['entry'] = 'in';
            header('location:../dashboard');
        }else{
            $_SESSION['entry'] = 'password';
            header('location:../index');
        }
    }else{
        $_SESSION['entry'] = 'email';
        header('location:../index');
    }

}

if(isset($_POST['UpdateAdmin'])){
    $id = mysqli_real_escape_string($conn,$_POST['UpdateID']);
    $name = mysqli_real_escape_string($conn,$_POST['UpdateName']);
    $email = mysqli_real_escape_string($conn,$_POST['UpdateEmail']);
    $pass = mysqli_real_escape_string($conn,$_POST['UpdatePassword']);
    $service = mysqli_real_escape_string($conn,$_POST['UpdateServices']);

    //UpdateServices
    $password = password_hash($pass,PASSWORD_DEFAULT);

    $sql = "UPDATE adminaccount SET NAME='$name', EMAIL='$email', PASSWORD='$password' WHERE ID='$id'";

    if(mysqli_query($conn, $sql)){
        $_SESSION['addadmin'] = 'success';
        header('location:../adminaccounts');
    } else{
        $_SESSION['addadmin'] = 'error';
        header('location:../adminaccounts');
    }
}


if(isset($_POST['AddAdmin'])){
    //name
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $pass = mysqli_real_escape_string($conn,$_POST['password']);
    
    $password = password_hash($pass,PASSWORD_DEFAULT);
    $sql = "INSERT INTO adminaccount(`ID`,`NAME`,`EMAIL`,`PASSWORD`) VALUES(NULL,'$name','$email','$password')";
    if(mysqli_query($conn,$sql)){
        $_SESSION['addadmin'] = 'success';
        header('location:../adminaccounts');
    }else{
        $_SESSION['addadmin'] = 'error';
        header('location:../adminaccounts');
    }
}
?>