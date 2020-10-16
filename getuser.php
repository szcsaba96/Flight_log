<?php

$from = $_GET['from'];
$to = $_GET['to'];
$type = $_GET['type'];

$con = mysqli_connect('localhost','root','','flight_log');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"flight_log");
$sql= "SELECT * FROM flights WHERE ( flight_date BETWEEN '".$from."' AND '".$to."' )";
$result = mysqli_query($con,$sql);

$sql_airc = "SELECT aircraft_reg FROM fleet WHERE type = '".$type."' AND aircraft_id in (SELECT aircraft_id FROM flights)";
$result_air = mysqli_query($con, $sql_airc);

$reg = mysqli_fetch_array($result_air);


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
while($row = mysqli_fetch_array($result) ) {
  
  $remainder = $counter % 2;
  if($remainder == 0){
    //echo $number . ' is even!';
    echo "<tr class='tbody_row even' >"; 
} else {
  echo "<tr class='tbody_row' >"; 
}
     $counter++;

    echo "<td class='date'>" . $row['flight_date'] . "</td>";
    echo "<td class='reg'>" . $reg['aircraft_reg'] . "</td>";
    echo "<td>" . $row['pilot'] . "</td>";
    echo "<td>" . $row['instructor'] . "</td>";
    echo "<td>" . $row['dep_place'] . "</td>";
    echo "<td>" . $row['arr_place'] . "</td>";
    echo "<td>" . $row['block_on'] . "</td>";
    echo "<td>" . $row['block_off'] . "</td>";
    echo "<td>" . $row['flight_time'] . "</td>";
    echo "<td>" . $row['flights'] . "</td>";
  echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>