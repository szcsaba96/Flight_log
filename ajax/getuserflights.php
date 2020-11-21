<?php

//allow the config
define('__CONFIG__', true);
//require the config
require_once "../inc/config.php"; 

$from = $_GET['from'];
$to = $_GET['to'];
$type = $_GET['type'];

$user_id = (int) $_SESSION['user_id'];

$con = mysqli_connect('localhost','root','','flight_log');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"flight_log");
$sql= "SELECT f.*, fl.aircraft_reg FROM flights f
        JOIN fleet fl ON f.fleet_id = fl.aircraft_id
         WHERE ( f.user_id = '".$user_id."' AND f.flight_date BETWEEN '".$from."' AND '".$to."' AND fl.type = '".$type."' )";
$result = mysqli_query($con,$sql);

echo "<link rel='stylesheet' href='css/style_myflights.css'>";
echo "<table class='fly_table'>
<tr>
  <th>Flight date</th>
  <th>Registration number</th>
  <th>Pilot</th>
  <th>Instructor</th>
  <th>Departure place</th>
  <th>Arrival place</th>
  <th>Block off</th>
  <th>Block on</th>
  <th>Flight time</th>
  <th>Flights</th>
</tr>";

$counter = 0;
while($date = mysqli_fetch_array($result) ) {

  $remainder = $counter % 2;
  if($remainder == 0){
    //echo $number . ' is even!';
    echo "<tr class='tbody_row even' >"; 
} else {
  echo "<tr class='tbody_row' >"; 
}
    $counter++;
    echo "<td class='date'>" . $date['flight_date'] . "</td>";
    echo "<td class='reg'>" . $date['aircraft_reg'] . "</td>";
    echo "<td>" . $date['pilot'] . "</td>";
    echo "<td>" . $date['instructor'] . "</td>";
    echo "<td>" . $date['dep_place'] . "</td>";
    echo "<td>" . $date['arr_place'] . "</td>";
    echo "<td>" . $date['block_on'] . "</td>";
    echo "<td>" . $date['block_off'] . "</td>";
    echo "<td>" . $date['flight_time'] . "</td>";
    echo "<td>" . $date['flights'] . "</td>";
  echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>