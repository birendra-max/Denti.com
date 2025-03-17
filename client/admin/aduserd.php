<?php
include 'header.php';
if (isset($_GET['userid'])) {
	$id=$_GET['userid'];

	$status=trim($_GET['status']);
	if ($status=='Deactivated') {
		mysqli_query($bd,"update user1 set acpinid='0' where userid=$id");
	}else
	{
		mysqli_query($bd,"update user1 set acpinid='1' where userid=$id");

	}
	
	?>
	<script>         
	alert("Designer is <?php echo $status ?> successfully.");
	window.location="aduserd.php";
</script>

<?php 	
}
?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Activate/Deactivate Designer List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">All Activate/Deactivate Designer List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

	
  <?php 
    
    function check_status($bd,$id)
    {
        $rr=mysqli_query($bd,"SELECT * FROM user1 WHERE id='$id' AND status='active'");
        $row=mysqli_fetch_assoc($rr);
        if($row['acpinid']!=0)
        return 1;
        else
        return 0;
       
    }
    ?>


	

			    <section class="content">
			      <div class="container-fluid">
			        <div class="row">
			          <div class="col-12">
			            <div class="card">
			              <div class="card-header">
			                <h3 class="card-title">All Activate/Deactivate Designer List</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<h2 class="text-center"><b>All Activate/Deactivate Designer List</b></h2>
			              	<hr>
			            <div class="table table-responsive">
			              <table class="table table-bordered table-striped" style="zoom:70% !important">
			              	  <thead>
						          <th>S.N</th>    
						          <th>ID</th>      
						          <th>Name</th>						          
						          <th>Designation</th>
						          <th>Email</th>
						       
						          <th>Phone Number</th>
						         
						          <th>Status</th>
						          <th>Action</th>
						        </thead>
						        <tbody>
						          <?php
						          $total=0;
						          $co=1;						          
						          $rr=mysqli_query($bd,"SELECT * FROM user1 WHERE status='active'");

						          while ($row=mysqli_fetch_assoc($rr)) {       						           
						          ?>
						          <tr>
						            <td><?php echo $co++?></td>
						            <td><?php echo $row['id']?></td>
						            <td><?php echo $row['name']?></td>
						            <td><?php echo $row['designation']?></td>
						           <td><?php echo $row['em']?></td>
						          
						           <td><?php echo $row['mobile']?></td>
						         
						               <?php 
						            if(($row['acpinid']==1))
						            {
						            ?>
						            <td><button class='btn btn-success'>Activated</button></td> 
						            <?php 
						            }else
						            {
						                ?>
						                <td><button class='btn btn-danger'>Not Activate</button></td> 
						            <?php    
						            }
						            ?>
						          <td><a href="aduserd.php?userid=<?php echo $row['userid'] ?>&status=<?php 
								            if(($row['acpinid']==1))
								            {
								            ?>
								        Deactivated
								            <?php 
								            }else
								            {
								                ?>
								               Activate
								            <?php    
								            }
								            ?>" class="btn btn-primary" onclick="return confirm('Are you sure to activate/deactivate operation?.')">
						               <?php 
								            if(($row['acpinid']==1))
								            {
								            ?>
								        Deactivated Now
								            <?php 
								            }else
								            {
								                ?>
								               Activate Now
								            <?php    
								            }
								            ?> </a>
								    </td>  
						          </tr>
						          <?php
						            }
						          ?>

						        </tbody>
			              	
			              </table>
			         
			         	</div>
						    <hr>						    
						    <hr>

			          		</div>
			          	</div>
			          </div>
			      </div>

			    </div>
			</section>
		</div>


<?php
include 'footer.php';
?>