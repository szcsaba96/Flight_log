<?php
    require_once "db.php";

    $json = array();
    $sqlQuery = "SELECT ev.*, us.last_name, us.first_name FROM events ev, users us WHERE ev.pilot_id = us.user_id ORDER BY ev.event_id";

    $result = mysqli_query($conn, $sqlQuery);
    $eventArray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $row += [ "color" => '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT) ];
        $row += ["pilot" => $row['last_name']." ".$row['first_name'] ];

        if( !empty($row['instructor_id']) ) {
            $sqlInstructorName = "SELECT us.last_name, us.first_name FROM users us, events ev WHERE ev.instructor_id = us.user_id";
            $res = mysqli_query($conn, $sqlInstructorName);

            $rowInstr = mysqli_fetch_assoc($res);

            $row += ["instructor" => $rowInstr['last_name']." ".$rowInstr['first_name'] ];
        } else {
            $row += ["instructor" => ""];
        }
        array_push($eventArray, $row);
    }
    mysqli_free_result($result);

    mysqli_close($conn);
    echo json_encode($eventArray);
?>