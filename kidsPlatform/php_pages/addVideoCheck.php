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

$statusMsg = '';
$status = 'danger';

if (isset($_POST['submit'])) {
    $videoName = $_POST['name'];
    $linkToFile = $_POST['linkToFile'];
    $universe = $_POST['universe'];
    $language = $_POST['language'];
    $location = "";

    // check empty
    if (! empty($videoName)) {

        // Check if the name already exist
        $prepQuery = $conn->prepare("SELECT * FROM videos WHERE name = ?");
        $prepQuery->bind_param("s", $videoName);
        $prepQuery->execute();
        $result = $prepQuery->get_result();

        if ($result->num_rows > 0) {
            echo "This video name already exist go update game";
        } else {

            // All good,check is link to file field empty
            if (! empty($linkToFile)) {
                // All good,check is universe field empty
                if (! empty($universe)) {
                    // All good,check is language field empty
                    if (! empty($language)) {
                        // All good,
                        // Count # of uploaded files in array
                        $total = count($_FILES['file']['name']);
                        $filesIds = [];
                        
                        for ($i = 0; $i < $total; $i ++) {
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
                                    
                                    if (! empty($result_arr['ObjectURL'])) {
                                        $location = $result_arr['ObjectURL'];
                                    } else {
                                        $api_error = 'Upload Failed! S3 Object URL not found';
                                    }
                                } catch (Aws\S3\Exception\S3Exception $e) {
                                    $api_error = $e->getMessage();
                                }
                                
                                if (empty($api_error)) {
                                    $status = 'success';
                                    $statusMsg = 'File was upload to the S3 bucket siccessfully!';
                                } else {
                                    $statusMsg = $api_error;
                                }
                            } else {
                                $statusMsg = 'File upload failed!';
                            }
                            
                            // Insert into table files
                            $sql = "INSERT INTO files(FileName,UploadedOn,Location,Size) VALUES('$fileName',NOW(),'$location','$fileSize')";
                            
                            $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                            
                            if ($query == 1) {
                                $filesIds[] = $conn->insert_id;
                            }
                        }

                        if ($query == 1) {
                            $fileId = $conn->insert_id;
                            // Add new content number in platform settings table to which need to use for likes
                            $sql1 = "SELECT * FROM platform_settings";
                            $result1 = mysqli_query($conn,$sql1);
                            $row = mysqli_fetch_array($result1);
                            $first =str_replace("Content_","",$row[1]);
                            $newNumber = "Content_".(intval($first)+1);
                            $query2 = "UPDATE platform_settings SET value = '".$newNumber."' where name = 'CurrentContentID'";
                            $result1 = mysqli_query($conn, $query2);
                            
                            
                            $filesDataBase = implode(",", $filesIds);

                            $query1 = "INSERT INTO videos(name,link_to_file,universe,language,featured_image,unique_content_id) 
                                        VALUES('$videoName','$linkToFile','$universe','$language','$filesDataBase','$newNumber')";

                            $que = mysqli_query($conn, $query1) or die($conn);

                            if ($que == 1) {
                                echo "Featured image uploaded and data insert in database";
                            } else {
                                echo "Featured image upload failed";
                            }
                        }
                    } else {
                        echo "Field language required";
                    }
                } else {
                    echo "Field universe required";
                }
            } else {
                echo "Field link to file required";
            }
        }
    }else {
        echo "Field video name required";
    }
}

?>