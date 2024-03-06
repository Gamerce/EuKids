<?php 
  include 'configConn.php';  
  
  require '../vendor/autoload.php';
  
  use Aws\S3\S3Client;
  use Aws\Exception\AwsException;
  
  // Amazon S3 API credentials
  $region = 'eu-north-1';
  $version = 'latest';
  $access_key_id = 'AKIA52R4QF2PED6A7PMJ';
  $secret_access_key = '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';
  $bucket = 'eukids';
  
  $gameId = $_GET['games_id'];
   
  $sql = "SELECT * FROM games WHERE id='$gameId'";
  
  $result = mysqli_query($conn, $sql);
  
  $info = $result -> fetch_assoc();
  
  if (isset($_POST['update'])) {
      
      $gameName = $_POST['name'];
      $description = $_POST['description'];
      $universe = $_POST['universe'];
      $iosLink = $_POST['iosLink'];
      $googlePlayLink = $_POST['googlePlayLink'];
      $language = $_POST['language'];
      $isLocalGame = $_POST['isLocalGame'];
      $picture = $_POST['picture'];
      $location = "";
      
      
      if ($picture === 'featuredPicture') {
          // Check if any file was uploaded
          if (!empty($_FILES['file']['name'][0])) {
              // Count # of uploaded files in array
              $total = count($_FILES['file']['name']);
              $filesIds = [];
              // Loop through each file
              for ($i = 0; $i < $total; $i++) {
                  $tempName = $_FILES['file']['tmp_name'][$i];
                  $fileName = rand(1000, 10000) . "-" . $_FILES['file']['name'][$i];
                  $fileSize = $_FILES['file']['size'][$i];
                  
                  if (is_uploaded_file($tempName)) {
                      // Instantiate an Amazon S3 client
                      $s3 = new S3Client([
                          'version' => $version,
                          'region' => $region,
                          'credentials' => [
                              'key' => $access_key_id,
                              'secret' => $secret_access_key
                          ]
                      ]);
                      
                      // Upload file to S3 bucket
                      try {
                          $result = $s3->putObject([
                              'Bucket' => $bucket,
                              'Key' => $fileName,
                              'ACL' => 'public-read',
                              'SourceFile' => $tempName
                          ]);
                          $result_arr = $result->toArray();
                          
                          if (!empty($result_arr['ObjectURL'])) {
                              $location = $result_arr['ObjectURL'];
                          } else {
                              $api_error = 'Upload Failed! S3 Object URL not found';
                          }
                      } catch (Aws\S3\Exception\S3Exception $e) {
                          $api_error = $e->getMessage();
                      }
                      
                      if (empty($api_error)) {
                          $status = 'success';
                          $statusMsg = 'File was uploaded to the S3 bucket successfully!';
                      } else {
                          $statusMsg = $api_error;
                      }
                  } else {
                      $statusMsg = 'File upload failed!';
                  }
                  
                  //Insert into table files
                  $sql = "INSERT INTO files(FileName,UploadedOn,Location,Size) VALUES('$fileName',NOW(),'$location','$fileSize')";
                  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                  if ($query == 1) {
                      $filesIds[] = $conn->insert_id;
                  }
              }
              
              if ($query == 1) {
                  $isLocalGame = ($isLocalGame == 'yes') ? 'True' : 'False';
                  // Join array elements in a string
                  
                  
                  if (empty($info['featured_image'])) {
                      $filesDataBase = $info['featured_image']. implode(",", $filesIds);
                  }else {
                      $filesDataBase = $info['featured_image'].",". implode(",", $filesIds);
                  }
                 
                  $query1 = "UPDATE games SET featured_image = '$filesDataBase' WHERE id='$gameId' ";
                  $que = mysqli_query($conn, $query1) or die(mysqli_error($conn));
                  if ($que == 1) {
                      echo "Featured picture uploaded and data inserted into the database";
                  } else {
                      echo "Featured picture upload failed";
                  }
              }
          } else {
              
              echo "Please select a file to upload.";
          }
      }
      
      if ($picture === 'icon') {
          // Check if any file was uploaded
          if (!empty($_FILES['file']['name'][0])) {
              // Count # of uploaded files in array
              $total = count($_FILES['file']['name']);
              $filesIds = [];
              // Loop through each file
              for ($i = 0; $i < $total; $i++) {
                  $tempName = $_FILES['file']['tmp_name'][$i];
                  $fileName = rand(1000, 10000) . "-" . $_FILES['file']['name'][$i];
                  $fileSize = $_FILES['file']['size'][$i];
                  
                  if (is_uploaded_file($tempName)) {
                      // Instantiate an Amazon S3 client
                      $s3 = new S3Client([
                          'version' => $version,
                          'region' => $region,
                          'credentials' => [
                              'key' => $access_key_id,
                              'secret' => $secret_access_key
                          ]
                      ]);
                      
                      // Upload file to S3 bucket
                      try {
                          $result = $s3->putObject([
                              'Bucket' => $bucket,
                              'Key' => $fileName,
                              'ACL' => 'public-read',
                              'SourceFile' => $tempName
                          ]);
                          $result_arr = $result->toArray();
                          
                          if (!empty($result_arr['ObjectURL'])) {
                              $location = $result_arr['ObjectURL'];
                          } else {
                              $api_error = 'Upload Failed! S3 Object URL not found';
                          }
                      } catch (Aws\S3\Exception\S3Exception $e) {
                          $api_error = $e->getMessage();
                      }
                      
                      if (empty($api_error)) {
                          $status = 'success';
                          $statusMsg = 'File was uploaded to the S3 bucket successfully!';
                      } else {
                          $statusMsg = $api_error;
                      }
                  } else {
                      $statusMsg = 'File upload failed!';
                  }
                  
                  //Insert into table files
                  $sql = "INSERT INTO files(FileName,UploadedOn,Location,Size) VALUES('$fileName',NOW(),'$location','$fileSize')";
                  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                  if ($query == 1) {
                      $filesIds[] = $conn->insert_id;
                  }
              }
              
              if ($query == 1) {
                  $isLocalGame = ($isLocalGame == 'yes') ? 'True' : 'False';
                  // Join array elements in a string
                  
                  
                  if (empty($info['icon'])) {
                      $filesDataBase = $info['icon']. implode(",", $filesIds);
                  }else {
                      $filesDataBase = $info['icon'].",". implode(",", $filesIds);
                  }
                  
                  $query1 = "UPDATE games SET icon = '$filesDataBase' WHERE id='$gameId' ";
                  $que = mysqli_query($conn, $query1) or die(mysqli_error($conn));
                  if ($que == 1) {
                      echo "Icon uploaded and data inserted into the database";
                  } else {
                      echo "Icon upload failed";
                  }
              }
          } else {
              
              echo "Please select a file to upload.";
          }
      }
      
      if ($picture === 'screenshotPicture') {
          // Check if any file was uploaded
          if (!empty($_FILES['file']['name'][0])) {
              // Count # of uploaded files in array
              $total = count($_FILES['file']['name']);
              $filesIds = [];
              // Loop through each file
              for ($i = 0; $i < $total; $i++) {
                  $tempName = $_FILES['file']['tmp_name'][$i];
                  $fileName = rand(1000, 10000) . "-" . $_FILES['file']['name'][$i];
                  $fileSize = $_FILES['file']['size'][$i];
                  
                  if (is_uploaded_file($tempName)) {
                      // Instantiate an Amazon S3 client
                      $s3 = new S3Client([
                          'version' => $version,
                          'region' => $region,
                          'credentials' => [
                              'key' => $access_key_id,
                              'secret' => $secret_access_key
                          ]
                      ]);
                      
                      // Upload file to S3 bucket
                      try {
                          $result = $s3->putObject([
                              'Bucket' => $bucket,
                              'Key' => $fileName,
                              'ACL' => 'public-read',
                              'SourceFile' => $tempName
                          ]);
                          $result_arr = $result->toArray();
                          
                          if (!empty($result_arr['ObjectURL'])) {
                              $location = $result_arr['ObjectURL'];
                          } else {
                              $api_error = 'Upload Failed! S3 Object URL not found';
                          }
                      } catch (Aws\S3\Exception\S3Exception $e) {
                          $api_error = $e->getMessage();
                      }
                      
                      if (empty($api_error)) {
                          $status = 'success';
                          $statusMsg = 'File was uploaded to the S3 bucket successfully!';
                      } else {
                          $statusMsg = $api_error;
                      }
                  } else {
                      $statusMsg = 'File upload failed!';
                  }
                  
                  //Insert into table files
                  $sql = "INSERT INTO files(FileName,UploadedOn,Location,Size) VALUES('$fileName',NOW(),'$location','$fileSize')";
                  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                  if ($query == 1) {
                      $filesIds[] = $conn->insert_id;
                  }
              }
              
              if ($query == 1) {
                  $isLocalGame = ($isLocalGame == 'yes') ? 'True' : 'False';
                  // Join array elements in a string
                  
                                   
                  if (empty($info['screenshoot_picture'])) {
                      $filesDataBase = $info['screenshoot_picture']. implode(",", $filesIds);
                  }else {
                      $filesDataBase = $info['screenshoot_picture'].",". implode(",", $filesIds);
                  }
                  
                  $query1 = "UPDATE games SET screenshoot_picture = '$filesDataBase' WHERE id='$gameId' ";
                  $que = mysqli_query($conn, $query1) or die(mysqli_error($conn));
                  if ($que == 1) {
                      echo "Screenshot picture uploaded and data inserted into the database";
                  } else {
                      echo "Screenshot picture upload failed";
                  }
              }
          } else {
              
              echo "Please select a file to upload.";
          }
      }
      
      $query = "UPDATE games SET name = '$gameName', description='$description', universe='$universe', ios_link='$iosLink', google_play_link='$googlePlayLink', language='$language', is_local_game='$isLocalGame' WHERE id='$gameId'";
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
			<h1>Update Game</h1> <br> <br>
		<form action="#" method="POST" enctype="multipart/form-data">
			<label class="labelDesign">Game name</label>
			<input class="inputDesign" type="text" name="name" value="<?php echo "{$info['name']}"?>">
			<label class="labelDesign" for="description">Description</label>
	 		<textarea class="descriptionDesign" name="description" id="description"  value="<?php echo "{$info['description']}"?>"></textarea> <br>
	 		<label class="labelDesign">Universe</label>
	 		<input class="inputDesign" type="text" name="universe" value="<?php echo "{$info['universe']}"?>">
	 		<label class="labelDesign">IOS Link</label>
	 		<input class="inputDesign" type="text" name="iosLink" value="<?php echo "{$info['ios_link']}"?>">
	 		<label class="labelDesign">Google Play Link</label>
	 		<input class="inputDesign" type="text" name="googlePlayLink" value="<?php echo "{$info['google_play_link']}"?>">
	 		<label class="labelDesign">Language</label>
	 		<input class="inputDesign" type="text" name="language" value="<?php echo "{$info['language']}"?>">
	 		<label class="labelDesign" for="isLocalGame">Is Local Game</label>
	 		<select name="isLocalGame" id="isLocalGame" value="<?php echo "{$info['isLocalGame']}"?>">
						<option value="">Is Local Game</option>
						<option value="True">Yes</option>
						<option value="False">No</option>
			</select> <br> <br>
			
			<select name="picture" id="picture">
	 							<option value="">Select type of image</option>
	 							<option value="featuredPicture">Featured image</option>
	 							<option value="icon">Icon</option>
	 							<option value="screenshotPicture">Screenshot</option>
	 						</select>
	 						<label class="labelDesign">Upload file</label>
	 						<input class="fileUpload" multiple="multiple" type="file" name="file[]"> <br>
	 						
	 							<br>
			<input class="btn btn-primary" type="submit" name="update" value="Update">
		</form>	
	 		 
			<?php
			
		  $featuredImage = $info['featured_image'];
		  $icon = $info['icon'];
		  $screenshootPicture = $info['screenshoot_picture'];
		  
		  $conditions = array();
		  
		  if (!empty($featuredImage)) {
		      $conditions[] = " id IN (" .$featuredImage. ") ";
		  }if (!empty($icon)){
		      $conditions[] = " id IN(" .$icon. ") ";
		  }if (!empty($screenshootPicture)){
		      $conditions[] = " id IN(" .$screenshootPicture. ") ";
		  }
			
		  $sql2 = "SELECT * FROM files WHERE " .implode("OR", $conditions) ;
		  $result3 = mysqli_query($conn, $sql2);
		  
		  while ($image = $result3 ->fetch_assoc()) {
		      echo '<img src="' . $image['Location'] . '" alt="User Image"> <a href="../php_pages/removeImage.php?gameId=' . $info['id'] . '&filesId=' . $image['id'] . ' ">Delete</a>';
		  }
		  
		  
			
	/*		
			$sql = "SELECT * FROM files WHERE id IN (".$info['featured_image'].") OR id IN (".$info['icon'].") OR id IN (".$info['screenshoot_picture'].")";
			var_dump($sql);
			$result = mysqli_query($conn, $sql);
			
			while ($info = $result ->fetch_assoc()) {
			    echo '<img src="' . $info['Location'] . '" alt="User Image">';
			}
	*/		

			
			
			?>
					
		
			</center>
		</div>


</body>
</html>