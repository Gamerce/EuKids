<?php 

include 'configConn.php';

function GetImageUrlFromFileID($featured_image) {
    
    global $conn;
    $sql = "SELECT * FROM files WHERE id = '".$featured_image."'";
    $result = mysqli_query($conn, $sql);
    
    $file = $result->fetch_assoc();
    if ($file != NULL){
        return $file['Location'];
    }
    return NULL;
    
    
    
}



$json_array = array();

if ((isset($_GET["user_id"]))) {
    $sql = "SELECT * FROM user_likes WHERE user_id = ".$_GET['user_id'];
    $result = mysqli_query($conn, $sql);
    
    while ($row = mysqli_fetch_assoc($result))
    {
        $query = "SELECT * FROM games WHERE unique_content_id = '{$row['unique_id']}'";
        $result1 = mysqli_query($conn, $query);
        while ($row1 = mysqli_fetch_assoc($result1)){
            $row1['type']="games";
            $row1['featured_image']=GetImageUrlFromFileID($row1['featured_image']);
            $json_array[] = $row1;
        }
        
        $query = "SELECT * FROM videos WHERE unique_content_id = '{$row['unique_id']}'";
        $result1 = mysqli_query($conn, $query);
        while ($row1 = mysqli_fetch_assoc($result1)){
            $row1['type']="videos";
            $row1['featured_image']=GetImageUrlFromFileID($row1['featured_image']);
            $json_array[] = $row1;
        }
        
        $query = "SELECT * FROM audiobooks WHERE unique_content_id = '{$row['unique_id']}'";
        $result1 = mysqli_query($conn, $query);
        while ($row1 = mysqli_fetch_assoc($result1)){
            $row1['type']="audiobooks";
            $row1['featured_image']=GetImageUrlFromFileID($row1['featured_image']);
            $json_array[] = $row1;
        }
        
        
        
    }
}

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>View games</title>

<link rel="stylesheet" type="text/css" href="../css_pages/adminDashboard.css">
<link rel="stylesheet" type="text/css" href="../css_pages/updateGame.css">
	<?php include '../include_pages/links_bootstrap.php';?>
</head>
<body>
	
	<?php print_r($json_array) ?>
	
		
	

</body>
</html>