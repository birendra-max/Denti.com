<?php
include 'header.php';

if (isset($_POST['submit'])) {
  extract($_POST);

   $des=$_POST['des'];
   if (isset($_FILES['image']['name'])) {
     
$name = $_FILES['image']['name'];
$tmp_name =  $_FILES['image']['tmp_name'];
$location = "images/";
$new_name = $location.time()."-".rand(1000, 9999)."-".$name;
$tdate=date("d/m/Y");
if (move_uploaded_file($tmp_name, $new_name)){
  mysqli_query($bd,"UPDATE product_item SET image='$new_name' WHERE id=$iddd");
}
   }

  if (mysqli_query($bd,"UPDATE product_item SET p_type='$pname',name='$proname',feature='$des',amount='$price',discount='$discount',bv='$bv' WHERE id=$iddd")) {
    echo "<script>alert('Product item is updated successfully.')</script>";
  }else
  {
    //echo "<script>alert('Sorry something went wrong.')</script>";
      echo "error".mysqli_error($bd);
  }
  echo "<script>window.location='listproduct.php'</script>";

}

?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update Product</li>
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
			                <h3 class="card-title">Update Product</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<hr>
			              	<h2 class="text-center"><b>Update Product</b></h2>
			              	<hr>
                      <?php 
                      $idd=$_GET['idd'];
                      $rr1=mysqli_query($bd,"SELECT * FROM product_item WHERE id=$idd");
                      $row1=mysqli_fetch_assoc($rr1);
                      ?>
                        <form action="" method="post" enctype="multipart/form-data">
                          <input type="hidden" name="iddd" value="<?php echo $idd ?>">
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
                                         <option value="<?php echo $row['name'] ?>" <?php if($row['name']==$row1['p_type']) echo "selected"; ?>><?php echo $row['name'] ?></option>
                                            <?php
                                         }
                                         ?>                     
                                      </select>
                                   </div>
                              <div class="form-group">
                                <label>Product Name</label>             
                                <input type="text" name="proname" class="form-control" value="<?php echo $row1['name'] ?>" required>
                              </div>
                             <div class="form-group">
                                <label>Price</label>                  
                                <input type="text" name="price" class="form-control" value="<?php echo $row1['amount'] ?>" required>
                             </div>
                             <div class="form-group">
                                <label>Discount</label>                  
                                <input type="text" name="discount" class="form-control" value="<?php echo $row1['discount'] ?>" required>
                             </div>
                             <div class="form-group">
                                      <label>BV</label>                  
                                      <input type="text" name="bv" class="form-control" value="<?php echo $row1['bv'] ?>" >
                                   </div>

                              <div class="form-group">
                                <label>Image</label>            
                                <input type="file" name="image" class="form-control">
                                <img src="<?php echo $row1['image'] ?>" style="width:150px;height: 150px;">
                              </div>
                              <div class="form-group">
                                <label>Feature</label>            
                                <textarea name="des" class="form-control"><?php echo $row1['feature'] ?></textarea>
                              </div>

                              <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-success" value="Update">            
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