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

$videoId = $_GET['videos_id'];

$sql = "SELECT * FROM videos WHERE id='$videoId'";

$result = mysqli_query($conn, $sql);

$info = $result -> fetch_assoc();

if (isset($_POST['update'])) {
    
    $videoName = $_POST['name'];
    $linkToFile = $_POST['linkToFile'];
    $universe = $_POST['universe'];
    $language = $_POST['language'];
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
            
                // Join array elements in a string
            
                
                if (empty($info['featured_image'])) {
                    $filesDataBase = $info['featured_image']. implode(",", $filesIds);
                }else {
                    $filesDataBase = $info['featured_image'].",". implode(",", $filesIds);
                }
                
                $query1 = "UPDATE videos SET featured_image = '$filesDataBase' WHERE id='$videoId' ";
                $que = mysqli_query($conn, $query1) or die(mysqli_error($conn));
                if ($que == 1) {
                    echo "Featured picture uploaded and data inserted into the database";
                } else {
                    echo "Featured picture upload failed";
                }
            
        } else {
            
            echo "Please select a file to upload.";
        }
    }
    
    $query = "UPDATE videos SET name = '$videoName',link_to_file ='$linkToFile', universe='$universe',language='$language' WHERE id='$videoId'";
    
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
			<h1>Update Video</h1> <br> <br>
		<form action="#" method="POST">	
			<label class="labelDesign">Video name</label>
			<input class="inputDesign" type="text" name="name" value="<?php echo "{$info['name']}"?>">
			<label class="labelDesign">Link to file</label>
	 		<input class="inputDesign" type="text" name="linkToFile" value="<?php echo "{$info['link_to_file']}"?>"> <br>
	 		<label class="labelDesign">Universe</label>
	 		<input class="inputDesign" type="text" name="universe" value="<?php echo "{$info['universe']}"?>">
	 		<label class="labelDesign">Language</label>
	 		<input class="inputDesign" type="text" name="language" value="<?php echo "{$info['language']}"?>">
			<br> <br>
			
			<select name="picture" id="picture">
	 							<option value="">Select type of image</option>
	 							<option value="featuredPicture">Featured image</option>
	 						</select>
	 						<label class="labelDesign">Upload file</label>
	 						<input class="fileUpload" multiple="multiple" type="file" name="file[]"> <br>
	 						
	 							<br>
			<input class="btn btn-primary" type="submit" name="update" value="Update">
		</form>	
			</center>
		</div>
	

</body>
</html>