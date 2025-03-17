<?php
include 'header.php';
if (isset($_POST['submit'])) {

	$msg=$_REQUEST['msg'];
	$title=$_POST['admin'];
	//$mid=$_POST['mid'];

	$tdate=date("d-M-Y");
	$ttime=date("h:i:sa");
	$iddf=$_POST['iddf'];
	$subject=$_POST['subject'];
	if(mysqli_query($bd,"INSERT INTO maillist(mid,direct,msg,todaydate,todaytime,status,subject) VALUES('','$title','$msg','$tdate','$ttime','Y','$subject')"))
	{
	echo "<scrip>alert('You have reply successfully.')</script>";
	$rr=mysqli_query($bd,"SELECT MAX(id) as mm FROM maillist");
	$row=mysqli_fetch_assoc($rr);
	$maxid=$row['mm'];
	if (!empty($_FILES['att']['name'])) {				
	$name = $_FILES['att']['name'];
	$tmp_name =  $_FILES['att']['tmp_name'];
	$location = "images/";
	$new_name = $location.time()."-".rand(1000, 9999)."-".$name;	
	if (move_uploaded_file($tmp_name, $new_name)){
		mysqli_query($bd,"UPDATE maillist SET attach='$new_name' WHERE id=$maxid");
	}
	}

	}else
	{
		echo "<scrip>alert('Sorry something went wrong.')</script>";
	}
		mysqli_query($bd,"UPDATE maillist SET status='Y' WHERE id=$iddf");
		echo "<script>window.location='inbox.php'</script>";

	}

	$id=$_GET['idd'];
	$rr=mysqli_query($bd,"SELECT * FROM maillist WHERE id=$id");
	$row=mysqli_fetch_assoc($rr);

?>



 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Compose Mail </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Mail Composer </li>
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
                Reply Mail For (ID : <?php echo $row['mid'] ?>)
              </h3>
              <hr>
              <h3 class="text-center">
                Reply For <?php echo $_GET['reg'] ?>
              </h3>
              <hr>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            	<form action="" method="post" enctype="multipart/form-data">
            	<div class="row">
            		<div class="col-sm-2"></div>
            		<div class="col-sm-8">
	            	<div class="form-group">
	            		<label>To : </label>            		
	            		<input type="text" class="form-control" readonly value="<?php echo $row['mid'] ?>">	
	            		<input type="hidden" name="iddf" value="<?php echo $id ?>">	
	            		<input type="hidden" name="admin" value="<?php echo $row['mid'] ?>">	           </div>
	            	<div class="form-group">
	            		<label>Subject : </label>            		
	            		<input type="text" name="subject" class="form-control" required>	            	
	            	</div>

	            	<div class="form-group">            	
	              		<textarea id="summernote" rows="5" name="msg">
	                		Write here Feedback /Suggestion / Query
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
              End Of Mail Composer
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