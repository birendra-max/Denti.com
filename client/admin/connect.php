<?php
session_start();
//error_reporting(E_ERROR | E_PARSE);

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "skydent_database";
    $prefix = "";
    
    $bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password,$mysql_database) or die("Could not connect database");
    if (!$bd) {
    die("Connection failed: " . mysqli_connect_error());
    $noof=0;
}
    mysqli_query($bd, "SET SESSION sql_mode = 'TRADITIONAL'");

    
    ?>