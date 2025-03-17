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
            <h1>Smart Income Second List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Smart Income Second List</li>
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
			                <h3 class="card-title">Smart Income Second List</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<h2 class="text-center"><b>Your Smart Income Second List</b></h2>
			              	<hr>
			              	  
      						<table  id="example1" class="table table-bordered table-striped">
			              	  <thead>
						          <th>S.N</th>    
						          <th>MID</th>      						          
						          <th>Amount</th>
						          <th>S.Date</th>
						          <th>E.Date</th>
						          <th>Calculate Date</th>						          
						        </thead>
						        <tbody>
						          <?php		
						          $co=1;				          
						          $rr=mysqli_query($bd,"SELECT * FROM smartincome2 WHERE mid='$x'");

						          while ($row=mysqli_fetch_assoc($rr)) {          
						          	$total=$total+$row['amount'];
						          ?>
						          <tr>
						            <td><?php echo $co++?></td>
						            <td><?php echo $row['mid']?></td>						            
						            <td><?php echo $row['amount']?></td> 
						            <td><?php echo date("d-M-Y",strtotime($row['sdate']))?></td> 
						            <td><?php echo date("d-M-Y",strtotime($row['edate']))?></td> 
						            <td><?php echo date("d-M-Y",strtotime($row['todaydate']))?></td> 						            
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
			</section>
		</div>


<?php
include 'footer.php';
?>