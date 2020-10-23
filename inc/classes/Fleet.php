<?php 

if(!defined('__CONFIG__')) {
	exit('You do not have a config file');
}

class User {

    private $con;

    public $aircraft_id;
    public $aircraft_reg;
    public $type;
    public $model;

    public function __construct() {
        $this->con = DB::getConnection();

        $user = $this->con->prepare("SELECT * FROM fleet");
        $user->execute();

        if($user->rowCount() == 1) {
            $user = $user->fetch(PDO::FETCH_OBJ);

            $this->aircraft_id = (string) $user->email;
            $this->user_id = (int) $user->user_id;
            $this->reg_time = (string) $user->reg_time;

        } else {
            //no user, redirect to logout
            header("Location: logout.php");
            exit;
        }   
    }
}

?>