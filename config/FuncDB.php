<?php
    require('config.php');
    class DbFunction {
        function login($username,$password){
            if(!ctype_alpha($username) || !ctype_alpha($password)){
                echo "<script>alert('Sai thong tin tai khoan hoac mat khau') </script>";
            }
            else{
                $db = Database::getInstance();
                $mysqli = $db->getConnection();
                $query = "SELECT usename, password FROM tbl_login where username=? and password=? ";
                $stmt = $mysqli->prepare($query);
                if($stmt===false){
                    trigger_error("Loi query: " . mysqli_connect_error(),E_USER_ERROR);
                }
                else{
                    $stmt->bind_param('ss',$username,$password);
                    $stmt->execute();
                    $stmt -> bind_result($username,$password);
                    $rs=$stmt->fetch();
                    if(!$rs)
                    {
                        echo "<script>alert('Sai Thong Tin')</script>";
                        header('location:login.php');
                    }
                    else{
                        header('location:dasboard.php');
                    }
                    
                }
            }
        }
    }
?>