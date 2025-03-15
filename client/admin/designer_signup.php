   <?php
    session_start();
    include('connect.php');
	
	extract($_POST);

		$rq=mysqli_query($bd,"SELECT userid as mxid FROM user1 order by userid desc");
		$roww=mysqli_fetch_assoc($rq);
		$sss=$roww['mxid'];
		$id="BRC".$sss;
		$tdate=date("d-M-Y");

		$rqc=mysqli_query($bd,"SELECT count(*) as cnt FROM user1 where em='$email'");
		$rowwc=mysqli_fetch_assoc($rqc);
		$sssc=$rowwc['cnt'];
		if($sssc<1)
		mysqli_query($bd,"INSERT INTO user1(id,name,designation,em,mobile,password,status,todaydate,acpinid) VALUES('$id','$name','$designation','$email','$mobile','12345','active','$tdate','0')");   
		else
		echo "<script>alert('This email ( $email ) is already registered.')</script>"; 
	?>
	 <script>  
	    alert('Designer is registered successfully  with SKYDENT PRIVATE LIMITED.Your Login ID is <?php echo $email ?> and Default Password is 12345 . You can change your password after the login.');
	  window.location="new_designer.php";
	</script>