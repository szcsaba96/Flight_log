<?php 
    //allow the config
    define('__CONFIG__', true);
    //require the config
    require_once "../inc/config.php"; 

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Always load JSON format
    header('Content-type: application/json');

    $return = [];

    $date = Filter::String($_POST['date']);

    //select the aircraft ID trough registration
    $reg = Filter::String($_POST['reg']);

    $selectID = $con -> prepare("SELECT aircraft_id FROM fleet WHERE aircraft_reg = :reg");
    $selectID -> bindParam(':reg', $reg, PDO::PARAM_STR);
    $selectID -> execute();

    $selectID = $selectID -> fetch(PDO::FETCH_ASSOC);
    $ID = $selectID['aircraft_id'];

    //check if ATL exists for the given day
    $checkDay = $con ->prepare("SELECT date, closed FROM atl WHERE date = :date AND aircraft_id = :id");
    $checkDay -> bindParam(':date', $date, PDO::PARAM_STR);
    $checkDay -> bindParam(':id', $ID, PDO::PARAM_INT);
    $checkDay -> execute();
    $day_found = $checkDay->rowCount();

    if( !isset($_POST['comm']) ) {
        //CREATE ATL handling

        if( $day_found > 0 ) {
            $return['error'] = "There is already an ATL created for today!";
        } else {

            $createATL = $con -> prepare("INSERT INTO atl(aircraft_id, date, closed)
                                            VALUES (:id, :date, 0)");
            $createATL -> bindParam(':id', $ID, PDO::PARAM_INT);
            $createATL -> bindParam(':date', $date, PDO::PARAM_STR);
            $createATL -> execute();

            $return['redirect'] = 'dashboard.php';
            }
            
            echo json_encode($return, JSON_PRETTY_PRINT);

            exit;
        } elseif ( isset($_POST['comm']) ) {
            //CLOSE ATL handling

            $checkDay = $checkDay -> fetch(PDO::FETCH_ASSOC);
            
            if( $checkDay['closed'] == 1) {
                $return['error'] = "There is already ATL closed for this aircraft today";
            } elseif( $day_found != 1 ) {
                $return['error'] = "There is no ATL created for today!";
            } else {

            $closeATL = $con -> prepare("UPDATE atl
                                            SET comments = :comments, closed = 1
                                                WHERE aircraft_id = :id AND date = :date");
            $closeATL -> bindParam(':id', $ID, PDO::PARAM_INT);
            $closeATL -> bindParam(':date', $date, PDO::PARAM_STR);
            $closeATL -> bindParam(':comments', $_POST['comm'], PDO::PARAM_STR);
            $closeATL -> execute();

            $addHoursLandings = $con -> prepare("UPDATE fleet SET hours = hours + :hours , landings = landings + :landings WHERE aircraft_id = :id");
            $addHoursLandings -> bindParam(':hours', $_POST['hours'], PDO::PARAM_INT);
            $addHoursLandings -> bindParam(':landings', $_POST['landings'], PDO::PARAM_INT);
            $addHoursLandings -> bindParam(':id', $ID, PDO::PARAM_INT);
            $addHoursLandings -> execute();

            $return['redirect'] = 'dashboard.php';

            
            }

            echo json_encode($return, JSON_PRETTY_PRINT);
            exit;
        } else {
            //kill this script.
            exit('INVALID URL');
        } 
    } 
?>