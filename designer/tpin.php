
<?php
include 'header.php';
$x=$_SESSION['id'];
if (isset($_POST['submit'])) {
	$adminto=$_POST['adminto'];
	$package=$_POST['package'];
	$quantity=$_POST['quantity'];

	$name = $_FILES['image']['name'];
	$tmp_name =  $_FILES['image']['tmp_name'];
	$location = "images/";
	$new_name = $location.time()."-".rand(1000, 9999)."-".$name;
	if (move_uploaded_file($tmp_name, $new_name)){

		$tdate=date("m/d/Y");
	if (mysqli_query($bd,"INSERT INTO pinr(mid,adminto,package,quantity,image,status,todaydate)VALUES('$x','$adminto','$package','$quantity','$new_name','N','$tdate')")) {
			//echo mysqli_error($bd);
			echo "<script>alert('You have sent request successfully.')</script>";
		}else
		{
			//echo mysqli_error($bd);
			echo "<script>alert('Sorry something went wrong.')</script>";
		}	
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
            <h1>Transfer Pin </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Transfer Pin</li>
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
                Pin Transfer
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

            	<form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
				
				  <div class="form-group">
                    <label for="exampleInputEmail1">Transfer To</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="tomid" placeholder="member id" required>
                  </div>                	

                  <div class="form-group">                      
                  	<label>Select Package</label>
	                  <select class="form-control select2" name="package" style="width: 100%;">
	                    <option value="5000" selected="selected">5000(Package 1)</option>
	                    <option value="10000">10000 (Package 2)</option>
	                    <option value="15000">15000 (Package 3)</option>
	                    <option value="20000">20000 (Package 4)</option>
	                    <option value="25000">25000 (Package 5)</option>
	                    <option value="30000">30000 (Package 6)</option>	                    
	                  </select>	            		
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Quantity</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="quantity" placeholder="quantity" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Slip Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      
                    </div>
                  </div>                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>




              	  <section class="content">
			      <div class="container-fluid">
			        <div class="row">
			          <div class="col-12">
			            <div class="card">
			              <div class="card-header">
			                <h3 class="card-title">Pending Pin List</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<h2 class="text-center"><b>Requested Pin Pending List</b></h2>
			              		<div class="table table-responsive">
			              <table class="table table-bordered table-striped" style="zoom:70% !important">
			              	 <thead>
			                  <tr>
			                    <th>Sr.No</th>
			                    <th>To</th>
			                    <th>Package</th>
			                    <th>Quantity</th>
			                    <th>Slip</th>
			                    <th>Status</th>
			                    <th>Requested Date</th>
			                  </tr>
			                  </thead>
			                  <tbody>
			                  	<?php
			                  	$i=1;			                  	
			                  	$rr=mysqli_query($bd,"SELECT * FROM pinr WHERE mid='$x' AND status='N' ORDER BY id desc ");
			                  	while ($row=mysqli_fetch_assoc($rr)) {
			                  		?>
			                  		<tr>
			                  		<td><?php echo $i++; ?></td>
			                  		<td><?php echo $row['adminto'] ?></td>
			                  		<td><?php echo $row['package'] ?></td>
			                  		<td><?php echo $row['quantity'] ?></td>
			                  		<td> <img src="<?php echo $row['image'] ?>" width="60" height="60"></td>
			                  		<th><?php echo "Not Approved" ?></th>
			                  		<td><?php echo date("d-M-Y",strtotime($row['todaydate'])) ?></td>			                  		
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
        </div>
    </div>
</div>
</section>
</div>




<?php
include 'footer.php';
?>