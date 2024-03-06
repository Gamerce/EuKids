<?php 
  include 'configConn.php';  
  
  
  $audioId = $_GET['audio_id'];
  
  $sql = "SELECT * FROM audiobooks WHERE id='$audioId'";
  
  $result = mysqli_query($conn, $sql);
  
  $info = $result -> fetch_assoc();
  
  if (isset($_POST['update'])) {
      
      $audioName = $_POST['name'];
      $linkToFile = $_POST['linkToFile'];
      $universe = $_POST['universe'];
      $language = $_POST['language'];
      
      $query = "UPDATE audiobooks SET name = '$audioName',link_to_file='$linkToFile',universe='$universe',language='$language' WHERE id='$audioId'";
      
      $result1 = mysqli_query($conn, $query);
      
      if ($result1) {
          echo "Update success";
      }
  }

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>View games page</title>

<link rel="stylesheet" type="text/css" href="../css_pages/adminDashboard.css">
<link rel="stylesheet" type="text/css" href="../css_pages/updateGame.css">
	<?php include '../include_pages/links_bootstrap.php';?>
</head>
<body>
	<?php include '../include_pages/admin_sidebar.php';?>
	
	
		<div class="content">
			
			<center>
			<h1>Update Audiobook</h1> <br> <br>
		<form action="#" method="POST">
			<label class="labelDesign">Audiobook name</label>
			<input class="inputDesign" type="text" name="name" value="<?php echo "{$info['name']}"?>">
			<label class="labelDesign">Link to file</label>
	 		<input class="inputDesign" type="text" name="linkToFile" value="<?php echo "{$info['link_to_file']}"?>"> <br>
	 		<label class="labelDesign">Universe</label>
	 		<input class="inputDesign" type="text" name="universe" value="<?php echo "{$info['universe']}"?>">
			<label class="labelDesign">Language</label>
	 		<input class="inputDesign" type="text" name="language" value="<?php echo "{$info['language']}"?>">
	 		
			<br> <br>
			<input class="btn btn-primary" type="submit" name="update" value="Update">
		</form>
			</center>
		</div>
	

</body>
</html>