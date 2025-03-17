<?php
include 'header.php';
if (isset($_GET['idd'])) {
  $id=$_GET['idd'];
  mysqli_query($bd,"DELETE FROM product_type WHERE id=$id");
  //echo "hello";
  if (true) {
    echo "<script>alert('You have deleted successfully.')<script>";
    echo "<script>window.location='producttype.php'<script>";
  }else
  {
    echo "<script>alert('Sorry can not be deleted.')<script>";
    echo "<script>window.location='producttype.php'<script>";
  }
}
if (isset($_POST['submit'])) {
  extract($_POST);

$name = $_FILES['image']['name'];
$tmp_name =  $_FILES['image']['tmp_name'];
$location = "images/";
$new_name = $location.time()."-".rand(1000, 9999)."-".$name;
$tdate=date("d/m/Y");

if (move_uploaded_file($tmp_name, $new_name)){

  if (mysqli_query($bd,"INSERT INTO product_type(name,image,todaydate) VALUES('$pname',' $new_name','$tdate')")) 
   {
    echo "<script>alert('Product type is uploaded successfully.')</script>";
  }else
  {
    echo "<script>alert('Sorry something went wrong.')</script>";
  }
}else
{
  echo "<script>alert('File can not be uploaded.')</script>";
}
}


//echo "<script>window.location='producttype.php'<script>";

?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create New Product Type</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">New Product Type</li>
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
			                <h3 class="card-title">New Product Type</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<hr>
			              	<h2 class="text-center"><b>New Product Type</b></h2>
			              	<hr>

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                              <div class="col-sm-2">          
                              </div>        
                              <div class="col-sm-8">          
                                <div class="form-group">
                                  <label>Product Type Name</label>            
                                  <input type="text" name="pname" class="form-control" required>
                                </div>
                                <div class="form-group">
                                  <label>Image</label>            
                                  <input type="file" name="image" class="form-control" required>
                                </div>          
                                <div class="form-group">
                                  <input type="submit" name="submit" class="btn btn-success" value="Upload">            
                                </div>
                              </div>        
                            </div>
                            </form>
                          </div>
                          <br><br><br><br><br>
                          <div class="table table-responsive">
                            <table class="table table-bordered table-striped" style="zoom:70% !important">
                              <thead>
                                <th>Sr.No.</th>
                                <th>Product Type</th>           
                                <th>Image</th>
                                <th>Action</th>
                              </thead>        
                              <tbody>
                                <?php 
                                $c=1;
                              $rr=mysqli_query($bd,"SELECT * FROM product_type");
                              while ($row=mysqli_fetch_assoc($rr)) {
                                ?>
                                <tr>
                                <td><?php echo $c++; ?></td>
                                <td><?php echo $row['name'] ?></td>         
                                <td><img src="<?php echo $row['image'] ?>" width="150" height="150"></td>
                                <td> <a href="producttype.php?idd=<?php echo $row['id'] ?>" class="btn btn-success">  <span class="fas fa-trash"></span> </a> </td>
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