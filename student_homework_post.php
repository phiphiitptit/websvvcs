<?php
// connect to the database
session_start();
include "config.php";
if (isset($_SESSION['user_data'])) {
    if ($_SESSION['user_data']['usertype'] != 2) {
        header("Location:teacher_dasboard.php");
    }

    // Uploads files
    if (isset($_POST['save'])) { // if save button on the form is clicked
        // name of the uploaded file
        $id_subject = $_POST['id'];
        $id_user = $_SESSION['user_data']['id'];
        $filename = $_FILES['download']['name'];
        $r = mysqli_query($con,"SHOW TABLE STATUS LIKE 'sub_result'");
        $row = mysqli_fetch_assoc($r);
        $idfile = $row['Auto_increment'];
        $desfolder = 'upload/student/sv'.$idfile;
        if(!mkdir($desfolder,0777, true)){
            die('Tao folder thất bại');
        };
        // destination of the file on the server
        $destination = $desfolder.'/'. $filename;

        // get the file extension
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        // the physical file on a temporary uploads directory on the server
        $file = $_FILES['download']['tmp_name'];
        $size = $_FILES['download']['size'];

        if (!in_array($extension, ['zip', 'pdf', 'docx', 'txt'])) {
            echo "You file extension must be .zip, .pdf or .docx";
        } elseif ($_FILES['download']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
            echo "File too large!";
        } else {
            // move the uploaded (temporary) file to the specified destination
            if (move_uploaded_file($file, $destination)) {
                $qr = mysqli_query($con,  "INSERT into sub_result (subject_id,name, id_user, created_at) values ('$id_subject' ,'$filename','$id_user','" . date('Y-m-d H:i:s') . "' )");
                if ($qr) {
                    header("Location:student_homework.php?id=$id_subject&success=Thêm thành công");
                } else {
                    header("Location:student_homework.php?error=Thêm thất bại");
                }
            } else {
                header("Location:student_homework.php?error=Thêm thất bại");
            }
        }
    }
   
}
