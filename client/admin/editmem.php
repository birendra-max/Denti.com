<?php
include 'header.php';
$iddd=$_GET['id'];
     $rr7=mysqli_query($bd,"SELECT * FROM user WHERE userid=$iddd");
     $rowp1=mysqli_fetch_assoc($rr7);
     $x=$rowp1['id'];
?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Client Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"> Edit Client Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Edit Client Details Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-Edit Client Details">
                <div class="text-center">
                	<?php 
                	if ($rowp1['pic']=='') {
                		?>		
                	 <img class="profile-user-img img-fluid img-circle"
                       src="dist/img/avatar.png"
                       alt="User profile picture">
                		<?php
                	}else
                	{
                		?>
               <img class="profile-user-img img-fluid img-circle" src="../<?php echo $rowp1['pic'] ?>" alt="User profile picture">

                		<?php
                	}
                	?>
                 
                </div>

                <h3 class="profile-username text-center"><?php echo $rowp1['name'] ?></h3>

                <p class="text-muted text-center">Client Details</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Client Details ID</b> <a class="float-right"><?php echo $rowp1['id'] ?></a>
                  </li>
                  
                  <li class="list-group-item">
                    <b>Joining Date</b> <a class="float-right"><?php echo date("d-M-Y",strtotime($rowp1['todaydate'])) ?></a>
                  </li>
				  
                </ul>
                	<?php
                	if ($rowp1['acpinid']!=0) {
                		?>
					<a href="#" class="btn btn-success btn-block"><b>Activated</b></a>                		
					<?php
                	}else
                	{
                	?>
                	<a href="#" class="btn btn-danger btn-block"><b>Not Active</b></a>                		
                	<?php
                	}
                	?>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Personal Details</a></li>
                  
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <form action="update.php" method="post">
               		    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="hidden" name="mid" value="<?php echo $rowp1['id']  ?>">
                          <input type="text" class="form-control" id="inputName" name="name" value="<?php echo $rowp1['name'] ?>">
                        </div>
                      </div>
                        <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">E-Mail</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" name="email" placeholder="Enter email" value="<?php echo $rowp1['em'] ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Designation</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputEmail" name="designation" placeholder="Enter designation" value="<?php echo $rowp1['designation'] ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Phone Number</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" name="mobile" placeholder="Enter Phone or mobile number" value="<?php echo $rowp1['mobile'] ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Lab Name </label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" name="labname" placeholder="Enter Lab Name" value="<?php echo $rowp1['labname'] ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Password </label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" name="password" placeholder="Enter Password" value="<?php echo $rowp1['password'] ?>">
                        </div>
                      </div>
                      <hr>
                      <h4>Default Design Parameters</h4>
                      <hr>
                     
                        <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Contact</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" name="contact" placeholder="Enter contact value" value="<?php echo $rowp1['contact'] ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Occlusion</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" name="occlusion" value="<?php echo $rowp1['occlusion'] ?>" placeholder="Enter Default occlusion value">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Anatomy</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" name="anatomy" value="<?php echo $rowp1['anatomy'] ?>"  placeholder="Enter Anatomy" >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Pontic</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" name="pontic" value="<?php echo $rowp1['pontic'] ?>" placeholder="Enter pontic value" >
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Remarks</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" name="remark"> <?php echo $rowp1['remark'] ?></textarea>
                        </div>
                      </div>


                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-success">Save</button>
                        </div>
                      </div>
                    <!-- Post -->
                  	</form>

                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <<!-- END timeline item -->
                      <div>
                        <i class="far fa-clock bg-gray"></i>
                      </div>                   
                  	</div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                 
                      	     
                   
                  </div>


                <div class="tab-pane" id="kyc">
                 
                    

                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



<?php
include 'footer.php';
?>