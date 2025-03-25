<?php
include('connect.php');
if (!isset($_SESSION['id']) or $_SESSION['user_type'] != "client") {
    header("Location:login.php");
}

$x = $_SESSION['id'];
$rrp = mysqli_query($bd, "SELECT * FROM user WHERE id='$x'");
$rowp = mysqli_fetch_assoc($rrp);

$rrcp = mysqli_query($bd, "SELECT * FROM profile WHERE id=1");
$rowcp = mysqli_fetch_assoc($rrcp);
$em = $_SESSION['user_id'];
$uri_name = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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

    <link rel="stylesheet" href="plugins/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



    <script src="plugins/toastr/toastr.min.js"></script>
    <style type="text/css">
        ul>li {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        ul>li:hover {
            background-color: rgb(46, 103, 194) !important;
            color: black;
        }

        ul>li>a {
            font-weight: bold !important;
            color: white !important;
            font-size: 20px;
        }

        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            height: 0.5em;
            border: 0;
            color: red;
            background-color: red;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        #searchbox {
            height: 45px;
            width: 200px;
        }

        #searchbtn {
            height: 45px;
            width: 50px;
        }

        input[type="checkbox"] {
            zoom: 1.5;
        }
    </style>

</head>

<body class="hold-transition layout-top-nav" style="zoom: 90%;">
    <div class="wrapper">
        <style>
            .navbar-toggler {
                border: none;
                background-color: transparent;
            }

            .navbar-toggler svg {
                width: 32px;
                height: 32px;
                fill: #fff;
            }
        </style>

        <nav class="navbar navbar-expand-sm bg-dark fixed-top">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <!-- Left: Logo -->
                <a class="navbar-brand" href="#">
                    <img src="public/images/dentigologo.png" alt="Logo" style="height: 65px; width: auto;">
                </a>

                <!-- Center: Navigation Items with Moderate Spacing -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto d-flex">
                        <li class="nav-item mx-4" id="dashboard">
                            <a href="dashboard.php" class="nav-link text-white">Dashboard</a>
                        </li>
                        <li class="nav-item mx-5" id="upload">
                            <a href="file_upload_center.php" class="nav-link text-white">File Upload Center</a>
                        </li>
                        <li class="nav-item mx-4" id="msearch">
                            <a href="multiple_search.php" class="nav-link text-white">Advanced Filters Orders</a>
                        </li>
                        <li class="nav-item mx-4" id="report">
                            <a href="report.php" class="nav-link text-white">Reports</a>
                        </li>
                        <form class="form-inline my-2 mr-3" method="post" action="search.php">
                            <input class="form-control mr-sm-2" type="search" name="orderid" placeholder="Search Orders"
                                aria-label="Search" id="searchbox">
                            <button id="searchbtn" class="btn btn-outline-primary my-2 my-sm-0" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </ul>
                </div>

                <!-- Right: Search & Profile -->
                <div class="d-flex align-items-center">

                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProfile" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="public/images/uuu.png" alt="User Image" class="rounded-circle"
                                    style="height: 40px; width: 40px;">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                <a class="dropdown-item" href="profile.php">Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Sign Out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <script>
            let title = document.title.trim();

            function setActiveMenuItem(itemId) {
                document.getElementById(itemId).classList.add('bg-primary');
                document.getElementById(itemId).classList.add('text-black');
            }

            switch (title) {
                case 'Dashboard':
                    setActiveMenuItem('dashboard');
                    break;
                case 'File Upload Center':
                    setActiveMenuItem('upload');
                    break;
                case 'Multiple Search':
                    setActiveMenuItem('msearch');
                    break;
                case 'Reports':
                    setActiveMenuItem('report');
                    break;
            }
        </script>


        <div style="margin-top: 6%;"></div>




        <!-- /.navbar -->

        <!-- Main Sidebar Container -->