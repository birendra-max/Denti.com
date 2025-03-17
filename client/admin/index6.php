<?php
include 'header.php';


?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <!-- Main content -->
    <section class="content">
      <div class="container-fluid">      
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
        
        <!-- Small boxes (Stat box) -->
        <div class="row">
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="index.php" class="small-box-footer">
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
           <div class="row">          
          <div class="col-2">
              <div class="form-group">                
                <input type="checkbox" name="select_all" id="select_all" onclick='selects()' value="all"> Select All Cases
              </div>
            </div>
          <div class="col-2">
            <div class="form-group">            
            <select class="form-control" id="download_file">
              <option value="Initial">Initial File</option>
              <option value="STL">STL File</option>
              <option value="Finished">Finished File</option>
            </select>
            </div>
          </div>
          <div class="col-2">
            <div class="form-group">              
              <input type="button" name="donload_button" id="download_button" value="Donwload Now" class="btn btn-primary">
            </div>
          </div>
            <!-- <div class="col-2">
            <div class="form-group">             
              <input type="button" name="run_button" id="run_button" value="Run Self" class="btn btn-warning">
            </div>
          </div> -->
        </div>
         <div class="table table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                       <thead>
                        <tr>                          
                          <th>OrderID</th>
                          <th>Name</th>
                          <th>TAT</th>
                          <th width="100">Status</th>
                          <th>Unit</th>
                          <th>Tooth</th>
                          
                          <th>Lab Name</th>
                          <th>Date</th>
                          <th>Message</th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php
                          //$clientid=$_SESSION['email'];
                          $i=0;
                      $sql="SELECT * FROM orders where  status='Cancel'";
                       $tdate=date("d-M-Y");
                        $res=mysqli_query($bd,$sql);
                        while($row=mysqli_fetch_array($res))
                        {
                      
                           ?>
                           <tr>
                             <td>

                                <input type="checkbox" name="caseid" class="caseid" id="caseid<?php echo $i?>" value="<?php echo $i?>"> 
                              <a href="order_detail.php?orderid=<?php echo $row['orderid'] ?>"><?php echo $row['orderid'] ?></a>

                              <input type="hidden" id="initial<?php echo $i?>" value="../api/files/<?php echo $row['filename'] ?>">



                              <input type="hidden" id="orderid_update<?php echo $i?>" value="<?php echo $row['orderid'] ?>">

                              <?php 
                              $orderid=$row['orderid'];
                             $sql2="SELECT * FROM orders_finished where orderid='$orderid'";
                        $res2=mysqli_query($bd,$sql2);
                        $row2=mysqli_fetch_array($res2);

                               ?>
                               <input type="hidden" id="finished_file<?php echo $i?>" value="../api/finished_files/<?php echo $row2['finished_file'] ?>">
                                <?php 
                              $orderid=$row['orderid'];
                              $sql23="SELECT * FROM orders_stl_files where orderid='$orderid'";
                        $res23=mysqli_query($bd,$sql23);
                        $st="";
                        $f=0;
                        $st = array();
                        while($row23=mysqli_fetch_assoc($res23))
                        {                          
                            $st[$f]=$row23['filename'];                         
                            $f++;                          
                        }
                      
                       ?>
                               <input type="hidden" size="5000" id="stl_file<?php echo $i?>" value="../api/stl_files/<?php echo implode("|", $st); ?>">

                             </td>
                             <td><?php echo $row['fname'] ?></td>
                             <td><?php if($row['tduration']=="Rush") { echo "1 - 2 Hour";}
                              if($row['tduration']=="Same Day") { echo "6 Hour";}
                              if($row['tduration']=="Next Day") { echo "12 Hour";}if(empty($row['tduration'])) { echo "12 Hour";}
                              ?></td>
                             <td> <i class="fas fa-clock"> </i>
                                <div class="progress">
                                  <div class="progress-bar <?php if($row['status']=='New') echo 'bg-white';if($row['status']=='Cancel') echo 'bg-danger';if($row['status']=='Completed') echo 'bg-success';if($row['status']=='QC Required') echo 'bg-primary';if($row['status']=='Hold') echo 'bg-danger';if($row['status']=='Redesign') echo 'bg-warning'; ?>" style="width:<?php if($row['status']=='New') echo '100%';if($row['status']=='Cancel') echo '40%';if($row['status']=='Completed') echo '100%';if($row['status']=='QC Required') echo '90%';if($row['status']=='Hold') echo '50%';if($row['status']=='Redesign') echo '100%'; ?>"> <?php echo $row['status'] ?> </div>
                                </div> 
                              </td>
                             <td><?php echo $row['unit'] ?></td>
                             <td><?php echo implode("-",explode(",",$row['tooth'])) ?></td>
                            
                             <td><?php echo $row['labname'] ?></td>

                             <td><?php echo $row['created_at'] ?></td>
                             <td> <button data-id="<?php echo $row['orderid'] ?>" class="btn btn-primary chatbtn">
                              <?php
                              $orderid=$row['orderid'];
                              $msgq="SELECT count(*) as cnt FROM chatbox where orderid='$orderid'";
                        $resmsg=mysqli_query($bd,$msgq);
                       
                       $msgrow=mysqli_fetch_array($resmsg);

                              if(!empty($row['message']))
                                echo ($msgrow['cnt']+1);
                              else
                                 echo ($msgrow['cnt']);
                              ?>  <i class="fas fa-comments"></i>
                            </button>
                            </td>
                           </tr>
                           <?php
                           $i++;
                            }       
                      
                  ?>
                        </tbody>
                      
                      
                    </table>  
                    </div>
        <!-- /.row (main row) -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<script type="text/javascript">


        $(function() {

            $('#run_button').click(function() {
                var dd;
                 $('.caseid:checked').each(function() {
              var stt=$("#orderid_update"+($(this).val())).val();
              dd=dd+","+stt;
                             
            });
                $.ajax({
                    type: 'POST',
                    url: 'update_run_self.php',
                    data: {
                        'orderid_update': dd,
                        // other data
                    },
                    success: function(result) {
                      alert(result);
                      window.location='index.php';
                    }
                });

            });

        });



 
</script>

<script type="text/javascript">

  $('#download_button').on('click', function() {
            var urls = [];
          var cnt=0;
      if ($("#download_file").val()=='Initial') {
            $('.caseid:checked').each(function() {
                urls.push($("#initial"+($(this).val())).val());      
            //alert($("#initial"+($(this).val())).val());        
            });
    }
      if ($("#download_file").val()=='Finished') {
            $('.caseid:checked').each(function() {
  //alert($("#finished_file"+($(this).val())).val());
                urls.push($("#finished_file"+($(this).val())).val());              
            });
    }
     if ($("#download_file").val()=='STL') {
      var txt="";
            $('.caseid:checked').each(function() {
              var stt=($("#stl_file"+($(this).val())).val()).split("|");
             //alert(stt);
              for (var i = 0; i<stt.length; i++) {
                //alert(stt[i]);
                if (i==0) 
                 txt=stt[i];
              else
                txt="../api/stl_files/"+stt[i];
                urls.push(txt); 
              }
                             
            });
    } 
    //alert("hello");         
    downloadAll(urls);  
        });
function downloadAll(urls) {

  for (var i = 0; i < urls.length; i++) {
    
    window.open(urls[i],"_blank");
  }


}
var c=0;

  function selects(){  
             if( c%2==0)
              {
                var ele=document.getElementsByName('caseid');  
                for(var i=0; i<ele.length; i++){  
                    if(ele[i].type=='checkbox')  
                        ele[i].checked=true;  
                }
            }
             if(c%2!=0)
              {
        var ele=document.getElementsByName('caseid');  
                for(var i=0; i<ele.length; i++){  
                    if(ele[i].type=='checkbox')  
                        ele[i].checked=false;  
                      
                } 
              }   
              c++;
            } 
</script>





<?php
include 'footer.php';
?>