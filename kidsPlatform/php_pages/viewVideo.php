<?php 
include 'configConn.php';

session_start();
include 'configConn.php';

$sql = "SELECT * FROM videos";

$result = mysqli_query($conn, $sql);

if (isset($_GET['unique_id'])) {
    $userIdLikes = $_SESSION['userId'];
    $uniqueId = $_GET['unique_id'];
    
    $sql1 = "SELECT * FROM user_likes WHERE user_id = '$userIdLikes' AND unique_id = '$uniqueId'";
    
    $result1 = mysqli_query($conn,$sql1);
    
    $row = mysqli_fetch_array($result1);
    
    if ($row == NULL) {
        $sql = "INSERT INTO user_likes(user_id,unique_id) VALUES('$userIdLikes','$uniqueId')";
        
    }else {
        $sql = "DELETE FROM user_likes WHERE user_id = '$userIdLikes' AND unique_id = '$uniqueId' ";
    }
    
    $query = mysqli_query($conn, $sql);
    
    
    
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
	<?php include '../include_pages/admin_sidebar.php';?>
	
	
		<div class="content">
			
			<center>
			<h1>All videos</h1> <br> <br>
			
			<table border="1px">
				<tr>
					<th class="tableTh">Order</th>
					<th class="tableTh">Name</th>
					<th class="tableTh">Link To File</th>
					<th class="tableTh">Universe</th>
					<th class="tableTh">Language</th>
					<th class="tableTh">Update</th>
					<th class="tableTh">Delete</th>

				
				</tr>
			
			<?php 
			     $rowNumber = 1;
			     while ($info = $result ->fetch_assoc()) {
			         
			     
			?>
				<tr>
					<td class="tableTd"><?php echo $rowNumber; ?></td>
					<td class="tableTd"><?php echo "{$info['name']}"; ?></td>
					<td class="tableTd"><?php echo "{$info['link_to_file']}"; ?></td>
					<td class="tableTd"><?php echo "{$info['universe']}"; ?></td>
					<td class="tableTd"><?php echo "{$info['language']}"; ?></td>
					<td class="tableTd"><?php echo "<a class='btn btn-primary' href= 'updateVideo.php?videos_id={$info['id']}'>Update</a>";?></td>
					<td class="tableTd"><?php echo "<a class='btn btn-danger' onClick=\" javascript:return confirm('Are you sure to delete this?');\" href= 'deleteVideo.php?videos_id={$info['id']}'>Delete</a>";?></td>

				</tr>
			
			
			<?php 
			     $rowNumber++;
			     }
			?>	
			</table>
			</center>
		</div>
	

</body>
</html>