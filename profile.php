<?php
include 'header.php';
$res = mysqli_query($bd, "SELECT * FROM user WHERE id='$x' ");
$rowp1 = mysqli_fetch_array($res);
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

  $id = trim($_POST['mid']);
  $name = mysqli_real_escape_string($bd, $_POST['name']);
  $remark = mysqli_real_escape_string($bd, $_POST['remark']);
  $clientId = mysqli_real_escape_string($bd, $_POST['client_id']);
  $pass = mysqli_real_escape_string($bd, $_POST['pass_w']);

  $uploadDir = 'public/upload';
  $uploadFile = $uploadDir . basename($_FILES['profile_pic']['name']);
  $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

  if (!empty($_FILES['profile_pic']['name'])) {
    $check = getimagesize($_FILES['profile_pic']['tmp_name']);
    if ($check !== false) {
      if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $uploadFile)) {
        $query = "UPDATE user SET name = '$name', remark = '$remark', pic = '$uploadFile' ,password='$pass' WHERE user_id = '$clientId'";
      } else {
        echo "<script> alert('Error uploading the file.'); </script>";
      }
    } else {
      echo "<script> alert('The file is not a valid image.'); </script>";
    }
  } else {
    $query = "UPDATE user SET name = '$name', remark = '$remark', password='$pass' WHERE user_id = '$clientId'";
  }

  if (mysqli_query($bd, $query)) {
    echo "<script> alert('Profile updated successfully.'); window.location='profile.php'; </script>";
  } else {
    echo "<script> alert('Error updating profile. Please try again.'); </script>";
  }
}
?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Profile - <?php echo htmlspecialchars($rowp1['name']); ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><?php echo htmlspecialchars($rowp1['name']); ?></li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
              <h4>Personal Details</h4>
            </div>
            <div class="card-body">
              <form action="" method="post" enctype="multipart/form-data">
                <div class="text-center mb-4">
                  <?php
                  if ($rowp1['pic'] == '') {
                    echo '<img class="profile-user-img img-fluid img-circle" src="dist/img/avatar.png" alt="User profile picture">';
                  } else {
                    echo '<img class="profile-user-img img-fluid img-circle" src="' . htmlspecialchars($rowp1['pic']) . '" alt="User profile picture">';
                  }
                  ?>
                </div>

                <div class="form-group row">
                  <label for="client_id" class="col-sm-4 col-form-label">User ID</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="client_id" value="<?php echo htmlspecialchars($rowp1['user_id']); ?>" name="client_id" readonly>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputName" class="col-sm-4 col-form-label">Name</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="inputName" name="name" value="<?php echo htmlspecialchars($rowp1['name']); ?>" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputRemarks" class="col-sm-4 col-form-label">Remarks</label>
                  <div class="col-sm-8">
                    <textarea class="form-control" name="remark" required><?php echo htmlspecialchars($rowp1['remark']); ?></textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="profilePicInput" class="col-sm-4 col-form-label">Change Profile Picture</label>
                  <div class="col-sm-8">
                    <input type="file" name="profile_pic" id="profilePicInput" class="form-control">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputName" class="col-sm-4 col-form-label">Password</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="pass_w" name="pass_w" value="<?php echo htmlspecialchars($rowp1['password']); ?>" required>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="offset-sm-4 col-sm-8">
                    <button type="submit" name="submit" class="btn btn-success btn-block">Save Details</button>
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

<?php include 'footer.php'; ?>