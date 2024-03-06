<?php 
    //include form submission script
    include_once 'addBrandCheck.php';
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
	 		
	 		<h1 class="addGameTittleDesign">Add Brands</h1>
			<div >
	 				<form class="addGameForm"  action="addBrandCheck.php" method="POST" enctype="multipart/form-data">

	 						<label class="labelDesign">Brand name</label>
	 						<input class="inputDesign" type="text" name="brandName"> <br>
	 						<label class="labelDesign" for="description">Brand Character</label>
	 						<input class="fileUpload" multiple="multiple" type="file" name="brandCharacter[]"> <br>
	 						<label class="labelDesign">Brand Icon</label>
	 						<input class="fileUpload" multiple="multiple" type="file" name="brandIcon[]"> <br>
							<label class="labelDesign">Brand Color</label>
							<input class="inputDesign" type="color" name="brandColor"> <br>
	 						<br>
	 				
	 						<input class="inputDesign" type="submit" name="submit" value="Upload">
                           
					</form>
	 		</div>
	 	</div>
	 </center>
</body>
</html>