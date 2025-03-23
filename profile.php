<?php
include 'header.php';
//$username=$_SESSION['username'];
  $res=mysqli_query($bd,"SELECT * FROM user where id='$x' ");
  $rowp1=mysqli_fetch_array($res);
  // if ($row['tempvalue2']==0) {    
  //   //echo "<script>alert('Please  ');</script>";
  //   echo "<script>window.location='kyc_pin.php'</script>";
  // }
?>
<!-- Trigger the modal with a button -->
<?php
// Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
      $id = trim($_POST['mid']);
    $name = mysqli_real_escape_string($bd, $_POST['name']);
    // $designation = mysqli_real_escape_string($bd, $_POST['designation']);
    // $mobile = mysqli_real_escape_string($bd, $_POST['mobile']);
    // $labname = mysqli_real_escape_string($bd, $_POST['labname']);
    // $contact = mysqli_real_escape_string($bd, $_POST['contact']);
    // $occlusion = mysqli_real_escape_string($bd, $_POST['occlusion']);
    // $anatomy = mysqli_real_escape_string($bd, $_POST['anatomy']);
    // $pontic = mysqli_real_escape_string($bd, $_POST['pontic']);
    $remark = mysqli_real_escape_string($bd, $_POST['remark']);

    // Update the user details
    $query = "UPDATE user SET 
        name = '$name',
        remark = '$remark'
        WHERE em ='$id'";

    if (mysqli_query($bd, $query)) {
        // Redirect back to the profile page with a success message
        echo "<script> alert('Profile is updated.'); window.location='profile.php'</script>";
      } else {
        echo "Error: " . mysqli_error($bd);
    }
}
?>

<?php
if (isset($_FILES['profile_pic']) && isset($_POST['client_id'])) {
    $clientId = $_POST['client_id'];
    $uploadDir = 'images/';
    $uploadFile = $uploadDir . basename($_FILES['profile_pic']['name']);
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

    // Check if image file is a valid image type
    $check = getimagesize($_FILES['profile_pic']['tmp_name']);
    if ($check !== false) {
        // Move uploaded file to target directory
        if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $uploadFile)) {
            // Update profile picture path in the database
            $query = "UPDATE user SET pic = '$uploadFile' WHERE em = '$clientId'";
            $result = mysqli_query($bd, $query);

            if ($result) {
                // Redirect back to profile page with success message
                echo "<script> alert('Profile picture updated'); window.location='profile.php'</script>";
            } else {
                echo "<script> alert('Error updating profile picture in the database.')</script>";
            }
        } else {
            echo "<script> alert('Error uploading file.')</script>";
        }
    } else {
        echo "<script> alert('File is not an image.</script>";
    }
}
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"  >
    <!-- Content Header (Page header) -->
    <section class="content-header" >
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile <?php echo $rowp['name'] ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $rowp['name'] ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" >
      <div class="container-fluid" >
        <div class="row">
          
          <!-- /.col -->
          <div class="col-md-6" style="font-weight: bold !important;box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.8), 0px 4px 8px rgba(255, 255, 255, 0.05);">
            <div class="card" >
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Personal Details</a></li>
                </ul>
              </div>
              <!-- /.card-header -->
              <div class="card-body" >
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <form action="" method="post">
                      <input type="hidden" name="mid" value="<?php echo $rowp['em'] ?>">

                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName" value="<?php echo $rowp1['em'] ?>" readonly>
                          </div>
                        </div>
                      <!-- Name -->
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" name="name" value="<?php echo $rowp1['name'] ?>" required>
                        </div>
                      </div>

                      <!-- Designation -->
                     

                      <!-- Remarks -->
                      <div class="form-group row">
                        <label for="inputRemarks" class="col-sm-2 col-form-label">Remarks</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" name="remark" required><?php echo $rowp1['remark'] ?></textarea>
                        </div>
                      </div>

                      <!-- Submit Button -->
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" name="submit" class="btn btn-success">Save</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-sm-6" style="font-weight: bold !important;box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.8), 0px 4px 8px rgba(255, 255, 255, 0.05);">
            <div class="card card-primary card-outline">
                <div class="card-body box-Edit Client Details" >
                    <div class="text-center">
                        <?php 
                        if ($rowp1['pic'] == '') {
                            ?>
                            <img class="profile-user-img img-fluid img-circle"
                                src="dist/img/avatar.png"
                                alt="User profile picture">
                            <?php
                        } else {
                            ?>
                            <img class="profile-user-img img-fluid img-circle" 
                                src="../<?php echo $rowp1['pic'] ?>" 
                                alt="User profile picture">
                            <?php
                        }
                        ?>
                    </div>

                    <h3 class="profile-username text-center"><?php echo $rowp1['name'] ?></h3>

                    <p class="text-muted text-center">Client Details</p>

                    <ul class="list-group list-group-unbordered mb-3" >
                        <li class="list-group-item"  >
                            <b>Client Details ID</b> <a class="float-right"><?php echo $rowp1['id'] ?></a>
                        </li>
                        <li class="list-group-item" >
                            <b>Joining Date</b> <a class="float-right"><?php echo date("d-M-Y", strtotime($rowp1['todaydate'])) ?></a>
                        </li>
                    </ul>

                    <?php
                    if ($rowp1['acpinid'] != 0) {
                        ?>
                        <a href="#" class="btn btn-success btn-block"><b>Activated</b></a>
                        <?php
                    } else {
                        ?>
                        <a href="#" class="btn btn-danger btn-block"><b>Not Active</b></a>
                        <?php
                    }
                    ?>

                    <!-- Form to upload a new profile picture -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="profilePicInput">Change Profile Picture</label>
                            <input type="file" name="profile_pic" id="profilePicInput" class="form-control">
                        </div>
                        <input type="hidden" name="client_id" value="<?php echo $rowp['em']; ?>">
                        <button type="submit" class="btn btn-primary btn-block"><b>Upload New Picture</b></button>
                    </form>
                </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php
include 'footer.php';
?>