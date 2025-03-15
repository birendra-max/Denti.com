<?php
include '../../connect.php';
    $rrp=mysqli_query($bd,"SELECT * FROM profile WHERE id=1");
  $rowp=mysqli_fetch_assoc($rrp);
  
  if(isset($_POST['submit']))
  {
      $email=$_POST['email'];
      
      $rr=mysqli_query($bd,"SELECT * FROM user WHERE em='$email'");
      $row=mysqli_fetch_assoc($rr);
      if($row['em']!='')
      {
          echo "<script>alert('entry')</script>";
          
          $pas=$row['password'];
          
          	   $to =$email;
         $subject = "Password Recovery From".  $rowp['title'];
         
         $message = "<h3><b>Your password is $pas.</b></h3>";
         
         $header = "From:himanshupandey.9000@gmail.com \r\n";
         $headers .= "Reply-To: himanshupandey.9000@gmail.com\r\n";
         $headers .= "Return-Path: himanshupandey.9000@gmail.com\r\n";
         $header .= "Cc:himanshupandey.9000@gmail.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "<script>alert('Password has been sent to registered email ...')</script>";
         }else {
            echo "<script>alert('Message could not be sent...')";
         }
		
	echo "<script>window.location=''</script>";
          
      }else
      {
          echo "<script>alert('Email is not registred or matched.')</script>";
          
      }
  }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
      <title><?php echo $rowp['cname'] ?> | Forgot Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="http://mriduproduction.in/login/pages/examples/login.php"><b><?php echo $rowp['cname'] ?></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.(<b>Password will send to registered email</b>)</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="../../">Login</a>
      </p>
      <p class="mb-0">
        <a href="../../signup.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
