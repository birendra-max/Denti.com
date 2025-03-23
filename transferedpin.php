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
            <h1>List Of Transfered Pin </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Transfered Pin</li>
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
                List Of Transfered Pin
              </h3>
            </div>

            	  <section class="content">
			      <div class="container-fluid">
			        <div class="row">
			          <div class="col-12">
			            <div class="card">
			              <div class="card-header">
			                <h3 class="card-title">Transfered Pin</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<h2 class="text-center"><b>List Of Transfered Pin</b></h2>
			              	 <div class="table table-responsive">
			              <table class="table table-bordered table-striped" style="zoom:70% !important">
			              	 <thead>
			                  <tr>
			                    <th>Sr.No</th>
			                    <th>ID</th>
			                    <th>Name</th>
			                    <th>Package</th>
			                    <th>Pin</th>			                    			                    
			                  </tr>
			                  </thead>
			                  <tbody>
			                  	<?php
			                  	$i=1;			                  	
			                  	$rr=mysqli_query($bd,"SELECT * FROM pintransfer ");
			                  	while ($row=mysqli_fetch_assoc($rr)) {
			                  		?>
			                  		<tr>
			                  		<td><?php echo $i++; ?></td>
			                  		<td><?php echo $row['toid'] ?></td>
			                  		<td>
			                  			<?php
			                  			$g=$row['toid'];
			                  	$rr2=mysqli_query($bd,"SELECT * FROM user WHERE id='$g'");
			                  	$row2=mysqli_fetch_assoc($rr2);
			                  	echo $row2['name'];
			                  	?>	
			                  		</td>
			                  		<td><?php echo $row['amount'] ?></td>
			                  		<td><?php echo $row['pin'] ?></td>			                  		
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
