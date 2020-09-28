<?php
// connect to the database
session_start();
include "config.php";
if (isset($_SESSION['user_data'])) {
    $student = false;
    if ($_SESSION['user_data']['usertype'] != 1) {
        $student=true;
    }


    // Uploads files
    if (isset($_POST['save']) & !$student) { // if save button on the form is clicked
        // name of the uploaded file
        $name = $_POST['subjectName'];
        $filename = $_FILES['download']['name'];
        $r = mysqli_query($con,"SHOW TABLE STATUS LIKE 'homework'");
        $row = mysqli_fetch_assoc($r);
        $idfile = $row['Auto_increment'];
        $desfolder = 'upload/teacher/gv'.$idfile;
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
                $qr = mysqli_query($con,  "INSERT into homework (subject_name, size, download,namefile,created_at) values ('$name' ,$size, 0, '$filename','" . date('Y-m-d H:i:s') . "' )");
                if ($qr) {
                    header("Location:add_homework.php?success=Thêm thành công");
                    header("Location:homework.php");
                } else {
                    header("Location:add_homework.php?error=Thêm thất bại");
                }
            } else {
                header("Location:add_homework.php?error=Thêm thất bại");
            }
        }
    }
    // Downloads files
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // fetch file to download from database
        $sql = "SELECT * FROM homework WHERE id=$id";
        $result = mysqli_query($con, $sql);

        $file = mysqli_fetch_assoc($result);
        $filepath = 'upload/teacher/gv'.$id.'/' . $file['namefile'];

        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filepath));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));

            //This part of code prevents files from being corrupted after download
            ob_clean();
            flush();

            readfile($filepath);

            // Now update downloads count
            $newCount = $file['download'] + 1;
            $updateQuery = "UPDATE homework SET download=$newCount WHERE id=$id";
            mysqli_query($con, $updateQuery);
            exit;
        }
    }
    // Downloads files
    if (isset($_GET['idsub'])) {
        $id = $_GET['idsub'];

        // fetch file to download from database
        $sql = "SELECT * FROM sub_result WHERE id=$id";
        $result = mysqli_query($con, $sql);

        $file = mysqli_fetch_assoc($result);
        $filepath = 'upload/student/sv'.$id.'/' . $file['name'];

        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filepath));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));

            //This part of code prevents files from being corrupted after download
            ob_clean();
            flush();

            readfile($filepath);

            // Now update downloads count
            $newCount = $file['download'] + 1;
            $updateQuery = "UPDATE homework SET download=$newCount WHERE id=$id";
            mysqli_query($con, $updateQuery);
            exit;
        }
    }


    if (isset($_GET['iddelete']) & !$student) {
        $id = $_GET['iddelete'];
        $sql = "SELECT * FROM homework WHERE id=$id";
        $result = mysqli_query($con, $sql);
        $file = mysqli_fetch_assoc($result);
        $path = $_SERVER['DOCUMENT_ROOT'].'upload/teacher/gv'.$id.'/'.$file['namefile'].'';
        unlink($path);
        $qr = mysqli_query($con, "DELETE FROM homework WHERE id=$id");
        if ($qr) {
            header("Location:homework.php");
        }
    }
}
