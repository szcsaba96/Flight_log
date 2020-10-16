<?php 
    //allow the config
    define('__CONFIG__', true);
    //require the config
    require_once "../inc/config.php"; 

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Always load JSON format
    header('Content-type: application/json');

    $return = [];

    $type = Filter::String($_POST['type']);
    $description = Filter::String($_POST['descr']);
    $file1 = Filter::String($_POST['file1']);
    $file2 = Filter::String( $_POST['file2']);
   
    $user_id = (int) $_SESSION['user_id'];

    $addDoc = $con -> prepare("INSERT INTO documents(user_id, file_path1, file_path2, doc_type, description)
                                    VALUES (:user_id, :file_path1, :file_path2, :doc_type, :description )");
    $addDoc -> bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $addDoc -> bindParam(':file_path1', $file1, PDO::PARAM_STR);
    $addDoc -> bindParam(':file_path2', $file2, PDO::PARAM_STR);
    $addDoc -> bindParam(':doc_type', $type, PDO::PARAM_STR);
    $addDoc -> bindParam(':description', $description, PDO::PARAM_STR);
    $addDoc -> execute();

    $return['redirect'] = 'documents.php';
    

    echo json_encode($return, JSON_PRETTY_PRINT);

    exit;

    } else {
        //kill this script.
        exit('INVALID URL');
    } 
?>