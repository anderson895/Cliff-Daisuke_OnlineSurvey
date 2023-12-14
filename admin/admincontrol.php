<?php
$id = $_GET['deleteadmin'];
require 'controllers/connection.php';
$sql = "DELETE FROM `adminaccount` WHERE ID = '$id'";
if(mysqli_query($conn,$sql)){
    $_SESSION['addadmind'] = "success";
    header('location: adminaccounts');
}else{
    $_SESSION['addadmind'] = "error";
    header('location: adminaccounts');
}

?>