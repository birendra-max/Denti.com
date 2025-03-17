<?php
include 'connect.php';
include 'testmail.php';

$response = ["status" => "error", "message" => "Something went wrong."];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $total_files = $_POST['total_files'] ?? 0;
    $timeduration = $_POST['timeduration'] ?? '';
    $success = true;
    $foid = "";

    for ($i = 0; $i < $total_files; $i++) {
        $orderId = $_POST["orderid"][$i];
        $unit = $_POST["unit"][$i];
        $tooth = $_POST["tooth"][$i];
        $message = $_POST["msg"][$i];

        if ($foid == "") {
            $foid = $orderId;
        }

        $checkQuery = "SELECT * FROM orders WHERE orderid = '$orderId'";
        $checkResult = mysqli_query($bd, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            $updateQuery = "UPDATE orders SET unit = '$unit', tooth = '$tooth', message = '$message', tduration = '$timeduration' WHERE orderid = '$orderId'";
            if (!mysqli_query($bd, $updateQuery)) {
                $success = false;
            }
        } else {
            $insertQuery = "INSERT INTO orders (orderid, unit, tooth, message, tduration) VALUES ('$orderId', '$unit', '$tooth', '$message', '$timeduration')";
            if (!mysqli_query($bd, $insertQuery)) {
                $success = false;
            }
        }
    }

    $loid = $foid + ($total_files - 1);

    if ($timeduration == 'Rush') {
        $to = 'bravodent@bravodentdesigns.com';
        $em = $_SESSION['user_id'];
        $resulth = mysqli_query($bd, "SELECT * FROM user WHERE em='$em'");
        $rowh = mysqli_fetch_array($resulth);
        $cname = $rowh['name'];
        $subject = ' Name (' . $_SESSION['labname'] . ') (' . ($total_files) . ') RUSH Order Received: (' . $foid . '-' . $loid . ')';

        $headers  = "From: bravodent@bravodentdesigns.com\r\n";
        $headers .= "Reply-To: bravodent@bravodentdesigns.com\r\n";
        $headers .= "CC: bravodent@bravodentdesigns.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        $message = '<p><strong>You have received <b>NEW RUSH</b> order ID (' . $foid . '-' . $loid . ') Total ' . ($total_files) . '</strong></p>';

        sendEmail($to, $subject, $message);
    }

    if ($success) {
        $response = ["status" => "success", "message" => "Records updated successfully!"];
    } else {
        $response = ["status" => "error", "message" => "Failed to update records."];
    }
}

echo json_encode($response);
