<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "gym_db"; // Make sure this DB exists in MySQL

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
