<?php
include 'header.php'; 

if (isset($_POST['submit'])) {
	extract($_POST);	
	if ($r>=$w) {
		
	$tdate=date("d-M-Y");
	if (mysqli_query($bd,"INSERT INTO mpayment(mid,name,ramount,todaydate,status,note)VALUES('$x','$name','$w','$tdate','N','$note')")) {
			echo "<script>alert('Your request has been sent')</script>";
		}	else
		{
			echo "<script>alert('Sorry something went wrong.')</script>";
		}

	}else
	{
		echo "<script>alert('Insufficient Balance.')</script>";
	}
}
                        $resulth = mysqli_query($bd,"SELECT sum(amount) as sm FROM directincome WHERE mid='$x'");
                        $rowh = mysqli_fetch_array($resulth);
                        echo $a1=$k1=$rowh['sm'];  

                         $result = mysqli_query($bd,"SELECT sum(amount) as sm FROM pincome where mid='$x'");
    $row = mysqli_fetch_array($result);
     echo $a2=$k2=$row['sm']; 

      $result = mysqli_query($bd,"SELECT sum(amount) as minc FROM llincome where mid='$x'");
    while($row = mysqli_fetch_array($result)) {  echo $a3=$k3=$row['minc'];  }

      $result = mysqli_query($bd,"SELECT sum(amount) as minc FROM smartincome where mid='$x'");
                  while($row = mysqli_fetch_array($result)) {  echo $a4=$k3=$row['minc'];  }

                     $result = mysqli_query($bd,"SELECT sum(amount) as minc FROM smartincome2 where mid='$x'");
                  while($row = mysqli_fetch_array($result)) {  echo $a5=$k3=$row['minc'];  }

                    $result = mysqli_query($bd,"SELECT sum(amount) as sm FROM reward where mid='$x'");
    $row = mysqli_fetch_array($result);
     echo $a6=$k2=$row['sm']; 

       $result = mysqli_query($bd,"SELECT sum(amount) as sm FROM autopooluser where mid='$x'");
              $row = mysqli_fetch_array($result);
              echo $a7=$row['sm']; 
               $all=$a1+$a2+$a3+$a4+$a5+$a6+$a7;
?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Request For Payout</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Request For Payout</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

			    <section class="content">
			      <div class="container-fluid">
			        <div class="row">
			          <div class="col-12">
			            <div class="card">
			              <div class="card-header">
			                <h3 class="card-title">Request For Payout</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<h2 class="text-center"><b>Request For Payout</b></h2>
			              	<hr>
			              	<form action="" method="post">
			              	<div class="row">
			              		<div class="col-sm-4">
			              			<div class="form-group">
			              				<label>ID</label>	
			              				<input type="text" class="form-control" value="<?php echo $rowp['id'] ?>" readonly>		              							              				
			              			</div>			              			
			              		</div>			              		
			              		<div class="col-sm-4">
			              			<div class="form-group">
			              				<label>Name</label>	
			              				<input type="text" class="form-control" value="<?php echo $rowp['name'] ?>" readonly>		              				
			              				<input type="hidden" name="name" value="<?php echo $rowp['name']  ?>">
			              			</div>			              			
			              		</div>			              		
			              		<div class="col-sm-4">
			              			<div class="form-group">
			              				<?php
			              		
			              				$aa=$r=$all;
			              				$r=($r*10/100);
			              				$r=$aa-$r;
			              				


			              				?>
			              				<label>Wallet Amount</label>		
			              				<input type="text" class="form-control" value="<?php echo $r ?>" readonly>
			              			</div>			              			
			              		</div>			              		
			              	</div>

			              	<div class="row">
			              		<div class="col-sm-4">
			              			<div class="form-group">
			              				<label>Available Balance</label>
			              				<?php
			              				$rr=mysqli_query($bd,"SELECT SUM(ramount) as rm FROM mpayment2 WHERE mid='$x'");
			              				$row=mysqli_fetch_assoc($rr);
			              				$amnt=$row['rm'];
			              				$aa=$r=$all-$amnt;
			              				$r=($r*10/100);
			              				$r=$aa-$r;



			              				?>
			              				<input type="text" class="form-control" value="<?php echo $r ?>" readonly>			              				
			              				<input type="hidden" name="r" class="form-control" value="<?php echo $r ?>">			              				
			              			</div>			              			
			              		</div>			              		
			              		<div class="col-sm-4">
			              			<div class="form-group">
			              				<label>Withdraw </label>	
			              				<input type="text" name="w" class="form-control">		              				
			              			</div>			              			
			              		</div>			              		
			              		<div class="col-sm-4">
			              			<div class="form-group">
			              				<label>Note</label>
			              				<input type="text" name="note" class="form-control">		              							              				
			              			</div>			              			
			              		</div>			              		
			              	</div>
			              	<div class="row">
			              		<div class="col-sm-4">
			              					              			
			              		</div>			              		
			              		<div class="col-sm-4">
			              			<div class="form-group">
			              				<input type="submit" name="submit" value="Submit" class="btn btn-success">	              				
			              			</div>			              			
			              		</div>			              					              				              		
			              	</div>
			              	</form>
			              	

			              	<hr>
			              	<h3>Request Amount History</h3>
			              	<hr>
			              	 <div class="table table-responsive">
			              <table class="table table-bordered table-striped" style="zoom:70% !important">
			              	  <thead>
						          <th>S.N</th>    
						          <th>ID</th>      
						          <th>Name</th>
						          <th>Request Amount</th>
						          <th>Date</th>
						          <th>Note</th>
						        </thead>
						        <tbody>
						          <?php
						          $total=0;
						          $co=1;
						          $x=$_SESSION['id'];
						          $rr=mysqli_query($bd,"SELECT * FROM mpayment WHERE mid='$x' AND status='N'");

						          while ($row=mysqli_fetch_assoc($rr)) {          
						          ?>
						          <tr>
						            <td><?php echo $co++?></td>
						            <td><?php echo $row['mid']?></td>
						            <td><?php echo $row['name']?></td>
						            <td><?php echo $row['ramount']?></td> 
						            <td><?php echo $row['todaydate']?></td> 					              
						            <td><?php echo $row['note']?></td> 
						               
						            
						          </tr>
						          <?php
						            }
						          ?>
						        </tbody>
			              	
			              </table>

			          
							</div>
			          		</div>
			          	</div>
			          </div>
			      </div>

			    </div>
			</section>
		</div>


<?php
include 'footer.php';
?>