<?php
session_start();
include 'config.php';
if (isset($_SESSION['user_data'])) {
	if ($_SESSION['user_data']['usertype'] != 1) {
		header("Location:student_dasboard.php");
	}


	$name = mysqli_real_escape_string($con, $_REQUEST['name']);
	$email = mysqli_real_escape_string($con, $_REQUEST['email']);
	$password = mysqli_real_escape_string($con, $_REQUEST['password']);
	$username = mysqli_real_escape_string($con, $_REQUEST['username']);
	$telephone = mysqli_real_escape_string($con, $_REQUEST['telephone']);


	if (isset($_POST['save'])) {
		$sql = mysqli_query($con, "SELECT * FROM user  WHERE username='".$username."' or email='".$email."'");
		if (mysqli_num_rows($sql) > 0) {
			header("Location:add_student.php?error=Lỗi thêm học sinh Tài khoản hoặc email trùng nhau");
		} else {
			$qr = mysqli_query($con, "INSERT into user (username,password,name,email,telephone,usertype,created_at) values ('" . $username . "','" . md5($password) . "','" . $name . "','" . $email . "','" . $telephone . "','2','" . date('Y-m-d H:i:s') . "')");

			if ($qr) {
				header("Location:add_student.php?success=Thêm thành công");
				header("Location:teacher_dasboard.php");
			} else {
				header("Location:add_student.php?error=Lỗi thêm học sinh");
			}
		}
	}
	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$record = mysqli_query($con, "SELECT * FROM user WHERE id=$id");
		$data = mysqli_fetch_array($record);
		if ($password != $data['password']) {
			$password = md5($password);
		}
		$sql = mysqli_query($con, "SELECT * FROM user  WHERE username='".$username."' or email='".$email."'");
		if (mysqli_num_rows($sql) > 0) {
			header("Location:add_student.php?error=Lỗi thêm học sinh Tài khoản hoặc email trùng nhau");
		} else {
			$qr = mysqli_query($con, "UPDATE user SET username='" . $username . "', password='" . $password . "',email='" . $email . "', name='" . $name . "',telephone='" . $telephone . "' WHERE id='" . $id . "'");
			// $_SESSION['message'] = "Address updated!"; 
			if ($qr) {
				header("Location:add_student.php?success=Sửa thành công");
				header("Location:teacher_dasboard.php");
			} else {
				header("Location:add_student.php?success=Gặp lỗi khi sửa");
			}
		}

		// header("Location:teacher_dasboard.php");
	}
	if (isset($_GET['iddelete'])) {
		$id = $_GET['iddelete'];
		$qr = mysqli_query($con, "DELETE FROM user WHERE id=$id");
		if ($qr) {
			header("Location:teacher_dasboard.php");
		}
	}
} else {
	header("Location:login.php?error=UnAuthorized Access");
}
