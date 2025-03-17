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
            <h1>Pin List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pin List</li>
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
			                <h3 class="card-title">Pin List</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<h2 class="text-center"><b>Your Pin List</b></h2>
			              		<div class="table table-responsive">
			              <table class="table table-bordered table-striped" style="zoom:70% !important">
			              	 <thead>
			                  <tr>
			                    <th>Sr.No</th>
			                    <th>Pin</th>
			                    <th>Status</th>
			                    <th>Amount</th>			                    			                    
			                    <th>Date</th>
			                  </tr>
			                  </thead>
			                  <tbody>
			                  	<?php
			                  	$i=1;
			                  	$used=0;
			                  	$av=0;			                  	
			                  	$rr=mysqli_query($bd,"SELECT * FROM pin");
			                  	while ($row=mysqli_fetch_assoc($rr)) {
			                  			if ($row['status']=='Y') {
			                  			$used++;	
			                  			}else
			                  			{
			                  				$av++;
			                  			}
			                  		?>
			                  		<tr>
			                  		<td><?php echo $i++; ?></td>
			                  		<td><?php echo $row['acpinid'] ?></td>
			                  		<td><?php if($row['status']=='Y') 
			                  			echo "<p class='btn btn-danger'>Used</p>";
			                  			else
			                  				echo "<p class='btn btn-success'>Available</p>";

			                  		?></td>
			                  		<td><?php echo 1500 ?></td>
			                  		
			                  		<td><?php echo date("d-M-Y",strtotime($row['todaydate'])) ?></td>	
			                  		</tr>
			                  		<?php
			                  	}
			                  	?>
			                  </tbody>

			              	
			              </table>
			          		</div>
			          		<h3 class="alert alert-success"> Available Pin : <?php echo $av; ?></h3>
			          		<h3 class="alert alert-danger"> Used Pin : <?php echo $used; ?></h3>
			          		<h3 class="alert alert-info"> Total Pin : <?php echo $av+$used; ?></h3>
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