<?php
include 'connect.php';
$idd=$_GET['q'];
$id=explode(",",$idd);
$edate=$id[0];
$sdate=$id[1];
echo $sdate=date("m/d/Y",strtotime($sdate));
echo $edate=date("m/d/Y",strtotime($edate));

      $diff = abs(strtotime($edate) - strtotime($sdate));               
      // To get the year divide the resultant date into 
      // total seconds in a year (365*60*60*24) 
      $nodays = floor($diff / (60*60*24));  
      //echo $nodays;
if ($nodays>=27 AND $nodays<32) {
	$tdate=date("m/d/Y");
	// total count no of user this month
	$rr=mysqli_query($bd,"SELECT count(*) as cnn FROM user WHERE str_to_date('$sdate','%m/%d/%Y')<=str_to_date(todaydate,'%m/%d/%Y') AND str_to_date('$edate','%m/%d/%Y')>=str_to_date(todaydate,'%m/%d/%Y') AND acpinid!='0'");
	$row=mysqli_fetch_assoc($rr);
	$nouser=$row['cnn'];
	echo "No of User" .$nouser."<br>";


	$rr1=mysqli_query($bd,"SELECT * FROM user WHERE str_to_date('$sdate','%m/%d/%Y')<=str_to_date(todaydate,'%m/%d/%Y') AND str_to_date('$edate','%m/%d/%Y')>=str_to_date(todaydate,'%m/%d/%Y') AND counting>=2");
	

	$rr2=mysqli_query($bd,"SELECT * FROM smartincome WHERE str_to_date('$sdate','%m/%d%/Y')=str_to_date(sdate,'%m/%d/%Y') AND str_to_date('$edate','%m/%d/%Y')=str_to_date(sdate,'%m/%d/%Y')");

	if (mysqli_num_rows($rr2)>0) {
	echo "<h1 class='alert alert-danger'>Sorry you have already generated smart income of this month.</h1>";
		}else
		{
			echo "have 2 direct no of ".mysqli_num_rows($rr1)."<br>";

	if (mysqli_num_rows($rr1)>0) {
		
	while($row1=mysqli_fetch_assoc($rr1))
	{
		if ($row1['pleft']>=25 AND $row1['pright']>=25) {
			$t1=$tot=(100*$nouser)/mysqli_num_rows($rr1);
				$tot=(($tot*40)/100);
				$t1=$t1-$tot;
		mysqli_query($bd,"INSERT INTO smartincome2(mid,amount,sdate,edate,todaydate)VALUES('$row1[id]','$t1','$sdate','$edate','$tdate')");	
		}else
		{
			if ($row1['pleft']>=5 AND $row1['pright']>=5) 
			{
				$t1=$tot=(50*$nouser)/mysqli_num_rows($rr1);
				$tot=(($tot*40)/100);
				$t1=$t1-$tot;
				echo "pass value".$t1;
				mysqli_query($bd,"INSERT INTO smartincome(mid,amount,sdate,edate,todaydate)VALUES('$row1[id]','$t1','$sdate','$edate','$tdate')");	
			}
			

		}
		
	}
	}else
	{
		mysqli_query($bd,"INSERT INTO smartincome(mid,amount,sdate,edate,todaydate)VALUES('0','0','$sdate','$edate','$tdate')");
	}
	}
	echo "<h1 class='alert alert-success'>You have generated smart income successfully.</h1>";

}else
{
	echo "<h1 class='alert alert-danger'>Sorry you have selected date range is wrong.Select minimum one month.</h1>";
}

?>


 <div class="card-body">
 							<hr>
			              	<h2 class="text-center"><b>Your Smart Income First List</b></h2>
			              	<hr>
			              	
                        <div class="table table-responsive">
			              <table class="table table-bordered table-striped" style="zoom:70% !important">
			              	  <thead>
						          <th>S.N</th>    
						          <th>MID</th>      						          
						          <th>Amount</th>
						          <th>S.Date</th>
						          <th>E.Date</th>
						          <th>Calculate Date</th>						          
						        </thead>
						        <tbody>
						          <?php		
						          $co=1;				          
						          $rr=mysqli_query($bd,"SELECT * FROM smartincome");

						          while ($row=mysqli_fetch_assoc($rr)) {          
						          ?>
						          <tr>
						            <td><?php echo $co++?></td>
						            <td><?php echo $row['mid']?></td>						            
						            <td><?php echo $row['amount']?></td> 
						            <td><?php echo date("d-M-Y",strtotime($row['sdate']))?></td> 
						            <td><?php echo date("d-M-Y",strtotime($row['edate']))?></td> 
						            <td><?php echo date("d-M-Y",strtotime($row['todaydate']))?></td> 						            
						          </tr>
						          <?php						          
						            }
						          ?>
						        </tbody>
			              	
			              </table>
                        </div>

<hr>
			              	<h2 class="text-center"><b>Your Smart Income Second List</b></h2>
			              	<hr>
			              	
                        <div class="table table-responsive">
			              <table class="table table-bordered table-striped" style="zoom:70% !important">
			              	  <thead>
						          <th>S.N</th>    
						          <th>MID</th>      						          
						          <th>Amount</th>
						          <th>S.Date</th>
						          <th>E.Date</th>
						          <th>Calculate Date</th>						          
						        </thead>
						        <tbody>
						          <?php						          
						          $co=1;
						          $rr=mysqli_query($bd,"SELECT * FROM smartincome2");

						          while ($row=mysqli_fetch_assoc($rr)) {          
						          ?>
						          <tr>
						            <td><?php echo $co++?></td>
						            <td><?php echo $row['mid']?></td>						            
						            <td><?php echo $row['amount']?></td> 
						            <td><?php echo date("d-M-Y",strtotime($row['sdate']))?></td> 
						            <td><?php echo date("d-M-Y",strtotime($row['edate']))?></td> 
						            <td><?php echo date("d-M-Y",strtotime($row['todaydate']))?></td> 						            
						          </tr>
						          <?php						          
						            }
						          ?>
						        </tbody>
			              	
			              </table>

                            </div>
			                
						 </div>