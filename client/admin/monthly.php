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
            <h1>User Monthly Income List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Monthly Income List</li>
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
			                <h3 class="card-title">User Monthly Income List</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<h2 class="text-center"><b>User Monthly Income List</b></h2>
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
				</tr>
			</thead>
			<tbody>
				<?php

				function monthlyincome($bd,$mid,$ino,$refid)
				{

					$rr=mysqli_query($bd,"SELECT * FROM monthlyincome WHERE mid='$mid' AND status>$ino AND refid='$refid'");
					$row=mysqli_fetch_assoc($rr);
					return $row['mincome'];
				}

				$result = mysqli_query($bd,"SELECT SUM(mincome) AS pinc FROM monthlyincome");												
				$pagli2=0;
				$rro=mysqli_fetch_assoc($result);
				echo $pagli2=$rro['pinc'];			


				$i=1;
				$rr=mysqli_query($bd,"SELECT * FROM monthlyincome");
				while ($row=mysqli_fetch_assoc($rr)) {						
					?>
					<tr>
						<td><?php echo $i++ ?></td>
						<td><?php echo $row['mid'] ?></td>
						<td><?php
					$mid=$row['mid'];
						$rr1=mysqli_query($bd,"SELECT name FROM user WHERE id='$mid'");
						$row1=mysqli_fetch_assoc($rr1);	
						echo $row1['name'];
						?>							
						</td>
						<td>
							<i class="fa fa-inr"></i>						 	
							<?php
							$a=0;
						$mid=$row['mid'];
						$ino=$row['ino'];
						$refid=$row['refid'];
						if ($ino>3) {
						echo $a=monthlyincome($bd,$mid,$row['ino'],$row['refid']);
						}else
						{
							echo $a=$row['mincome'];
						}

						?></td>
						 <td><i class="fa fa-inr"></i>						 	
						 	<?php 
						 	$di=($a*10)/100;
						 	echo $di;
						 	?>
						 </td>
						 <td>	
						 	<i class="fa fa-inr"></i>						 						 	
						 	<?php 
						 	$rr1=mysqli_query($bd,"SELECT SUM(amount) as amn FROM monthlyincome1 WHERE mid='$mid' AND refid='$refid'");
							$row1=mysqli_fetch_assoc($rr1);													
							echo $b=$row1['amn'];
						 	?>
						 </td>
						  <td>		<i class="fa fa-inr"></i>						 					 	
						 	<?php 
						 	$r=$a-$di-$b;
						 	echo $r;
						 	?>
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