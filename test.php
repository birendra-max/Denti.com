<?php

$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "skydent_database";
$prefix = "";

// Try to connect to the database
$bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);

// Check if the connection was successful
if (!$bd) {
    die("Could not connect to the database: " . mysqli_connect_error());
} else {
    echo "Connected to the database successfully!";
}

?>