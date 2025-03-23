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
            <h1>Direct Referral List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Direct Referral List</li>
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
			                <h3 class="card-title"> Direct Referral List</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<h2 class="text-center"><b>Your Direct Referral List</b></h2>
			              	<div class="table table-responsive">
			              <table class="table table-bordered table-striped" style="zoom:70% !important">
			              	 <thead>
			                  <tr>
			                    <th>Sr.No</th>
			                    <th>ID</th>
			                    <th>Name</th>
			                    <th>Sponser ID</th>
			                    <th>Side</th>

			                    <th>Date Of Joining</th>
			                    <th>Status</th>
			                  </tr>
			                  </thead>
			                  <tbody>
			                  	<?php
			                  	$i=1;			                  	
			                  	$rr=mysqli_query($bd,"SELECT * FROM user WHERE direct='$x'");
			                  	while ($row=mysqli_fetch_assoc($rr)) {
			                  		?>
			                  		<tr>
			                  		<td><?php echo $i++; ?></td>
			                  		<td><?php echo $row['id'] ?></td>
			                  		<td><?php echo $row['name'] ?></td>
			                  		<td><?php echo $row['sponserid'] ?></td>
			                  		<td><?php echo $row['side'] ?></td>
			                  		<td><?php echo date("d-M-Y",strtotime($row['todaydate'])) ?></td>	
			                  		<td><?php if( $row['acpinid']!=0 )
							               echo "<p class='btn btn-success'>Active</p>";
							               else
							               	echo "<p class='btn btn-danger'>Not Active</p>"; 

							               ?></td>		                  		
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