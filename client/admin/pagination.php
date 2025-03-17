<?php
include 'header.php';
$status=base64_decode($_GET['type']);

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color: #343A40 !important;color: #FFF !important;font-weight: bold !important;">
    <!-- Content Header (Page header) -->
      <!-- Main content -->
    <section class="content">
      <div class="container-fluid">      
          <br><br>
        <!-- Small boxes (Stat box) -->
        <?php include_once 'dashboard.php' ?>
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
            <div class="col-2">
            <div class="form-group">             
              <input type="button" name="run_button" id="run_button" value="Run Self" class="btn btn-warning">
            </div>
          </div>
        </div>
      <?php                
    if (isset($_GET['pageno'])) {
                $pageno = $_GET['pageno'];
            } else {
                $pageno = 1;
            }
            $no_of_records_per_page =50;
            $offset = ($pageno-1) * $no_of_records_per_page;
            $total_rows=Total_row($bd,$status);
           	
            $total_pages = ceil($total_rows / $no_of_records_per_page);  
    ?>
        <div class="card" style="background-color: #343A40 !important;color: #FFF !important;font-weight: bold !important;">
         <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  <?php echo $status ?> List
                </h3>

                <div class="card-tools">
                  
                  <ul class="pagination pagination-sm" >
                    <li class="page-item"><a href="?pageno=1&type=<?php echo base64_encode($status) ?>" class="page-link" >&laquo; First</a></li>
                    
            <?php
        $maxVisiblePages = 50;  // Maximum number of visible pages
        $startPage = max(2, $pageno - floor($maxVisiblePages / 2));
        $endPage = min($total_pages - 1, $startPage + $maxVisiblePages - 1);

        if ($startPage > 2) {
            echo '<li class="page-item"><a href="?pageno=2&type=' . base64_encode($status) . '" class="page-link">2</a></li>';
            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }

        for ($i = $startPage; $i <= $endPage; $i++) {
            echo '<li class="page-item ' . ($pageno == $i ? 'disabled' : '') . '">';
            echo '<a href="?pageno=' . $i . '&type=' . base64_encode($status) . '" class="page-link">' . $i . '</a>';
            echo '</li>';
        }

        if ($endPage < $total_pages - 1) {
            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
            echo '<li class="page-item"><a href="?pageno=' . ($total_pages - 1) . '&type=' . base64_encode($status) . '" class="page-link">' . ($total_pages - 1) . '</a></li>';
        }
        ?>
                    <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>&type=<?php echo base64_encode($status) ?>" class="page-link">&raquo; Last</a></li>
                  </ul>
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
            
            
    		//$data=$p->select_limit($offset,$no_of_records_per_page);

                          
                          
                          
                          $i=0;
                          if($status=="All")
                          $sql="SELECT * FROM orders LIMIT $offset,$no_of_records_per_page ";
                          else
                           $sql="SELECT * FROM orders where  status='$status' LIMIT $offset,$no_of_records_per_page ";
                          
                     // $sql="SELECT * FROM orders where  status='$status' order by created_at DESC";
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
                             <td> <i class="fas fa-running" style="font-size: 18px;font-weight: bold;"></i><?php if($row['tduration']=="Rush") { echo "1 - 2 Hour";}
                              if($row['tduration']=="Same Day") { echo "6 Hour";}
                              if($row['tduration']=="Next Day") { echo "12 Hour <i class='fas fa-moon' style='font-size:18px'></i>";}if(empty($row['tduration'])) { echo "12 Hour <i class='fas fa-moon' style='font-size:18px'></i>";}
                              ?></td>
                             <td> 
                                 <div class="btn <?php if($row['status']=='New') echo 'bg-white';if($row['status']=='Cancel') echo 'bg-danger';if($row['status']=='Completed') echo 'bg-success';if($row['status']=='QC Required') echo 'bg-info';if($row['status']=='Hold') echo 'bg-danger';if($row['status']=='Redesign') echo 'bg-warning';if($row['status']=='progress') echo 'bg-default'; ?>" style="width:<?php if($row['status']=='New') echo '100%';if($row['status']=='Cancel') echo '100%';if($row['status']=='Completed') echo '100%';if($row['status']=='QC Required') echo '100%';if($row['status']=='Hold') echo '100%';if($row['status']=='Redesign') echo '100%';if($row['status']=='progress') echo '100%'; ?>"> <?php echo $row['status'] ?> </div> 
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
//   var link = document.createElement('a');

//   link.setAttribute('download', null);
//   link.style.display = 'none';

//   document.body.appendChild(link);

  for (var i = 0; i < urls.length; i++) {
    // link.setAttribute('href', urls[i]);
    // mystr=urls[i].split("/");
    // link.setAttribute('download', mystr[3]);
    // link.click();
    window.open(urls[i],"_blank");
  }

  //document.body.removeChild(link);
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