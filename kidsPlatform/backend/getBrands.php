<?php 
include '../php_pages/configConn.php';

if (isset($_GET["All"])&& $_GET['All'] == "1") {
    
    $sql = "SELECT * FROM brands";
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