<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "pdv_systeme";
$db_connect = mysqli_connect($serverName, $userName, $password, $dbName);
if (!$db_connect) {
    die("Error" . mysqli_connect_error());
}
