<?php
include 'header.php';
if (isset($_POST['submit'])) {
	$msg=$_REQUEST['msg'];
	$title=$_POST['title'];
	$tdate=date("d-M-Y");

	$name = $_FILES['att']['name'];
	$tmp_name =  $_FILES['att']['tmp_name'];
	$location = "images/";
	$new_name = $location.time()."-".rand(1000, 9999)."-".$name;
	if (move_uploaded_file($tmp_name, $new_name)){

	if (mysqli_query($bd,"INSERT INTO news(title,msg,todaydate,att) VALUES('$title','$msg','$tdate','$new_name')")) {
		echo "<script>alert('News is uploaded successfully.')</script>";
	}else
	{
		echo "<script>alert('Sorry Something went Wrong.')</script>";
	}
	}else
	{

	}
}
if (isset($_GET['id'])) {
	$id=$_GET['id'];
	if (mysqli_query($bd,"DELETE FROM news where id=$id")) {
		echo "<script>alert('News is deleted successfully.');window.location='news.php';</script>";
	}else
	{
		echo "<script>alert('Sorry Something went Wrong.');window.location='news.php'</script>";
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
            <h1>Upload News </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">News Creator</li>
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
                Create New News
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            	<form action="" method="post" enctype="multipart/form-data">
            	<div class="row">
            		<div class="col-sm-2"></div>
            		<div class="col-sm-8">
	            	<div class="form-group">
	            		<label>News Title</label>            		
	            		<input type="text" name="title" class="form-control">
	            	</div>
	            	<div class="form-group">            	
	              		<textarea id="summernote" rows="5" name="msg">
	                		Write here anything
	              		</textarea>
		       		</div>
		       		<div class="form-group">
	            		<label>Attachment</label>            		
	            		<input type="file" name="att" class="form-control">
	            	</div>

		          	<div class="form-group">
		            	<input type="submit" name="submit" value="Submit" class="btn btn-success">            	
		            </div>
		        	</div>
		    	</div>
		    	</form>


            <div class="card-footer">
              End Of News Area
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
			                <h3 class="card-title">News List</h3>
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
			                    <th>Attachment</th>
			                    <th>Action</th>
			                  </tr>
			                  </thead>
			                  <tbody>
			                  	<?php
			                  	$i=1;
			                  	$rr=mysqli_query($bd,"SELECT * FROM news");
			                  	while ($row=mysqli_fetch_assoc($rr)) {
			                  		?>
			                  		<tr>
			                  		<td><?php echo $i++; ?></td>
			                  		<td><?php echo $row['title'] ?></td>
			                  		<td><?php echo $row['msg'] ?></td>
			                  		<td><?php echo date("d-M-Y",strtotime($row['todaydate'])) ?></td>
			                  		<td> <a href="<?php echo $row['att'] ?>" class="btn btn-info" download> <i class="fas fa-download"></i> </a></td>
			                  		<td> <a href="news.php?id=<?php echo $row['id'] ?>" class="btn btn-danger"> <i class="fas fa-trash-alt"></i> </a> </td>
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