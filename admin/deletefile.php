<?php

include 'connect.php';

 function delTree($dir)
    { 
        $files = array_diff(scandir($dir), array('.', '..')); 

        foreach ($files as $file) { 
            (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
        }

        return rmdir($dir); 
    }

$pid=$_GET['pid'];
$filepid=trim($_GET['filepid']);
$type=$_GET['type'];
$tdate=date("d-M-Y h:i:sa");
if ($type=="finished") {
			$sql23="SELECT * FROM orders_finished where id=$pid";
          $res23=mysqli_query($bd,$sql23);
          
          $row23=mysqli_fetch_array($res23);
          if(file_exists($filepid))
          {
			mysqli_query($bd,"UPDATE orders_finished set delete_status='1',d_date='$tdate' where id=$pid");
			delTree(substr($filepid,0,strlen($filepid)-4));
			echo "wait..";
			unlink($filepid);
		 }else
		 {
		 	echo "<h3>The Without backup can not be delete the finished file.</h3>";
		 }
}else
{
	$sql23="SELECT * FROM orders where id=$pid";
          $res23=mysqli_query($bd,$sql23);
          
          $row23=mysqli_fetch_array($res23);
          if(file_exists($filepid))
          {
				mysqli_query($bd,"UPDATE orders set delete_status='1',d_date='$tdate' where id=$pid");
				delTree(substr($filepid,0,strlen($filepid)-4));
				echo "wait..";
				if(unlink($filepid))
					echo "file is deleting.......";
	 		}else
		 {
		 	echo "<h3>The Without backup can not be delete the initial file.</h3>";
		 }
}
?>
