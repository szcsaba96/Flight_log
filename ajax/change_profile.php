<?php 
    //allow the config
    define('__CONFIG__', true);
    //require the config
    require_once "../inc/config.php"; 

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Always load JSON format
    header('Content-type: application/json');

    $user_id = (int) $_SESSION['user_id'];

    function change($col, $var) {

        $change = $con -> prepare("UPDATE users SET ".$col." = ".$var." WHERE ( user_id = :user_id )");
        $change -> bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $change -> execute();

    }

    $return = [];

    if( isset($_POST['first_name']) ) {
        $first_name = Filter::String($_POST['first_name']);
        change("first_name", $first_name);
    }
    if( isset($_POST['last_name']) ) {
        $last_name = Filter::String($_POST['last_name']);
        change("last_name", $last_name);
    }
    if( isset($_POST['birthday']) ) {
        $birthday = $_POST['birthday'];
        change("birthday", $birthday);
    }
    if( isset($_POST['address']) ) {
        $address = Filter::String($_POST['address']);
        change("address", $address);
    }
    if( isset($_POST['tel_number']) ) {
        $tel_number = Filter::String($_POST['tel_number']);
        change("tel_number", $tel_number);
    }
    if( isset($_POST['email']) ) {
        $email = Filter::String($_POST['first_name']);
        change("email", $email);
    }

    /*

    //Make sure the user does not exist
    $user_found = User::Find( $email );

    if($user_found) {
        //User exists
        $return['error'] = "The email you entered is already in use!";
    } else {

        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        //User does not exists, add them
        $addUser = $con -> prepare("INSERT INTO users(email, password, first_name, last_name, birthday, address, tel_number) VALUES(LOWER(:email), :password, :first_name, :last_name, :birthday, :address, :tel_number) ");
        $addUser -> bindParam(':email', $email, PDO::PARAM_STR);
        $addUser -> bindParam(':password', $password, PDO::PARAM_STR);
        $addUser -> bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $addUser -> bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $addUser -> bindParam(':birthday', $birthday, PDO::PARAM_STR);
        $addUser -> bindParam(':address', $address, PDO::PARAM_STR);
        $addUser -> bindParam(':tel_number', $tel_number, PDO::PARAM_STR);
        $addUser -> execute();

        $user_id = $con -> lastInsertId();


        //login
        $_SESSION['user_id'] = (int) $user_id;

        $return['redirect'] = 'dashboard.php?welcome';
        $return['is_logged_in'] = true;
    } */

    //Make sure the user can be added and it is added

    //return the proper inf back to javascript

    echo json_encode($return, JSON_PRETTY_PRINT);

    exit;

    } else {
        //kill this script.
        exit('INVALID URL');
    }  
?>