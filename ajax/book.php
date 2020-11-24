<?php 
    //allow the config
    define('__CONFIG__', true);
    //require the config
    require_once "../inc/config.php"; 

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Always load JSON format
    header('Content-type: application/json');

    $return = [];

    $aircraft_reg = Filter::String($_POST['aircraft_reg']);
    $date = Filter::String($_POST['date_book']);
    $start = $date." ".Filter::String($_POST['start']).":00";
    $end = $date." ".Filter::String($_POST['end']).":00";
    $instructor_id = Filter::Int($_POST['instructor_book']);
    $comm = Filter::String( $_POST['comm_book']);

    $pilot_id = $_SESSION['user_id'];

    //check if user already added book or not, and if added get the color hex, else generate one
    $sqlCheckUser = $con -> prepare("SELECT color FROM events WHERE pilot_id = '".$pilot_id."' ");
    $sqlCheckUser -> execute();
    $res = $sqlCheckUser -> fetch(PDO::FETCH_ASSOC);
    $user_found = (boolean) $sqlCheckUser->rowCount();


    //if user was found, get it's color hex
    if ( $user_found ) {
        $color = $res['color'];
    } else { 
        //generate random color
        $color = '#'.str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }
    
    if ( empty($instructor_id) ) {
        $bookFlight = $con -> prepare("INSERT INTO events(title, start, end, pilot_id, comments, color)
                                    VALUES ('".$aircraft_reg."', '".$start."','".$end ."', '".$pilot_id."', '".$comm."', '".$color."'  )");
    } else {
        $bookFlight = $con -> prepare("INSERT INTO events(title, start, end, pilot_id, instructor_id, comments, color)
                                    VALUES ('".$aircraft_reg."', '".$start."','".$end ."', '".$pilot_id."', '".$instructor_id."', '".$comm."', '".$color."' )");
    }
    $bookFlight -> execute();

    $return['redirect'] = 'planning.php';
    
    echo json_encode($return, JSON_PRETTY_PRINT);

    exit;

    } else {
        //kill this script.
        exit('INVALID URL');
    } 
?>