<?php
session_start();
include 'config.php';
if(isset($_SESSION['user_data'])){
	if($_SESSION['user_data']['usertype']!=1){
		header("Location:student_dasboard.php");
	}
	$name=mysqli_real_escape_string($con,$_REQUEST['name']);
	$email=mysqli_real_escape_string($con,$_REQUEST['email']);
	$password=mysqli_real_escape_string($con,$_REQUEST['password']);
    $username =mysqli_real_escape_string($con,$_REQUEST['username']);
    $telephone=mysqli_real_escape_string($con,$_REQUEST['telephone']);
	$qr=mysqli_query($con,"INSERT into user (username,password,name,email,telephone,usertype,created_at) values ('".$username."','".md5($password)."','".$name."','".$email."','".$telephone."','2','".date('Y-m-d H:i:s')."')");
   
    if($qr){
		header("Location:add_student.php?success=Thêm thành công");
	}
	else{
		header("Location:add_student.php?error=Lỗi thêm học sinh");
	}
?>
<?php
}
else{
	header("Location:login.php?error=UnAuthorized Access");
}