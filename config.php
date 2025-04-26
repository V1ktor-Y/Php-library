<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "alexandria";

if (!$dbConn = mysqli_connect($serverName, $userName, $password, $dbName)) {
    die("Could not connect to db<br>" . mysqli_connect_error());
}
if (!mysqli_select_db($dbConn, $dbName)) {
    die("Could not select db<br>" . mysqli_connect_error());
}