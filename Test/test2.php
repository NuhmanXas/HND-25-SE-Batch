<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "hnd_se_25";

$conn = mysqli_connect($server, $username, $password, $database);

print_r($conn);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>