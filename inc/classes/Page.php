<?php 

if(!defined('__CONFIG__')) {
    exit('You do not have a config file');
}

class Page {

    static function ForceLogin() {
        if(isset($_SESSION['user_id'])) {
            //The user is allowed here
        } else {
            //The user is not allowed here
            header("Location: login.php");
            exit;
        }
    }
    
    static function ForceDashboard() {
        if(isset($_SESSION['user_id'])) {
            //The user is allowed here
            header("Location: dashboard.php");
            exit;
        } else {
            //The user is not allowed here
            
        }
    }

}

?>