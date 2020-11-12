<?php 
    //allow the config
    define('__CONFIG__', true);
    //require the config
    require_once "../inc/config.php"; 

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Always load JSON format
    header('Content-type: application/json');

    $user_id = (int) $_SESSION['user_id'];

    $col = $_POST['col'];
    $value = $_POST['value'];

    echo $col;
    
    $change = $con -> prepare("UPDATE users SET ".$col." = ".$value." WHERE ( user_id = :user_id )");
    $change -> bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $change -> execute();

    $return['redirect'] = 'profile_1.php';

    //return the proper inf back to javascript

    echo json_encode($return, JSON_PRETTY_PRINT);

    exit;

    } else {
        //kill this script.
        exit('INVALID URL');
    }  
?>