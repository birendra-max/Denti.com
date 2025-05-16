   <?php
	//session_start();
	include('connect.php');

	extract($_POST);

	$rq = mysqli_query($bd, "SELECT userid as mxid FROM user order by userid desc");
	$roww = mysqli_fetch_assoc($rq);

	$q = mysqli_query($bd, "SELECT id_end FROM user WHERE id = (SELECT MAX(id) FROM user);");
	$id_end = mysqli_fetch_assoc($q);

	$range_size = 900000;

	if ($id_end) {
		// Find the next base starting from the previous end + 1, aligned to 10 lakh blocks
		$base = ceil(($id_end['id_end'] + 1) / 1000000) * 1000000;
		$i_start = $base;
	} else {
		$i_start = 100000; // First user starts at 1 lakh
	}

	$i_end = $i_start + $range_size - 1;


	$sss = $roww['mxid'];
	$id = "BRC" . $sss;
	$tdate = date("d-M-Y");

	$rqc = mysqli_query($bd, "SELECT count(*) as cnt FROM user where user_id='$user_id'");
	$rowwc = mysqli_fetch_assoc($rqc);
	$sssc = $rowwc['cnt'];
	if ($sssc < 1) {
		if (mysqli_query($bd, "INSERT INTO user(id,name,user_id,id_start,id_end,mobile,labname,occlusion,password,status,todaydate,anatomy,pontic,remark,contact,acpinid,pic) VALUES('$id','$name','$user_id','$i_start','$i_end','$mobile','$labname','$occlusion','" . $pass_w . "','active','$tdate','$anatomy','$pontic','$remark','$contact','1','')")) {

	?>
   		<script>
   			alert('Client is registered successfully  with SKYDENT PRIVATE LIMITED.Your Login ID is <?php echo $user_id ?> and the Password is <?php echo $pass_w; ?> . You can change your password after the login.');
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