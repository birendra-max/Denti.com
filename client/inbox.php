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
            <h1>Inbox</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Inbox</li>
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
                List Mail
              </h3>
            </div>

            	  <section class="content">
			      <div class="container-fluid">
			        <div class="row">
			          <div class="col-12">
			            <div class="card">
			              <div class="card-header">
			                <h3 class="card-title">Inbox</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<h2 class="text-center"><b>List Of Replied E-Mail</b></h2>
			              <table  id="example1" class="table table-bordered table-striped">
			              	 <thead>
			                  <tr>
			                    <th>Sr.No</th>
			                    <th>ID</th>
			                    <th>Name</th>
			                    <th>Subject</th>
			                    <th>Msg</th>
			                    <th>Date</th>
			                    <th>Time</th>
			                    <th>Attachment</th>		
			                    <th>Action</th>
			                  </tr>
			                  </thead>
			                  <tbody>
			                  	<?php
			                  	$i=1;			                  	
			                  	$rr=mysqli_query($bd,"SELECT * FROM maillist WHERE direct='$x' ORDER BY id DESC");
			                  	while ($row=mysqli_fetch_assoc($rr)) {
			                  		if ($row['status']=='Y') {			                  		
			                  		?>
			                  		<tr style="background-color: rgba(0,100,0,0.4);color: #000;font-weight: bold;">
			                  		<?php
			                  		}else
			                  		{?>
			                  			<tr>
			                  		<?php
			                  		}
			                  		?>			                  

			                  		<td><?php echo $i++; ?></td>
			                  		<td><?php echo $row['direct'] ?></td>
			                  		<td><?php
			                  		$ui=$row['direct'];
			                  		 $pp=mysqli_query($bd,"SELECT name FROM user WHERE id='$ui'");
			                  		 $rpp=mysqli_fetch_assoc($pp);
			                  		 echo $rpp['name'];
			                  		?></td>
			                  		<td><?php echo $row['subject'] ?></td>
			                  		<td><?php echo $row['msg'] ?></td>				                  		
			                  		<td><?php echo $row['todaydate'] ?></td>			                  	
			                  		<td><?php echo $row['todaytime'] ?></td>
			                  		<td> <a href="../<?php echo $row['att'] ?>" class="btn btn-info" download> <i class="fas fa-download"></i> </a></td>
			                  		<td> <a href="compose.php" class="btn btn-info"> <span class="fas fa-reply"></span> Reply</a></td>
			                  		</tr>
			                  		<?php
			                  	}
			                  	?>
			                  </tbody>

			              	
			              </table>
			          		</div>
			          	</div>
			          </div>
			      </div>

			    </div>
			</section>
		</div>
	</div>
</div>
</section>
</div>




<?php
include 'footer.php';
?>
