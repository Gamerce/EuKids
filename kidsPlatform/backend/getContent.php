<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get content</title>
</head>
<body>
    <?php 
    include '../php_pages/configConn.php';
    
    $json_array = array();
    $sql = "";
    //Select all content

    if ((isset($_GET['All']) && $_GET['All'] == "1") || (isset($_GET["users"]) && $_GET['users'] == "1")) {
        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn,$sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $json_array[] = $row;
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

    // Select all from files
    
    if ((isset($_GET["All"]) && $_GET['All'] == "1") || (isset($_GET["files"]) && $_GET['files'] == "1")) {
        $sql = "SELECT * FROM files";
        $result = mysqli_query($conn, $sql);
        
        while ($row = mysqli_fetch_assoc($result))
        {
            $json_array[] = $row;
        }
    }

    // Select all from Universe
    
    if ((isset($_GET["All"]) && $_GET['All'] == "1") || (isset($_GET["Universe"]) && $_GET['Universe'] == "1")) {
        $sql = "SELECT * FROM Universe";
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
    
    
    echo '<pre>';  
    print_r(json_encode($json_array));  
    echo '</pre>';  
    
    
    

    
    
    ?>
</body>
</html>
