<?php
include '../php_pages/configConn.php';

if (isset($_GET['user_id']) && isset($_GET['unique_id'])) {
    $userId = $_GET['user_id'];
    $uniqueId = $_GET['unique_id'];
    $toadd = $_GET['toadd'];

    $sql1 = "SELECT * FROM user_likes WHERE user_id = '$userId' AND unique_id = '$uniqueId'";

    $result1 = mysqli_query($conn, $sql1);

    $row = mysqli_fetch_array($result1);

    $sql = "SELECT * FROM users WHERE id = '$userId'";

    $result = mysqli_query($conn, $sql);
    $liked = $result->fetch_assoc();

    if ($toadd == "1") {

        if (strpos($liked['liked'], $uniqueId) == false) {
            $likeIds = explode(",", $liked['liked']);

            $likeIds[] = $uniqueId;

            $filesDataBase = implode(",", $likeIds);

            $query1 = "UPDATE users SET liked = '$filesDataBase' WHERE id='$userId' ";

            $que = mysqli_query($conn, $query1) or die(mysqli_error($conn));

            if ($row == NULL) {

                $sql = "INSERT INTO user_likes(user_id,unique_id) VALUES('$userId','$uniqueId')";
                $query = mysqli_query($conn, $sql);
            }

            if ($que == 1 && $query == 1) {
                echo "Liked set";
            } else {
                echo "Something wrong";
            }
        }
    } elseif ($toadd == "0") {

        if (strpos($liked['liked'], $uniqueId) !== false) {
            $likeIds = explode(",", $liked['liked']);

            if (($key = array_search($uniqueId, $likeIds)) !== false) {
                unset($likeIds[$key]);
            }
        }

        $filesDataBase = implode(",", $likeIds);

        $query1 = "UPDATE users SET liked = '$filesDataBase' WHERE id='$userId' ";

        $que = mysqli_query($conn, $query1) or die(mysqli_error($conn));

        $sql = "DELETE FROM user_likes WHERE user_id = '$userId' AND unique_id = '$uniqueId' ";
        $query = mysqli_query($conn, $sql);
        if ($que == 1 && $query == 1) {
            echo "Unlike set";
        } else {
            echo "Something wrong";
        }
    }
}

/*
 * if($toadd == 1){
 * //make sure it exists in users and user_likes
 *
 *
 *
 *
 * else if($toadd == "0")
 * //remove from users and user_likes
 *
 */
?>

   
    