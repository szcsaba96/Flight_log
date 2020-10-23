<?php

$type = $_GET['type'];

$con = mysqli_connect('localhost','root','','flight_log');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"flight_log");
$sql= "SELECT aircraft_id, aircraft_reg FROM fleet WHERE type = '".$type."' ";
$result = mysqli_query($con,$sql);

echo "<label for='reg_number'>Registration number</label>
<select name='reg_number' id='reg_number'> 
    <option> Select Aircraft </option> ";
     while ( $row = mysqli_fetch_array($result) ) {
        echo "<option value='";
            echo $row['aircraft_id'];
            echo "' > ";
        echo $row['aircraft_reg'];
     }
        echo "</option>
            </select>"; 

mysqli_close($con);

?>

