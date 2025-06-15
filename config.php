<?php

$host = 'localhost';
$username = 'root';
$password = '#Harsha1234';
$database = 'savendragardendb';

// Create connection
$conn = new mysqli($host,$username, $password, $database);

if($conn->connect_error){
    die('Connection Failed:'. $conn->connect_error);
}
?>