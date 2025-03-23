<?php
include 'header.php';
if (isset($_POST['submit'])) {

	$amount=$_POST['amount'];
	$quantity=$_POST['quantity'];
	$id=$_POST['idd'];
	$str="";
  for($i=1;$i<=$quantity;$i++)
  {
    $rr=mysqli_query($bd,"SELECT max(ID) as pii FROM pin");
    $row=mysqli_fetch_assoc($rr);
    $idd=$row['pii'];    
    $n=rand(100,999);
    $acpin=$idd.$n;
    $str=$str.",".$acpin;
    mysqli_query($bd,"INSERT INTO pin(acpinid,status,sale,amount) VALUES('$acpin','N','Y','$amount')");
  }

		$tdate=date("m/d/Y");
	if (mysqli_query($bd,"UPDATE pinr SET pinno='$str',status='Y',appdate='$tdate' WHERE id=$id")) {
			//echo mysqli_error($bd);
			echo "<script>alert('You have generated successfully.')</script>";
			echo "<script>window.location='rpin.php'</script>";
		}else
		{
			//echo mysqli_error($bd);
			echo "<script>alert('Sorry something went wrong.')</script>";
			echo "<script>window.location='rpin.php'</script>";
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
            <h1>Generate Pin </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pin Generation</li>
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
                Pin Generate
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

            	<form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
			             	<?php
			             	$id=$_GET['id'];
			             	$rr=mysqli_query($bd,"SELECT * FROM pinr WHERE id=$id");
			             	$row=mysqli_fetch_assoc($rr);
			             	?>
                  <div class="form-group">                      
                  	<label>Select Package</label>
                  	<input type="hidden" name="idd" value="<?php echo $id?>">
	                <input type="text" class="form-control" id="exampleInputPassword1" name="amount" placeholder="amount" value="<?php echo $row['package'] ?>">  
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Quantity</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="quantity" placeholder="quantity" value="<?php echo $row['quantity'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Slip Image</label>
                    <div class="input-group">
                    <a href="../<?php echo $row['image'] ?>">
                   		<img src="../<?php echo $row['image']?>" width="100" height="100">
                   	</a>
                    </div>
                  </div>                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Generate Now</button>
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
