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
              <li class="breadcrumb-item active">Welcome Letter Creator</li>
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
                Create New Welcome Letter
                <?php 

                if (isset($_POST['submit'])) {
  $msg=$_POST['msg'];
  $title=$_POST['title'];
  $tdate=date("d-M-Y");
  if (mysqli_query($bd,"UPDATE welcome SET msg='$msg',title='$title' WHERE id=1")) {
    echo "error".mysqli_error($bd);
    //echo "<script>alert('Welcome letter is updated successfully.')</script>";
  }else
  {
    echo "error".mysqli_error($bd);
    //echo "<script>alert('Sorry Something went Wrong.')</script>";
  }
}

$rr=mysqli_query($bd,"SELECT * FROM welcome");
$row=mysqli_fetch_assoc($rr);
                ?>
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            	<form action="" method="post">
            	<div class="row">
            		<div class="col-sm-2"></div>
            		<div class="col-sm-8">
	            	<div class="form-group">
	            		<label>Greeting Title</label>            		
	            		<input type="text" name="title" class="form-control" value="<?php echo $row['title'] ?>">
	            	</div>
	            	<div class="form-group"> 
	            	<label>Write Here</label>           	
	              		<textarea id="summernote" maxlength="5000" rows="5" name="msg">
	                		<?php echo $row['msg'] ?>
	              		</textarea>
		       		</div>
		       		

		          	<div class="form-group">
		            	<input type="submit" name="submit" class="btn btn-success">            	
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