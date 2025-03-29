<?php
include 'connect.php'; // Including the database connection

if (isset($_POST['submit'])) {
  // Function to sanitize values received from the form to prevent SQL injection
  function clean($bd, $str)
  {
    $str = trim($str);
    return mysqli_real_escape_string($bd, $str);
  }

  // Sanitize the POST values
  $username = clean($bd, $_POST['id']);
  $password = clean($bd, $_POST['password']);

  // Validation: Check if username or password is missing
  if (empty($username) || empty($password)) {
    $_SESSION['ERRMSG_ARR'] = ['Username or Password is missing'];
    session_write_close();
    echo "<script>window.location='index.php';</script>";
    exit();
  }

  // Create query to check credentials
  $qry = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
  $result = mysqli_query($bd, $qry);

  // Check if the query was successful
  if ($result && mysqli_num_rows($result) > 0) {
    // Login successful
    $member = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $member['username'];
    session_write_close();
    echo "<script>window.location='index.php';</script>";
    exit();
  } else {
    // Login failed
    $_SESSION['ERRMSG_ARR'] = ['Username and password not found'];
    session_write_close();
    echo "<script>window.location='index.php';</script>";
    exit();
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login | Panel</title>
  <!-- Include required CSS and JS files -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="shortcut icon" href="public/images/dentigologo.png" type="image/x-icon">
  <style type="text/css">
    .divider:after,
    .divider:before {
      content: "";
      flex: 1;
      height: 1px;
      background: #eee;
    }

    .h-custom {
      height: calc(100% - 73px);
    }

    @media (max-width: 450px) {
      .h-custom {
        height: 100%;
      }
    }
  </style>
</head>

<body>
  <!-- <section class="vh-100" style="background-color: #87CEEB;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                  alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
                  <form action="" method="post">
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <img src="pages/examples/logo.png" class="img-fluid h-100" alt="Logo" style="width: 100px; height: 75px;">
                    </div>
                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Admin Portal</h5>
                    <div class="form-outline mb-4">
                      <input type="text" id="form2Example17" name="id" class="form-control form-control-lg" placeholder="ID" />
                      <label class="form-label" for="form2Example17">ID</label>
                    </div>
                    <div class="form-outline mb-4">
                      <input type="password" id="form2Example27" name="password" class="form-control form-control-lg" placeholder="Enter Password" />
                      <label class="form-label" for="form2Example27">Password</label>
                    </div>
                    <div class="pt-1 mb-4">
                      <input type="submit" name="submit" value="Login" class="btn btn-dark btn-lg btn-block">
                    </div>
                    <a class="small text-muted" href="#!">Forgot password?</a>
                    <a href="#!" class="small text-muted">Terms of use.</a>
                    <a href="#!" class="small text-muted">Privacy policy</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->


  <section>

    <style>
      body {
        background-color: #2c2c2c;
        /* Dark background for a modern look */
        color: #e0e0e0;
        /* Light text for better readability */
        font-family: Arial, sans-serif;
        /* Clean font */
      }

      .custom-container {
        background-color: rgb(0, 0, 0);
        /* Darker background for the container */
        padding: 2rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        /* Softer shadow */
      }

      .custom-input {
        background-color: #444;
        /* Dark input background */
        border: 1px solid #555;
        /* Darker border */
        color: #e0e0e0;
        /* Light text */
        height: 50px;
        /* Fixed height for consistency */
      }

      .custom-input::placeholder {
        color: #bbb;
        /* Placeholder color */
      }

      .custom-select {
        background-color: #444;
        /* Dark select background */
        border: 1px solid #555;
        /* Darker border */
        color: #e0e0e0;
        /* Light text */
      }

      .input-group-text {
        background-color: #444;
        /* Dark background for input group */
        border: 1px solid #555;
        /* Darker border */
        color: #e0e0e0;
        /* Light text */
        cursor: pointer;
        /* Pointer cursor for better UX */
      }

      .btn-primary {
        background-color: #007bff;
        /* Bootstrap primary color */
        border: none;
        /* Remove border */
        color: white;
        /* White text */
        padding: 10px 20px;
        /* Padding for button */
        border-radius: 0.25rem;
        /* Rounded corners */
        transition: background-color 0.3s;
        /* Smooth transition */
      }

      .btn-primary:hover {
        background-color: #0056b3;
        /* Darker shade on hover */
      }

      .text-primary {
        color: #007bff;
        /* Primary link color */
      }

      .text-primary:hover {
        text-decoration: underline;
        /* Underline on hover */
      }

      .footer-links a {
        color: #bbb;
        /* Lighter color for footer links */
        margin-right: 15px;
        /* Spacing between links */
      }

      .footer-links a:hover {
        text-decoration: underline;
        /* Underline on hover */
      }
    </style>

    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <div class="d-flex align-items-center justify-content-center min-vh-100">
      <div class="container custom-container w-100">
        <div class="row w-100">
          <div class="col-md-6 mb-4">
            <div class="d-flex align-items-center mb-3">
              <img alt="Google logo" class="mr-2" height="120" src="../public/images/dentigologo.png"
                width="170" />
            </div>
            <h1 class="h4 font-weight-bold">
              Login to Admin Portal
            </h1>
            <br>
            <p>
              Welcome Dentogolab, you can log in to your portal for sharing file.
            </p>

          </div>
          <div class="col-md-6">
            <h1 class="h4 font-weight-bold border-bottom border-5 border-cyan">
              Login
            </h1>
            <form action="login.php" method="post" class="py-2">

              <div class="form-group">
                <label for="user_name">
                  Email address
                </label>
                <input class="form-control custom-input" id="form2Example17" name="id"
                  placeholder="Enter your email id" type="email" required />
              </div>

              <div class="form-group">
                <label for="password">
                  Password
                </label>
                <div class="input-group">
                  <input class="form-control custom-input" id="form2Example27" name="password"
                    placeholder="Enter your password" type="password" required />
                  <div class="input-group-append">
                    <span class="input-group-text" onclick="togglePassword()">
                      <i id="password-icon" class="fas fa-eye-slash"></i>
                    </span>
                  </div>
                </div>
              </div>

              <div class="d-flex justify-content-between">
                <input class="btn btn-primary w-50" type="submit" name="submit" value="Login">
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="position-absolute footer-links" style="bottom: 1rem; right: 1rem;">
        <div class="d-flex">
          <a href="#">
            Help
          </a>
          <a href="#">
            Privacy
          </a>
          <a href="#">
            Terms
          </a>
        </div>
      </div>
    </div>
    <script>
      function togglePassword() {
        const passwordField = document.getElementById('form2Example27');
        const passwordFieldType = passwordField.getAttribute('type');
        const passwordIcon = document.getElementById('password-icon');

        if (passwordFieldType === 'password') {
          passwordField.setAttribute('type', 'text');
          passwordIcon.classList.remove('fa-eye-slash');
          passwordIcon.classList.add('fa-eye');
        } else {
          passwordField.setAttribute('type', 'password');
          passwordIcon.classList.remove('fa-eye');
          passwordIcon.classList.add('fa-eye-slash');
        }
      }
    </script>

  </section>
</body>

</html>