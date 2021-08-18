<?php
// error_reporting(0);
$servername = "localhost";
$username = 'root';
$password = '';
$dbname = "digital_class";


$conn1 = new mysqli($servername, $username, $password, $dbname);


if ($conn1->connect_error) {
die("<h2>Database Connection Failure : " . $conn1->connect_error . "</h2><hr>");
} 
?>