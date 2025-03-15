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
            <h1>Pin List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Generated Pin</li>
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
                List Of Generated Pin
              </h3>
            </div>

            	  <section class="content">
			      <div class="container-fluid">
			        <div class="row">
			          <div class="col-12">
			            <div class="card">
			              <div class="card-header">
			                <h3 class="card-title">Generated Pin</h3> <a href="lpin.php" class="btn btn-danger" style="float: right;">Back</a>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<h2 class="text-center"><b>List Generated Pin</b></h2>
			              <table  id="example1" class="table table-bordered table-striped">
			              	 <thead>
			                  <tr>
			                    <th>Sr.No</th>			                    
			                    <th>Pin</th>			                    
			                    <th>Generated Date</th>
			                    <th>Pin Status</th>
			                    <th>Amount</th>			                    			                    
			                  </tr>
			                  </thead>
			                  <tbody>
			                  	<?php
			                  	$i=1;

			             	$id=$_GET['id'];
			             	$rr=mysqli_query($bd,"SELECT * FROM pinr WHERE id=$id");
			             	$row=mysqli_fetch_assoc($rr);
			             	$p=$row['pinno'];
			             	$nopin=explode(",",$p);	
			             	$amount=$row['package'];
			                  	$td=$row['appdate'];
			                  	for($j=1;$j<count($nopin);$j++)
			                  	{
			                  		$pp=$nopin[$j];
			                  			$rr1=mysqli_query($bd,"SELECT * FROM pin WHERE acpinid='$pp'");
			             				$row1=mysqli_fetch_assoc($rr1);
			                  		if ($row1['status']=='Y') {
			                  			$color="#F48782";
			                  		}else
			                  		{
			                  			$color="#5AC249";
			                  		}

			                  		?>
			                  		<tr style="background-color:<?php echo $color ?>">
			                  		<td><?php echo $i++; ?></td>
			                  		<td><?php echo $nopin[$j]; ?></td>
			                  		<td><?php echo date("d-M-Y",strtotime($td)) ?></td>
			                  		<td>
			                  	<?php
			                  	
			             				if($row1['status']=="Y")
			             					echo "Used";
			             				else
			             					echo "Not Used";
			             		?>
			                  		</td>
			                  		<td><?php echo $amount?></td>			                  		
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
