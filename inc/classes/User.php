<?php 

if(!defined('__CONFIG__')) {
	exit('You do not have a config file');
}

class User {

    private $con;

    public $user_id;
    private $email;
    private $reg_time;
    private $first_name;
    private $last_name;
    private $mobile;
    private $birth;
    private $address;

    public function __construct(int $user_id) {
        $this->con = DB::getConnection();

        $user_id = Filter::Int( $user_id );

        $user = $this->con->prepare("SELECT user_id, email, reg_time, first_name, last_name, tel_number, birthday, address, email FROM users WHERE user_id = :user_id LIMIT 1");
        $user->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $user->execute();

        if($user->rowCount() == 1) {
            $user = $user->fetch(PDO::FETCH_OBJ);

            $this->email = (string) $user->email;
            $this->user_id = (int) $user->user_id;
            $this->reg_time = (string) $user->reg_time;
            $this->first_name = (string) $user->first_name;
            $this->last_name = (string) $user->last_name;
            $this->mobile = (string) $user->tel_number;
            $this->birth = (string) $user->birthday;
            $this->address = (string) $user->address;

        } else {
            //no user, redirect to logout
            header("Location: logout.php");
            exit;
        }   
    }

    public function getUserId() {
        return $this->$user_id;
    }

    public function getName() {

    $full_name = $this->first_name . " " . $this->last_name;

    return $full_name;

    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function getMobile() {
        return $this->mobile;
    }

    public function getBirth() {
        return $this->birth;
    }

    public function getAddress(){
        return $this->address;
    }

    public function getEmail() {
        return $this->email;
    }

    public static function Find( $email, $return_assoc = false) {

        $con = DB::getConnection();

        $email = (string) Filter::string( $email );
    
        $findUser = $con->prepare("SELECT user_id, password FROM users WHERE email = LOWER(:email) LIMIT 1");
        $findUser->bindParam(':email', $email, PDO::PARAM_STR);
        $findUser->execute();
        
        if($return_assoc) {
            return $findUser->fetch(PDO::FETCH_ASSOC);
        }
        
        $user_found = (boolean) $findUser->rowCount();
        return $user_found;
    }

    public static function lastFlight($user_id, $type) {

    $con = DB::getConnection();

    $getlastDate = $con -> prepare("SELECT max(flight_date) FROM flights, fleet WHERE (flights.user_id = :user_id AND flights.fleet_id = fleet.aircraft_id AND fleet.type = '".$type."')");
    $getlastDate ->bindParam(':user_id', $user_id, PDO::PARAM_STR);
    $getlastDate -> execute();

    $getlastDate = $getlastDate->fetch(PDO::FETCH_ASSOC);

    return $getlastDate['max(flight_date)'];
    }

    public static function totalHours($user_id, $type) {

        $con = DB::getConnection();
    
        $totalHours = $con -> prepare("SELECT ".$type." FROM experience WHERE user_id = :user_id");
        $totalHours ->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $totalHours -> execute();
    
        $totalHours = $totalHours->fetch(PDO::FETCH_ASSOC);

        $pieces = explode(':', $totalHours[$type]);

    
        return $pieces[0]."h ".$pieces[1]."'";
    }
}

?>