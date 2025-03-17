   <?php
    session_start();
    include('connect.php');
	$x = $_SESSION['id'];
	extract($_POST);
	{
    mysqli_query($bd,"update user set name='$name',fathername='$fathername',em='$email',address='$address',dob='$dob',mobile='$mobile',panno='$panno',nominee='$nominee',nrelation='$nrelation',city='$city',state='$state',aadhar='$aadhar',pin='$pin' where id='$x'");
	}
	?>
	<script>         
	alert("Your Profile is updated successfully.");
	window.location="profile.php";
</script>
	