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
            <h1>Reward/Award List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Reward/Award List</li>
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
			                <h3 class="card-title">Reward/Award List</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<h2 class="text-center"><b>Your Reward/Award List</b></h2>
			              	<div class="table table-responsive">
			              <table class="table table-bordered table-striped" style="zoom:70% !important">
			                <thead>
					          <th>S.N</th>    
					          <th>MID</th>      
					          <th>Reward</th>
					          <th>Type</th>
					          <th>Date</th>          
					        </thead>
					        <tbody>
					          <?php
					          $total=0;
					          $co=1;
					          $x=$_SESSION['id'];
					          $rr=mysqli_query($bd,"SELECT * FROM reward WHERE mid='$x'");
					          while ($row=mysqli_fetch_assoc($rr)) {          
					          ?>
					          <tr>
					            <td><?php echo $co++?></td>
					            <td><?php echo $row['mid']?></td>
					            <td><?php echo $row['ramount']?></td>            
					            <td><?php echo $row['type']?></td>            
					            <td><?php echo date("d-M-Y",strtotime($row['todaydate']))?></td>                         
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