<?php
include 'connect.php';
$idd=$_GET['q'];
$rr=mysqli_query($bd,"SELECT * FROM pin WHERE acpinid='$idd'");
$row=mysqli_fetch_assoc($rr);
if ($row['status']=="Y") {
	echo "<p class='alert alert-danger'>Sorry This pin is not available more because its used by another member for activation.</p>";
}else
{
?>
<input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $row['amount'] ?>" readonly>
<input type="hidden" id="amount" name="amount" value="<?php echo $row['amount'] ?>">
<?php
}
?>