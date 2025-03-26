<?php
include 'header.php';
if (isset($_POST['submit'])) {
  extract($_POST);
  if (!empty($_FILES['logo']['name'])) {

    $name = $_FILES['logo']['name'];
    $tmp_name =  $_FILES['logo']['tmp_name'];
    $location = "images/";
    $new_name = $location . time() . "-" . rand(1000, 9999) . "-" . $name;
    if (move_uploaded_file($tmp_name, $new_name)) {
      if (mysqli_query($bd, "UPDATE profile SET logo='$new_name' WHERE id=1")) {
      }
    } else {
      echo "<script>alert('logo Can not be uploaded.')</script>";
    }
  }

  if (mysqli_query($bd, "UPDATE profile SET cname='$cname',email='$email',mobile='$mobile',address='$address',state='$state',city='$city',pin='$pin',todaydate='$todaydate',person='$person' WHERE id=1")) {
    echo "<script>alert('Profile is updated successfully.')</script>";
  } else
    echo "<script>alert('Sorry something went wrong.')</script>";
}
$rr = mysqli_query($bd, "SELECT * FROM profile WHERE id=1");
$row = mysqli_fetch_assoc($rr);
?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Update Company Details</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Fill Form</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Comapny Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Company Name</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="cname" placeholder="Enter company name" value="<?php echo $row['cname'] ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">E-Mail</label>
                  <input type="email" name="email" class="form-control" id="exampleInputPassword1" placeholder="Enter E-Mail" value="<?php echo $row['email'] ?>">
                  <input type="hidden" name="todaydate" value="<?php echo date('d-m-Y') ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Mobile No.</label>
                  <input type="text" name="mobile" class="form-control" id="exampleInputPassword1" placeholder="Enter mobile" value="<?php echo $row['mobile'] ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Contact Person</label>
                  <input type="text" name="person" class="form-control" id="exampleInputPassword1" placeholder="Enter person" value="<?php echo $row['person'] ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Address</label>
                  <input type="text" name="address" class="form-control" id="exampleInputPassword1" placeholder="Enter Address" value="<?php echo $row['address'] ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">City</label>
                  <input type="text" name="city" class="form-control" id="exampleInputPassword1" placeholder="Enter City" value="<?php echo $row['city'] ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">State</label>
                  <input type="text" name="state" class="form-control" id="exampleInputPassword1" placeholder="Enter State" value="<?php echo $row['state'] ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">pin</label>
                  <input type="text" name="pin" class="form-control" id="exampleInputPassword1" placeholder="Enter Pin" value="<?php echo $row['pin'] ?>">
                </div>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
              </div>
              <!-- /.card-body -->


            </div>
            <!-- /.card -->
          </div>

          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Comapny Logo</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <div class="card-body bg-black">
                <div class="form-group">
                  <label for="exampleInputFile">Logo</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="logo" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                  </div>

                </div>
                <?php
                if (!empty($row['logo'])) {
                ?>
                  <img src="../public/images/dentigologo.png" width="150" height="150">
                <?php
                }
                ?>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary" name="submit">Save</button>
              </div>
            </div>
          </div>

        </div>
      </form>
    </div>
  </section>
</div>



<?php
include 'footer.php';
?>