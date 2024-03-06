<?php
	include '../php_pages/configConn.php';

	$json_array = array();
	$sql = "";
	//Select all content
	if (isset($_GET['All']) && $_GET['All'] == "1" || (isset($_GET["users"]) && $_GET['users'] == "1")) {
		$sql = "SELECT * FROM users";
		$result = mysqli_query($conn,$sql);
		while ($row = mysqli_fetch_assoc($result)) {
			$json_array[] = $row;
		}
	}

	//User Likes
	if ((isset($_GET['UserName']))
	&& isset($_GET['Password'])
	&& (isset($_GET["UserLikes"]) && $_GET['UserLikes'] == "1")) {
        $username = $_GET['UserName'];
        $password = $_GET['Password'];


        $sql = "SELECT * FROM users WHERE username_id = '".$username."' AND password = '".$password."' ";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$userID = $row["id"];

		$sql2 = "SELECT * FROM user_likes where user_id = '".$userID."'";
		$result2 = mysqli_query($conn,$sql2);
		while ($row2 = mysqli_fetch_assoc($result2)) {
			$json_array[] = $row2;
		}
	}



	//Select all from games

	if ((isset($_GET["All"]) && $_GET['All'] == "1")  || (isset($_GET["games"]) && $_GET['games'] == "1"))  {
		$sql = "SELECT * FROM games";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($result))
		{
			 $json_array[] = $row;
		}
	}

	// Select al from audiobooks



	if ((isset($_GET["All"]) && $_GET['All'] == "1") || (isset($_GET["audiobooks"]) && $_GET['audiobooks'] == "1")) {
		$sql = "SELECT * FROM audiobooks";
		$result = mysqli_query($conn, $sql);

		while ($row = mysqli_fetch_assoc($result))
		{
			$json_array[] = $row;
		}
	}

	//Select all from videos

	if ((isset($_GET["All"]) && $_GET['All'] == "1") || (isset($_GET["videos"]) && $_GET['videos'] == "1")) {
		$sql = "SELECT * FROM videos";
		$result = mysqli_query($conn, $sql);

		while ($row = mysqli_fetch_assoc($result))
		{
			$json_array[] = $row;
		}
	}

    if ((isset($_GET["All"]) && $_GET['All'] == "1") || (isset($_GET["files"]) && $_GET['files'] == "1")) {
        $sql = "SELECT * FROM files";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result))
        {
            $json_array[] = $row;
        }
    }

    if ((isset($_GET["All"]) && $_GET['All'] == "1") || (isset($_GET["Universe"]) && $_GET['Universe'] == "1")) {
        $sql = "SELECT * FROM Universe";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result))
        {
            $json_array[] = $row;
        }
    }

		if ((isset($_GET["All"]) && $_GET['All'] == "1") || (isset($_GET["PlatformSettings"]) && $_GET['PlatformSettings'] == "1")) {
        $sql = "SELECT * FROM platform_settings";
        $result = mysqli_query($conn, $sql);
        
        while ($row = mysqli_fetch_assoc($result))
        {
            $json_array[] = $row;
        }
    }



    //Select all from User Likes

    if ((isset($_GET["All"]) && $_GET['All'] == "1") || (isset($_GET["user_likes"]) && $_GET['user_likes'] == "1")) {
        $sql = "SELECT * FROM user_likes";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result))
        {
            $json_array[] = $row;
        }
    }



	header("Content-Type: application/json");
	echo json_encode($json_array);
	exit();





?>
