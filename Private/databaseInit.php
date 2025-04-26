<?php
$servername = "localhost";
$username = "root";
$password = "";
$conn = mysqli_connect($servername, $username, $password);
if (!$conn) {
    die("Could not connect to database<br>" . mysqli_connect_error());
}

$sql = "CREATE DATABASE Alexandria";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error creating database<br>" . mysqli_error($conn));
}
echo ("Database created");

mysqli_close($conn);