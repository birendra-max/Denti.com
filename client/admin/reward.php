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
            <h1>Reward Income List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Reward Income List</li>
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
			                <h3 class="card-title">Reward Income List</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<h2 class="text-center"><b>Your Reward Income List</b></h2>
			              	<hr>
			              	   <div class="table table-responsive">
      						<table class="table table-bordered table-striped" style="zoom:70% !important">
			              	  <thead>
						          <th>S.N</th>    
						          <th>ID</th>     
						          <th>Name</th> 						          
						          <th>Position</th>
						          <th>Prize</th>
						          <th>Date</th>
						          <th>Status</th>
						          
						        </thead>
						        <tbody>
						          <?php		
						          $co=1;	
						          $total=0;			          
						          $rr=mysqli_query($bd,"SELECT * FROM reward");

						          while ($row=mysqli_fetch_assoc($rr)) {          
						          	$total=$total+$row['amount'];
						          ?>
						          <tr>
						            <td><?php echo $co++?></td>
						            <td><?php echo $row['mid']?></td>	
						                <td><?php 
						            $mid=$row['mid'];
										$rr1=mysqli_query($bd,"SELECT name FROM user WHERE id='$mid'");
										$row2=mysqli_fetch_assoc($rr1);
						            echo $row2['name']?>						            	
						            </td>					            
						            <td><?php echo $row['ramount']?></td>						            
						            <td><?php echo $row['amount']?></td> 						            						            
						            <td><?php echo date("d-M-Y",strtotime($row['todaydate']))?></td> 
						            <td><?php echo $row['status']?></td> 						            						            
						          </tr>
						          <?php						          
						            }
						          ?>
						        </tbody>
			              	
			              </table>
                            </div>
			             
						    <hr>
						    <h3 class="text-center alert alert-info">Total Income : <span class="fa fa-inr"></span> <?php echo $total ?></h3>
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