<?php 
    //allow the config
    define('__CONFIG__', true);
    //require the config
    require_once "../inc/config.php"; 

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Always load JSON format
    header('Content-type: application/json');

    $return = [];

    $reg = Filter::String($_POST['reg']);
    $type = Filter::String($_POST['type']);
    $model = Filter::String($_POST['model']);
    $manufacturer = Filter::String($_POST['manufacturer']);
    $short_name = Filter::String($_POST['short_name']);
    $hours = Filter::Int( $_POST['hours']);
    $landings = Filter::Int( $_POST['landings']);

   
    $addAircraft = $con -> prepare("INSERT INTO fleet(reg, type, model, manufacturer, short_name, hours, landings)
                                    VALUES (:reg, :type, :model, :manufacturer, :short_name, :hours, :landings )");
    $addAircraft -> bindParam(':reg', $reg, PDO::PARAM_STR);
    $addAircraft -> bindParam(':type', $type, PDO::PARAM_STR);
    $addAircraft -> bindParam(':model', $model, PDO::PARAM_STR);
    $addAircraft -> bindParam(':manufacturer', $manufacturer, PDO::PARAM_STR);
    $addAircraft -> bindParam(':short_name', $short_name, PDO::PARAM_STR);
    $addAircraft -> bindParam(':hours', $hours, PDO::PARAM_INT);
    $addAircraft -> bindParam(':landings', $landings, PDO::PARAM_INT);
    $addAircraft -> execute();

    $return['redirect'] = 'fleet.php';
    
    echo json_encode($return, JSON_PRETTY_PRINT);

    exit;

    } else {
        //kill this script.
        exit('INVALID URL');
    } 
?>