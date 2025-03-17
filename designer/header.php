<?php
include('connect.php');
//echo $_SESSION['id'];die;

if (!isset($_SESSION['id'])  or $_SESSION['user_type'] != "designer") {
  header("Location: login.php");
}

$x = $_SESSION["id"];
$rrp = mysqli_query($bd, "SELECT * FROM user WHERE id='$x'");
$rowp = mysqli_fetch_array($rrp);
$rrcp = mysqli_query($bd, "SELECT * FROM profile WHERE id=1");
$rowcp = mysqli_fetch_assoc($rrcp);
$em = $_SESSION["email"];
$uri_name = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <link rel="shortcut icon" href="admin/<?php echo $rowcp['logo'] ?>" type="image/x-icon">

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->

  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">


  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

  <!-- CodeMirror -->
  <link rel="stylesheet" href="plugins/codemirror/codemirror.css">
  <link rel="stylesheet" href="plugins/codemirror/theme/monokai.css">
  <!-- SimpleMDE -->
  <link rel="stylesheet" href="plugins/simplemde/simplemde.min.css">

  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

  <!-- iCheck for checkboxes and radio inputs -->


  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="plugins/dropzone/min/dropzone.min.css">

  <link rel="stylesheet" href="../plugins/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <style type="text/css">
    ul>li:hover {
      background-color: rgba(0, 0, 0, 0.5) !important;
    }

    /*  ul>li>a
    {
    font-weight: bold !important;
    }*/
  </style>
  <script src="plugins/toastr/toastr.min.js"></script>
</head>

<body class="hold-transition layout-top-nav" style="zoom: 90%;">
  <div class="wrapper">



    <nav class="navbar navbar-expand-sm navbar-light bg-dark fixed-top" style="background-color:#F2F2F2 !important">
      <div class="container-fluid">
        <a class="navbar-brand text-success" href="#">
          <img src="../public/images/dentigologo.png" style="height: 50px;width: 150px">
        </a>
        <button class="navbar-toggler" type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse"></div>

        <div class="collapse navbar-collapse"
          id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item d-none d-sm-inline-block" <?php if ($uri_name == 'index.php' || $uri_name == 'index2.php' || $uri_name == 'index3.php' || $uri_name == 'index4.php' || $uri_name == 'index5.php' || $uri_name == 'index6.php' || $uri_name == 'index7.php' || $uri_name == 'index8.php' || $uri_name == 'index9.php' || $uri_name == 'index55.php') echo 'style="background-color:#FFF !important"' ?>>
              <a href="index.php" class="nav-link" <?php if ($uri_name == 'index.php' || $uri_name == 'index2.php' || $uri_name == 'index3.php' || $uri_name == 'index4.php' || $uri_name == 'index5.php' || $uri_name == 'index6.php' || $uri_name == 'index7.php' || $uri_name == 'index8.php' || $uri_name == 'index9.php' || $uri_name == 'index55.php') echo 'style="color:#FF8B13 !important"';
                                                    else echo 'style="color:#000 !important"' ?>>Dashboard</a>
            </li>

            <!-- <li class="nav-item d-none d-sm-inline-block" <?php if ($uri_name == 'donwline.php') echo 'style="background-color:#FFF !important"' ?>>
                      <a href="pagination.php?type=<?php echo base64_encode('All') ?>" class="nav-link" <?php if ($uri_name == 'donwline.php') echo 'style="color:#FF8B13 !important"';
                                                                                                        else echo 'style="color:#000 !important;font-weight:bold !important;"' ?> >Orders</a>
                    </li>   -->
            <li class="nav-item d-none d-sm-inline-block" <?php if ($uri_name == 'new_request.php') echo 'style="background-color:#FFF !important"' ?>>
              <a href="new_request.php" class="nav-link" <?php if ($uri_name == 'new_request.php') echo 'style="color:#FF8B13 !important"';
                                                          else echo 'style="color:#000 !important;font-weight:bold !important;"' ?>>File Upload Center</a>
            </li>

            <li class="nav-item d-none d-sm-inline-block" <?php if ($uri_name == 'msearch.php') echo 'style="background-color:#FFF !important"' ?>>
              <a href="msearch.php" class="nav-link" <?php if ($uri_name == 'msearch.php') echo 'style="color:#FF8B13 !important"';
                                                      else echo 'style="color:#000 !important;font-weight:bold !important;"' ?>>Multiple Search</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block" <?php if ($uri_name == 'report.php') echo 'style="background-color:#FFF !important"' ?>>
              <a href="report.php" class="nav-link" <?php if ($uri_name == 'report.php') echo 'style="color:#FF8B13 !important"';
                                                    else echo 'style="color:#000 !important;font-weight:bold !important;"' ?>>Reports</a>
            </li>
            <!--  <li class="nav-item d-none d-sm-inline-block"  <?php if ($uri_name == 'todayreport.php') echo 'style="background-color:#FFF !important"' ?>>
                      <a href="todayreport.php" class="nav-link" <?php if ($uri_name == 'todayreport.php') echo 'style="color:#FF8B13 !important"';
                                                                  else echo 'style="color:#000 !important;font-weight:bold !important;"' ?> >CW Report</a>
                    </li>  -->
            <li class="nav-item">
              <form class="form-inline ml-0 ml-md-3" method="post" action="search.php">
                <div class="input-group input-group-sm">
                  <input class="form-control form-control-navbar" type="text" name="orderid" placeholder="Search Orders" aria-label="Search">
                  <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
                <div class="input-group input-group-sm">
                  <input type="submit" name="submit" class="btn btn-success" value="Search" style="background-color:#FF8B13 !important">
                </div>
              </form>
            </li>
          </ul>

          <ul class="navbar-nav ml-auto">
            <li class="nav-item d-none d-sm-inline-block">
              <a href="logout.php" class="nav-link" style="color: #000 !important;font-weight:bold !important;">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div style="margin-top:80px"></div>


    <!-- /.navbar -->

    <!-- Main Sidebar Container -->