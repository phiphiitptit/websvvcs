<?php
$host = "localhost";
$username = "phiphi";
$password = "3lKUkKrBpEUhNNzk";
$database = "studentdb";

$con = mysqli_connect($host,$username,$password,$database);
if(!$con){
	die("Lỗi kết nối database");
}

?>