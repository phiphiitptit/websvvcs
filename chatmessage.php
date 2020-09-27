<?php
session_start();
include 'config.php';
if (isset($_SESSION['user_data'])) {


    $id = $_SESSION['user_data']['id'];

    $qr = mysqli_query($con, "SELECT user.name,chat_message.to_user_id,chat_message.title,chat_message.msg,chat_message.created_at,chat_message.id
         FROM  chat_message
         Join user ON user.id=chat_message.to_user_id
         where chat_message.from_user_id=$id
         order by chat_message.id");
    $data_send = array();
    $count = 0;

    while ($row = mysqli_fetch_assoc($qr)) {
        array_push($data_send, $row);
    }
    $qr = mysqli_query($con, "SELECT user.name,chat_message.from_user_id,chat_message.title,chat_message.msg,chat_message.created_at,chat_message.id
    FROM  chat_message
    left join user ON user.id=chat_message.from_user_id
    where chat_message.status_mes=0 and chat_message.to_user_id=$id
    order by chat_message.from_user_id");
    $data_noseen = array();
    while ($row = mysqli_fetch_assoc($qr)) {
        array_push($data_noseen, $row);
    }
    $qr = mysqli_query($con, "SELECT user.name,chat_message.from_user_id,chat_message.title,chat_message.msg,chat_message.created_at,chat_message.id
    FROM  chat_message
    left Join user ON user.id=chat_message.from_user_id
    where chat_message.status_mes=1 and chat_message.to_user_id=$id
    order by chat_message.from_user_id");
    $data_seen = array();
    while ($row = mysqli_fetch_assoc($qr)) {
        array_push($data_seen, $row);
    }
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $qr = mysqli_query($con, "UPDATE chat_message SET status_mes=1 WHERE id=$id");
            if($qr){
                header("Location:chatmessage.php");
            }
        }
    $update = false;
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Dashboard</title>

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
        <link href="chat.css" rel="stylesheet">
       
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

                    <div class="container">


                        <ul class="nav nav-tabs">
                            <li class="active"><a class="btn btn-info" href="#send">Tin nhắn gửi đi</a></li>
                            <li><a class="btn btn-info" href="#noseen">Tin nhắn chưa xem</a></li>
                            <li><a class="btn btn-info" href="#seen">Tin nhắn đã xem</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="send" class="tab-pane fade in active">
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm" style="text-align: center;">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Người nhận</th>
                                                <th>Ngày gửi</th>
                                                <th>Tiêu đề</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 0;
                                            foreach ($data_send as $d) {
                                            ?>
                                                <tr>
                                                    <td><?php echo ++$count; ?></td>
                                                    <td><?php echo $d['name']; ?></td>
                                                    <td><?php echo $d['created_at']; ?></td>
                                                    <td><?php echo $d['title']; ?></td>
                                                   
                                                    <td><a class="btn btn-info" name="seenmes" href="edit_message.php?id=<?php echo $d['id']; ?>&edit=false">
                                                            Xem</a>
                                                            <a class="btn btn-info" name="edit" href="edit_message.php?id=<?php echo $d['id']; ?>&edit=true">
                                                            Sửa</a>
                                                            <a class="btn btn-info" name="delete" href="edit_message_post.php?id=<?php echo $d['id']; ?>">
                                                            Xóa</a>
                                                    </td> 

                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="noseen" class="tab-pane fade">
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm" style="text-align: center;">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Người gửi</th>
                                                <th>Ngày gửi</th>
                                                <th>Tiêu đề</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 0;
                                            foreach ($data_noseen as $d) {
                                            ?>
                                                <tr>
                                                    <td><?php echo ++$count; ?></td>
                                                    <td><?php echo $d['name']; ?></td>
                                                    <td><?php echo $d['created_at']; ?></td>
                                                    <td><?php echo $d['title']; ?></td>
                                                    <td><a class="btn btn-info" name="seenmes" href="edit_message.php?id=<?php echo $d['id']; ?>&edit=false">
                                                            Xem</a>

                                                        <a class="btn btn-info" name="checkseen" href="chatmessage.php?id=<?php echo $d['id']; ?>&edit=false">
                                                            Đã xem</a>
                                                    </td>

                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="seen" class="tab-pane fade">
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm" style="text-align: center;">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Người gửi</th>
                                                <th>Ngày gửi</th>
                                                <th>Tiêu đề</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 0;
                                            foreach ($data_seen as $d) {
                                            ?>
                                                <tr>
                                                    <td><?php echo ++$count; ?></td>
                                                    <td><?php echo $d['name']; ?></td>
                                                    <td><?php echo $d['created_at']; ?></td>
                                                    <td><?php echo $d['title']; ?></td>
                                                    <td><a class="btn btn-info" name="seenmes" href="edit_message.php?id=<?php echo $d['id']; ?>&edit=false">
                                                            Xem</a>
                                                    </td>

                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <hr>

                    </div>


                </main>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js">
        </script>
        <script>
            $(document).ready(function() {
                $(".nav-tabs a").click(function() {
                    $(this).tab('show');
                });
                $('.nav-tabs a').on('shown.bs.tab', function(event) {
                    var x = $(event.target).text(); // active tab
                    var y = $(event.relatedTarget).text(); // previous tab
                    $(".act span").text(x);
                    $(".prev span").text(y);
                });
            });
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
