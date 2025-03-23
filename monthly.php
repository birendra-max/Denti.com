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
            <h1>Monthly Income List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Monthly Income List</li>
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
			                <h3 class="card-title">Monthly Income List</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<h2 class="text-center"><b>Your Monthly Income List</b></h2>

			              	    <div class="row">
							        <div class="col-sm-6">
							      <?php
							      $pp=mysqli_query($bd,"SELECT count(*) as acontl FROM user WHERE directside='left' AND direct='$x' AND acpinid!=0");
							      $row1=mysqli_fetch_assoc($pp);      
							      $pp1=mysqli_query($bd,"SELECT count(*) as acontr FROM user WHERE directside='right' AND direct='$x' AND acpinid!=0");
							      $row2=mysqli_fetch_assoc($pp1);      
							      ?>
							      <hr>
							      <h2 class="">Active In Directly Added Left: <?php echo $row1['acontl']?></h2>
							      <hr>
							        </div>
							      <div class="col-sm-6">
							        <hr>
							        <h2 class="">Active In Directly Added Right: <?php echo $row2['acontr']?></h2>        
							        <hr>
							      </div>
							    </div>
                            	<div class="table table-responsive">
			              <table class="table table-bordered table-striped" style="zoom:70% !important">
			              	   <thead>
						          <th>S.N</th>    
						          <th>MID</th>      
						          <th>Amount</th>
						          <th>Start Date</th>
						          <th>End Date</th>
						          <th>Next Month</th>          
						        </thead>
						        <tbody>
						          <?php
						          $total=0;
						          $co=1;
						          $x=$_SESSION['id'];
						          $rr=mysqli_query($bd,"SELECT * FROM monthlyincome WHERE mid='$x'");
						          while ($row=mysqli_fetch_assoc($rr)) {          
						          ?>
						          <tr>
						            <td><?php echo $co++?></td>
						            <td><?php echo $row['mid']?></td>
						            <td><?php echo $row['mincome']?>
						              <?php
						              $total=$total+$row['mincome'];
						              ?>
						            </td>            
						            <td><?php echo date("d-M-Y",strtotime($row['sdate']))?></td>             
						            <td><?php echo date("d-M-Y",strtotime($row['edate']))?></td>             
						            <td><?php echo date("d-M-Y",strtotime($row['idate']))?></td>             
						          </tr>
						          <?php
						            }
						          ?>
						        </tbody>			              	
			              </table>

			               <div class="row">
						        <div class="col-sm-6">
						      <?php
						  $kk=mysqli_query($bd,"SELECT * FROM user WHERE directside='left' AND direct='$x' AND acpinid=0");
						    
						  $mm=mysqli_query($bd,"SELECT * FROM user WHERE directside='right' AND direct='$x' AND acpinid=0");    

						      ?>
						      <hr>
						      <h2 class="">Inactive In Directly Added Left: <?php echo mysqli_num_rows($kk);?></h2>
						      <hr>
						        </div>
						      <div class="col-sm-6">
						        <hr>
						        <h2 class="">Inactive In Directly Added Right: <?php echo mysqli_num_rows($mm);?></h2>        
						        <hr>
						      </div>
						    </div>
						    <hr>
						    <h3 class="text-center">Total Pair Income : <span class="fa fa-inr"></span> <?php echo $total ?></h3>
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