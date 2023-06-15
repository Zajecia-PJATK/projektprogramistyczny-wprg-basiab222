<?php
$dbHost = "szuflandia.pjwstk.edu.pl";
$dbUser = "s27263";
$dbPass = "Bar.Bara";
$dbName = "s27263";

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
