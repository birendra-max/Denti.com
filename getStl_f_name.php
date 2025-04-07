<?php
session_start();
include 'connect.php';

if (isset($_POST['orderid'])) {
    $orderid = $_POST['orderid'];
    $query = "SELECT * FROM orders_stl_files where orderid='$orderid'";
    $res = mysqli_query($bd, $query);
    if (mysqli_num_rows($res) > 0) {
        while ($r = mysqli_fetch_assoc($res)) {
            echo $r['filename'];
        }
    } else {
        echo '';
    }
}
