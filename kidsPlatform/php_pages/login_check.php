<?php

    error_reporting(0);
    session_start();
    include 'configConn.php';

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $username = $_GET['username'];
        $password = $_GET['password'];

        $sql = "SELECT * FROM users WHERE username_id = '".$username."' ";

        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);


        if (md5($password)== $row['password']) {

            if ($row["usertype"] == "admin") {
                $_SESSION['username'] = $username;
                $_SESSION['usertype'] = "admin";
                $_SESSION['userId'] = $row['id'];
                header("location:../Analytics.php");

            }elseif($row["usertype"] == "user"){
                $_SESSION['username'] = $username;
                $_SESSION['usertype'] = "user";
                $_SESSION['userId'] = $row['id'];
                header("location:../Analytics.php");
            }
        }else {
            $message = "Username or Password do not match";

            $_SESSION['loginMessage'] = $message;

            header("location:login.php");

        }

    }

?>
