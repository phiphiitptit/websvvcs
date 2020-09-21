<?php
session_start();
include 'connect.php';
if(isset($_SESSION['user_data'])){
	if($_SESSION['user_data']['usertype']!=1){
		header("Location:student_dasboard.php");
	}
	echo "student".$_SESSION['user_data']['name'];
}

	$data=array();
	$qr=mysqli_query($con,"select * from users where usertype='2'");
	while($row=mysqli_fetch_assoc($qr)){
		array_push($data,$row);
	}
?>