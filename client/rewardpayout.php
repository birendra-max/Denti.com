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
            <h1>Reward/Award Payout List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Reward/Award Payout List</li>
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
			                <h3 class="card-title">Reward/Award Payout List</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<h2 class="text-center"><b>Your Reward/Award List</b></h2>
			              <table  id="example1" class="table table-bordered table-striped">
			              	 <thead>
			                  <tr>
			                    <th>Sr.No</th>
			                    <th>ID</th>
			                    <th>Type</th>
			                    <th>Reward</th>			                    
			                    <th>Status</th>			                    
			                    <th>Date</th>
			                  </tr>
			                  </thead>
			                  <tbody>
			                  	<?php
			                  	$i=1;			                  	
			                  	$rr=mysqli_query($bd,"SELECT * FROM reward WHERE mid='$x'");
			                  	while ($row=mysqli_fetch_assoc($rr)) {
			                  		?>
			                  		<tr>
			                  		<td><?php echo $i++; ?></td>
			                  		<td><?php echo $row['mid'] ?></td>
			                  		<td><?php echo $row['type'] ?></td>
			                  		<td><?php echo $row['ramount'] ?></td>
			                  		<td><?php echo $row['status'] ?></td>
			                  		<td><?php echo date("d-M-Y",strtotime($row['todaydate'])) ?></td>			                  		
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
			</section>
		</div>

		




<?php
include 'footer.php';
?>