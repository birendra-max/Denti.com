<?php
include 'connect.php';
$mid=$_GET['q'];
$rr=mysqli_query($bd,"SELECT * FROM user WHERE id='$mid'");
$row=mysqli_fetch_assoc($rr);
if ($row['name']=="") {
echo "<p class='bnt btn-danger'>name not found member id is wrong try again.<p>";
}else
{
?>
<input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $row['name'] ?>" readonly>
<?php
}
?>