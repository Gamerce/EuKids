<?php 
include 'configConn.php';

if ($_GET['games_id']) {
    
    $gameId = $_GET['games_id'];
    
    $sql = "DELETE FROM games WHERE id = '$gameId' ";
    
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
       header("location:viewGames.php");
    }
}

?>