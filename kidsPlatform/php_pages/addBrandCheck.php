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
    $brandName = $_POST['brandName'];
    $brandColor = $_POST['brandColor'];
    $location = "";
    
    if (!empty($brandName)) {
        // Check if the name already exist
        $prepQuery = $conn->prepare("SELECT * FROM brands WHERE brand_name = ?");
        $prepQuery->bind_param("s", $brandName);
        $prepQuery->execute();
        $result = $prepQuery->get_result();
        
        if (!$result->num_rows > 0) {
            //All good
            if (!empty($brandColor)) {
                //All good
                if (!empty($_FILES['brandCharacter']['name'][0])) {
                    //All good
                    if (!empty($_FILES['brandIcon']['name'][0])) {
                        
                    //Count brand character
                    $files = $_FILES['brandCharacter'];
                    $total = count($files['name']);
                    $filesIds = [];
                    
                    // Loop through each file of brand character
                    for ($i = 0; $i < $total; $i ++) {
                        $tempName = $_FILES['brandCharacter']['tmp_name'][$i];
                        $fileName = rand(1000, 10000) . "-" . $_FILES['brandCharacter']['name'][$i];
                        $fileSize = $_FILES['brandCharacter']['size'][$i];
                        
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
                        
                        // Join array elements in a string
                        $filesDataBase = implode(",", $filesIds);
                        
                    }
                    
                        //Count brand icon values
                        $files = $_FILES['brandIcon'];
                        $total = count($files['name']);
                        $filesIds1 = [];
                        
                        // Loop through each file of brand icon
                        for ($i = 0; $i < $total; $i ++) {
                            $tempName = $_FILES['brandIcon']['tmp_name'][$i];
                            $fileName = rand(1000, 10000) . "-" . $_FILES['brandIcon']['name'][$i];
                            $fileSize = $_FILES['brandIcon']['size'][$i];
                            
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
                                $filesIds1[] = $conn->insert_id;
                            }
                        }
                        
                        if ($query == 1) {
                            $fileId = $conn->insert_id;
                            
                            // Join array elements in a string
                            $filesDataBase1 = implode(",", $filesIds1);
                            
                            // Insert into brands
                            $query1 = "INSERT INTO brands(brand_name,brand_character,brand_icon,brand_color)VALUES('$brandName','$filesDataBase','$filesDataBase1','$brandColor')";
                            var_dump($query1);
                            
                            $que = mysqli_query($conn, $query1) or die(mysqli_error($conn));
                            
                            if ($que == 1) {
                                echo "Brand Character picture uploaded";
                            } else {
                                echo "Brand Character picture upload failed";
                            }
                        }
                }else {
                    echo "Field Brand Icon is required";
                }
             }else {
                 echo "Field Brand Character is required";
             }
                
            }else {
                echo "Field Brand Color is required";
            }
        }else {
            echo "This game name already exist";
        }
    }else {
        echo "Field Brand Name is required";
    }
}

?>