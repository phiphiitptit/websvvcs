<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="../dist/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../dist/css/jquery.validate.css" />
    <link href="../dist/css/web.css" rel="stylesheet">
    <link href="../dist/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../dist/css/jquery.validate.css" />
</head>
<body>
    <h2 align="center">Student Management System</h2>
    <div class="container" align="center">
    <br><br><br>
        <div class="col-md-6 col-md-offset-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Sign in</h3>
                </div>
                <div class="panel-body">
                    <form method="post">
                        <fieldset>
                        <div class="form-group">
                                <input class="form-control" placeholder="Username"  id="id"name="id" type="text" autofocus autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" id="password"name="password" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" value="login" name="submit" class="btn btn-lg btn-success btn-block">
                            
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>