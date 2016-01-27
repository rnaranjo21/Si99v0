<?php
session_start();
$_SESSION['Usuario']=$_POST['Usuario'];
$_SESSION['Password']=$_POST['Password'];
header("Location:consumopos.php");
?>