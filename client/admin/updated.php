   <?php
    session_start();
    include('connect.php');
	$x = $_POST['mid'];
	extract($_POST);
	{
   mysqli_query($bd,"update user1 set name='$name',designation='$designation',em='$email',mobile='$mobile',password='$password' where id='$x'");
	}
	?>
	<script>         
	alert("Designer Profile is updated successfully.");
	window.location="allmemberd.php";
   </script>
	