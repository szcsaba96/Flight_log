<?php
    require_once "db.php";

    $json = array();
    $sqlQuery = "SELECT * FROM tbl_events ORDER BY id";

    $result = mysqli_query($conn, $sqlQuery);
    $eventArray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $row += [ "color" => '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT) ];
        array_push($eventArray, $row);
    }
    mysqli_free_result($result);

    mysqli_close($conn);
    echo json_encode($eventArray);
?>