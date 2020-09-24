<?php
// connect to the database
session_start();
include "config.php";
if (isset($_SESSION['user_data'])) {
    if ($_SESSION['user_data']['usertype'] != 1) {
        header("Location:student_dasboard.php");
    }
      
    // Uploads challenge
    if (isset($_POST['save'])) { // if save button on the form is clicked
        // name of the uploaded file
        $r = mysqli_query($con,"SHOW TABLE STATUS LIKE 'challengequizz'");
        $row = mysqli_fetch_assoc($r);
        $idfile = $row['Auto_increment'];
       
        $name = $_POST['ChallName'];
        $hint = $_POST['hint'];
        $filename = $_FILES['download']['name'];
        $desfolder ='challenge/chall'.$idfile;
        if(!mkdir($desfolder,0, true)){
            die('Tao folder thất bại');
        };
        // destination of the file on the server
        $destination = $desfolder.'/' . $filename;

        // get the file extension
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        // the physical file on a temporary uploads directory on the server
        $file = $_FILES['download']['tmp_name'];
        $size = $_FILES['download']['size'];

        if (!in_array($extension, ['txt'])) {
            echo "You file extension must be .txt";
        } elseif ($_FILES['download']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
            echo "File too large!";
        } else {
            // move the uploaded (temporary) file to the specified destination
            if (move_uploaded_file($file, $destination)) {
                $qr = mysqli_query($con,  "INSERT into challengequizz (name, hint, created_at) values ('$name' ,'$hint', '" . date('Y-m-d H:i:s') . "' )");
                if ($qr) {
                    header("Location:add_challenge.php?success=Thêm thành công");
                    header("Location:challenge.php");
                } else {
                    header("Location:add_challenge.php?error=Thêm thất bại");
                }
            } else {
                header("Location:add_challenge.php?error=Thêm thất bại");
            }
        }
    }
    if (isset($_GET['iddelete'])) {
        $id = $_GET['iddelete'];
        $desfolder ='challenge/chall'.$id;
        array_map('unlink', glob("$desfolder/*.*"));
        rmdir($desfolder);

        $qr = mysqli_query($con, "DELETE FROM challengequizz WHERE id=$id");
        if ($qr) {
            header("Location:challenge.php");
        }
    }
   
}
