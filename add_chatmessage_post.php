<?php
session_start();
include 'config.php';
if (isset($_SESSION['user_data'])) {

    $title = mysqli_real_escape_string($con, $_REQUEST['title']);
    $msg = mysqli_real_escape_string($con, $_REQUEST['msg']);

    if (isset($_POST['sendmessage'])) {
        $to_user_id = $_POST['id'];
        $from_user_id = $_SESSION['user_data']['id'];
        $status=0;
        $title = $_POST['title'];
        $qr = mysqli_query($con, "INSERT into chat_message (title,to_user_id,from_user_id,msg,status_mes,created_at) values ('$title',$to_user_id,$from_user_id,'$msg',$status,'" . date('Y-m-d H:i:s') . "')");

        if ($qr) {
            header("Location:add_chatmessage.php?id=$to_user_id&success=Gửi tin nhắn thành công");
        } else {
            header("Location:add_chatmessage.php?id=$to_user_id&error=Gửi tin nhắn thất bại");
        }
    }
    if (isset($_POST['editmsg'])) {
        $to_user_id = $_POST['id'];
        $from_user_id = $_SESSION['user_data']['id'];
        $status=0;
        $title = $_POST['title'];
        $qr = mysqli_query($con, "INSERT into chat_message (title,to_user_id,from_user_id,msg,status_mes,created_at) values ('$title',$to_user_id,$from_user_id,'$msg',$status,'" . date('Y-m-d H:i:s') . "')");

        if ($qr) {
            header("Location:add_chatmessage.php?id=$to_user_id&success=Gửi tin nhắn thành công");
        } else {
            header("Location:add_chatmessage.php?id=$to_user_id&error=Gửi tin nhắn thất bại");
        }
    }

} else {
    header("Location:login.php?error=UnAuthorized Access");
}
