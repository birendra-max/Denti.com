<?php
include 'header.php';
$x=$_SESSION['id'];
if (isset($_POST['submit'])) {
		
	extract($_POST);
	$pin=$_POST['pin'];
	$mainid=$_POST['mainid'];
	$rr=mysqli_query($bd,"SELECT * FROM pinr WHERE id=$mainid");
	$row=mysqli_fetch_assoc($rr);
	$nnp=$row['pinno'];
	$nnp=str_replace($pin,"$pin Transfered",$nnp);
	mysqli_query($bd,"UPDATE pinr SET pinno='$nnp' WHERE id=$mainid");

		$tdate=date("m/d/Y");
	if (mysqli_query($bd,"INSERT INTO pintransfer(toid,fromid,pin,amount,status,todaydate)VALUES('$tomid','$x','$pin','$amount','N','$tdate')")) {
			//echo mysqli_error($bd);

			echo "<script>alert('You have tranfered successfully.')</script>";
			echo "<script>window.location='lpin.php'</script>";
		}else
		{
			//echo mysqli_error($bd);
			echo "<script>alert('Sorry something went wrong.')</script>";
			echo "<script>window.location='lpin.php'</script>";
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
              <li class="breadcrumb-item active">Pin Transfer</li>
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
                Transfer Pin
              </h3><a href="lpin.php" class="btn btn-danger" style="float: right;">Back</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

            	<form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
				
				  <div class="form-group">
                    <label for="exampleInputEmail1">Transfer To</label>        
                    <input type="hidden" name="mainid" value="<?php echo $_GET['mainid'] ?>">           
                    	<input type="text" class="form-control" id="exampleInputPassword1" name="tomid" onblur="show_name(this.value)" placeholder="user id" required>              	
                  </div>
				  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <div id="txtHint">
                    	<input type="text" class="form-control" id="exampleInputPassword1" name="name" placeholder="name" required>
                    </div>
                  </div>  
                   <div class="form-group">                      
                  	<label>Pin</label>	 
                  	<input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $_GET['tpin'] ?>" readonly>                     		
                  	<input type="hidden" name="pin" value="<?php echo $_GET['tpin'] ?>">                     	
                  </div>  
                  <div class="form-group">                      
                  	<label>Amount</label>	 
                  	<input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $_GET['amount'] ?>" readonly>              	
                  	<input type="hidden" name="amount" value="<?php echo $_GET['amount'] ?>">                     
                  </div>                
                            
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Transfer</button>
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

<script type="text/javascript">
	function show_name(str) {
  if (str.length == 0) {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "getname.php?q=" + str, true);
    xmlhttp.send();
  }
}
</script>