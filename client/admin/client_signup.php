   <?php
	//session_start();
	include('connect.php');

	extract($_POST);

	$rq = mysqli_query($bd, "SELECT userid as mxid FROM user order by userid desc");
	$roww = mysqli_fetch_assoc($rq);
	$sss = $roww['mxid'];
	$id = "BRC" . $sss;
	$tdate = date("d-M-Y");


	$rqc = mysqli_query($bd, "SELECT count(*) as cnt FROM user where user_id='$user_id'");
	$rowwc = mysqli_fetch_assoc($rqc);
	$sssc = $rowwc['cnt'];
	if ($sssc < 1) {
		if (mysqli_query($bd, "INSERT INTO user(id,name,user_id,mobile,labname,occlusion,password,status,todaydate,anatomy,pontic,remark,contact,acpinid,pic) VALUES('$id','$name','$user_id','$mobile','$labname','$occlusion','" . md5($pass_w) . "','active','$tdate','$anatomy','$pontic','$remark','$contact','0','')")) {

	?>
   		<script>
   			alert('Client is registered successfully  with SKYDENT PRIVATE LIMITED.Your Login ID is <?php echo $user_id ?> and Default Password is 12345 . You can change your password after the login.');
   			window.location = "new_client.php";
   		</script>
   <?php
		} else {
			echo mysqli_error($bd);
			die;
		}
	} else {
		echo "<script>alert('This email ( $user_id ) is already registered.')</script>";
	}
	?>