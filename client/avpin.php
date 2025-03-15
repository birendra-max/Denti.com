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
            <h1> Available Pin List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Available Pin List</li>
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
			                <h3 class="card-title">Available Pin List</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<h2 class="text-center"><b>Available Pin List</b></h2>
			              	<div class="table table-responsive">
			              <table  style="zoom:70% !important" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Sr.No</th>
									<th>Pin</th>
									<th>Status</th>								
								</tr>
							</thead>
							<tbody>
								<?php			
								$us=0;
								$nu=0;
								$rr=mysqli_query($bd,"SELECT * FROM pinr WHERE mid='$x' AND pinno!=''");
								while($row=mysqli_fetch_assoc($rr))
								{
								$pinl=$row['pinno'];
								$p=explode(",",$pinl);
								echo $c=count($p);
								
								for ($i=0; $i <$c ;) { 
									if (empty($p[$i])) {
									$i++;	
									}else
									{
									?>
								<tr>
									<td><?php echo $i ?></td>
									<td><?php echo $p[$i] ?></td>
									<td>
										<?php
										$pp=$p[$i];
								$rr2=mysqli_query($bd,"SELECT * FROM pin WHERE acpinid='$pp'");
								$row2=mysqli_fetch_assoc($rr2);
								if ($row2['status']=='N') {
									$nu=$nu+1;
									echo "<p class='btn btn-success'>Available</p>";
								}else
								{
									$us=$us+1;
									echo "<p class='btn btn-danger'>Not Available</p>";
								}
										?>										
									</td>
									
								</tr>
									<?php
									$i++;
								}
							}
								}
									?>				
								
							</tbody>
			              	
			              </table>

			              </div>
			              <hr>
			              <h3 class="alert alert-success text-center"> Available Pin : <?php echo $nu ?></h3>
			              <hr>
			              <hr>
			              <h3 class="alert alert-danger text-center"> Not Available Pin : <?php echo $us ?></h3>
			              <hr>
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