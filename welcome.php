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
            <h1>Welcome Letter </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Welcome Letter</li>
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
                Your Welcome Letter
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            	<hr>
            	<h1 class="text-center"><b><?php echo $rowcp['cname'] ?></b></h1>
            	<hr>
            	<div class="row">
            		<div class="col-sm-2"></div>
            		<div class="col-sm-8">
            			<div class="row">
	            			<div class="col-sm-6">
	            				<div class="form-group">
	            					<label class="col-sm-6">Member Name : </label><i class="col-sm-6"><b><?php echo $rowp['name']?></b></i>
	            				</div>
	            			</div>
	            			<div class="col-sm-6">
								<div class="form-group">
	            					<label class="col-sm-6">Contact No. : </label><i class="col-sm-6"><b><?php echo $rowp['mobile']?></b></i>
	            				</div>
	            			</div>
            			</div>
            			<div class="row">
	            			<div class="col-sm-6">
	            				<div class="form-group">
	            					<label class="col-sm-6">Member ID : </label><i class="col-sm-6"><b><?php echo $rowp['id']?></b></i>
	            				</div>
	            			</div>
	            			<div class="col-sm-6">
								<div class="form-group">
	            					<label class="col-sm-6">Package : </label><i class="col-sm-6"><b><?php echo $rowp['amount']?></b></i>
	            				</div>
	            			</div>
            			</div>
            			<div class="row">
	            			<div class="col-sm-6">
	            				<div class="form-group">
	            					<label class="col-sm-6">E-Mail : </label><i class="col-sm-6"><b><?php echo $rowp['em']?></b></i>
	            				</div>
	            			</div>
	            			<div class="col-sm-6">
								<div class="form-group">
	            					<label class="col-sm-6">Date Of Joining : </label><i class="col-sm-6"><b><?php echo date("d-M-Y",strtotime($rowp['todaydate']))?></b></i>
	            				</div>
	            			</div>
            			</div>
            			<hr>
            			<hr>
            			<?php 
            			$rm=mysqli_query($bd,"SELECT * FROM welcome");
            			$rowwel=mysqli_fetch_assoc($rm);
            			?>
	            	<div class="form-group">

	            		<h3><b><?php echo $rowwel['title'] ?></b></h3><br><br><br>
	            	</div>
	            	<div class="form-group">
	            		<h5><b>Dear <?php echo $rowp['name'] ?></b></h5> 
	            		<p><b><?php echo $rowwel['msg'] ?></b></p>
		       		</div>
		       		

		        	</div>
		    	</div>
		    	</form>


            <div class="card-footer">
              End Of Welcome Letter
            </div>
          </div>
      </div>
  </div>
</div>
</section>



</div>
       


    <!-- /.content -->
  </div>




<?php
include 'footer.php';
?>