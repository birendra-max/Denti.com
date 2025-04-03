<?php

include('connect.php');

$data = json_decode($_POST['data'], true);
$status = $data['status'];
$id = $data['id'];
$sql = "UPDATE user SET acpinid='$status' WHERE id='$id'";

if (mysqli_query($bd, $sql)) {
    echo "success";
} else {
    echo "error";
}
