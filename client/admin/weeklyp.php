<?php
include 'header.php';
?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Weekly Payout List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Weekly Payout List</li>
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
			                <h3 class="card-title">User Weekly Payout List</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<hr>
			              	<h2 class="text-center"><b>User Weekly Payout List</b></h2>
			              	<hr>
			              <table  id="example1" class="table table-bordered table-striped">
			              		<thead>
									<tr>
										<th>Sr.No</th>
										<th>ID</th>
										<th>Name</th>
										<th>Amount</th>
										<th>TDS+Admin(10%)</th>
										<th>Withdrwal</th>
										<th>Remain</th>					
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i=1;
									$rr=mysqli_query($bd,"SELECT * FROM user WHERE acpinid<>0 AND counting>0");
									while ($row=mysqli_fetch_assoc($rr)) {						
										?>
										<tr>
											<td><?php echo $i++ ?></td>
											<td><?php echo $row['id'] ?></td>
											<td><?php echo $row['name'] ?></td>
											<td>
												<i class="fa fa-inr"></i>						 	
												<?php
											$mid=$row['id'];
											$rr1=mysqli_query($bd,"SELECT SUM(amount) as amn FROM pincome WHERE mid='$mid'");
											$row1=mysqli_fetch_assoc($rr1);													
											$a=$row1['amn'];
											$rr2=mysqli_query($bd,"SELECT SUM(amount) as amn FROM directincome WHERE mid='$mid'");
											$row2=mysqli_fetch_assoc($rr2);													
											$b=$row2['amn'];
											$c=$a+$b;
											echo  $c;
											 ?></td>
											 <td><i class="fa fa-inr"></i>						 	
											 	<?php 
											 	$di=($c*10)/100;
											 	echo $di;
											 	?>
											 </td>
											 <td>	<i class="fa fa-inr"></i>						 						 	
											 	<?php 
											 	$rr1=mysqli_query($bd,"SELECT SUM(amount) as amn FROM weekly WHERE mid='$mid'");
												$row1=mysqli_fetch_assoc($rr1);													
												echo $d=$row1['amn'];
											 	?>
											 </td>
											  <td>		<i class="fa fa-inr"></i>						 					 	
											 	<?php 
											 	$r=$c-$di-$d;
											 	echo $r;
											 	?>
											 </td>
											 <td>
											 	<a href="paynow1.php?id=<?php echo $row['id']?>&remain=<?php echo $r ?>" class="btn btn-success">Pay Now</a>
											 </td>
										</tr>
										<?php
										}	

									?>
									<tr>
										
									</tr>
								</tbody>
			              	
			              </table>
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