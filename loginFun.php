<?php
session_start();
include 'config.php';

if(isset($_REQUEST['username']) && isset($_REQUEST['password'])){

	//mysqli real escape prevent from sql injection which filter the user input
	$username=mysqli_real_escape_string($con,$_REQUEST['username']);
	$password=mysqli_real_escape_string($con,$_REQUEST['password']);
	$qr=mysqli_query($con,"select * from user where username='".$username."' and password='".md5($password)."'");
	if(mysqli_num_rows($qr)>0){
		$data=mysqli_fetch_assoc($qr);
		$_SESSION['user_data']=$data;
		if($data['usertype']==1){
			header("Location:teacher_dasboard.php");	
		}
		else{
			header("Location:student_dasboard.php");
		}

	}
	else{
		header("Location:login.php?error=Invalid Login Details");		
	}
}
else{
	header("Location:login.php?error=Please Enter Email and Password");
}