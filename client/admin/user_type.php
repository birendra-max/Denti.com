<?php
include 'connect.php';
	
	if (isset($_POST['user_type'])) {
		
		$user_type=$_POST['user_type'];
		if ($user_type=='client') 
			$r="SELECT * FROM user where acpinid='1'";	
        else
        	$r="SELECT * FROM user1 where acpinid='1'";	
		
		$res=mysqli_query($bd,$r);
		$ht="";
		while ($row=mysqli_fetch_assoc($res)) {
			$ht=$ht."<option>".$row['em']."</option>";
		}
		echo $ht;
	}
?>
