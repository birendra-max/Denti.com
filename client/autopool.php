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
            <h1>None-Working Income List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">None-Working Income List</li>
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
			                <h3 class="card-title">None-Working Income List</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<h2 class="text-center"><b>Your None-Working Income List</b></h2>
			              	<hr>
			              	  	<div class="table table-responsive">
      						<table class="table table-bordered table-striped" style="zoom:70% !important">
			              	  <thead>
						          <th>S.N</th>    
						          <th>ID</th>      						          
						          <th>Side</th>
						          <th>Level</th>
						          <th>Total Count</th>
						          <th>Amount</th>
						          <th>Date</th>
						          <th>Sponser ID</th>         
						          
						        </thead>
						        <tbody>
						          <?php		
						          $co=1;	
						          $total=0;			          
						          $rr=mysqli_query($bd,"SELECT * FROM autopooluser WHERE mid='$x'");

						          while ($row=mysqli_fetch_assoc($rr)) {          
						          	$total=$total+((int)$row['amount']);
						          ?>
						          <tr>
						            <td><?php echo $co++?></td>
						            <td><?php echo $row['mid']?></td>						            
						            <td><?php echo $row['side']?></td>						            
						            <td><?php echo $row['level']?></td>						            
						            <td><?php echo $row['tot']?></td>						            						           
						            <td><?php echo $row['amount']?></td> 						            						            
						            <td><?php echo date("d-M-Y",strtotime($row['todaydate']))?></td> 
						            <td><?php echo $row['sponserid']?></td> 						            						            
						          </tr>
						          <?php						          
						            }
						          ?>
						        </tbody>
			              	
			              </table>

			             
						    <hr>
						    <h3 class="text-center alert alert-info">Total Income : <span class="fa fa-inr"></span> <?php echo $total ?></h3>
						    <hr>

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