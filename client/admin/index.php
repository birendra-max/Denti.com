<?php
include 'header.php';
$x='RSV9999';

 


?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <h1>
<?php
// Execute the 'df -h' command using shell_exec
// $output = (shell_exec('df -h') !='')?null:shell_exec('df -h');
$output = shell_exec('df -h');
$output = ($output === null || trim($output) === '') ? '' : $output;


// Split the output into lines
$lines = explode("\n", trim($output));

// Start the table
echo '<table class="table table-hover" border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">';

// Output the header row (the first line)
echo '<tr>';
$headers = preg_split('/\s+/', array_shift($lines));
foreach ($headers as $header) {
    echo "<th>$header</th>";
}
echo '</tr>';

// Output each line as a row
foreach ($lines as $line) {
    echo '<tr>';
    $columns = preg_split('/\s+/', $line);
    foreach ($columns as $column) {
        echo "<td>$column</td>";
    }
    echo '</tr>';
}

// Close the table
echo '</table>';
?>
          </h1>
          
          
        <!-- Small boxes (Stat box) -->
       <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
             <a href="allmember.php" class="small-box-footer">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>
                  <?php 
                          $resulth = mysqli_query($bd,"SELECT count(*) as sm FROM user");
                        $rowh = mysqli_fetch_array($resulth);
                        echo $tclient=$rowh['sm'];   ?>  
                </h3>
                <p>Total Client</p>
              </div>
              <div class="icon">
                <i class="fas fa-warning"></i>
              </div>
              
            </div>
            </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="allmemberd.php" class="small-box-footer">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php 
                          $resulth = mysqli_query($bd,"SELECT count(*) as sm FROM user1");
                        $rowh = mysqli_fetch_array($resulth);
                        echo $tdesigner=$rowh['sm'];   ?>                        
                </h3>

                <p>Total Designer</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-friends"></i>
              </div>              
            </div>
            </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="allmember.php" class="small-box-footer">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>  <?php 
                          $resulth = mysqli_query($bd,"SELECT count(*) as sm FROM user where acpinid<>0");
                        $rowh = mysqli_fetch_array($resulth);
                        echo $tactclient=$rowh['sm'];   ?> 
                    </h3>

                <p>Total Active Client</p>
              </div>
              <div class="icon">
               <i class="fas fa-users"></i>
              </div>
             
            </div>
            </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="allmemberd.php" class="small-box-footer">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>
                 <?php 
                          $resulth = mysqli_query($bd,"SELECT count(*) as sm FROM user1 where acpinid<>0");
                        $rowh = mysqli_fetch_array($resulth);
                        echo $tactclient=$rowh['sm'];   ?> 
                </h3>

                <p>Total Active Designer</p>
              </div>
              <div class="icon">
               <i class="fas fa-users"></i>
              </div>
              
            </div>
            </a>
          </div>
          <!-- ./col -->
        </div>

           <!-- Small boxes (Stat box) -->
        <div class="row">

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="allmember.php" class="small-box-footer">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>
                 <?php 
                          $resulth = mysqli_query($bd,"SELECT count(*) as sm FROM user where acpinid=0");
                        $rowh = mysqli_fetch_array($resulth);
                        echo $tactclient=$rowh['sm'];   ?> 
                </h3>

                <p>Total Deactive Client</p>
              </div>
              <div class="icon">
               <i class="fas fa-users"></i>
              </div>
             </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="allmemberd.php" class="small-box-footer">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>
               <?php 
                          $resulth = mysqli_query($bd,"SELECT count(*) as sm FROM user1 where acpinid=0");
                        $rowh = mysqli_fetch_array($resulth);
                        echo $tactclient=$rowh['sm'];   ?>                 
                </h3>

                <p>Total Deactive Designer</p>
              </div>
              <div class="icon">
               <i class="fas fa-users"></i>
              </div>
               
            </div>
            </a>
          </div>
          <!-- ./col -->      
        </div>
        
        <div class="row">
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="index10.php" class="small-box-footer">
            <div class="small-box " style="background-color: rgba(10,10,250,0.7) !important">
              <div class="inner">
                <h3>
             <?php 

                        $resulth = mysqli_query($bd,"SELECT count(*) as sm FROM orders WHERE status='New'");
                        $rowh = mysqli_fetch_assoc($resulth);
                        echo $rowh['sm'];   ?>        
                </h3>

                <p>New Cases</p>
              </div>
              <div class="icon">
               
              </div>
               <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="index2.php" class="small-box-footer">
            <div class="small-box" style="background-color: rgba(10,10,250,0.7) !important">
              <div class="inner">
                <h3>
                <?php 
                        
                        $resulth = mysqli_query($bd,"SELECT count(*) as sm FROM orders WHERE  tduration='Rush' and status='New'");
                        $rowh = mysqli_fetch_array($resulth);
                        echo $rowh['sm'];   ?>   
                </h3>
                <p>Rush Hour Cases</p>
              </div>
              <div class="icon">
               
              </div>
               <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="index5.php" class="small-box-footer">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php 
                        
                        $resulth = mysqli_query($bd,"SELECT count(*) as sm FROM orders WHERE tduration='Same Day'");
                        $rowh = mysqli_fetch_array($resulth);
                        echo $rowh['sm'];   ?>                         
                </h3>

                <p>6 Hour Cases</p>
              </div>
              <div class="icon">
                
              </div>
               <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="index3.php" class="small-box-footer">
            <div class="small-box" style="background-color: rgba(10,10,250,0.7) !important">
              <div class="inner">
                <h3>  <?php
                 $tdate=date('d-M-Y');
                 $cc=0;
                    $resulth = mysqli_query($bd,"SELECT created_at FROM orders");
                        while($rowh = mysqli_fetch_array($resulth))
                        {

                          if (strtotime($tdate)==strtotime(date("d-M-Y",strtotime($rowh['created_at']))))
                            $cc++;                          
                        }
                        echo $cc;
                    ?> 
                      
                    </h3>

                <p>Today Cases</p>
              </div>
              <div class="icon">
               
              </div>
              <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="index4.php" class="small-box-footer">
            <div class="small-box" style="background-color: rgba(10,10,250,0.7) !important">
              <div class="inner">
                <h3>
                <?php 

                        $resulth = mysqli_query($bd,"SELECT count(*) as sm FROM orders WHERE status='Hold'");
                        $rowh = mysqli_fetch_assoc($resulth);
                        echo $rowh['sm'];   ?>     
                </h3>

                <p>Case On Hold</p>
              </div>
              <div class="icon">
               
              </div>
              <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

            <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="index55.php" class="small-box-footer">
            <div class="small-box"  style="background-color: rgba(102,102,255,0.8) !important">
              <div class="inner">
                <h3 style="color: #000 !important">  <?php
                     $resulth = mysqli_query($bd,"SELECT count(*) as sm FROM orders WHERE status='progress'");
                        $rowh = mysqli_fetch_array($resulth);
                        echo $rowh['sm'];
                    ?>
                      
                    </h3>

                <p style="color: #000 !important">In Progress</p>
              </div>
              <div class="icon">
                <i class="fas fa-tasks"></i>
              </div>
               <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
           <div class="col-lg-3 col-6">
            <!-- small box -->
             <a href="index6.php" class="small-box-footer">
            <div class="small-box" style="background-color: rgba(102,102,255,0.8) !important">
              <div class="inner">
                <h3 style="color: #000 !important">
                   <?php
                    $resulth = mysqli_query($bd,"SELECT count(*) as sm FROM orders WHERE status='Cancel'");
                        $rowh = mysqli_fetch_array($resulth);
                        echo $rowh['sm'];
                    ?>    
                </h3>

                <p style="color: #000 !important">Canceled Case</p>
              </div>
              <div class="icon">
                <i class="fas fa-money-bill-alt"></i>
              </div>
              <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="index7.php" class="small-box-footer">
            <div class="small-box" style="background-color: #FFF !important">
              <div class="inner">
                <h3 style="color: #000 !important"> <?php
                      $resulth = mysqli_query($bd,"SELECT count(*) as sm FROM orders WHERE status='Completed'");
                        $rowh = mysqli_fetch_array($resulth);
                        echo $rowh['sm'];
                    ?>    
                 
               </h3>

                <p style="color: #000 !important">Completed Cases</p>
              </div>
              <div class="icon">
                <i class="fas fa-dollar-sign"></i>
              </div>
               <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>


        </div>

        <div class="row">
          <!-- Left col -->
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="index8.php" class="small-box-footer">
            <div class="small-box" style="background-color: rgba(102,102,255,0.8) !important">
              <div class="inner">
                <h3 style="color: #000 !important"><?php
                     $resulth = mysqli_query($bd,"SELECT count(*) as sm FROM orders WHERE status='QC Required'");
                        $rowh = mysqli_fetch_array($resulth);
                        echo $rowh['sm'];

                    ?>             
               </h3>
                <p style="color: #000 !important">QC Required</p>
              </div>
              <div class="icon">
               <i class="fas fa-money-bill-alt"></i>
              </div>
               <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
           <div class="col-lg-3 col-6">
            <!-- small box -->
             <a href="donwline.php" class="small-box-footer">
                <div class="small-box" style="background-color: #FFF !important">
                  <div class="inner">
                    <h3 style="color: #000 !important"><?php
                     $tdate=date('d-M-Y', strtotime('-1 day', strtotime(date("d-M-Y"))));
                      $resulth = mysqli_query($bd,"SELECT count(*) as sm FROM orders");
                            $rowh = mysqli_fetch_array($resulth);
                            echo $rowh['sm'];
                        ?> 
                                  
                  </h3>

                    <p style="color: #000 !important">All Cases</p>
                  </div>
                  <div class="icon">
                      <i class="fas fa-tasks"></i>
                  </div>
                   <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
       
        </div>


           <!-- Small boxes (Stat box) -->
      

        

        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="info-box mb-3 bg-warning">
              <span class="info-box-icon"><i class="fas fa-tag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Cases</span>
                <span class="info-box-number"><?php echo 0?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          
        
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-info">
              <span class="info-box-icon"><i class="far fa-comment"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total </span>
                <span class="info-box-number">0</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.card -->

                 <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Client</h3>

                    <div class="card-tools">
                      <span class="badge badge-danger">New Client</span>
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>

                  <div class="card-body p-0">
                    <ul class="users-list clearfix">

                      

                        <?php
                     
                       $sql="SELECT * FROM user limit 10";
                        $res=mysqli_query($bd,$sql);
                        while($row=mysqli_fetch_array($res))
                        {
                    
                           ?>
                             <li>
                                <?php 
                                if ($row['pic']=="" OR $row['pic']=="0") {                          
                                ?>
                                <img src="dist/img/avatar5.png" alt="User n" style="width:128px;height: 128px;">  
                                <?php
                                }else
                                {
                                  ?>
                                  <img src="../<?php echo $row['pic'] ?>" alt="User Image" style="width:128px;height: 128px;">  
                                  <?php
                                }
                                ?>
                                <a class="users-list-name" href="#"><?php echo $row['name'] ?></a>
                                <span class="users-list-date"><?php echo date("d-M-Y",strtotime($row['todaydate'])) ?></span>
                              </li>

                           <?php                           
                            
				                } 
				               
                  ?>
                     
                     
                    </ul>
                    <!-- /.users-list -->
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-center">
                    <a href="allmember.php">View All Client</a>
                  </div>
                  <!-- /.card-footer -->
                </div>


            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">
            <!-- Map card -->
               <!-- TABLE: LATEST ORDERS -->
          <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Joining Of Designer</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>User ID</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Joinging Date</th>
                    </tr>
                    </thead>
                    <tbody>
                 

                    	  <?php
                   
                       $sql="SELECT * FROM user1 limit 10";
            $res=mysqli_query($bd,$sql);
            while($row=mysqli_fetch_array($res))
            {
                           ?>
                         <tr>
                             <td><?php echo $row['id'] ?></td>
                             <td><?php echo $row['name'] ?></td>
                             <td>  <?php 
                                  if ($row['acpinid']!=0) {
                                    ?>
                                <span class="badge badge-success">Activated</span>

                                    <?php
                                  }else
                                  {
                                  ?>
                                  <span class="badge badge-danger">Not Active</span>
                                  <?php
                                  }
                                  ?>
                              </td>                             
                             <td>
                               <div class="sparkbar" data-color="#00a65a" data-height="20"><?php echo date("d-M-Y",strtotime($row['todaydate'])) ?></div>                               
                             </td>
                           </tr>

                           <?php                           
                            
				                } 
				              
                  ?>            
               
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                
                <a href="allmemberd.php" class="btn btn-sm btn-secondary float-right">View All Designer</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->

             
            
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


<?php
include 'footer.php';
?>