<?php 

    //if there is no const defined as __CONFIG__ do not load this file
    if(!defined('__CONFIG__')) {
        exit('You do not have a config file');

    //Our config is below
    
    }

    

    //SEssion are always turned on
    if(!isset($_SESSION)) {
        session_start();
    }


    define('ALLOW FOOTER', true);

    //Allow errors
    error_reporting(-1);
    ini_set('display_errors', 'On');

    //Include the DB
    include_once "classes/DB.php";
    include_once "classes/Filter.php";
    include_once "classes/User.php";
    include_once "classes/Page.php";
    include_once "functions.php";

    $con = DB::getConnection();

    

?>