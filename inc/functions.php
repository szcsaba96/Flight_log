<?php

function FindInstructor( $first_name, $last_name ) {
    $con = DB::getConnection();

    $email = (string) Filter::string( $email );

    $findUser = $con->prepare("SELECT first_name, last_name FROM users WHERE first_name = :first_name, last_name = :last_name");
    $findUser->bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $findUser->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $findUser->execute();
    
    if($return_assoc) {
        return $findUser->fetch(PDO::FETCH_ASSOC);
    }
    
    $user_found = (boolean) $findUser->rowCount();
    return $user_found;
}

function addTime($time1, $time2) {

    list($hours, $minutes) = explode(':', $time1, 2);
    $total = $minutes * 60 + $hours * 3600;
  
    // Explode by seperator : 
    $temp = explode(":", $time2); 
      
    // Convert the hours into seconds 
    // and add to total 
    $total+= (int) $temp[0] * 3600; 
      
    // Convert the minutes to seconds 
    // and add to total 
    $total+= (int) $temp[1] * 60; 
  
    // Format the seconds back into HH:MM:SS 
    $formatted = sprintf('%02d:%02d',  
                    ($total / 3600), 
                    ($total / 60 % 60) ); 
    
    return $formatted;  
}
?>