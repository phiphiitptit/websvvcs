<?php
session_start();
include 'config.php';
if (isset($_SESSION['user_data'])) {

    if ($_SESSION['user_data']['usertype'] != 1) {
        header("Location:student_dasboard.php");
    }
    $name = "";
    $email = "";
    $id = 0;
    $password = "";
    $telephone = "";
    $username = "";
    $update = false;

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $update = true;
        $record = mysqli_query($con, "SELECT * FROM user WHERE id=$id");
        if (count(array($record)) == 1) {
            $data = mysqli_fetch_array($record);
            $name = $data['name'];
            // $username = $data['username'];
            // $password = $data['password'];
            $email = $data['email'];
            $telephone = $data['telephone'];
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
            <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="teacher_dasboard.php">VCS Admin</a>
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
                    <div class="col-lg-2">
                        <div class="btn-group mr-2">
                            <a class="btn btn-info" href="teacher_dasboard.php">
                                Quay lại</a>
                        </div>
                    </div>
                    <div class="container padding-bottom-3x mb-2">
                        <div class="row">

                            <div class="col-lg-4">
                                <aside class="user-info-wrapper">

                                    <div class="user-info">
                                        <div class="user-avatar">
                                            <a class="edit-avatar" href="#"></a><img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="User"></div>
                                        <div class="user-data">
                                            <h4><?php echo $name; ?></h4>
                                        </div>
                                    </div>
                                </aside>
                            </div>
                            <div class="col-lg-8 row align-items-center">
                                <div class="padding-top-2x mt-2 hidden-lg-up"></div>
                                <!-- Wishlist Table-->
                                <div class="table-responsive wishlist-table margin-bottom-none">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Thông tin chi tiết</th>
                                                <th class="text-center"><a class="btn btn-sm btn-outline-success" href="chatmessage.php?id=<?php echo $id?>">Nhắn tin</a></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm" style="text-align: center;">
                                                    <thead>
                                                        <tr style="   line-height: 40px;">
                                                            <th>Họ tên</th>
                                                            <th><?php echo $name; ?></th>
                                                        </tr>
                                                        <tr style="   line-height: 40px;">
                                                            <th>Email</th>
                                                            <th><?php echo $email; ?></th>
                                                        </tr>
                                                        <tr style="   line-height: 40px;">
                                                            <th>Số điện thoại</th>
                                                            <th><?php echo $telephone; ?></th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
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
