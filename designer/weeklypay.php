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
            <h1>Weekly Payout List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Weekly Payout List</li>
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
			                <h3 class="card-title">Weekly Payout List</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<h2 class="text-center"><b>Your Weekly Payout List</b></h2>
			              <table  id="example1" class="table table-bordered table-striped">
			              	  <thead>
						          <th>Sr.No</th>    
						          <th>ID</th>      
						          <th>Name</th>          
						          <th>Amount</th>
						          <th>Date</th>
						          <th>Referance ID</th>
						          <th>Status</th>
						        </thead>
						        <tbody>
						          <?php
						          $total=0;
						          $co=1;
						          $x=$_SESSION['id'];
						          $rr=mysqli_query($bd,"SELECT * FROM weekly WHERE mid='$x'");
						          while ($row=mysqli_fetch_assoc($rr)) {          
						          ?>
						          <tr>
						            <td><?php echo $co++?></td>
						            <td><?php echo $row['mid']?></td>
						            <td><?php echo $row['name']?></td>           
						           <td><?php echo $row['amount']?></td>   
						           <?php
						           $total=$total+$row['amount'];
						           ?>        
						           <td><?php echo $row['todaydate']?></td>           
						           <td><?php echo $row['ref']?></td>     
						           <td> <a href="" class="btn btn-success"> <i class="fa fa-money"></i> Paid</a></td>                  
						          </tr>
						          <?php
						            }
						          ?>
						        </tbody>        	
			              	</table>

			              	  <hr>
							    <h3 class="text-center">Total : <span class="fa fa-inr"></span> <?php echo $total ?></h3>
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