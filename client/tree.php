<?php
include 'header.php';
?>



 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Your Ring View </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Your Ring</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                Tree Ring
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
     


            	<div class="row">				
				<div class="col-sm-12">
			
				<?php			

	
				function getTotalLeg($bd,$memid,$leg){ 

			     $sql="SELECT * FROM user where sponserid='$memid' and side='$leg'";
			      $res=mysqli_query($bd,$sql);
			      $row=mysqli_fetch_array($res);
			      global $total;
			       if ($row['acpinid']!=0) {
			       $total=$total+mysqli_num_rows($res);
			   		}
			   		
			         if($row['id']!=''){
			           getTotalLeg ($bd,$row['id'],'left');
			           getTotalLeg ($bd,$row['id'],'right');
			          } 
			          return $total;      
			      }      

			    
	
				function dgetTotalLeg($bd,$memid,$leg){ 

			     $sql="SELECT * FROM user where sponserid='".$memid."' and side='".$leg."'";
			      $res=mysqli_query($bd,$sql);
			      $row=mysqli_fetch_array($res);
			      global $total1;
			      if ($row['acpinid']==0) {			      				      
			       $total1=$total1+mysqli_num_rows($res);
			       }
			         if($row['id']!=''){
			           dgetTotalLeg ($bd,$row['id'],'left');
			           dgetTotalLeg ($bd,$row['id'],'right');
			          } 
			          return $total1;      
			      }      

			    
			     			

?>
		<div class="row" style="display: none;">
			<div class="col-sm-6">
			<h5 class="alert alert-success" align="center" style="color:black !important;font-weight:bold;font-size: 1.5em">Green In Left: 
				<?php
				$y=$_GET['id'];
				 $total=0; 
			    $left=getTotalLeg($bd,$y,"left");  			   
			    ?>
				<?php echo "<span style='color:white'>".$total."</span>"?>
					
					</h5>
				<h5 class="alert alert-danger" align="center" style="color:black !important;font-weight:bold;font-size: 1.5em">Red In Left:
					<?php
				 $total1=0; 
			    $left=dgetTotalLeg($bd,$y,"left");    			    
			   
			    ?>
				<?php echo "<span style='color:white'>".$total1."</span>"?></h5>
				</div>
				<div class="col-sm-6">

			<h5 class="alert alert-success" align="center" style="color:black !important;font-weight:bold;font-size: 1.5em">Green In Right: 
				<?php
				$total=0;
			    $right=getTotalLeg($bd,$y,"right");  			    
			    ?>
				<?php echo "<span style='color:white'>".$total."</span>"?>
					</h5>
					<h5 class="alert alert-danger" align="center" style="color:black !important;font-weight:bold;font-size: 1.5em">Red In Right: 
					<?php
				$total1=0;
			    $right=dgetTotalLeg($bd,$y,"right");  			    
			    ?>
				<?php echo "<span style='color:white'>".$total1."</span>"?></h5>
			</div>
		</div>


		</div>
	</div>


	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
			
		
	<table class="table-responsive" style="text-align: center;width: 100%;zoom: 80%!important;" align="center">
  		<tr>
  			<td>
  				<?php

             
			$y=$_GET['id'];
			$a=$_GET['id'];
			$a1=$_GET['name'];
			$result = mysqli_query($bd,"SELECT * FROM user where sponserid='$y' and side='1'");
			$row = mysqli_fetch_array($result);
  				?>
             <table class="table-responsive">
				<tbody>
					<tr class="alt-row">

					<td align="center" class="tooltip1">
						<?php
						if ($row['pic']!='') {
						?>
							<img  src="<?php echo $row['pic'] ?>" style="border-width: 0px; border-radius: 50%;height: 100px;width: 100px;">
						<?php	
						}else
						{
							if ($row['acpinid']=='') {
						?>
						<img  src="images/userDeactive.png" style="border-width: 0px;">
						<?php 
						}else
						{
							?>
                         <img  src="images/user.png" style="border-width: 0px;">
							<?php
						}
					}
						?>
					</td>

				</tr>
				<tr class="alt-row">
					<td align="center">
					  <a href="tree.php?id=<?php echo $row['id']; ?>&name=<?php echo $row['name']; ?>" data-toggle="tooltip" data-placement="top" title="Mobile No. : <?php echo $row['mobile'] ?> Sponser ID : <?php echo $row['direct'] ?> " ><br>        

					  <font color="red"><?php echo $row['id']; ?></font><br><font color="red">  <?php echo $row['name']; ?></font></a>
                        <?php if($row['id']==''){ ?>
                        <a href="signup2.php?x=<?php echo $_SESSION['id']; ?>&upl=<?php echo $_GET['id']; ?>&di=1" data-toggle="tooltip" data-placement="top" title="Mobile No. : <?php echo $row['mobile'] ?> Sponser ID : <?php echo $row['direct'] ?> " > Add More(+)</a>
                    <?php }?>
					  	
					</td>
				</tr>
			</tbody>
		</table>

  			</td>
  			<td><img  src="images/ringtop2.PNG" style="border-width: 0px;margin-top: -10px;"></td>
  			<td> <?php

              
			$y=$_GET['id'];
			$a=$_GET['id'];
			$a1=$_GET['name'];
			$result = mysqli_query($bd,"SELECT * FROM user where sponserid='$y' and side='2'");
			$row = mysqli_fetch_array($result);
  				?>
             <table class="table-responsive">
				<tbody>
					<tr class="alt-row">

					<td align="center" class="tooltip1">
						<?php
						if ($row['pic']!='') {
						?>
							<img  src="<?php echo $row['pic'] ?>" style="border-width: 0px; border-radius: 50%;height: 100px;width: 100px;">
						<?php	
						}else
						{
							if ($row['acpinid']=='') {
						?>
						<img  src="images/userDeactive.png" style="border-width: 0px;">
						<?php 
						}else
						{
							?>
                         <img  src="images/user.png" style="border-width: 0px;">
							<?php
						}
					}
						?>
					</td>

				</tr>
				<tr class="alt-row">
					<td align="center">
					  <a href="tree.php?id=<?php echo $row['id']; ?>&name=<?php echo $row['name']; ?>" data-toggle="tooltip" data-placement="top" title="Mobile No. : <?php echo $row['mobile'] ?> Sponser ID : <?php echo $row['direct'] ?> " ><br>
					  <font color="red"><?php echo $row['id']; ?></font><br><font color="red"><?php echo $row['name']; ?></font></a>
                          <?php if($row['id']==''){ ?>
                        <a href="signup2.php?x=<?php echo $_SESSION['id']; ?>&upl=<?php echo $_GET['id']; ?>&di=2" data-toggle="tooltip" data-placement="top" title="Mobile No. : <?php echo $row['mobile'] ?> Sponser ID : <?php echo $row['direct'] ?> " > Add More(+)</a>
                    <?php }?>
					</td>
				</tr>
			</tbody>
		</table>
		 </td>




  		</tr>
  		<tr>
			<?php					   	
			// Check connection

			$x = $_SESSION['id'];
			$y=$_GET['id'];
			$a=$_GET['id'];
			$a1=$_GET['name'];
			$result = mysqli_query($bd,"SELECT * FROM user where id='$y'");
			$row = mysqli_fetch_array($result);

			?> 
			
			  <td><img  src="images/ringleft.PNG" style="border-width: 0px;margin-top: 0px;"></td>
			    <td>
			    <table class="table-responsive">
				<tbody >
					<tr class="alt-row">

					<td align="center" class="tooltip1" >
						<div style="margin-right: -250px">
						<?php
						if ($row['pic']!='') {
						?>
							<img  src="<?php echo $row['pic'] ?>" style="border-width: 0px; border-radius: 50%;height: 100px;width: 100px;">
						<?php	
						}else
						{
							if ($row['acpinid']=='') {
						?>
						<img  src="images/userDeactive.png" style="border-width: 0px;">
						<?php 
						}else
						{
							?>
                         <img  src="images/user.png" style="border-width: 0px;">
							<?php
						}
					}
						?>
						</div>
					</td>

				</tr>
				<tr class="alt-row">
					<td align="center">
						<div style="margin-right: -250px">
					  <a href="tree.php?id=<?php echo $a; ?>&name=<?php echo $a1; ?>" data-toggle="tooltip" data-placement="top" title="Mobile No. : <?php echo $row['mobile'] ?> Sponser ID : <?php echo $row['direct'] ?> " ><br>
					  <font color="red"><?php echo $a; ?></font><br><font color="red"><?php echo $a1; ?></font></a>
                      </div>
					</td>
				</tr>
			</tbody>
		</table>
			 </td>
			 <td><img  src="images/ringright2.PNG" style="border-width: 0px;"></td>
	   
	</tr>
	<tr>
  			<td>
  				<?php

              
			$y=$_GET['id'];
			$a=$_GET['id'];
			$a1=$_GET['name'];
			$result = mysqli_query($bd,"SELECT * FROM user where sponserid='$y' and side='3'");
			$row = mysqli_fetch_array($result);
  				?>
             <table class="table-responsive">
				<tbody>
					<tr class="alt-row">

					<td align="center" class="tooltip1">
						<?php
						if ($row['pic']!='') {
						?>
							<img  src="<?php echo $row['pic'] ?>" style="border-width: 0px; border-radius: 50%;height: 100px;width: 100px;">
						<?php	
						}else
						{
							if ($row['acpinid']=='') {
						?>
						<img  src="images/userDeactive.png" style="border-width: 0px;">
						<?php 
						}else
						{
							?>
                         <img  src="images/user.png" style="border-width: 0px;">
							<?php
						}
					}
						?>
					</td>

				</tr>
				<tr class="alt-row">
					<td align="center">
					  <a href="tree.php?id=<?php echo $row['id']; ?>&name=<?php echo $row['name']; ?>" data-toggle="tooltip" data-placement="top" title="Mobile No. : <?php echo $row['mobile'] ?> Sponser ID : <?php echo $row['direct'] ?> " ><br>
					  <font color="red"><?php echo $row['id']; ?></font><br><font color="red"><?php echo $row['name']; ?></font></a>
					   <?php if($row['id']==''){ ?>
                        <a href="signup2.php?x=<?php echo $_SESSION['id']; ?>&upl=<?php echo $_GET['id']; ?>&di=3" data-toggle="tooltip" data-placement="top" title="Mobile No. : <?php echo $row['mobile'] ?> Sponser ID : <?php echo $row['direct'] ?> " > Add More(+)</a>
                    <?php }?>

					</td>
				</tr>
			</tbody>
		</table>

  			</td>
  			<td><img  src="images/ringbottom2.PNG" style="border-width: 0px;margin-top: 10px;"></td>
  			<td> <?php

              
			$y=$_GET['id'];
			$a=$_GET['id'];
			$a1=$_GET['name'];
			$result = mysqli_query($bd,"SELECT * FROM user where sponserid='$y' and side='4'");
			$row = mysqli_fetch_array($result);
  				?>
             <table class="table-responsive">
				<tbody>
					<tr class="alt-row">

					<td align="center" class="tooltip1">
						<?php
						if ($row['pic']!='') {
						?>
							<img  src="<?php echo $row['pic'] ?>" style="border-width: 0px; border-radius: 50%;height: 100px;width: 100px;">
						<?php	
						}else
						{
							if ($row['acpinid']=='') {
						?>
						<img  src="images/userDeactive.png" style="border-width: 0px;">
						<?php 
						}else
						{
							?>
                         <img  src="images/user.png" style="border-width: 0px;">
							<?php
						}
					}
						?>
					</td>

				</tr>
				<tr class="alt-row">
					<td align="center">
					  <a href="tree.php?id=<?php echo $row['id']; ?>&name=<?php echo $row['name']; ?>" data-toggle="tooltip" data-placement="top" title="Mobile No. : <?php echo $row['mobile'] ?> Sponser ID : <?php echo $row['direct'] ?> " ><br>
					  <font color="red"><?php echo $row['id']; ?></font><br><font color="red"><?php echo $row['name']; ?></font></a>
					   <?php if($row['id']==''){ ?>
                        <a href="signup2.php?x=<?php echo $_SESSION['id']; ?>&upl=<?php echo $_GET['id']; ?>&di=4" data-toggle="tooltip" data-placement="top" title="Mobile No. : <?php echo $row['mobile'] ?> Sponser ID : <?php echo $row['direct'] ?> " > Add More(+)</a>
                    <?php }?>

					</td>
				</tr>
			</tbody>
		</table>
		 </td>




  		</tr>

  


		</table>
	    </div>
		<div class="col-sm-3"></div>
	    </div>
		</div>
	
    
    </div>
</div>
</section>
</div>



<?php 
include 'footer.php';
?>