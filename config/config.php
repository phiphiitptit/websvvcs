<?php
    session_start();
    $host ="localhost";
    $username ="root";
    $password = "";
    $dbname ="studentdb";
    
    $con = mysqli_connect($host,$username,$password) or die(mysqli_error());
    if($con){
        mysqli_select_db($dbname) or die(mysqli_errno());
    }
?>