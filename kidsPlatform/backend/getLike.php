 <?php
include '../php_pages/configConn.php';

$username = $_GET['username'];

$sql = "SELECT liked FROM users WHERE id = '$username'";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

$arr = explode(",", $row['liked']);

$returnValue = [];

for ($i = 0; $i < sizeof($arr); $i ++) {
    $query = "SELECT * FROM games WHERE unique_content_id = '{$arr[$i]}'";
    $result1 = mysqli_query($conn, $query);

    while ($row1 = mysqli_fetch_assoc($result1)) {
        $row1['type'] = "games";
        $returnValue[$arr[$i]] = $row1;
    }

    $query = "SELECT * FROM videos WHERE unique_content_id = '{$arr[$i]}'";
    $result1 = mysqli_query($conn, $query);
    while ($row1 = mysqli_fetch_assoc($result1)) {
        $row1['type'] = "videos";
        $returnValue[$arr[$i]] = $row1;
    }

    $query = "SELECT * FROM audiobooks WHERE unique_content_id = '{$arr[$i]}'";
    $result1 = mysqli_query($conn, $query);
    while ($row1 = mysqli_fetch_assoc($result1)) {
        $row1['type'] = "audiobooks";
        $returnValue[$arr[$i]] = $row1;
    }
}

echo '<pre>';
print_r(json_encode($returnValue));
echo '</pre>';

?>