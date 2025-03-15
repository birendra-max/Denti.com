<?php
session_start();
include 'connect.php';

if (isset($_POST['fileName'])) {
    $fileName = $_POST['fileName'];
    $query = "SELECT * FROM orders WHERE fname = '$fileName' and user_id = '$_SESSION[user_id]'";
    $result = mysqli_query($bd, $query);

    if (mysqli_num_rows($result) > 0) {
        echo 'exists';
    } else {
        echo 'not_exists';
    }
}
