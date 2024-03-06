<?php 
    //include form submission script
    include_once 'addAudioCheck.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Add Audio Page</title>

<link rel="stylesheet" type="text/css"
	href="../css_pages/adminDashboard.css">
<link rel="stylesheet" type="text/css" href="../css_pages/addAudio.css">
	<?php include '../include_pages/links_bootstrap.php';?>
</head>
<body>
	<?php include '../include_pages/admin_sidebar.php';?>
	
	<center>
		<div class="content">
			<h1 class="addGameTittleDesign">Add Audiobook</h1>

			<div>
				<form action="addAudioCheck.php" method="POST" enctype="multipart/form-data">
					<div>
						<label class="labelDesign">Audiobook name</label>
						<input class="inputDesign" type="text" name="name">
					</div>
					<div>
						<label class="labelDesign">Link to file</label>
						<input class="inputDesign" type="text" name="linkToFile">
					</div>
					<div>
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
					</div>
					<div>
						<label class="labelDesign">Language</label>
						<input class="inputDesign" type="text" name="language">
					</div>
					<div>
						<label class="labelDesign">Featured image</label>
						<input class="inputDesign" multiple="multiple" type="file" name="file[]">
					</div>
					<div>
						<input  class="btn btn-primary" type="submit" name="submit" value="Add Audiobook">
					</div>
				</form>
			</div>

		</div>
	</center>

</body>
</html>