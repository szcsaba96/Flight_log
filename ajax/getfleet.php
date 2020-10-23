<?php

if(isset($_GET['type'])) {
    $type = $_GET['type'];

    if( $type == 'all') {
        $sql= "SELECT * FROM fleet";
    } else {
        $sql= "SELECT * FROM fleet WHERE ( type = '".$type."')";  
    }     
}

if(isset($_GET['reg_number'])) {
    $reg_number = $_GET['reg_number'];

    $sql = "SELECT * FROM fleet WHERE aircraft_reg = '".$reg_number."' ";
}

$con = mysqli_connect('localhost','root','','flight_log');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"flight_log");
$result = mysqli_query($con,$sql);

echo "<link rel='stylesheet' href='css/style_fleet.css'>";

echo "<table class='fly_table' style='margin-left: 15%;'>
<tr>
  <th>Registration number</th>
  <th>Manufacturer</th>
  <th>Model</th>
  <th>Short name</th>
  <th>Type of aircraft</th>
</tr>";

$counter = 0;
while($row = mysqli_fetch_array($result) ) {
  
  $remainder = $counter % 2;
  if($remainder == 0){
    //echo $number . ' is even!';
    echo "<tr class='tbody_row even'>"; 
} else {
  echo "<tr class='tbody_row' >"; 
}
     $counter++;

    echo "<td>" . $row['aircraft_reg'] . "</td>";
    echo "<td>" . $row['manufacturer'] . "</td>";
    echo "<td>" . $row['model'] . "</td>";
    echo "<td>" . $row['short_name'] . "</td>";
    echo "<td>" . $row['type'] . "</td>";
  echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>