<?php
include 'header.php';
if (isset($_POST['submit'])) {

	$amount=$_POST['amount'];
	$quantity=$_POST['quantity'];
	$id=$_POST['idd'];
	$str="";
  $tdate=date("d-M-Y");
  for($i=1;$i<=$quantity;$i++)
  {
    $rr=mysqli_query($bd,"SELECT max(ID) as pii FROM pin_kyc");
    $row=mysqli_fetch_assoc($rr);
    $idd=$row['pii'];    
    $n=rand(100,999);
    $acpin=$idd.$n;
    $str=$str.",".$acpin;
    mysqli_query($bd,"INSERT INTO pin_kyc(acpinid,status,sale,amount,todaydate,sid) VALUES('$acpin','N','Y','$amount','$tdate','admin')");
    $f=true;
  }

		
	if ($f) {
			//echo mysqli_error($bd);
			echo "<script>alert('You have generated successfully.')</script>";
			echo "<script>window.location='rpin3.php'</script>";
		}else
		{
			//echo mysqli_error($bd);
			echo "<script>alert('Sorry something went wrong.')</script>";
			echo "<script>window.location='rpin3.php'</script>";
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
			             
                  <div class="form-group">                      
                  	<label>Amount</label>                  	
	                <input type="text" class="form-control" id="exampleInputPassword1" name="amount" placeholder="amount" >  
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Quantity</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="quantity" placeholder="quantity">
                  </div>
                <!--   <div class="form-group">
                    <label for="exampleInputFile">Slip Image</label>
                    <div class="input-group">
                    <a href="../<?php echo $row['image'] ?>">
                   		<img src="../<?php echo $row['image']?>" width="100" height="100">
                   	</a>
                    </div>
                  </div>  -->                
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Generate KYC PIN </button>
                </div>
              </form>

                  <div class="table table-responsive">
                    <table class="table table-bordered table-striped" style="zoom:70% !important">
                       <thead>
                        <tr>
                          <th>Sr.No</th>
                          <th>Pin</th>
                          <th>Status</th>
                          <th>Amount</th>                                                   
                          <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i=1;
                          $used=0;
                          $av=0;                          
                          $rr=mysqli_query($bd,"SELECT * FROM pin_kyc");
                          while ($row=mysqli_fetch_assoc($rr)) {
                              if ($row['status']=='Y') {
                              $used++;  
                              }else
                              {
                                $av++;
                              }
                            ?>
                            <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $row['acpinid'] ?></td>
                            <td><?php if($row['status']=='Y') 
                              echo "<p class='btn btn-danger'>Used</p>";
                              else
                                echo "<p class='btn btn-success'>Available</p>";

                            ?></td>
                            <td><?php echo $row['amount'] ?></td>
                            
                            <td><?php echo date("d-M-Y",strtotime($row['todaydate'])) ?></td> 
                            </tr>
                            <?php
                          }
                          ?>
                        </tbody>

                      
                    </table>
                    </div>
                    <h3 class="alert alert-success"> Available Pin : <?php echo $av; ?></h3>
                    <h3 class="alert alert-danger"> Used Pin : <?php echo $used; ?></h3>
                    <h3 class="alert alert-info"> Total Pin : <?php echo $av+$used; ?></h3>

            </div>
        </div>
    </div>
</div>
</section>
</div>




<?php
include 'footer.php';
?>
