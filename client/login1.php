<?php
include 'connect.php';

$rrp = mysqli_query($bd, "SELECT * FROM profile WHERE id=1");
$rowp = mysqli_fetch_assoc($rrp);

if (isset($_POST['submit'])) {
    // Function to sanitize values received from the form to prevent SQL injection
    function clean($bd, $str) {
        $str = trim($str);
        return mysqli_real_escape_string($bd, $str);
    }

    // Array to store validation errors
    $errmsg_arr = array();

    // Validation error flag
    $errflag = false;

    // Sanitize the POST values
    $username = clean($bd, $_POST['id']);
    $password = clean($bd, $_POST['password']);

    // Input Validations
    if ($username == '') {
        $errmsg_arr[] = 'Username missing';
        $errflag = true;
    }
    if ($password == '') {
        $errmsg_arr[] = 'Password missing';
        $errflag = true;
    }

    // If there are input validations, redirect back to the login form
    if ($errflag) {
        $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
        session_write_close();
        ?>
        <script>window.location="index.php";</script>
        <?php
        exit();
    }

    // Create query
    $qry = "SELECT * FROM user WHERE em='$username' AND password='$password' AND acpinid='1'";
    $result = mysqli_query($bd, $qry);

    // Check whether the query was successful or not
    if (mysqli_num_rows($result) > 0) {
        // Login Successful
        session_regenerate_id();
        $member = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $member['id'];
        $_SESSION['userid'] = $member['userid'];
        $_SESSION['email'] = $member['em'];
        $_SESSION['labname'] = $member['labname'];
        $_SESSION['user_type'] = "client";
        $_SESSION['name'] = $member['name'];
        $_SESSION['status'] = $member['status'];

        if (isset($_SESSION['pname'])) {
            $pname = $_SESSION['pname'];
            $pprice = $_SESSION['pprice'];
            $imag = $_SESSION['imag'];
            $tdate = date("m/d/Y");
            mysqli_query($bd, "INSERT INTO product(mid, name, price, tdate, status, imag) VALUES('$username', '$pname', '$pprice', '$tdate', 'N', '$imag')");
        }

        session_write_close();
        ?>
        <script>window.location="index.php";</script>
        <?php
        exit();
    } else {
        // Login failed
        $errmsg_arr[] = 'Username and password not found';
        $errflag = true;
        if ($errflag) {
            $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
            session_write_close();
            ?>
            <script>
                alert('Username Or Password Invalid');
                window.location="index.php";
            </script>
            <?php
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Client Login | Panel</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
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
<section class="vh-100" style="background-color: #87CEEB;">
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

                                <form action="login.php" method="post">

                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <img src="pages/examples/logo.png"
                                             class="img-fluid h-100" alt="Logo" style="width: 100px;height: 75px;">
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Client Portal</h5>

                                    <div class="form-outline mb-4">
                                        <input type="email" id="form2Example17" name="id" class="form-control form-control-lg" placeholder="Enter Email ID" />
                                        <label class="form-label" for="form2Example17">Email address</label>
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
</section>
</html>