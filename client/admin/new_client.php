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
          <h1>New User</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">New User </li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-1">

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
                  <form action="client_signup.php" method="post">
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                      <div class="col-sm-10">
                        <input type="hidden" name="mid" value="">
                        <input type="text" class="form-control" id="inputName" name="name" placeholder="Enter name" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="inputSkills" class="col-sm-2 col-form-label">User Id</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="user_id" name="user_id" placeholder="Enter user id" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail" class="col-sm-2 col-form-label">Password</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="pass_w" name="pass_w" placeholder="Enter Password" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputSkills" class="col-sm-2 col-form-label">Phone Number</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputSkills" name="mobile" placeholder="Enter Phone or mobile number" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputSkills" class="col-sm-2 col-form-label">Lab Name </label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputSkills" name="labname" placeholder="Enter Lab Name" required>
                      </div>
                    </div>
                    <hr>
                    <h4>Default Design Parameters</h4>
                    <hr>

                    <div class="form-group row">
                      <label for="inputSkills" class="col-sm-2 col-form-label">Contact</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputSkills" name="contact" placeholder="Enter contact value">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputSkills" class="col-sm-2 col-form-label">Occlusion</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputSkills" name="occlusion" placeholder="Enter Default occlusion value">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="inputSkills" class="col-sm-2 col-form-label">Anatomy</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputSkills" name="anatomy" placeholder="Enter Anatomy">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputSkills" class="col-sm-2 col-form-label">Pontic</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputSkills" name="pontic" placeholder="Enter pontic value">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputSkills" class="col-sm-2 col-form-label">Remarks</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="remark"></textarea>
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

                  <!-- END timeline item -->
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