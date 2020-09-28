<?php
session_start();
include 'config.php';
if (isset($_SESSION['user_data'])) {
    $student=false;
    if ($_SESSION['user_data']['usertype'] != 1) {
		$student=true;
	}

    $name = "";
    $hint = "";
    $update = false;
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $update = true;
        $record = mysqli_query($con, "SELECT * FROM challengequizz WHERE id=$id");
        if (count(array($record)) == 1) {
            $data = mysqli_fetch_array($record);
            $name = $data['name'];
            $hint = $data['hint'];
        }
    }
    $check = false;
    if (isset($_POST['submit'])) { // if save button on the form is clicked
        // name of the uploaded file
        $idfile = $_GET['id'];
        $desfolder = 'challenge/chall' . $idfile;

        $results_array = array();

        if (is_dir($desfolder)) {
            if ($handle = opendir($desfolder)) {
                //Notice the parentheses I added:
                while (($file = readdir($handle)) !== FALSE) {
                    $results_array[] = $file;
                }
                closedir($handle);
            }
        }
        $answer = $_POST['answer'];
        //Output findings
       
        $show ="";
        foreach ($results_array as $value) {
            if (basename($value,".txt") == $answer) {
                $show = $value;
                $check=true;
                break;
            } 
        }
        if($check){
            $des = 'challenge/chall'.$idfile.'/'.$value;
            $content="";
            $read = file($des);
            foreach ($read as $line) {
                $content= $content.$line."<br>";
            }   
            // header("Location:challenge/chall".$idfile."/".$value);
        }
        else{
            header("Location:view_challenge.php?id=" . $id . "&error=Thử thách thất bại");
        }
       
    }

?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Dashboard</title>
        <link rel="manifest" href="/docs/4.5/assets/img/favicons/manifest.json">

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js">
        </script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js">
        </script>
        <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
        <meta name="theme-color" content="#563d7c">


        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }
        </style>
        <!-- Custom styles for this template -->
        <link href="dashboard.css" rel="stylesheet">

    </head>

    <body>
        <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="teacher_dasboard.php"><?php if (!$student) {echo "VCS Admin";} else {echo "VCS Student";}?></a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="logout.php">Đăng xuất</a>
                </li>
            </ul>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <?php include 'teacher_menu.php' ?>

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <?php if ($update != true) : ?>
                            <div class="btn-group mr-2">
                                <a class="btn btn-info" href="add_challenge.php">
                                    Thêm Challenge</a>
                            </div>
                        <?php else : ?>
                            <div class="btn-group mr-2">
                                <a class="btn btn-info" href="challenge.php">
                                    Quay lại</a>
                            </div>
                        <?php endif ?>


                    </div>
                    <form method="post">
                        <div class="row">
                            <?php if (isset($_REQUEST['error'])) { ?>
                                <div class="col-lg-12">
                                    <span class="alert alert-danger" style="display: block;"><?php echo $_REQUEST['error']; ?></span>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="row">
                            <?php if (isset($_REQUEST['success'])) { ?>
                                <div class="col-lg-12">
                                    <span class="alert alert-success" style="display: block;"><?php echo $_REQUEST['success']; ?></span>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-6">

                            <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputName">Tên Challenge</label>
                            <input type="text" class="form-control" name="ChallName" required="required" id="inputName" value="<?php echo $name; ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputName">Hint</label>
                            <input type="text" class="form-control" name="hint" required="required" id="inputName" value="<?php echo $hint; ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputAnswer">Đáp án</label>
                            <input type="text" class="form-control" name="answer" required="required" id="inputAnswer">
                        </div>


                        <button type="submit" class="btn btn-primary col-md-6" name="submit">Submit Challenge</button>
                       <?php if ($check) { ?>
                         <div class="form-group col-md-6">
                            <label for="inputAnswer">Đáp án</label>
                           <p><?php echo $content ?></p>
                        </div>
                        <?php } ?>


                    </form>
                </main>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js">
        </script>
        <script>
            window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery.slim.min.js"><\/script>')
        </script>
        <script src="https://getbootstrap.com/docs/4.5/dist/js/bootstrap.bundle.min.js">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="dashboard.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location:login.php?error=UnAuthorized Access");
}
