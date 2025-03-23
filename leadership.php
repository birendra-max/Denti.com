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
            <h1>Leadership Income List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Leadership Income List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


		
  <?php 
    
    function check_status($bd,$id)
    {
        $rr=mysqli_query($bd,"SELECT * FROM user WHERE id='$id' AND status='active'");
        $row=mysqli_fetch_assoc($rr);
        if($row['acpinid']!=0)
        return 1;
        else
        return 0;
       
    }
    ?>





			    <section class="content">
			      <div class="container-fluid">
			        <div class="row">
			          <div class="col-12">
			            <div class="card">
			              <div class="card-header">
			                <h3 class="card-title">Leadership Income List</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<h2 class="text-center"><b>Your Leadership Income List</b></h2>
			              	<hr>
			              	

			              <table  id="example1" class="table table-bordered table-striped">
			              	  <thead>
						          <th>S.N</th>    
						          <th>ID</th>      						          
						          <th>Amount</th>
						          <th>Sponser ID</th>
						          <th>Date</th>						          
						        </thead>
						        <tbody>
						          <?php
						          $total=0;
						          $co=1;
						          $x=$_SESSION['id'];
						          $rr=mysqli_query($bd,"SELECT * FROM llincome WHERE mid='$x'");

						          while ($row=mysqli_fetch_assoc($rr)) {          
						          ?>
						          <tr>
						            <td><?php echo $co++?></td>
						            <td><?php echo $row['mid']?></td>						            
						            <td><?php echo $row['amount']?></td> 
						            <td><?php echo $row['spid']?></td> 
						            <td><?php echo $row['todaydate']?></td> 
						            
						          </tr>
						          <?php
						          $total=$total+$row['amount'];
						            }
						          ?>
						        </tbody>
			              	
			              </table>

			                
						        
						    <hr>
						    <h3 class="text-center alert alert-info">Total Direct Income : <span class="fa fa-inr"></span> Rs. <?php echo $total ?></h3>
						    <hr>

			          		
			          	</div>
			          </div>
			      </div>

			    </div>
			</section>
		</div>


<?php
include 'footer.php';
?>