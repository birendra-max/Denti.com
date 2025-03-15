<?php
include 'connect.php';
include 'testmail.php';

if (isset($_POST['submit2'])) {
	$tdate=date("d-M-Y h:i:sa");
	$orderid=$_POST['redesignorderid'];
	$linkurl=$_POST['linkurl'];
	$em=$_SESSION['email'];
	$status=$_POST['status'];
	$msg=$_POST['msg'];
	
		$sqlem="SELECT * FROM user where em='$em'";
$res_sqlem=mysqli_query($bd,$sqlem);
$row_sqlem=mysqli_fetch_array($res_sqlem);


	$sql="UPDATE orders set status='New', tduration='$status' where orderid='$orderid'";
	$sql2="INSERT INTO chatbox (orderid,msg,user_type,created_at,attachment,userid,filename) VALUES('$orderid','$msg','user','$tdate','','$em','')";
	mysqli_query($bd,$sql2);

	      $to = 'skydent@skydentdesigns.com';

      $subject = $row_sqlem['labname'].' Redesign Case :'.$orderid;

      $headers  = "From: " . strip_tags("skydent@skydentdesigns.com") . "\r\n";
      $headers .= "Reply-To: " . strip_tags("skydent@skydentdesigns.com") . "\r\n";
      $headers .= "CC: skydent@skydentdesigns.com\r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

      $message = '<p><strong>You have recieve the redesign case. Orderid : '. $orderid .'</strong> </p>';
	  sendEmail($email, $subject, $message);

      //mail($to, $subject, $message, $headers);

	if (mysqli_query($bd,$sql)) {
		echo "<script> alert('$orderid is updated successfully.');window.location='$linkurl'</script>";
	}
	else
	{
		echo "<script>   alert('Selected case of status can not be change. Plese try after sometime.');window.location='$linkurl'</script>";
	}
}

?>