<?php
session_start();
unset($_SESSION['admin']);
$_SESSION['admin'] = '';
$_SESSION['entry']='out';

session_destroy();
header('location: index');
?>