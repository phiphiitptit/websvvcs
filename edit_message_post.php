<?php
// connect to the database
session_start();
include "config.php";
if (isset($_SESSION['user_data'])) {
    $student = false;
    if ($_SESSION['user_data']['usertype'] != 1) {
        $student = true;
    }
    $title = mysqli_real_escape_string($con, $_REQUEST['title']);
	$msg = mysqli_real_escape_string($con, $_REQUEST['msg']);
    if (isset($_POST['update'])) {
        $id = $_POST['id'];


        $qr = mysqli_query($con, "UPDATE chat_message SET title='" . $title . "', msg='" . $msg . "' WHERE id='". $id . "'");
        // $_SESSION['message'] = "Address updated!"; 
        if ($qr) {
            header("Location:chatmessage.php");
           
        } else {
            header("Location:edit_message.php?error=Gặp lỗi khi sửa");
        }
    }

    if (isset($_GET['id'])) {

        $id = $_GET['id'];

        $qr = mysqli_query($con, "DELETE FROM chat_message WHERE id=$id");
        if ($qr) {
            header("Location:chatmessage.php");
        }
    }
}
