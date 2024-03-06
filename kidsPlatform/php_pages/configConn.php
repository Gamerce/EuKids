<?php


  //$host = "http://54.88.122.65";

    // $host = "localhost";
    // $username = "root";
    // $password = "123456";

    $host = "54.88.122.65";
    $username = "jerry";
    $password = "jerrypassword";


    $db = "EU_Kids";

  global  $conn;


   $conn = new mysqli($host,$username,$password,$db);


//   $mysqli = new mysqli("http://54.88.122.65","root","123456","EU_Kids");
// var_dump($mysqli);
  // Check connection
  // if ($mysqli -> connect_errno) {
  //   echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  //   exit();
  // }


/*
  if ($conn === false) {
    die ("Connection error");
  }else{
      echo "Connection successfully";
  }*/

?>
