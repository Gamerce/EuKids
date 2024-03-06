<?php
include 'configConn.php';
session_start();

if (isset($_GET['username']) && isset($_GET['password'])) {

    $name = $_GET['name'];
    $username = $_GET['username'];
    $password = $_GET['password'];
    $verifyPass = $_GET['verifyPassword'];
    $email = $_GET['email'];
    $age = $_GET['age'];

    // Set default user type to "user"
    $userType = "user";

    // Encrypt the password
    $md5 = md5($password);

    // If field age empty set NULL
    if (! empty($age)) {
        $age = "'" . $age . "'";
    } else {
        $age = "NULL";
    }
    var_dump($age);
    // Check if the provided password and verify password match
    if ($password == $verifyPass) {

        // check username exist
        $existUsernameQuery = "SELECT * FROM users WHERE username_id = '$username'";
        $existUsernameResult = mysqli_query($conn, $existUsernameQuery);
        if (mysqli_num_rows($existUsernameResult) > 0) {
            echo '<script  type="application/javascript">alert("User already in the database")</script>';
        } else {
            // Insert user data into the database
            $sql = "INSERT INTO users(name,username_id,password,email,age,usertype) VALUES('$name','$username','$md5','$email',$age,'$userType')";
            var_dump($sql);
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("location:login.php");
                $message = "You have registered successfully.";

                $_SESSION['loginMessage'] = $message;
            } else {

                echo '<script  type="application/javascript">alert("Registration failed.")</script>';
            }
        }
    } else {
        echo '<script  type="application/javascript">alert("Password and verify password must be the same.")</script>';
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register Page</title>

<link rel="stylesheet" href="../css_pages/register.css">
	<?php include '../include_pages/links_bootstrap.php';?>
    
</head>
<body>

	<!-- Register form -->
	<center>
		<div class="formDesign">
			<form class="registerForm" method="GET" action="#">
				<h3 class="registerTittleDesign">Register form</h3>
				<div>
					<label class="labelDesign">Name</label> <input class="inputDesign"
						type="text" name="name">
				</div>
				<div>
					<label class="labelDesign">Username</label> <input
						class="inputDesign" type="text" name="username" required>
				</div>
				<div>
					<label class="labelDesign">Password</label> <input
						class="inputDesign" type="password" name="password" required>
				</div>
				<div>
					<label class="labelDesign">Verify password</label> <input
						class="inputDesign" type="password" name="verifyPassword" required>
				</div>
				<div>
					<label class="labelDesign">Email</label> <input class="inputDesign"
						type="email" name="email">
				</div>
				<div>
					<label class="labelDesign">Age</label> <input class="inputDesign"
						type="date" name="age">
				</div>

				<div>
					<input class="btn btn-primary" type="submit" name="register"
						value="Register">
				</div>
			</form>
		</div>
	</center>
</body>
</html>