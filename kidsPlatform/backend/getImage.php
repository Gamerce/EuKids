<?php 
	include '../php_pages/configConn.php';
	require_once("AuthenticationCheck.php");
	ini_set('display_startup_errors', 1);
	ini_set('display_errors', 1);
	error_reporting(-1);
	
	//if(isset($_SERVER["REQUEST_METHOD"]))
	//	echo $_SERVER["REQUEST_METHOD"];
	
	if(isset($_GET['username']) == false){
		//echo '<br>No user name set';
	}
	if(isset($_GET['password']) == false){
		//echo '<br>No pasword set';
	}
	if(isset($_GET['username']) && isset($_GET['password'])){
		$validUser = false;
		if(!isset($_SESSION['username']) || !isset($_SESSION['password'])){
			$userName = strval($_GET['username']);
			$passWord = strval($_GET['password']);
			//echo "Testing login: ../php_pages/login_check.php?username={$userName}&password={$passWord}";
			$validUser = Authenticate($userName, $passWord);
			$temp = strval($validUser);
		}
		
		if($validUser == true && isset($_GET['FileName']) && $_GET['FileName'] != "" && file_exists("../../../FileStorage/Images/{$_GET['FileName']}")){
			//$b64image = base64_encode(file_get_contents("../../../FileStorage/Images/{$_GET['FileName']}"));
			//header("Content-Type: text/plain");
			//header("Content-Type: image/jpeg");
			
			//echo $b64image;
			//echo "<img src = 'data:image/jpeg;base64,$b64image'>";
			echo file_get_contents("../../../FileStorage/Images/{$_GET['FileName']}");
		}
	}
	exit();
?>