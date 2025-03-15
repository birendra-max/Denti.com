<?php
include 'header.php';
$id=$_GET['id'];
$rr=mysqli_query($bd,"SELECT * FROM user WHERE id='$id'");
$row=mysqli_fetch_assoc($rr);

if (isset($_POST['submit'])) {
  extract($_POST);
  $tdate=date("m/d/Y");
  if ($w<$bal) {    
  if (mysqli_query($bd,"INSERT INTO weekly(mid,name,amount,todaydate,ref)VALUES('$mid','$name','$w','$tdate','$ref')")) {
    echo "<script>alert('You have payout successfully.')</script>";
    echo "<script>window.location='weeklyp.php'</script>";
    }else{
      echo "<script>alert('Sorry query is not executed.')</script>";
      echo "<script>window.location='weeklyp.php'</script>";
    } 
  }else
  {
    echo "<script>alert('Your Withdrwal amount is greater than available balance.try again.')</script>";
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
            <h1>Payout - <?php echo $row['id'] ?> -  <?php echo $row['name'] ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Payout - <?php echo $row['id'] ?> -  <?php echo $row['name'] ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

			    <section class="content">
			      <div class="container-fluid">
			        <div class="row">
			          <div class="col-12">
			            <div class="card">
			              <div class="card-header">
			                <h3 class="card-title">User Pair Income</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
                      <hr>
			              	<h2 class="text-center"><b>Payout - <?php echo $row['id'] ?> -  <?php echo $row['name'] ?></b></h2>
                      <hr>
                      <form action="" method="post">
                        <div class="row">
                          <div class="col-sm-2">    
                          </div>  
                          <div class="col-sm-8">    
                            <div class="row">
                              <div class="col-sm-4">

                                <label>Name</label>       
                                <input type="hidden" name="mid" value="<?php echo $row['id'] ?>">
                                <input type="text" value="<?php echo $row['name'] ?>" class="form-control" readonly>
                                <input type="hidden" name="name" value="<?php echo $row['name'] ?>">
                              </div>
                              <div class="col-sm-4">
                                <label>Father Name</label>        
                                <input type="text" value="<?php echo $row['fathername'] ?>" class="form-control" readonly>        
                              </div>
                              <div class="col-sm-4">
                                <label>Mobile</label>       
                                <input type="text" value="<?php echo $row['mobile'] ?>" class="form-control" readonly>
                              </div>
                            </div>

                            <?php
                            $rk=mysqli_query($bd,"SELECT * FROM bank WHERE id='$id'");
                            $rowk=mysqli_fetch_assoc($rk);
                            ?>

                            <div class="row">
                              <div class="col-sm-4">
                                <label>Bank Name</label>        
                                <input type="text" value="<?php echo $rowk['bank'] ?>" class="form-control" readonly>       
                              </div>
                              <div class="col-sm-4">
                                <label>Bank A/C</label>       
                                <input type="text" value="<?php echo $rowk['account'] ?>" class="form-control" readonly>        
                              </div>
                              <div class="col-sm-4">
                                <label>Branch</label>       
                                <input type="text" value="<?php echo $rowk['branch'] ?>" class="form-control" readonly>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-4">
                                <label>IFSC Code</label>        
                                <input type="text" value="<?php echo $rowk['ifsc'] ?>" class="form-control" readonly>       
                              </div>
                            </div>





                            <div class="row">
                              <div class="col-sm-4">
                                <label>Balance</label>        
                                <input type="text" value="<?php echo $_GET['remain'] ?>" class="form-control" readonly>
                                <input type="hidden" name="bal" value="<?php echo $_GET['remain'] ?>">
                              </div>
                              <div class="col-sm-4">
                                <label>Withdrwal Amount</label>       
                                <input type="text" name="w" class="form-control" required>
                              </div>      
                              <div class="col-sm-4">
                                <label>Reference Number</label>       
                                <input type="text" name="ref" class="form-control" required>
                              </div>      
                            </div><br><br>
                            <div class="row">
                              <div class="col-sm-4"></div>
                              <div class="col-sm-4">
                                <input type="submit" name="submit" class="btn btn-success" value="Submit">
                              </div>
                            </div>
                          </div>
                        </div>
                        </form>



                  <hr>
                  <h3 class="text-center">Withdrawal Details of <?php echo $row['id'] ?> -  <?php echo $row['name'] ?></h3>
                  <hr>
                  <table  id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                          <th>Sr.No.</th>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Amount</th>
                          <th>Date</th>
                          <th>Reference</th>
                        </tr>
                      </thead>      
                      <tbody>
                        <?php
                        $i=1;
                        $sum=0;
                        $rr=mysqli_query($bd,"SELECT * FROM weekly WHERE mid='$id'");
                        while ($row=mysqli_fetch_assoc($rr)) {
                          ?>
                          <tr>
                          <td><?php echo $i++; ?></td>
                          <td><?php echo $row['mid'] ?></td>
                          <td><?php echo $row['name'] ?></td>
                          <td><?php echo $row['amount'] ?></td>
                          <?php
                          $sum=$sum+$row['amount'];
                          ?>
                          <td><?php echo date("d-M-Y",strtotime($row['todaydate']))?></td>
                          <td><?php echo $row['ref'] ?></td>
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
          </section>
        </div>





<?php
include 'footer.php';
?>