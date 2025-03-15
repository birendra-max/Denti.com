
<?php
include 'header.php';
$x=$_SESSION['id'];
if (isset($_POST['submit'])) {
	$kyc_pin=$_POST['kyc_pin'];
 	$res=mysqli_query($bd,"SELECT tempvalue2 FROM user where id='$x' ");
  	$row=mysqli_fetch_array($res);

  	$res2=mysqli_query($bd,"SELECT acpinid FROM pin_kyc where acpinid='$kyc_pin' and status='N'");
  	$row2=mysqli_fetch_array($res2);
  	if (!empty($row2['acpinid'])) {
  		
  if ($row2['acpinid']==$kyc_pin) {   
	if (mysqli_query($bd,"UPDATE user SET tempvalue2=$kyc_pin WHERE id='$x'")) {
			//echo mysqli_error($bd);
		mysqli_query($bd,"UPDATE pin_kyc SET status='Y' WHERE acpinid='$kyc_pin'");
			echo "<script>alert('You have successfully activated kyc.')</script>";
			echo "<script>window.location='profile.php'</script>";
		}else
		{
			echo mysqli_error($bd);
			echo "<script>alert('Sorry something went wrong.')</script>";
		}	
	}
}else
{
	echo "<script>alert('Sorry your pin is wrong.')</script>";
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
            <h1>KYC Pin </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">KYC Pin</li>
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
                KYC Pin
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

            	<form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
				
				  <div class="form-group">
                    <label for="exampleInputEmail1">Approval From</label>
                    <div class="icheck-success d-inline">
                        Administrator <input type="radio" name="adminto" checked id="radioSuccess1" value="Administrator">
                        <label for="radioSuccess1">
                        </label>
                      </div>
                  </div>                	

                  <div class="form-group">                      
                  	<label>Enter KYC Pin</label>
                  	<input type="text" name="kyc_pin" class="form-control" required placeholder="Enter your user kyc pin">
                  </div>
                 <!--  <div class="form-group">
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
                  </div>  -->                
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>

            </div>
        </div>
    </div>
</div>
</section>
</div>




<?php
include 'footer.php';
?>