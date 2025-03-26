<?php
include 'connect.php';
if (!isset($_SESSION['username'])) {
  header("Location:login.php");
}

$rrp = mysqli_query($bd, "SELECT * FROM profile WHERE id=1");
$rowp = mysqli_fetch_assoc($rrp);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Dentigo Designs | Dashboard</title>

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

  <link rel="shortcut icon" href="../public/images/dentigologo.png" type="image/x-icon">

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

  <!-- CodeMirror -->
  <link rel="stylesheet" href="plugins/codemirror/codemirror.css">
  <link rel="stylesheet" href="plugins/codemirror/theme/monokai.css">
  <!-- SimpleMDE -->
  <link rel="stylesheet" href="plugins/simplemde/simplemde.min.css">

  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">


</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index.php" class="nav-link">Dashboard</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="donwline.php" class="nav-link">Orders</a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
          <a href="index.php" class="nav-link">Reports</a>
        </li>
      </ul>


      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user" style="font-size:22px;margin-left: -30px;"></i>
            <span class="badge badge-warning navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">Super Admin</span>
            <div class="dropdown-divider"></div>
            <a href="profile.php" class="dropdown-item">
              <i class="fas fa-user mr-2"></i> Company Profile
              <span class="float-right text-muted text-sm">Personal</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="pass.php" class="dropdown-item">
              <i class="fas fa-key mr-2"></i> Change Password
              <span class="float-right text-muted text-sm">Protect</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="logout.php" class="dropdown-item">
              <i class="fas fa-sign-out-alt mr-2"></i> Logout
              <span class="float-right text-muted text-sm">Secure</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="index.php" class="dropdown-item dropdown-footer">Admin Panel</a>
          </div>
        </li>

      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #222d32 !important">
      <!-- Brand Logo -->
      <a href="index.php" class="brand-link">
        <img src="../public/images/dentigologo.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Dentigo Designs</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../public/images/dentigologo.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Super Admin</a>
          </div>
        </div>

        <style type="text/css">
          .nav-item {
            margin-bottom: 10px !important;
          }
        </style>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-item">
              <a href="index.php" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>


            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Company
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="profile.php" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>My Profile</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pass.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Change Password</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Backup & Delete
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="backup.php" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Backup & Delete</p>
                  </a>
                </li>

              </ul>
            </li>
            <li class="nav-item">
              <a href="assign.php" class="nav-link">
                <i class="nav-icon fas fa-user-plus"></i>
                <p>
                  Assign
                  <span class="right badge badge-danger">Assign</span>
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="news.php" class="nav-link">
                <i class="nav-icon fas fa-user-plus"></i>
                <p>
                  News
                  <span class="right badge badge-danger">New</span>
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="todayreport.php" class="nav-link">
                <i class="nav-icon fas fa-user-plus"></i>
                <p>
                  CW Report
                  <span class="right badge badge-danger">CW Report</span>
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="report.php" class="nav-link">
                <i class="nav-icon fas fa-user-plus"></i>
                <p>
                  Report
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="reportu.php" class="nav-link">
                <i class="nav-icon fas fa-user-plus"></i>
                <p>
                  Report By User
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="active_cases.php" class="nav-link">
                <i class="nav-icon fas fa-user-plus"></i>
                <p>
                  Active Cases
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="msearch.php" class="nav-link">
                <i class="nav-icon fas fa-user-plus"></i>
                <p>
                  Multiple Search
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="donwline.php" class="nav-link">
                <i class="nav-icon fas fa-user-plus"></i>
                <p>
                  Orders
                </p>
              </a>
            </li>

            <!-- <li class="nav-item">
            <a href="about.php" class="nav-link">
              <i class="nav-icon fas fa-user-plus"></i>
              <p>
                Company
                <span class="right badge badge-danger">About</span>
              </p>
            </a>
          </li> -->

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Client
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">3</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="new_client.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>New Client </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="allmember.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Client List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="aduser.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Activate/Deactivate Client </p>
                  </a>
                </li>
                <!--  <li class="nav-item">
                <a href="donwline.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Downline</p>
                </a>
              </li> -->

              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Designer
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">3</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="new_designer.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>New Designer</p>
                  </a>
                </li>
                <!--  <li class="nav-item">
                <a href="donwline.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Downline</p>
                </a>
              </li> -->
                <li class="nav-item">
                  <a href="allmemberd.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Designer List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="aduserd.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Activate/Deactivate Designer </p>
                  </a>
                </li>
              </ul>
            </li>

            <!--  <li class="nav-item">
            <a href="welcome.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Welcome Letter
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> -->

            <!--  <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                E-Pin
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="rpin.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Requested Pin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="lpin.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approved Pin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="tpin.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Transfer Pin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="ltpin.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Transfer Pin</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="pind.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pin Details</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="rpin3.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gen KYC Pin</p>
                </a>
              </li>

            </ul>
          </li>



            
    <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-money-bill-alt"></i>
              <p>
                Income Details
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="csmarti.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Calculate Smart Income</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="direct.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Direct Income</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="leadership.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Leadership Level Income</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pair.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Matching Income</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="smart1.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Smart First Income</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="smart2.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Smart Second Income</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="reward.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reward</p>
                </a>
              </li>              
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Repurchase Income</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="autopool.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Auto-None Working Income</p>
                </a>
              </li>             
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Car Fund</p>
                </a>
              </li>             
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>House Fund</p>
                </a>
              </li>             
            </ul>
          </li>


          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-credit-card"></i>
              <p>
                Payout
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                    <li class="nav-item">
                <a href="prequest.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payout Request</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="monthlyp.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pay</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="weeklyp.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Car Winner</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>House Winner</p>
                </a>
              </li>            
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shopping-bag"></i>
              <p>
                Product
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="producttype.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product Type</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="newproduct.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="listproduct.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Product</p>
                </a>
              </li>
             
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                E-Mail
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="inbox.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inbox</p>
                </a>
              </li>             
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shopping-basket"></i>
              <p>
                Repurchase
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Shop</p>
                </a>
              </li>           
            </ul>
          </li>

 -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-shopping-basket"></i>
                <p>
                  Slider
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="slider.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Upload Image</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  Logout
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="logout.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Signout</p>
                  </a>
                </li>
              </ul>
            </li>


            <!-- 
          <li class="nav-item">
            <a href="mriduproduct.php" class="nav-link">
              <i class="nav-icon fas fa-gift"></i>
              <p>
                Upload <?php echo $rowp['cname'] ?> Product
                
              </p>
            </a>
          </li>
          
          
             
          <li class="nav-item">
            <a href="mriduproduct1.php" class="nav-link">
              <i class="nav-icon fas fa-gift"></i>
              <p>
                <?php echo $rowp['cname'] ?> List
              </p>
            </a>
          </li>
          
          
          <li class="nav-item">
            <a href="aboutus.php" class="nav-link">
              <i class="nav-icon fas fa-gift"></i>
              <p>
                About Us Team
              </p>
            </a>
          </li> -->


          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>