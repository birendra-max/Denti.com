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
            <h1>Orders</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Orders</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

			    <section class="content">
			      <div class="container-fluid">
			        <div class="row">
			          <div class="col-12">
			            <div class="card">
			             
			              <!-- /.card-header -->
			              
			               <div class="row">          
          <div class="col-3">
              <div class="form-group">
                <label>Selection Type</label><br>
                <input type="checkbox" name="select_all" id="select_all" onclick='selects()' value="all"> Select All Cases
              </div>
            </div>
          <div class="col-3">
            <div class="form-group">
            <label>Donwload</label>
            <select class="form-control" id="download_file">
              <option value="Initial">Initial File</option>
              <option value="STL">STL File</option>
              <option value="Finished">Finished File</option>
            </select>
            </div>
          </div>
          <div class="col-3">
            <div class="form-group">
              <label>Action</label><br>
              <input type="button" name="donload_button" id="download_button" value="Donwload Now" class="btn btn-primary">
            </div>
          </div>
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
                       $sql="SELECT * FROM orders ";
                        $res=mysqli_query($bd,$sql);
                        //$tdate=date('d-M-Y', strtotime('-1 day', strtotime(date("d-M-Y"))));

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