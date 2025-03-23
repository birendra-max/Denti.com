<?php
include 'connect.php';
$clientid=$_SESSION['email'];
 $resulth = mysqli_query($bd,"SELECT count(id) as sm FROM orders where status='New' and flag=0 and clientid='$clientid' ");
      $rowh = mysqli_fetch_array($resulth);
    echo   $orderid= $rowh['sm']; die;
 $to = 'john.bravodent@gmail.com';

      $subject = 'QSDL Order Recieved (Next Day) : $oid';

      $headers  = "From: " . strip_tags("john.bravodent@gmail.com") . "\r\n";
      $headers .= "Reply-To: " . strip_tags("john.bravodent@gmail.com") . "\r\n";
      $headers .= "CC: susan@example.com\r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

      $message = '<p><strong>You have recieve the new order. Orderid :  $oid </strong> </p>';
      mail($to, $subject, $message, $headers);
?>