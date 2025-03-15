   <?php
	include('connect.php');
	$x = $_POST['mid'];
	extract($_POST); {
		mysqli_query($bd, "update user set name='$name',designation='$designation',em='$email',mobile='$mobile',labname='$labname',contact='$contact',occlusion='$occlusion',anatomy='$anatomy',pontic='$pontic',remark='$remark',password='" . md5($password) . "' where id='$x'");
	}
	?>
   <script>
   	alert("Client Profile is updated successfully.");
   	window.location = "allmember.php";
   </script>