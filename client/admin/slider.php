<?php
include 'header.php';

	if (isset($_POST['submit'])) {
	extract($_POST);

$name = $_FILES['image']['name'];
$tmp_name =  $_FILES['image']['tmp_name'];
$location = "images/";
$new_name = $location.time()."-".rand(1000, 9999)."-".$name;
if (move_uploaded_file($tmp_name, $new_name)){
		$tdate=date("d-M-Y");
	if (mysqli_query($bd,"INSERT INTO slider(des,heading,image,todaydate) VALUES('$des','$heading',' $new_name','$tdate')")) {
		echo "<script>alert('Slider image is uploaded successfully.')</script>";
	}else
	{
		echo "<script>alert('Sorry something went wrong.')</script>";
	}
}else
{
	echo "<script>alert('File can not be uploaded.')</script>";
}
}

if (isset($_GET['idd'])) {
   $idd=$_GET['idd'];
   	
	if (mysqli_query($bd,"DELETE FROM slider WHERE id=$idd")) {
		echo "<script>alert('You have deleted successfully.')<script>";
		echo "<script>window.location='slider.php'<script>";
	}else
	{
		echo "<script>alert('Sorry can not be deleted.')<script>";
		echo "<script>window.location='slider.php'<script>";
	}
      echo "<script>window.location='slider.php'<script>";

}

?>



 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Upload Image For Slider </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Slider</li>
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
                Upload Image For Slider
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            	<form action="" method="post" enctype="multipart/form-data">
            	<div class="row">
            		<div class="col-sm-2"></div>
            		<div class="col-sm-8">
	            	<div class="form-group">
	            		<label>Slider Title</label>            		
	            		<input type="text" name="heading" class="form-control">
	            	</div>
	            	<div class="form-group">            	
	              		<textarea id="summernote" rows="5" name="des">
	                		description
	              		</textarea>
		       		</div>
		       		<div class="form-group">
	            		<label>Image</label>            		
	            		<input type="file" name="image" class="form-control">
	            	</div>

		          	<div class="form-group">
		            	<input type="submit" name="submit" value="Upload" class="btn btn-success">            	
		            </div>
		        	</div>
		    	</div>
		    	</form>


            <div class="card-footer">
              End Of Slider
            </div>
          </div>
      </div>
  </div>
</div>
</section>


			    <section class="content">
			      <div class="container-fluid">
			        <div class="row">
			          <div class="col-12">
			            <div class="card">
			              <div class="card-header">
			                <h3 class="card-title">Slider List</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			                   <div class="table table-responsive">
			              <table class="table table-bordered table-striped" style="zoom:70% !important">
			              	 <thead>
			                  <tr>
			                    <th>Sr.No</th>
			                    <th>Title</th>
			                    <th>Content</th>
			                    <th>Created Date</th>
			                    <th>Image</th>
			                    <th>Action</th>
			                  </tr>
			                  </thead>
			                  <tbody>
			                  	<?php
			                  	$i=1;
			                  	$rr=mysqli_query($bd,"SELECT * FROM slider");
			                  	while ($row=mysqli_fetch_assoc($rr)) {
			                  		?>
			                  		<tr>
			                  		<td><?php echo $i++; ?></td>
			                  		<td><?php echo $row['heading'] ?></td>
			                  		<td><?php echo $row['des'] ?></td>
			                  		<td><?php echo date("d-M-Y",strtotime($row['todaydate'])) ?></td>
			                  		<td> <img src="<?php echo $row['image'] ?>" style="width:150px;height:150px;"> </td>
			                  		<td> <a href="slider.php?idd=<?php echo $row['id'] ?>" class="btn btn-danger"> <i class="fas fa-trash-alt"></i> </a> </td>
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
       


    <!-- /.content -->
  </div>

<?php
include 'footer.php';
?>