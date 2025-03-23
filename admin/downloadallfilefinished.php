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
                          if (strtotime($sdate)<=strtotime(date("d-M-Y",strtotime($row["created_at"]))) and strtotime(date("d-M-Y",strtotime($row["created_at"]))) <=strtotime($edate)) {
                            $ordid=$row['orderid'];
                            $sql2="SELECT * FROM orders_finished where orderid='$ordid'";
                        $res2=mysqli_query($bd,$sql2);
                        $row2=mysqli_fetch_array($res2);
                          	$pid2=$row2['id'];
                          	$filepid2="../api/finished_files/".$row2['finished_file'];
                          if(file_exists($filepid2))
                          	{
                            ?>
						
						
                <script>window.open('<?php echo $filepid2 ?>')</script>

              <?php
                        	mysqli_query($bd,"UPDATE orders_finished set backup_status='1',b_date='$tdate' where id=$pid2");
                          }
                      }
                      
                    }
         echo "Wait for few movement............";
        }

?>
