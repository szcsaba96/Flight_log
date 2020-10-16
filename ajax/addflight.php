<?php 
    //allow the config
    define('__CONFIG__', true);
    //require the config
    require_once "../inc/config.php"; 

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Always load JSON format
    header('Content-type: application/json');

    $return = [];

    $flight_date = Filter::String($_POST['flight_date']);
    $fleet_id = Filter::Int($_POST['reg_number']);
    $pilot = Filter::String($_POST['pilot']);
    $instructor = Filter::String( $_POST['instructor']);
    $dep_place = Filter::String($_POST['dep_place']);
    $arr_place = Filter::String($_POST['arr_place']);
    $flight_time = Filter::String($_POST['flight_time']);
    $flights = Filter::Int($_POST['flights']);
   
    $user_id = (int) $_SESSION['user_id'];

    $str_arr = explode(" ", $instructor);
    $first_name = $str_arr[0];
    $last_name = $str_arr[1];

    //make sure that the given instructor exists
    $findInstructor = $con ->prepare("SELECT * FROM users WHERE instructor = '1' AND first_name = :first_name AND last_name = :last_name ");
    $findInstructor -> bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $findInstructor -> bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $findInstructor -> execute();
    $findInstructor -> fetch(PDO::FETCH_ASSOC);
    $user_found = (boolean) $findInstructor->rowCount();

    if(!$user_found) {
        $return['error'] = "Instructor does not exist!";
    } else {

    // Split string - to block off time and block on
    $pieces = explode(" ", $flight_time);
    $datetime1 = new DateTime($pieces[0]);
    $datetime2 = new DateTime($pieces[2]);
    $interval = $datetime1->diff($datetime2);
    $time_result = $interval->format('%H').":".$interval->format('%I')."";

    //add flight to flights in db
    $addFlight = $con -> prepare("INSERT INTO flights(user_id, flight_date, pilot, instructor, dep_place, arr_place, block_on, block_off, flight_time, flights, fleet_id)
                                    VALUES (:user_id, :flight_date, :pilot, :instructor, :dep_place, :arr_place, :block_on, :block_off, :flight_time, :flights, :fleet_id )");
    $addFlight -> bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $addFlight -> bindParam(':flight_date', $flight_date, PDO::PARAM_STR);
    $addFlight -> bindParam(':pilot', $pilot, PDO::PARAM_STR);
    $addFlight -> bindParam(':instructor', $instructor, PDO::PARAM_STR);
    $addFlight -> bindParam(':dep_place', $dep_place, PDO::PARAM_STR);
    $addFlight -> bindParam(':arr_place', $arr_place, PDO::PARAM_STR);
    $addFlight -> bindParam(':block_on', $pieces[0], PDO::PARAM_STR);
    $addFlight -> bindParam(':block_off', $pieces[2], PDO::PARAM_STR);
    $addFlight -> bindParam(':flight_time', $time_result, PDO::PARAM_STR);
    $addFlight -> bindParam(':flights', $flights, PDO::PARAM_INT);
    $addFlight -> bindParam(':fleet_id', $fleet_id, PDO::PARAM_INT);
    $addFlight -> execute();

    
    //get type
    $getType = $con ->prepare("SELECT type FROM fleet WHERE (aircraft_id = :fleet_id)");
    $getType -> bindParam(':fleet_id', $fleet_id, PDO::PARAM_INT);
    $getType -> execute();
    $getType = $getType -> fetch(PDO::FETCH_ASSOC);

    //get the experience
    $getExp = $con -> prepare("SELECT ".$getType['type']." FROM experience WHERE user_id = :user_id");
    $getExp -> bindParam(':user_id', $user_id, PDO::PARAM_STR);
    $getExp -> execute();

    $getExp = $getExp -> fetch(PDO::FETCH_ASSOC);
    
    $exp1 = $getExp[ $getType['type'] ];
    $interval2 = addTime($exp1, $time_result);

    //now add the exp
    $setExp = $con -> prepare("UPDATE experience SET ".$getType['type']." = :interval2 WHERE ( user_id = :user_id )");
    $setExp -> bindParam(':interval2', $interval2, PDO::PARAM_STR);
    $setExp -> bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $setExp -> execute(); 

    $return['redirect'] = 'dashboard.php';
    }

    echo json_encode($return, JSON_PRETTY_PRINT);

    exit;

    } else {
        //kill this script.
        exit('INVALID URL');
    } 
?>