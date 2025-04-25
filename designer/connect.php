<?php
session_start();
date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "Dentigo_lab";

// $mysql_hostname = "database-1.ckd26egemssz.us-east-1.rds.amazonaws.com";
// $mysql_user = "DentigoU1";
// $mysql_password = "DentiGo#WelCome#2021";
// $mysql_database = "dentigo_db";

$prefix = "";

$bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database) or die("Could not connect database");
if (!$bd) {
    die("Connection failed: " . mysqli_connect_error());
    $noof = 0;
}


// mysqli_query($bd, "SET SESSION sql_mode = 'TRADITIONAL'");
