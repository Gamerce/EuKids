<?php 
   include_once 'configConn.php'; 
   
   if (isset($_GET['gameId']) && isset($_GET['filesId'])) {
       
       $gameId = $_GET['gameId'];
       $fileId = $_GET['filesId'];
       
       $sql = "DELETE FROM files WHERE id = '$fileId'";
       
       $result = mysqli_query($conn, $sql);
       
       $sql = "SELECT * FROM games WHERE id = '$gameId'";
       
       $result = mysqli_query($conn, $sql);
       $game = $result -> fetch_assoc();
       
       // Check if the deleted file ID is present in the 'featured_image' field
       if (strpos($game['featured_image'],$fileId) !== false) {
           $imageIds = explode(",", $game['featured_image']);
           
           // Find and remove the deleted file ID from the list of featured images
           if (($key = array_search($fileId, $imageIds)) !== false) {
               unset($imageIds[$key]);
           }
           // Convert the modified list back to a comma-separated string
           $filesDataBase = implode(",", $imageIds);
           
           // Update the 'featured_image' field in the 'games' table
           $query1 = "UPDATE games SET featured_image = '$filesDataBase' WHERE id='$gameId' ";
           $que = mysqli_query($conn, $query1) or die(mysqli_error($conn));
           if ($que == 1) {
              
               echo "Featured picture deleted from the database";
               
           } else {
               echo "Featured picture upload failed";
           }
       }
       
       if (strpos($game['screenshoot_picture'],$fileId) !== false) {
           $imageIds = explode(",", $game['screenshoot_picture']);
           
           if (($key = array_search($fileId, $imageIds)) !== false) {
               unset($imageIds[$key]);
           }
           $filesDataBase = implode(",", $imageIds);
           $query1 = "UPDATE games SET screenshoot_picture = '$filesDataBase' WHERE id='$gameId' ";
           $que = mysqli_query($conn, $query1) or die(mysqli_error($conn));
           if ($que == 1) {
              
               echo "Screenshoot_picture deleted from the database";
           } else {
               echo "Featured picture upload failed";
           }
       }
       //izmenjati nazive
       if (strpos($game['icon'],$fileId) !== false) {
           $imageIds = explode(",", $game['icon']);
           
           if (($key = array_search($fileId, $imageIds)) !== false) {
               unset($imageIds[$key]);
           }
           $filesDataBase = implode(",", $imageIds);
           $query1 = "UPDATE games SET icon = '$filesDataBase' WHERE id='$gameId' ";
           $que = mysqli_query($conn, $query1) or die(mysqli_error($conn));
           if ($que == 1) {
               
               echo "Icon deleted from the database";
           } else {
               echo "Featured picture upload failed";
           }
   }

   }
?>