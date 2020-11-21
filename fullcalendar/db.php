<?php
$conn = mysqli_connect("localhost","root","","flight_log") ;

if (!$conn)
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>