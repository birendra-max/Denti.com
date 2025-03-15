<?php
include 'connect.php';
$dd=$_GET['q'];
$dd=explode(",",$dd);
$d=$dd[0];
$snumber=$dd[1];
$enumber=$dd[2];
$odate=date("d-M-Y");
$status="";
$f=0;
if ($d=='1')
{
  $status="All";
  $f=1;
}
  if ($d=='2')
  {
   $status="New";
    $f=1;
  }
    if ($d=='3')
    {
      $status="progress";
      $f=1;
    }
     if ($d=='4')
    {
      $status="QC Required";
      $f=1;
    }
     if ($d=='5')
    {
      $status="Hold";
      $f=1;
    }
    if ($d=='6')
    {
      $status="Completed";
      $f=1;
    }
    if ($d=='7')
    {
      $status="Cancel";
      $f=1;
    }
     if ($d=='8')
    {
      $status="Completed";
      $f=1;
    }

  

if ($f==1) {
                             // $sdate=date("d-M-Y",strtotime($_POST['sdate']));
                             //  $edate=date("d-M-Y",strtotime($_POST['edate']));

                              //echo "<h3 class='text-center btn btn-warning'> : ".$status."</h3>";

                          ?>
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
                          
                             $clientid=$_SESSION['email'];
                          $i=0;
                          $tdate=date('d-M-Y');
                           $sql="";
                          if ($status=='All') {
                           $sql="SELECT * FROM orders where orderid  BETWEEN $snumber and $enumber";
                          }else
                          {
                       $sql="SELECT * FROM orders where status='$status' and  orderid  BETWEEN $snumber and $enumber";
                     }
                        $res=mysqli_query($bd,$sql);
                        while($row=mysqli_fetch_array($res))
                        {
                         
                          
                           ?>
                          <tr>
                             <td>
                              <input type="checkbox" name="caseid" class="caseid" id="caseid<?php echo $i?>" value="<?php echo $i?>"> 
                              <a href="order_detail.php?orderid=<?php echo $row['orderid'] ?>"><?php echo $row['orderid'] ?></a>

                              <input type="hidden" id="initial<?php echo $i?>" value="../api/files/<?php echo $row['filename'] ?>">
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
<?php

}else
{
  echo "data not found";
}

?>