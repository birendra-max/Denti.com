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
            <h1>Payout Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Payout Report</li>
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
			                <h3 class="card-title">Payout Report</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<h2 class="text-center"><b>Your Payout Report</b></h2>
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
						          $rr=mysqli_query($bd,"SELECT * FROM mpayment2 WHERE mid='$x' AND status='Y'");

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