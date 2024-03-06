<?php
include '../php_pages/configConn.php';
session_start();

if (isset($_GET['name']) && isset($_GET['username']) && isset($_GET['password']) && isset($_GET['verifypass']) && isset($_GET['email']) && isset($_GET['age']) && isset($_GET['usertype'])) {

    $name = $_GET['name'];
    $username = $_GET['username'];
    $password = $_GET['password'];
    $verifyPass = $_GET['verifypass'];
    $email = $_GET['email'];
    $age = $_GET['age'];
    $usertype = $_GET['usertype'];

    // Encrypt the password
    $md5 = md5($password);

    // If field age empty set NULL
    if (! empty($age)) {
        $age = "'" . $age . "'";
    } else {
        $age = "NULL";
    }

    // Check if username is not empty
    if (! empty($username)) {
        // Check if password is not empty
        if (! empty($password)) {
            // Check if verify password is not empty
            if (! empty($verifyPass)) {
                // Check if password and verify password match
                if ($password == $verifyPass) {

                    // check username exist
                    $existUsernameQuery = "SELECT * FROM users WHERE username_id = '$username'";
                    $existUsernameResult = mysqli_query($conn, $existUsernameQuery);
                    if (mysqli_num_rows($existUsernameResult) > 0) {
                        echo '<script  type="application/javascript">alert("User already in the database")</script>';
                    } else {
                        // Insert the user data into the database
                        $sql = "INSERT INTO users(name,username_id,password,email,age,usertype) VALUES('$name','$username','$md5','$email',$age,'$usertype')";
                        $result = mysqli_query($conn, $sql);

                        if ($result) {
                            header("location:../php_pages/login.php");
                            $message = "You have registered successfully.";

                            $_SESSION['loginMessage'] = $message;
                        } else {
                            echo '<script  type="application/javascript">alert("Registration failed.")</script>';
                        }
                    }
                } else {
                    echo '<script  type="application/javascript">alert("Password and verify password must be the same.")</script>';
                }
            } else {
                echo '<script  type="application/javascript">alert("Verify password required.")</script>';
            }
        } else {
            echo '<script  type="application/javascript">alert("Password required.")</script>';
        }
    } else {
        echo '<script  type="application/javascript">alert("Username required.")</script>';
    }
    $conn->close();
}

?>