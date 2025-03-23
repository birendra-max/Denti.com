<?php
include 'connect.php';
        if (isset($_GET['edate']) and isset($_GET['sdate'])) {
        
					$edate=$_GET['edate'];
					$sdate=$_GET['sdate'];
					$tdate=date('d-M-Y');
					$tdateu=date('d-M-Y h:i:sa');
                       if (isset($_GET['labname']) and $_GET['labname']!="all") 
                       $sql="SELECT * FROM orders where labname='$_GET[labname]'";
                   else
                         $sql="SELECT * FROM orders";
                        $res=mysqli_query($bd,$sql);
                        while($row=mysqli_fetch_array($res))
                        {
                            // echo "hello";
                          if (strtotime($sdate)<=strtotime(date("d-M-Y",strtotime($row["created_at"]))) and strtotime(date("d-M-Y",strtotime($row["created_at"]))) <=strtotime($edate)) {
                              //echo "hello";die;
                          	$pid=$row['id'];
                          	$filepid="../api/files/".$row['filename'];
                          	if(file_exists($filepid))
                          	{
                            ?>
                            
                            <script>window.open('<?php echo $filepid ?>')</script>
                            <?php
                            
                          	mysqli_query($bd,"UPDATE orders set backup_status='1',b_date='$tdateu' where id=$pid");
                          	}
                          }
                      }
        }

?>
