<?php
session_start();
include 'config.php';
if (isset($_SESSION['user_data'])) {
	if ($_SESSION['user_data']['usertype'] != 1) {
		header("Location:student_dasboard.php");
	}
	echo "Techer" . $_SESSION['user_data']['name'];
}
$data = array();
$qr = mysqli_query($con, "select * from user");
while ($row = mysqli_fetch_assoc($qr)) {
	array_push($data, $row);
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
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
            data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
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
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="">
                                <span class="iconify" data-icon="bi:file-person" data-inline="false"></span>
                                Danh sách người dùng <span class="sr-only">(current)</span>
                            </a>
                        </li>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

                    <div class="btn-group mr-2">
                        <a class="btn btn-info" href="add_student.php">
                            Thêm SV</a>
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-sm" style="text-align: center;">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Công việc</th>
                                <th>Điện thoại</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							foreach ($data as $d) {
							?>
                            <tr>
                                <td><?php echo $d['id']; ?></td>
                                <td><?php echo $d['name']; ?></td>
                                <td><?php echo $d['email']; ?></td>
                                <td>
                                    <?php if ($d['usertype'] == '1') {
											echo "Giáo viên";
										} else {
											echo "Học sinh";
										} ?>
                                </td>
                                <td><?php echo $d['telephone']; ?></td>


                                <td><a class="btn btn-info" href="edit_result.php?id=<?php echo $d['id']; ?>">
                                        Xem</a>
                                    <a class="btn btn-info" href="edit_student.php?id=<?php echo $d['id']; ?>">
                                        Sửa</a>
                                    <a class="btn btn-info" href="edit_result.php?id=<?php echo $d['id']; ?>">
                                        Xóa</a>
                                </td>

                            </tr>
                            <?php
							}
							?>
                        </tbody>
                    </table>
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