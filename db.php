<?php
$db_host = 'localhost:3310'; 
$db_user = 'root'; 
$db_password = ''; 
$db_name = 'studentmanagement'; 

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
