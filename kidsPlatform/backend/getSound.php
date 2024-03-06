<?php 
	include '../php_pages/configConn.php';
	require_once("AuthenticationCheck.php");
	
	if(isset($_GET['username']) && isset($_GET['password'])){
		$validUser = false;
		if(!isset($_SESSION['username']) || !isset($_SESSION['password'])){
			$userName = strval($_GET['username']);
			$passWord = strval($_GET['password']);
			$validUser = Authenticate($userName, $passWord);
			$temp = strval($validUser);
		}
		else
			$validUser = true;
		
		if($validUser == true && isset($_GET['FileName']) && $_GET['FileName'] != "" && file_exists("../../../FileStorage/Sounds/{$_GET['FileName']}")){
			echo file_get_contents("../../../FileStorage/Sounds/{$_GET['FileName']}");
		}
	}
	exit();
?>