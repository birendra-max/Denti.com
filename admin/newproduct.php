<?php
include 'header.php';



if (isset($_POST['submit'])) {
  extract($_POST);
   $des=$_POST['des'];
$name = $_FILES['image']['name'];
$tmp_name =  $_FILES['image']['tmp_name'];
$location = "images/";
$new_name = $location.time()."-".rand(1000, 9999)."-".$name;
$tdate=date("d/m/Y");
if (move_uploaded_file($tmp_name, $new_name)){

  if (mysqli_query($bd,"INSERT INTO product_item(name,feature,image,amount,discount,p_type,todaydate,bv) VALUES('$proname','$des','$new_name','$price','$discount','$pname','$tdate','$bv')")) {
    echo "<script>alert('Product item is uploaded successfully.')</script>";
  }else
  {
    //echo "<script>alert('Sorry something went wrong.')</script>";
      echo "error".mysqli_error($bd);
  }
}else
{
  echo "<script>alert('Image can not be uploaded.')</script>";
}

}

if (isset($_GET['idd'])) {
  $id=$_GET['idd'];
  if (mysqli_query($bd,"DELETE FROM product_item WHERE id=$id")) {
    echo "<script>alert('You have deleted successfully.')<script>";
    echo "<script>window.location='product.php'<script>";
  }else
  {
    echo "<script>alert('Sorry can not be deleted.')<script>";
    echo "<script>window.location='product.php'<script>";
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
            <h1>Upload New Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Upload New Product</li>
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
			                <h3 class="card-title">Upload New Product</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<hr>
			              	<h2 class="text-center"><b>Upload New Product</b></h2>
			              	<hr>

                        <form action="" method="post" enctype="multipart/form-data">
                          <div class="row">
                            <div class="col-sm-2">          
                            </div>        
                            <div class="col-sm-8">          
                                   <div class="form-group">   
                                      <label>Product Type</label>                  
                                      <select name="pname" class="form-control" required>
                                         <option value="">Select Product Type</option>
                                         <?php 
                                         $rr=mysqli_query($bd,"SELECT * FROM product_type");
                                         while ($row=mysqli_fetch_assoc($rr)) {
                                            ?>
                                         <option value="<?php echo $row['name'] ?>"><?php echo $row['name'] ?></option>
                                            <?php
                                         }
                                         ?>                     
                                      </select>
                                   </div>
                              <div class="form-group">
                                <label>Product Name</label>             
                                <input type="text" name="proname" class="form-control" required>
                              </div>
                                   <div class="form-group">
                                      <label>Price</label>                  
                                      <input type="text" name="price" class="form-control" required>
                                   </div>
                                   <div class="form-group">
                                      <label>Discount</label>                  
                                      <input type="text" name="discount" class="form-control" required>
                                   </div>
                                   <div class="form-group">
                                      <label>BV</label>                  
                                      <input type="text" name="bv" class="form-control" required>
                                   </div>

                              <div class="form-group">
                                <label>Image</label>            
                                <input type="file" name="image" class="form-control" required>
                              </div>
                              <div class="form-group">
                                <label>Feature</label>            
                                <textarea name="des" class="form-control"></textarea>
                              </div>

                              <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-success" value="Upload">            
                              </div>
                            </div>        
                          </div>
                          </form>


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