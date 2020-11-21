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
    $instructor_id = Filter::String($_POST['instructor_book']);
    $pilot = Filter::String($_POST['pilot']);
    $comm = Filter::String( $_POST['comm_book']);


    $getInstructorName = $con -> prepare("SELECT last_name, first_name FROM users WHERE user_id = '".$instructor_id."' ");
    $getInstructorName -> execute();

    $getInstructorName = $getInstructorName->fetch(PDO::FETCH_ASSOC);
    $instructorName = $getInstructorName['last_name']." ".$getInstructorName['first_name'];
   
    $bookFlight = $con -> prepare("INSERT INTO tbl_events(title, start, end, pilot, instructor, comments)
                                    VALUES ('".$aircraft_reg."', '".$start."','".$end ."', '".$pilot."', '".$instructorName."', '".$comm."' )");
    $bookFlight -> execute();

    $return['redirect'] = 'planning.php';
    
    echo json_encode($return, JSON_PRETTY_PRINT);

    exit;

    } else {
        //kill this script.
        exit('INVALID URL');
    } 
?>