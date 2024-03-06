<?php 
include 'configConn.php';

if ($_GET['videos_id']) {
    $gameId = $_GET['videos_id'];
    
    $sql = "DELETE FROM videos WHERE id = '$gameId'";
    
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        header("location:viewVideo.php");
    }
}
?>