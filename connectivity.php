<?php
$server = 'database';
$database= 'lamp';
$user = 'lamp';
$password = 'lamp';


$conn = new mysqli($server, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    else{
        echo "Connected successfully";
    }
?>