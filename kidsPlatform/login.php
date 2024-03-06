


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="css_pages/login.css">
     <?php include 'include_pages/links_bootstrap.php';?>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <center>
                <h3>Login form</h3>
                <h3>
                    <?php
                        error_reporting(0);
                        session_start();
                        session_destroy();
                        echo $_SESSION['loginMessage'];
                    ?>
                </h3>
            </center>
            <form action="login_check.php" method="GET">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="ptext">
                	<p >Don't have an account yet? <a href="php_pages/register.php">Register</a></p>
                </div>
                <div>
                    <input class="btn btn-login btn-block" type="submit" name="login" value="Login">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
