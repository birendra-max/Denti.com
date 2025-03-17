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
            <h1>List Of Approved</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Approved Request</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                List Of Approved Pin
              </h3>
            </div>

            	  <section class="content">
			      <div class="container-fluid">
			        <div class="row">
			          <div class="col-12">
			            <div class="card">
			              <div class="card-header">
			                <h3 class="card-title">Approved Pin</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<h2 class="text-center"><b>List Of Approved Pin</b></h2>
			              	  <div class="table table-responsive">
			              <table class="table table-bordered table-striped" style="zoom:70% !important">
			              	 <thead>
			                  <tr>
			                    <th>Sr.No</th>
			                    <th>To</th>
			                    <th>Package</th>
			                    <th>Quantity</th>
			                    <th>Slip</th>
			                    <th>Status</th>
			                    <th>Requested Date</th>
			                    <th>Action</th>
			                  </tr>
			                  </thead>
			                  <tbody>
			                  	<?php
			                  	$i=1;			                  	
			                  	$rr=mysqli_query($bd,"SELECT * FROM pinr WHERE status='Y' ORDER BY id desc");
			                  	while ($row=mysqli_fetch_assoc($rr)) {
			                  		?>
			                  		<tr>
			                  		<td><?php echo $i++; ?></td>
			                  		<td><?php echo $row['adminto'] ?></td>
			                  		<td><?php echo $row['package'] ?></td>
			                  		<td><?php echo $row['quantity'] ?></td>
			                  		<td> <img src="../<?php echo $row['image'] ?>" width="60" height="60"></td>
			                  		<th><?php echo "Not Approved" ?></th>
			                  		<td><?php echo date("d-M-Y",strtotime($row['todaydate'])) ?></td>		
			                  		<td> <a href="lpin2.php?id=<?php echo $row['id']?>" class="btn btn-warning"> View Pin </a></td>	                  		
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
	</div>
</div>
</section>
</div>




<?php
include 'footer.php';
?>
