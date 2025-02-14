<?php 


// connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym";

// create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}





?>