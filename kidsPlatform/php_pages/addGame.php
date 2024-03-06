<?php 
    //include form submission script
    include_once 'addGameCheck.php';
    
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add game page</title>

	<link rel="stylesheet" type="text/css" href="../css_pages/adminDashboard.css">
	<link rel="stylesheet" type="text/css" href="../css_pages/addGame.css">
	<?php
		include '../include_pages/links_bootstrap.php';
	?>
</head>
<body>

	<?php
		include '../include_pages/admin_sidebar.php';
	 ?>

	<center>
 
	 	<div class="content">
	 		
	 		<h1 class="addGameTittleDesign">Add Game</h1>
			<div >
	 				<form class="addGameForm"  action="addGameCheck.php" method="POST" enctype="multipart/form-data">

	 						<label class="labelDesign">Game name</label>
	 						<input class="inputDesign" type="text" name="gameName"> <br>
	 						<label class="labelDesign" for="description">Description</label>
	 						<textarea class="descriptionDesign" name="description" id="description" ></textarea> <br>
	 						<?php 
	 						
	 						$sql = "SELECT brand_name FROM brands";
	 						$result = mysqli_query($conn, $sql);
	 						
	 						?>
	 						
	 						<label class="labelDesign" for="universe">Select universe</label>
	 						
	 						<select name="universe" id="universe">
	 						<?php 
	 						$rowNumber = 1;
	 						while ($info = $result ->fetch_assoc()) {
	 						?>
	 							<option value="<?php echo "{$info['brand_name']}"; ?>"><?php echo "{$info['brand_name']}"; ?></option>
	 							
	 						<?php 
	 						}
	 						?>
	 						</select>
	 						
	 						
							<label class="labelDesign">IOS Link</label>
							<input class="inputDesign" type="text" name="iosLink"> <br>
							<label class="labelDesign">Google Play Link</label>
							<input class="inputDesign" type="text" name="googlePlayLink"> <br>
							<label class="labelDesign">Language</label>
							<input class="inputDesign" type="text" name="language">
							<label class="labelDesign" for="isLocalGame">Is Local Game</label>
							<select name="isLocalGame" id="isLocalGame">
								<option value="">Is Local Game</option>
								<option value="yes">Yes</option>
								<option value="no">No</option>
							</select>
	 						<br>
	 							
	 						<label class="labelDesign" for="picture">Type of images</label>
	 						<select name="picture" id="picture">
	 							<option value="">Select type of image</option>
	 							<option value="featuredPicture">Featured image</option>
	 							<option value="icon">Icon</option>
	 							<option value="screenshotPicture">Screenshot</option>
	 						</select>
	 						<label class="labelDesign">Upload file</label>
	 						<input class="fileUpload" multiple="multiple" type="file" name="file[]"> <br>
	 						
	 						
	 						<input class="inputDesign" type="submit" name="submit" value="Upload">
                           
					</form>
	 		</div>
	 	</div>
	 </center>
</body>
</html>