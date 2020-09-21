<?php
session_start();
if(isset($_SESSION['user_data'])){
	if($_SESSION['user_data']['usertype']==1){
		header("Location:teacher_dasboard.php");
	}
	else{
		header("Location:student_dasboard.php");	
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <!-- Include Bootrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js">
    </script>
</head>

<body >

    <h1 class="h3 mb-3 font-weight-normal" style="text-align:center">Hệ thống quản lý sinh viên</h1>
    
    <div class="container">
    
   	<div class="row">
   		<?php if(isset($_REQUEST['error'])){ ?>
   		<div class="col-lg-12">
   			<span class="alert alert-danger" style="display: block;"><?php echo $_REQUEST['error']; ?></span>
   		</div>
	   	<?php } ?>
   	</div>
   	<div class="row">
   		<div class="col-lg-4">
   		</div>
   		<div class="col-lg-4">
           <img class="mb-4"
                src="https://lh3.googleusercontent.com/proxy/8G_i-UxmV9WDGY7CrOYjDvLre5tEMy0p8MN7se1COc8K7RQGKYgUKYdUsQ9HPfGZvuWNFkgAv4KWBr7WXeoP0Mep4EWEl8dUNMighbVr8UE"
                alt="" width="400" height="100">
	     <form class="form-signin" action="loginFun.php" method="post">
	     	<div class="form-group">
	    	    <h2 class="form-signin-heading text-center">Đăng nhập</h2>
		    </div>
	        <div class="form-group">
		        <label for="inputEmail" class="sr-only">Username</label>
		        <input type="username" id="inputUser" name="username" class="form-control" placeholder="Username" required autofocus>
	  		</div>
	        <div class="form-group">
		        <label for="inputPassword" class="sr-only">Password</label>
		        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
		    </div>
		    <div class="form-group">
		        <button class="btn btn-lg btn-primary btn-block" type="submit">Đăng nhập</button>
		    </div>
	      </form>
		</div>
	    <div class="col-lg-4">
   		</div>
	  </div>
    </div>
</body>

</html>