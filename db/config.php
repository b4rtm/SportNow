<?php
$servername = "localhost";
$port = 3307;
$dbname = "facilityrezervations";
$username = "root";
$password = "";

$conn = new PDO("mysql:host=$servername;dbname=$dbname;port=$port", $username, $password);
?>