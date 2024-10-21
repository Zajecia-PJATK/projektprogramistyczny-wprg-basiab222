<?php
$dbHost = "szuflandia.pjwstk.edu.pl";
$dbUser = "";
$dbPass = "";
$dbName = "s27263";

//$dbHost = "127.0.0.1";
//$dbUser = "root";
//$dbPass = "";
//$dbName = "Projekt_wprg";

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
