<?php
include 'header.php'; 
if (isset($_GET['id'])) {
	$id=$_GET['id'];
	$tdate=date("d-M-Y");
	if (mysqli_query($bd,"UPDATE mpayment SET status='Y',apdate='$tdate' WHERE ID=$id")) {
		echo "<script>alert('You have approved successfully.')</script>";
		echo "<script>window.location='prequest.php'</script>";
	}else
	{
		echo "<script>alert('Sorry something went wrong.')</script>";
		echo "<script>window.location='prequest.php'</script>";
	}
	}
?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Request For Payout</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Request For Payout</li>
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
			                <h3 class="card-title">Request For Payout</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">	              	
			              	
			              	 <div class="table table-responsive">
			              <table class="table table-bordered table-striped" style="zoom:70% !important">
			              	  <thead>
						          <th>S.N</th>    
						          <th>ID</th>      
						          <th>Name</th>
						          <th>Request Amount</th>
						          <th>Date</th>
						          <th>Note</th>
						          <th>Action</th>
						        </thead>
						        <tbody>
						          <?php
						          $total=0;
						          $co=1;						          
						          $rr=mysqli_query($bd,"SELECT * FROM mpayment WHERE status='N'");

						          while ($row=mysqli_fetch_assoc($rr)) {          
						          ?>
						          <tr>
						            <td><?php echo $co++?></td>
						            <td><?php echo $row['mid']?></td>
						            <td><?php echo $row['name']?></td>
						            <td><?php echo $row['ramount']?></td> 
						            <td><?php echo $row['todaydate']?></td> 					              
						            <td><?php echo $row['note']?></td>
						            <td> <a href="prequest.php?id=<?php echo $row['id'] ?>" class="btn btn-success" onclick="return confirm('Are you sure to approve this payment.')"> Approve </a></td>						               
						            
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