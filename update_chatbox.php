<?php
include 'connect.php';
if (!empty($_POST['orderid_id']) && !empty($_POST['message_id'])) {
	$tdate=date("d-M-Y h:i:sa");
	$em=$_SESSION['user_id'];
	$orderid=$_POST['orderid_id'];
	$fname2="";
	$msg=mysqli_real_escape_string($bd,$_POST['message_id']);
	if (false) {
		$imagePath = 'api/chatbox/';
		$uniquesavename=time().uniqid(rand());
		$ext=strtolower(pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION));
		$fname=$uniquesavename.".". $ext;
		$destFile = $imagePath . $uniquesavename.".". $ext;
		$filename = $_FILES["file"]["tmp_name"];
		$fname2 = $_FILES["file"]["name"];
		//list($width, $height) = getimagesize( $filename );       
		move_uploaded_file($filename,  $destFile);
		$sql2="INSERT INTO chatbox (orderid,msg,user_type,created_at,attachment,userid,filename) VALUES('$orderid','$msg','user','$tdate','$fname','$em','$fname2')";
	mysqli_query($bd,$sql2);
	echo $msg."____".$tdate."____".$fname;
	}else
	{
		$sql2="INSERT INTO chatbox (orderid,msg,user_type,created_at,attachment,userid,filename) VALUES('$orderid','$msg','user','$tdate','','$em','$fname2')";
	mysqli_query($bd,$sql2);
	echo $msg."____".$tdate."____";
	}
	
}
?>
