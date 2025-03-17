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
            <h1>User Monthly Payout List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Monthly Payout List</li>
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
			                <h3 class="card-title">User Monthly Payout List</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<h2 class="text-center"><b>User Monthly Payout List</b></h2>
			              	<div class="table table-responsive">
			              <table  style="zoom:70% !important" class="table table-bordered table-striped">
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
				$rr=mysqli_query($bd,"SELECT * FROM user WHERE acpinid!=0");
				while ($row=mysqli_fetch_assoc($rr)) {						
					?>
					<tr>
						<td><?php echo $i++ ?></td>
						<td><?php echo $row['id'] ?></td>
						<td><?php					
						echo $row['name'];
						?>							
						</td>
						<td>
							<?php
							$x=$row['id'];

							$resulth = mysqli_query($bd,"SELECT sum(amount) as sm FROM directincome WHERE mid='$x'");
                        $rowh = mysqli_fetch_array($resulth);
                         $a1=$k1=$rowh['sm'];  

                         $result = mysqli_query($bd,"SELECT sum(amount) as sm FROM pincome where mid='$x'");
    $row = mysqli_fetch_array($result);
      $a2=$k2=$row['sm']; 

      $result = mysqli_query($bd,"SELECT sum(amount) as minc FROM llincome where mid='$x'");
    while($row = mysqli_fetch_array($result)) {   $a3=$k3=$row['minc'];  }

      $result = mysqli_query($bd,"SELECT sum(amount) as minc FROM smartincome where mid='$x'");
                  while($row = mysqli_fetch_array($result)) {   $a4=$k3=$row['minc'];  }

                     $result = mysqli_query($bd,"SELECT sum(amount) as minc FROM smartincome2 where mid='$x'");
                  while($row = mysqli_fetch_array($result)) {   $a5=$k3=$row['minc'];  }

                    $result = mysqli_query($bd,"SELECT sum(amount) as sm FROM reward where mid='$x'");
    $row = mysqli_fetch_array($result);
      $a6=$k2=$row['sm']; 

       $result = mysqli_query($bd,"SELECT sum(amount) as sm FROM autopooluser where mid='$x'");
              $row = mysqli_fetch_array($result);
               $a7=$row['sm']; 
               echo $all=$a1+$a2+$a3+$a4+$a5+$a6+$a7;
               ?>
						</td>
						<td>
							<?php 
							$tds=(($all*10)/100);
							echo $tds=$all-$tds; 
							?>
						</td>	
						<td>
							<?php
			$result = mysqli_query($bd,"SELECT sum(ramount) as sm FROM mpayment2 where mid='$x'");
              $row = mysqli_fetch_array($result);
               echo $w=$row['sm']; 
               ?>               	
               </td>					
               <td>
               	<?php
               	echo $r=$tds-$w;
               	?>
               </td>

						 <td>
						 	<a href="paynow2.php?id=<?php echo $x?>&remain=<?php echo $r ?>" class="btn btn-success">Pay Now</a>
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

			    </div>
			</section>
		</div>

		




<?php
include 'footer.php';
?>