<?php
include '../php_pages/configConn.php';

if (isset($_GET['UserID'])) {
    $UserID = $_GET['UserID'];
    $EventValue = $_GET['EventValue'];
    $EventType = $_GET['EventType'];
    $EventName = $_GET['EventName'];
    $Platform = $_GET['Platform'];

    $sql = "INSERT INTO AnalyticsEvent(UserID,Created,EventValue,EventType,EventName,Platform) VALUES('$UserID',CURRENT_TIMESTAMP(),'$EventValue','$EventType','$EventName','$Platform' )";
    $query = mysqli_query($conn, $sql);

    if ( $query == 1) {
        echo "1";
    } else {
        echo "0";
    }




}


?>
