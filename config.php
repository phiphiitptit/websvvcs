<?php
$host = "localhost";
$username = "phiphi";
$password = "test";
$database = "studentdb";

$con = mysqli_connect($host,$username,$password,$database);
if(!$con){
	die("Lỗi kết nối database");
}

?>