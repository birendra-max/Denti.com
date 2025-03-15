<?php
include 'header.php';
$idd=$_GET['idd'];
$rr=mysqli_query($bd,"SELECT * FROM product_item WHERE id=$idd");
$row=mysqli_fetch_assoc($rr);

?>

<style type="text/css"> 

  .sty
  {
    box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.5);
    padding: 25px;    
    border-radius: 2%;
    margin:25px;
  }
  .sty:hover
  {
    box-shadow: 4px 4px 8px 8px rgba(0,0,0,0.8);
    transition: 0.2s ease-out;
  }
</style>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">About : <?php echo $row['name'] ?></li>
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
                      <h3 class="card-title">Product List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <hr>
                      <h2 class="text-center"><b><?php echo $row['name'] ?></b></h2>
                      <hr>
                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        
                        <div class="col-sm-4">
                             <center>
                              <img src="admin/<?php echo $row['image'] ?>" width="250" height="250"><br>
                              <h4 style="color:#000;font-size: 22px;font-weight: bold;"><?php echo $row['name'] ?></h4><br>   
                              <h5 style="color:green;font-size: 22px;"> Price <i class="fas fa-rupee-sign"></i> <?php echo $row['amount'] ?></h5><br>
                              <hr>
                              <div class="row">
                                  
                                <div class="col-sm-12">
                                  <p><?php echo $row['feature'] ?></p>
                                </div>
                              </div>
                              <hr>
                              <div class="row">
                                <div class="col-sm-12">
                                  <p>Type : <?php echo $row['p_type'] ?></p>
                                </div>
                              </div><hr>
                              <div class="row">
                                <div class="col-sm-12">
                                  <p>Discount : <?php echo $row['discount'] ?></p>
                                </div>
                              </div>
                              </center>
                        </div>
                        
                    </div>
                    <?php 
                    
                    
                    ?>
                        
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