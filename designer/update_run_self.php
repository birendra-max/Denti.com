<?php
include 'connect.php';
	$tdate=date("d-M-Y h:i:sa");
	$did=$_SESSION['email'];

	if (isset($_POST['orderid_update'])) {
		$tdate=date("d-M-Y h:i:sa");
		$str=explode(",", $_POST['orderid_update']);
	for($i=1;$i<count($str);$i++)
	{
		$orderid=$str[$i];
		$sql2="UPDATE orders set status='progress',did='$did',assign_date='$tdate',status_ch_date='$tdate' where orderid='$orderid'";
		mysqli_query($bd,$sql2);
	}
	echo "Cases is progress in successfully";
		
	}
	
	
	
?>
