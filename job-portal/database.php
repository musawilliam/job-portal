<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "job_portal";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong;");
}

?>