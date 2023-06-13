<?php
$dbHost = "sftp://szuflandia.pjwstk.edu.pl";
$dbUser = "s27263";
$dbPass = "Bar.Bara";
$dbName = "s27263";
$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
