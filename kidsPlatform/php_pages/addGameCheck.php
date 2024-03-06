

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
    $gameName = $_POST['gameName'];
    $description = $_POST['description'];
    $universe = $_POST['universe'];
    $iosLink = $_POST['iosLink'];
    $googlePlayLink = $_POST['googlePlayLink'];
    $language = $_POST['language'];
    $isLocalGame = $_POST['isLocalGame'];
    $picture = $_POST['picture'];
    $location = "";
    var_dump($universe);

    // check empty
    if (! empty($gameName)) {
        // Check if the name already exist
        $prepQuery = $conn->prepare("SELECT * FROM games WHERE name = ?");
        $prepQuery->bind_param("s", $gameName);
        $prepQuery->execute();
        $result = $prepQuery->get_result();

        if ($result->num_rows > 0) {
            echo "This game name already exist go update game";
        } else {

            // All good we proceed and check is Description field empty
            if (! empty($description)) {

                // All good we proceed and check is Universe field empty
                if (! empty($universe)) {
                   
                    // All good we proceed and check is IOS Link field empty
                    if (! empty($iosLink)) {

                        // All good we proceed and check is Google Play Link Link field empty
                        if (! empty($googlePlayLink)) {

                            // All good we proceed and check is Language field empty
                            if (! empty($language)) {

                                // All good we proceed and check is Is Local Game field empty
                                if (! empty($isLocalGame)) {

                                    if ($picture === 'featuredPicture') {
                                        // Count # of uploaded files in array
                                        $total = count($_FILES['file']['name']);
                                        $filesIds = [];

                                        // Loop through each file
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
                                            if ($isLocalGame == 'yes') {
                                                $isLocalGame = 'True';
                                            } else {
                                                $isLocalGame = 'False';
                                            }
                                          
                                           
                                            
                                            // Add new content number in platform settings table to which need to use for likes
                                            $sql1 = "SELECT * FROM platform_settings";
                                            $result1 = mysqli_query($conn, $sql1);
                                            $row = mysqli_fetch_array($result1);
                                            $first = str_replace("Content_", "", $row[1]);
                                            $newNumber = "Content_" . (intval($first) + 1);
                                            $query2 = "UPDATE platform_settings SET value = '" . $newNumber . "' where name = 'CurrentContentID'";
                                            $result1 = mysqli_query($conn, $query2);

                                            // Join array elements in a string
                                            $filesDataBase = implode(",", $filesIds);

                                            // Insert into games
                                            $query1 = "INSERT INTO games(name,description,universe,ios_link,google_play_link,language,is_local_game,featured_image,unique_content_id) 
                                                                                VALUES('$gameName','$description','$universe','$iosLink','$googlePlayLink','$language','$isLocalGame','$filesDataBase','$newNumber')";
                                            var_dump($query1);

                                            $que = mysqli_query($conn, $query1) or die(mysqli_error($conn));

                                            if ($que == 1) {
                                                echo "Featured picture uploaded and data insert in database";
                                            } else {
                                                echo "Featured picture upload failed";
                                            }
                                        }
                                        // If selected icon, insert in that column in database
                                    } 
                                    elseif ($picture === 'icon') {
                                        // Count # of uploaded files in array
                                        $total = count($_FILES['file']['name']);
                                        $filesIds = [];

                                        // Loop through each file
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
                                            if ($isLocalGame == 'yes') {
                                                $isLocalGame = 'True';
                                            } else {
                                                $isLocalGame = 'False';
                                            }

                                            // Add new content number in platform settings table to which need to use for likes
                                            $sql1 = "SELECT * FROM platform_settings";
                                            $result1 = mysqli_query($conn, $sql1);
                                            $row = mysqli_fetch_array($result1);
                                            $first = str_replace("Content_", "", $row[1]);
                                            $newNumber = "Content_" . (intval($first) + 1);
                                            $query2 = "UPDATE platform_settings SET value = '" . $newNumber . "' where name = 'CurrentContentID'";
                                            $result1 = mysqli_query($conn, $query2);

                                            // Join array elements in a string
                                            $filesDataBase = implode(",", $filesIds);

                                            $query1 = "INSERT INTO games(name,description,universe,ios_link,google_play_link,language,is_local_game,icon,unique_content_id) VALUES('$gameName','$description','$universe','$iosLink','$googlePlayLink','$language','$isLocalGame','$filesDataBase','$newNumber')";

                                            $que = mysqli_query($conn, $query1) or die(mysqli_error($conn));

                                            if ($que == 1) {
                                                echo "Icon uploaded and data insert in database";
                                            } else {
                                                echo "Icon upload failed";
                                            }
                                        }
                                        
                                    } 
                                    // If selected Screenshot picture insert in that column in database
                                    elseif ($picture === 'screenshotPicture') {
                                        // Count # of uploaded files in array
                                        $total = count($_FILES['file']['name']);
                                        $filesIds = [];

                                        // Loop through each file
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
                                            if ($isLocalGame == 'yes') {
                                                $isLocalGame = 'True';
                                            } else {
                                                $isLocalGame = 'False';
                                            }

                                            // Add new content number in platform settings table to which need to use for likes
                                            $sql1 = "SELECT * FROM platform_settings";
                                            $result1 = mysqli_query($conn, $sql1);
                                            $row = mysqli_fetch_array($result1);
                                            $first = str_replace("Content_", "", $row[1]);
                                            $newNumber = "Content_" . (intval($first) + 1);
                                            $query2 = "UPDATE platform_settings SET value = '" . $newNumber . "' where name = 'CurrentContentID'";
                                            $result1 = mysqli_query($conn, $query2);

                                            // Join array elements in a string
                                            $filesDataBase = implode(",", $filesIds);

                                            $query1 = "INSERT INTO games(name,description,universe,ios_link,google_play_link,language,is_local_game,screenshoot_picture,unique_content_id) VALUES('$gameName','$description','$universe','$iosLink','$googlePlayLink','$language','$isLocalGame','$filesDataBase','$newNumber')";

                                            $que = mysqli_query($conn, $query1) or die(mysqli_error($conn));

                                            if ($que == 1) {
                                                echo "Screenshot picture uploaded and data insert in database";
                                            } else {
                                                echo "Screenshot picture upload failed";
                                            }
                                        }
                                    } 
                                    else {
                                        echo "Something wrong with uploading try again";
                                    }
                                } else {
                                    echo "Field Is Local Game is required";
                                }
                            } else {
                                echo "Field language is required";
                            }
                        } else {
                            echo "Field Google Play Link is required";
                        }
                    } else {
                        echo "Field IOS Link is required";
                    }
                } else {
                    echo "Field Universe is required";
                }
            } else {
                echo "Field Description is required";
            }
        }
    } else {
        echo "Field Game name is required";
    }
}

?>