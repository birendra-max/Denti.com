<?php
include 'connect.php';
$pid=$_GET['pid'];
$filepid=$_GET['filepid'];
$type=$_GET['type'];
$tdate=date("d-M-Y h:i:sa");
if ($type=="finished") {
	mysqli_query($bd,"UPDATE orders_finished set backup_status='1',b_date='$tdate' where id=$pid");
}else
{
	mysqli_query($bd,"UPDATE orders set backup_status='1',b_date='$tdate' where id=$pid");
}
?>
<!-- <a href="<?php echo $filepid?>"></a> -->
<script type="text/javascript">
  document.location.href = '<?php echo $filepid?>'; </script>
