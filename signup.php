<?php 
include('connect.php');
  
    if (isset($_POST['submit'])){
    	$kk=0;
    	$ref="";
    	$dirref="";
		$dirref=$_POST['upliner'];
	
		if(empty($_POST['ref']))
		    $ref="RSV9999";
		    else
		    $ref=$_POST['ref'];
		
		
		//echo "<script>alert('$ref')</script>";
		
								 function getTotalLegss($bd,$memid,$leg)
								 { 								 	
								 	  $sql="SELECT * FROM user where sponserid='$memid' and side='$leg'";
                        $res=mysqli_query($bd,$sql);
                        $row=mysqli_fetch_array($res);
                        global $total;                
                  
                        
                           if($row['id']!=''){
                            $total=$row['id'];                            
                             getTotalLegss($bd,$row['id'],"1");  
                             getTotalLegss($bd,$row['id'],"2");  
                             getTotalLegss($bd,$row['id'],"3");  
                             getTotalLegss($bd,$row['id'],"4");                             
                            } 
                            return $total;      
						            }    

                      if (empty($_POST['upliner'])) {
                      
                      $total=0;     
                    getTotalLegss($bd,$ref,$_POST['side']); 
                   echo "<script>alert('$total')</script>";
                     if ($total=='0') 
                     $dirref=$ref;   
                     else                     
                     $dirref=$total;        
                  }
			
		          		if (empty($dirref)) {
		
		$rq=mysqli_query($bd,"SELECT userid as mxid FROM user order by userid desc");
		$roww=mysqli_fetch_assoc($rq);
		$sss=$roww['mxid'];
		
		//echo "<script>alert('$sss')</script>";
		
		$rq1=mysqli_query($bd,"SELECT * FROM user WHERE userid=$sss");
		$roww1=mysqli_fetch_assoc($rq1);
		$sss1=$dirref=$roww1['id'];
		
		$sss=$sss1;
		$dirref=$sss;
		
		//echo "<script>alert('$dirref')</script>";
	}
		//echo "<script>alert('$ref')</script>";
		
		
		
	
$check_pin= mysqli_query($bd,"SELECT * FROM user WHERE id='$dirref'");
$check_ref= mysqli_query($bd,"SELECT * FROM user WHERE id='$ref'");


//CHECKING THE REFRAL ID AND PIN ID PRESENTED IN DATABASE OR NOT
//
if (mysqli_num_rows($check_pin) > 0 && mysqli_num_rows($check_ref) > 0) {
	
	
  	mysqli_query($bd,"INSERT INTO user(status) VALUES('active')");  

  $rq1=mysqli_query($bd,"SELECT userid FROM user WHERE userid=(SELECT MAX(userid) FROM user)");
		$roww1=mysqli_fetch_assoc($rq1);
		$z=$roww1['userid'];
		$pinid="RSV".$z.rand(100,999);
  
  //echo "<script>alert('$z')</script>";
  mysqli_query($bd,"update user set id='$pinid' where userid='$z'"); 

	extract($_POST);
	
	$x=date("Y-m-d");
    $name=$_POST['name'];
    $side=$_POST['side'];    
    $saveref2=$ref;
    
    $savepin2=$savecid=$cid=$pinid;    
	$email=$_POST['email'];
	$mobile=$_POST['mobile'];		
	$password='12345';
	
//	echo "<script>alert('$ref')</script>";
//	echo "<script>alert('$sss')</script>";


	$saveref=$ref;

// CHECK HERE TO SELECT UPLINER IS ALREADY FILL OR NOT

	$p1=0;
  $p2=0;
  $p3=0;
  $p4=0;
	$flagr=0;
	$allflag=0;

	if ($side=='1') {

		$rr=mysqli_query($bd,"SELECT * FROM user WHERE sponserid='$dirref' AND side='1'");
		if (mysqli_num_rows($rr)>0) {
			$p1=1;
			$allflag=1;
		}

		}else{
      if ($side=='2') {

		$rr=mysqli_query($bd,"SELECT * FROM user WHERE sponserid='$dirref' AND side='2'");
		if (mysqli_num_rows($rr)>0) {
			$p2=1;
			$allflag=1;
		}

		}else
    {
          if ($side=='3') {

    $rr=mysqli_query($bd,"SELECT * FROM user WHERE sponserid='$dirref' AND side='3'");
    if (mysqli_num_rows($rr)>0) {
      $p3=1;
      $allflag=1;
    }


    }else
    {
        $rr=mysqli_query($bd,"SELECT * FROM user WHERE sponserid='$dirref' AND side='4'");
       if (mysqli_num_rows($rr)>0) {
         $p4=1;
         $allflag=1;
       }

    }
  }
}


//TEST FLAG POINTER THAT EMPTY THE LEFT OR RIGHT OR NOT

	if ($allflag==0) {

		mysqli_query($bd,"update user set direct='$ref' where id='$cid'");

		mysqli_query($bd,"update user set directside='$side' where id='$cid'");

		

//UPDATING THE MEMBER INFORMATION	

	  $tdate=date("m/d/Y");
	  if (isset($_SESSION['pname'])) {

	  	$pname=$_SESSION['pname'];	  	
	  	$pprice=$_SESSION['pprice'];
	  	$imag=$_SESSION['pimag'];
	  	mysqli_query($bd,"update `user` set name='$name',em='$email',side='$side',mobile='$mobile',sponserid='$dirref',password='$password',status='active',todaydate='$tdate',amount='$pprice',product='$pname',daily='$imag' where id='$cid'");

	  	mysqli_query($bd,"INSERT INTO product(mid,name,price,tdate,status,imag) VALUES('$cid','$pname','$pprice','$tdate','N','$imag')");

	  }else
	  {
	  	mysqli_query($bd,"update `user` set name='$name',em='$email',side='$side',mobile='$mobile',sponserid='$dirref',password='$password',status='active',todaydate='$tdate' where id='$cid'");
	  }
	  
		
		mysqli_query($bd,"INSERT INTO `closing`(`pinid`, `name`, `amount`, `date`,`status`) VALUES ('$cid','$name',0,0,'not')");


	mysqli_query($bd,"INSERT INTO bank(id,account,bank,branch,ifsc)VALUES('$savepin2','0','0','0','0')");
		$kk=10;
		
		
		   $to =$email;
         $subject = "Congratulation, Registration Success From RSV Crowd Digital India";
         
         $message = "<h3><b>Congratulation, You have successfully registetred with <b>RSV Crowd Digital India</b>.Now Earn More For activate self ID and add more members at ring your.Your Login Credentials is <br> ID :$savepin2 and default Password is : 12345. <br><br> Thanks Regard <br> <b>RSV Crowd Digital India</b> </b></h3>";
         
         $header = "From:himanshupandey.9000@gmail.com \r\n";
         $header .= "Reply-To: himanshupandey.9000@gmail.com\r\n";
         $header .= "Return-Path: himanshupandey.9000@gmail.com\r\n";
         $header .= "Cc:himanshupandey.9000@gmail.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
         }
		
		
		
	?>
	 <script>  
	    alert('You are successfully registered with RSV Crowd Digital India.Your Login ID is <?php echo $savecid ?> and Default Password is 12345 . You can change your password after the login.');
	  //window.location="index.php";
	</script>
	<?php
	

		}else{

		if ($p1==1) {
			$kk=1;
			echo "<script>alert('This $dirref id of first position is already completed.')</script>";
		}else{
			if ($p2==1) {
				$kk=1;
			echo "<script>alert('This $dirref id of second position is already completed.')</script>";
		}else
    {
    if ($p3==1) {
        $kk=1;
      echo "<script>alert('This $dirref id of third position is already completed.')</script>";
    }else
    {
      if ($p4==1) {
        $kk=1;
      echo "<script>alert('This $dirref id of fourth position is already completed.')</script>";
    }
		}		
		}
  }
}
}else{
		$kk=1;
		?>

	<script>  
	    alert('You are entered Upliner or Referal id is incorrect.');
	  window.location="signup.php";
	</script>

		<?php
	
			}
			if ($kk==10) {
		echo "<script>window.location='logout.php'</script>";	
		}
		
		}


 $rrcp=mysqli_query($bd,"SELECT * FROM profile WHERE id=1");
  $rowcp=mysqli_fetch_assoc($rrcp);
		
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registration |  Form</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="shortcut icon" href="admin/<?php echo $rowcp['logo'] ?>" type="image/x-icon">
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page" style="background-image: url('images/off3.jpg') !important;background-size: cover;background-repeat: no-repeat;background-position: center;">
<div class="register-box">
  <div class="register-logo" style="background:rgba(255,255,255,0.4);">
    <a href="index.php"><b style="text-decoration: none;font-weight: bold;color: rgba(200,0,0,1);font-size: 30px !important; "></b></a>
  </div>

  <div class="card" style="background-color: rgba(0,0,0,0.2);color: #FFF !important;border-radius: 2% !important">
    <div class="card-body register-card-body" style="background-color: rgba(0,0,0,0.4);color: #FFF !important;border-radius: 2% !important" >
    		<h3 class="text-center" style="color:rgba(0,0,255,0.8);font-weight:bold">
    		<?php
// 			if (isset($_SESSION['pname'])) {
// 				echo "<h3 style='color:#FFF'>Product :".$_SESSION['pname']."</h3>";
// 			}
			?>
			<?php echo strtoupper($rowcp['cname']) ?>
		</h3>
		<hr>

      <p class="login-box-msg">Register a new membership</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" name="name" class="form-control" placeholder="Full name" style="color: #000;font-weight: bold;">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email"  style="color: #000;font-weight: bold;">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" name="mobile" class="form-control" placeholder="Mobile"  style="color: #000;font-weight: bold;">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
    
        
        <div class="input-group mb-3">
        	    <?php
					if (isset($_REQUEST['upl'])) {?>
        	<input type="hidden"  name="upliner" value="<?php echo $_REQUEST['upl'] ?>">	
        	<input type="text" class="form-control" value="<?php echo $_REQUEST['x'] ?>"  style="color: #000;font-weight: bold;" readonly>	     
        	<?php
			}else
			{?>
			
			<input type="text" class="form-control"  name="ref"  style="color: #000;font-weight: bold;font-size:16px;" placeholder="Sponsor ID" required>	<br>				
			
			
			<?php
			}
			?>    
        </div>
        <label class="form-control">If you do not have sponsor id use RSV9999</label>       

        <div class="input-group mb-3" style="display:none;">
        	<?php
			if (isset($_REQUEST['x'])) {?>
			<input type="text" class="form-control" value="<?php echo $_REQUEST['x'] ?>"  style="color: #000;font-weight: bold;">
			<input type="hidden" name="ref" value="<?php echo $_REQUEST['x'] ?>">
			<?php
			}else
			{
			?>
		<input type="text" name="upliner" placeholder="If you do'nt have Sponsor ID use 8899" class="form-control"  style="color: #000;font-weight: bold;">
			<?php
			}
			?>          
         
        </div>
         
        
          <div class="form-group clearfix">          	
          	<?php
          	if (isset($_REQUEST['di'])) {
					if ($_REQUEST['di']=="1") {?>

          	 Position 1
	            <div class="icheck-success d-inline">
                    <input type="radio" name="side" id="radioSuccess1" value="1" checked>
                    <label for="radioSuccess1">
                    </label>
                  </div>
                      <?php
					}else
					{
            if ($_REQUEST['di']=="2") {
						?>			

                  Position 2
                  <div class="icheck-success d-inline">
                    <input type="radio" name="side" id="radioSuccess2" value="2" checked>
                    <label for="radioSuccess2">
                    </label>
                  </div><br>
                  		<?php
					}else{
            if ($_REQUEST['di']=="3") {
              ?>
               Position 3
                  <div class="icheck-success d-inline">
                    <input type="radio" name="side" id="radioSuccess2" value="3" checked>
                    <label for="radioSuccess2">
                    </label>
                  </div><br>
              <?php
          }else
          {
            ?>
            Position 4
                  <div class="icheck-success d-inline">
                    <input type="radio" name="side" id="radioSuccess2" value="4" checked >
                    <label for="radioSuccess2">
                    </label>
                  </div><br>
                  <?php
          }	
          }
          }				
					}else
					{
					?><br>
					
                   <input type="radio" name="side" value="1" style="height:16px;width:16px;margin-top: -15px;color: green;" required>Position 1
                   <br>

                   <input type="radio" name="side" value="2"  style="height:16px;width: 16px;margin-top: -15px" required>Position 2

                   <input type="radio" name="side" value="3"  style="height:16px;width: 16px;margin-top: -15px" required>Position 3

                   <input type="radio" name="side" value="4"  style="height:16px;width: 16px;margin-top: -15px" required>Position 4
                 
                  <?php
              		}
              	?>
	      </div>

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree" required onclick="openModal()">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


                
                
                
                
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" style="color: #000 !important">Registration Terms & Condition</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p style="color: #000 !important">Your registration will remain valid for 30 days, between this 30 days you can take any product and activate your Id and speed up your income.&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">OK</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->



<!-- Trigger the modal with a button -->
<script type="text/javascript">

function openModal(){

    $('#modal-default').modal('show');
}       
</script>


      <a href="../login/" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>






<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultInfo').click(function() {
      Toast.fire({
        icon: 'info',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultError').click(function() {
      Toast.fire({
        icon: 'error',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultWarning').click(function() {
      Toast.fire({
        icon: 'warning',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultQuestion').click(function() {
      Toast.fire({
        icon: 'question',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });

    $('.toastrDefaultSuccess').click(function() {
      toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultInfo').click(function() {
      toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultError').click(function() {
      toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultWarning').click(function() {
      toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });

    $('.toastsDefaultDefault').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultTopLeft').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'topLeft',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultBottomRight').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'bottomRight',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultBottomLeft').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'bottomLeft',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultAutohide').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        autohide: true,
        delay: 750,
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultNotFixed').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        fixed: false,
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultFull').click(function() {
      $(document).Toasts('create', {
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        icon: 'fas fa-envelope fa-lg',
      })
    });
    $('.toastsDefaultFullImage').click(function() {
      $(document).Toasts('create', {
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        image: '../../dist/img/user3-128x128.jpg',
        imageAlt: 'User Picture',
      })
    });
    $('.toastsDefaultSuccess').click(function() {
      $(document).Toasts('create', {
        class: 'bg-success',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultInfo').click(function() {
      $(document).Toasts('create', {
        class: 'bg-info',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultWarning').click(function() {
      $(document).Toasts('create', {
        class: 'bg-warning',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultDanger').click(function() {
      $(document).Toasts('create', {
        class: 'bg-danger',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultMaroon').click(function() {
      $(document).Toasts('create', {
        class: 'bg-maroon',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
  });
</script>
</body>
</html>










</body>
</html>






