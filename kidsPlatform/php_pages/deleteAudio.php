<?php 
include 'configConn.php';

if ($_GET['audio_id']) {
    $audioId = $_GET['audio_id'];
    
    $sql = "DELETE FROM audiobooks WHERE id = '$audioId'";
    
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        header("location:viewAudio.php");
    }
}
?>