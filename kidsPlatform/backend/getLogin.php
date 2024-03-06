<?php 

session_start();
include '../php_pages/configConn.php';

$json_array = array();

$username = $_GET['username'];
$password = $_GET['password'];

// SQL query
$sql = "SELECT * FROM users WHERE username_id = '$username' AND password = '$password'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    
    // User logged in
    $json_array['login_status'] = true;
    $json_array['user_info'] = $row;
    
    //user information
    echo json_encode($json_array);
} else {
    // User not logged in
    $json_array['login_status'] = false;
    
    echo json_encode($json_array);
}

?>