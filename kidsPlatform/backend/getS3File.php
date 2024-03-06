<?php
include 'configConn.php';
require '../vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;


	//echo "fully Done 01";
	if ((isset($_GET['UserName']))
	&& isset($_GET['Password'])){
		//Check for user access level and exit or continue.
	}

	//echo "\nfully Done 02";
// Amazon S3 API credentials
$region = 'eu-north-1';
$version = 'latest';
$access_key_id = 'AKIA52R4QF2PED6A7PMJ';
$secret_access_key = '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';
$bucket = 'eukids';

	//echo "\nfully Done 03";
$statusMsg = '';
$status = 'danger';

	//echo "\nfully Done 04";
if (isset($_GET['linkToFile'])) {
	$linkToFile = $_GET['linkToFile'];

	//echo "\nfully Done 05";
	// Instantiate an Amazon S3 client
	$s3 = new Aws\S3\S3Client([
		//'profile' => 'default',
		'region' => $region,
		'version' => $version,
		'credentials' => [
			'key' => $access_key_id,
			'secret' => $secret_access_key
		]
	]);
	//echo "\nfully Done 06";
	$cmd = $s3->getCommand('GetObject', [
			'Bucket' => $bucket,
			'Key' => $linkToFile
		]);
		
	//echo "\nfully Done 07";	
	$request = $s3->createPresignedRequest($cmd, '+5 minutes');
	//echo "\nfully Done 08";
    $presignedUrl = (string)$request->getUri();
	//echo "\nfully Done 09";
	echo urldecode($presignedUrl);
	//echo "\nfully Done 10";
}

?>