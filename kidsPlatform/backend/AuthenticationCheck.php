<?php
function Authenticate($userNameID, $usedPass){ //function parameters, two variables.
	include '../php_pages/configConn.php';
	$isValid = false;
	
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		$sql = "SELECT * FROM users WHERE username_id = '".$userNameID."' AND password = '".$usedPass."' ";

		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result);

		if(isset($row["usertype"])){
		}
		
		if ($row["usertype"] == "admin") {
			$isValid = true;

		}elseif($row["usertype"] == "user"){
			$isValid = true;
		}else{
		}
	}


	return $isValid;
}
?>