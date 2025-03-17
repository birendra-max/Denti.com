<?php
include('connect.php');
if(!isset($_SESSION['id']) ) {
    header("Location: pages/examples/login.php");
    }

  $x=$_SESSION['id'];
 $rrp=mysqli_query($bd,"SELECT * FROM user WHERE id='$x'");
  $rowp=mysqli_fetch_assoc($rrp);

 $rrcp=mysqli_query($bd,"SELECT * FROM profile WHERE id=1");
  $rowcp=mysqli_fetch_assoc($rrcp);
          $em=$_SESSION['email'];
            $uri_name=basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
                        ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $rowp['name'] ?>,<?php echo $x; ?> | Dashboard</title>

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

</head>
<body class="hold-transition layout-top-nav" style="zoom: 90%;">
<div class="wrapper">


<nav class="main-header navbar navbar-expand-md navbar-light navbar-primary fixed-top" style="display: none;" >
    <div class="container">
      <a href="index.php" class="navbar-brand" style="margin-left:-105px !important;">
        
        <span class="brand-text font-weight-light" style="font-weight:bold !important;"><?php echo substr($rowcp['cname'],0,9) ?></span>
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav" style="margin-left:100px;">
            
                <li class="nav-item d-none d-sm-inline-block" <?php if($uri_name=='index.php' || $uri_name=='index2.php' || $uri_name=='index3.php' || $uri_name=='index4.php' || $uri_name=='index5.php' || $uri_name=='index6.php' || $uri_name=='index7.php' || $uri_name=='index8.php') echo 'style="background-color:#FFF !important"' ?> >
              <a href="index.php" class="nav-link"  <?php if($uri_name=='index.php' || $uri_name=='index2.php' || $uri_name=='index3.php' || $uri_name=='index4.php' || $uri_name=='index5.php' || $uri_name=='index6.php' || $uri_name=='index7.php' || $uri_name=='index8.php') echo 'style="color:#000 !important"';else echo 'style="color:#FFF !important"' ?>  >Dashboard </a>
            </li>   
           
            <li class="nav-item d-none d-sm-inline-block" <?php if($uri_name=='donwline.php') echo 'style="background-color:#FFF !important"' ?>>
              <a href="donwline.php" class="nav-link" <?php if($uri_name=='donwline.php') echo 'style="color:#000 !important"';else echo 'style="color:#FFF !important"' ?> >Orders</a>
            </li>  
            <li class="nav-item d-none d-sm-inline-block" <?php if($uri_name=='new_request.php') echo 'style="background-color:#FFF !important"' ?> >
              <a href="new_request.php" class="nav-link" <?php if($uri_name=='new_request.php') echo 'style="color:#000 !important"';else echo 'style="color:#FFF !important"' ?> >File Upload Center</a>
            </li>  
              <li class="nav-item d-none d-sm-inline-block" <?php if($uri_name=='msearch.php') echo 'style="background-color:#FFF !important"' ?> >
              <a href="msearch.php" class="nav-link" <?php if($uri_name=='msearch.php') echo 'style="color:#000 !important"';else echo 'style="color:#FFF !important"' ?>>Multiple Search</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block" <?php if($uri_name=='report.php') echo 'style="background-color:#FFF !important"' ?>>
              <a href="report.php" class="nav-link" <?php if($uri_name=='report.php') echo 'style="color:#000 !important"';else echo 'style="color:#FFF !important"' ?>>Reports</a>
            </li>                    
          
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-0 ml-md-3" method="post" action="order_detail2.php">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="text" name="orderid" placeholder="Search Orders" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
          <div class="input-group input-group-sm">
            <input type="submit" name="submit" class="btn btn-success" value="Search">
          </div>
        </form>
         <li class="nav-item d-none d-sm-inline-block" style="margin-left:60px !important;">
              <a href="logout.php" class="nav-link" style="color: #FFF !important;font-weight:bold" >Logout</a>
            </li>
      </div>


    </div>
  </nav>


  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  

<?php  
//include 'header.php';
$orderid=$_GET['orderid'];
$sql="SELECT * FROM orders where orderid='$orderid'";
$res=mysqli_query($bd,$sql);
$row=mysqli_fetch_array($res);
// if (isset($_POST['submit2'])) {
// 	$orderid=$_POST['orderid'];
// 	$status=$_POST['status'];
// 	$sql="UPDATE orders set status='$status' where orderid='$orderid'";

// 	if (mysqli_query($bd,$sql)) {
// 		echo "<script>alert('$orderid is updated successfully.');window.location='donwline.php'</script>";
// 	}
// 	else
// 	{
// 		echo "<script>alert('Selected case of status can not be change. Plese try after sometime.');window.location='donwline.php'</script>";
// 	}
// }
?>


<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
 

			    <section class="content">
			      <div class="container-fluid">
			        <div class="row">
			          <div class="col-12">
			            <div class="card">
			             
			              <div class="card-body">
			              <!--  <div class="row">
			          			<div class="col-4">
			          				<label>Chat ID : </label>	<?php echo $row['orderid'] ?>
			          			</div>
			          			<div class="col-4">
			          				<label><i class="fas fa-clock"></i> </label>  <?php echo $row['status'] ?>	
			          			</div>
			          			<div class="col-4">
			          				<a href="donwline.php" class="btn btn-success">Back</a>
			          			</div>
			          		</div>
			          		<br><br> -->
			          			<input type="hidden" name="orderid" value="<?php echo $row['orderid'] ?>">
<!-- 
			          		<form action="" method="post">
			          		<div class="row">
			          			<div class="col-7">
			          				<label>Initial Scan : </label><a href="api/files/<?php echo $row['filename'];?>">	<?php echo $row['filename']; ?></a> || <?php echo $row['created_at'];?>
			          			</div>
			          			<div class="col-3">
			          				<select class="form-control" name="status">
			          					<option value="" <?php if($row['status']=='New') echo 'selected' ?>>Select Status</option>
			          				
			          					<option value="Redesign and Rush" <?php if($row['status']=='Redesign and Rush') echo 'selected' ?>>Redesign and Rush</option>
			          					
			          				</select>			          				
			          			</div>
			          			<div class="col-1">
			          				<input type="submit" name="submit2" value="Change" class="btn btn-primary">
			          			</div>
			          			
			          		</div>
			          		</form> -->
			         <!--  		<div class="row">
			          			<div class="col-12">
			          				<div class="form-group">
			          					<label>STL File</label>	
			          					<table class="table table-hover">
			          						<thead>
			          							<tr>
			          							<th>Sr.No</th>
			          							<th>File</th>
			          							<th>Created At</th>
			          						</tr>
			          						</thead>
			          					<?php 
			          					$sql22="SELECT * FROM orders_stl_files where orderid='$orderid'";
										$res22=mysqli_query($bd,$sql22);
										$i=1;
										while($row22=mysqli_fetch_array($res22))
										{
											?>
											<tr>
												<td><?php echo $i++ ?></td>
												<td><a href="api/stl_files/<?php echo $row22['filename'] ?>"><?php echo $row22['filename'] ?></a></td>
												<td><?php echo $row22['created_at'] ?></td>
											</tr>

											<?php
										}
			          					?>		   
			          					</table>       					
			          				</div>
			          			</div>
			          		</div> -->
			          	<!-- 	<div class="row">
			          			<div class="col-12">
			          				<div class="form-group">
			          					<label>Finished Design</label>
			          					<?php
			          					$sql23="SELECT * FROM orders_finished where orderid='$orderid'";
										$res23=mysqli_query($bd,$sql23);
										$i=1;
										$row23=mysqli_fetch_array($res23);	
										?>		          			
										<a href="api/finished_files/<?php echo $row23['finished_file'] ?>"> <?php echo $row23['finished_file'] ?> || <?php echo $row23['created_at'] ?></a>		
			          				</div>
			          			</div>
			          		</div> -->
			          		
			          		<div class="row">
			          			
			          			<div class="col-12">
			          			
			          				<h4>Chat Messages</h4>
			          				          			
			  <div class="card direct-chat direct-chat-primary">
             
              <!-- /.card-header -->
              <div class="card-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">
                  <!-- Message. Default to the left -->
                  <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left">User</span>
                      <span class="direct-chat-timestamp float-right"><?php echo trim($row['created_at']) ?></span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      <?php echo trim($row['message']) ?>
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->
                 <!-- /.direct-chat-msg -->
                  <!-- /.direct-chat-msg -->
                  <?php
                  	$sql22="SELECT * FROM chatbox where orderid='$orderid'";
					$res22=mysqli_query($bd,$sql22);
					$i=1;
					while($row22=mysqli_fetch_array($res22))
					{
						if ($row22['user_type']=="user") 
						{				
											?>
                  <!-- Message to the right -->
                  <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left">You</span>
                      <span class="direct-chat-timestamp float-right"><?php echo $row22['created_at'] ?></span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      <?php echo $row22['msg']."<br>" ;
                     
                      if (!empty($row22['attachment'])) {
                      	?>
                      	<a href="../api/chatbox/<?php echo $row22['attachment'] ?>">Download </a>
                      	<?php
                      }
                      ?>
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->
              <?php }else{ ?>
                  <!-- Message. Default to the left -->
                  <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-right"><?php echo $row22['user_type']?></span>
                      <span class="direct-chat-timestamp float-left"><?php echo $row22['created_at'] ?></span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img " src="dist/img/user1-128x128.jpg" alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                        <?php echo $row22['msg']."<br>";
                     
                      if (!empty($row22['attachment'])) {
                      	?>
                      	<a href="../api/chatbox/<?php echo $row22['attachment'] ?>">Download </a>
                      	<?php
                      }
                      ?>
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->
              <?php 
		          }
		          } 
		          ?>
                
                  <!-- /.direct-chat-msg -->
                  	<div id="chat_live"></div>
                </div>
                <!--/.direct-chat-messages-->

             
					                <!-- /.direct-chat-pane -->
					              </div>
					              <!-- /.card-body -->
					              <div class="card-footer">
					                <form action="#" method="post" enctype="multipart/form-data">
					                <input type="hidden" id="orderid" name="orderid" value="<?php echo $row['orderid']; ?>">
                					  <div class="row">
					                	<div class="col-sm-12">
					                		<div class="form-group">
					                			<textarea name="message" id="message" class="form-control" rows="3"></textarea>
					                		</div>
					                	</div>
					                </div>
					                <div class="row">
					                	<div class="col-sm-8">
					                		<div class="form-group">
					                			<button type="button" id="send" class="btn btn-primary">Send</button>
					                		</div>
					                	</div>
					                	<div class="col-sm-4">
					                		<div class="form-group">
					                			<div class="btn btn-default btn-file">
				                                <i class="fas fa-paperclip"></i> Attachment
				                                <input type="file" name="file" id="file" />
				                              </div>
					                		</div>
					                	</div>
					                </div>
					                </form>
					              </div>
					              <!-- /.card-footer-->
					            </div>
					            <!--/.direct-chat -->
			          			</div>
			          		</div>
			          	</div>
			            </div>
			          </div>
			        </div>
			    </div>
			</section>
		</div>
			   

<script type="text/javascript">

$(document).ready(function () {
$('#send').on('click', function() {
    var file_data = $('#file').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data);
    form_data.append('message_id',$("#message").val());
    form_data.append('orderid_id',$("#orderid").val());
    //alert(form_data);                             
    $.ajax({
        url: 'update_chatbox.php', // <-- point to server-side PHP script 
        dataType: 'text',  // <-- what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(response){
				$("#message").val('');
              //alert(response);
              var arr=response.split("____");
               $("#chat_live").html('<div class="direct-chat-msg"><div class="direct-chat-infos clearfix"><span class="direct-chat-name float-left">You</span><span class="direct-chat-timestamp float-right">"'+arr[1]+'"</span>    </div><img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image"><div class="direct-chat-text"> "'+arr[0]+'"</div></div>');        }
     });
});
 });
</script>





<?php  
include 'footer.php';
?>





