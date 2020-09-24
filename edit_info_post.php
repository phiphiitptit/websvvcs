<?php
session_start();
include 'config.php';
if (isset($_SESSION['user_data'])) {
	

	$name = mysqli_real_escape_string($con, $_REQUEST['name']);
	$email = mysqli_real_escape_string($con, $_REQUEST['email']);
	$telephone = mysqli_real_escape_string($con, $_REQUEST['telephone']);

	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$record = mysqli_query($con, "SELECT * FROM user WHERE id=$id");
		$data = mysqli_fetch_array($record);
		if($password != $data['password']){
			$password=md5($password);
		}
		$qr = mysqli_query($con, "UPDATE user SET email='".$email."', name='".$name."',telephone='".$telephone."' WHERE id='".$id."'");
		// $_SESSION['message'] = "Address updated!"; 
		if ($qr) {
            header("Location:edit_info.php?success=Sửa thành công");
            if ($_SESSION['user_data']['usertype'] != 1) {
                header("Location:student_dasboard.php");
            }
        else{
            header("Location:teacher_dasboard.php");
        }
		} else {
			header("Location:edit_info.php?error=Gặp lỗi khi sửa");
		}
		
		// header("Location:teacher_dasboard.php");
	}
	
} else {
	header("Location:login.php?error=UnAuthorized Access");
}
?>
