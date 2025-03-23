<?php
include 'connect.php';
$d=$_GET['q'];
$odate=date("d-M-Y");
$dd=explode(",",$d);
$f=0;


                             $sdate=date("d-M-Y",strtotime($dd[0]));
                              $edate=date("d-M-Y",strtotime($dd[1]));
                              $labname=$dd[2];
                              echo "<h3 class='text-center btn btn-warning'>From : ".$sdate." To ".$edate."</h3>";

                          ?>
                          <div class="row">
                            <div class="col-1"></div>
                            <div class="col-2">
                              <div class="form-group">
                                <label>Action </label><br>
                                <a href="deletealllisted.php?sdate=<?php echo $sdate ?>&edate=<?php echo $edate ?>&labname=<?php echo $labname ?>" class="btn btn-danger"> Delete All Listed Initial</a>
                              </div>
                            </div>
                            <div class="col-2">
                              <div class="form-group">
                                <label>Action </label><br>
                                <a href="deletealllisted2.php?sdate=<?php echo $sdate ?>&edate=<?php echo $edate ?>&labname=<?php echo $labname ?>" class="btn btn-danger"> Delete All Listed Finished</a>
                              </div>
                            </div>
                            <div class="col-2">
                              <div class="form-group">
                                <label>Action </label><br>
                                <a href="downloadallfile.php?sdate=<?php echo $sdate ?>&edate=<?php echo $edate ?>&labname=<?php echo $labname ?>" class="btn btn-danger" > Download All Listed Initial </a>
                                
                              </div>
                            </div>
                            <div class="col-4">
                              <div class="form-group">
                                <label>Action </label><br>
                                 <a href="downloadallfilefinished.php?sdate=<?php echo $sdate ?>&edate=<?php echo $edate ?>&labname=<?php echo $labname ?>" class="btn btn-danger" > Download All Listed Finished File</a>
                              </div>
                            </div>
                          </div>
                     <div class="table table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                       <thead>
                        <tr>                          
                          <th>OrderID</th>
                          <th>Name</th>                         
                                                 
                          <th>Lab Name</th>
                          <th>Date</th>
                          <th>Backup</th>
                          <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php
                          
                             //$clientid=$_SESSION['email'];
                          $i=0;
                          $tdate=date('d-M-Y');
                          if ($labname=="all")
                            $sql="SELECT * FROM orders";
                          else
                       $sql="SELECT * FROM orders where labname='$labname'";
                        $res=mysqli_query($bd,$sql);
                        while($row=mysqli_fetch_array($res))
                        {
                          if (strtotime($sdate)<=strtotime(date("d-M-Y",strtotime($row["created_at"]))) and strtotime(date("d-M-Y",strtotime($row["created_at"]))) <=strtotime($edate)) {
                           
                          
                           ?>
                           <tr>
                             <td>
                              <input type="checkbox" name="caseid" class="caseid" id="caseid<?php echo $i?>" value="<?php echo $i?>"> 
                              <a href="order_detail.php?orderid=<?php echo $row['orderid'] ?>"><?php echo $row['orderid'] ?></a>

                              <input type="hidden" id="initial<?php echo $i++?>" value="api/files/<?php echo $row['filename'] ?>">
                              <?php 
                              $orderid=$row['orderid'];
                              $sql2="SELECT * FROM orders_finished where orderid='$orderid'";
                        $res2=mysqli_query($bd,$sql2);
                        $row2=mysqli_fetch_array($res2);

                               ?>
                               <input type="hidden" id="finished_file<?php echo $i++?>" value="api/finished_files/<?php echo $row2['finished_file'] ?>">
                                <?php 
                              $orderid=$row['orderid'];
                              $sql23="SELECT * FROM orders_stl_files where orderid='$orderid'";
                        $res23=mysqli_query($bd,$sql23);
                        $st="";
                        $f=0;
                        while($row23=mysqli_fetch_array($res23))
                        {
                          if ($f==0) 
                            $st=$row23['filename'];
                          else
                            $st=$st."||||".$row23['filename'];
                          
                        }

                               ?>
                               <input type="hidden" id="stl_file<?php echo $i++?>" value="api/stl_files/<?php echo $st ?>">

                             </td>
                             <td><?php echo $row['fname'] ?></td>
                           
                             <td><?php echo $row['labname'] ?></td>

                             <td><?php echo $row['created_at'] ?></td>
                               <td> <?php
                               $dirr="../api/files/".$row['filename'];

                                if(file_exists($dirr) and !empty($row['filename'])){ ?>
                                <a href="downloadfile.php?filepid=../api/files/<?php echo $row['filename'];?>&type=init&pid=<?php echo $row['id'];?>" class="btn btn-<?php if($row['backup_status']=='1') echo 'success';else echo 'warning' ?>" target="_blank" > <i class="fas fa-download"></i> Initial</a> 
                                <?php
                                }else{ 
                                ?>
                                <a href="#" class="btn btn-danger"> <i class="fas fa-download"></i> Initial</a> 
                              <?php } ?>
                                ||
                                <?php
                          $sql23="SELECT * FROM orders_finished where orderid='$orderid'";
                          $res23=mysqli_query($bd,$sql23);
                          
                          $row23=mysqli_fetch_array($res23);  
                           $dirr2="../api/finished_files/".$row23['finished_file'];

                                if(file_exists($dirr2) and !empty($row23['finished_file'])){ ?>
                                            
                          <a href="downloadfile.php?filepid=../api/finished_files/<?php echo $row23['finished_file'];?>&type=finished&pid=<?php echo $row23['id'];?>" class="btn btn-<?php if($row23['backup_status']=='1') echo 'success';else echo 'warning' ?>" target="_blank"> <i class="fas fa-download"></i> Finished</a>
                        <?php }else{ ?>

                           <a href="#" class="btn btn-danger"> <i class="fas fa-download"></i> Finished</a>
                         <?php }?>
                            </td>
                             <td> <?php
                               $dirr="../api/files/".$row['filename'];

                                if(file_exists($dirr) and !empty($row['filename'])){ ?>
                                <a href="deletefile.php?filepid=../api/files/<?php echo $row['filename'];?>&type=init&pid=<?php echo $row['id'];?>" class="btn btn-<?php if($row['delete_status']=='1') echo 'success';else echo 'warning' ?>" target="_blank"> <i class="fas fa-trash"></i> Delete Initial</a> 
                                <?php
                                }else{ 
                                ?>
                                <a href="#" class="btn btn-danger"> <i class="fas fa-trash"></i> Deleted Initial</a> 
                              <?php } ?>
                                ||
                                <?php
                          $sql23="SELECT * FROM orders_finished where orderid='$orderid'";
                          $res23=mysqli_query($bd,$sql23);
                          
                          $row23=mysqli_fetch_array($res23);  
                           $dirr2="../api/finished_files/".$row23['finished_file'];

                                if(file_exists($dirr2) and !empty($row23['finished_file'])){ ?>
                                            
                          <a href="deletefile.php?filepid=../api/finished_files/<?php echo $row23['finished_file'];?>&type=finished&pid=<?php echo $row23['id'];?>" class="btn btn-<?php if($row23['delete_status']=='1') echo 'success';else echo 'warning' ?>" target="_blank"> <i class="fas fa-trash"></i> Delete Finished </a>
                        <?php }else{ ?>

                           <a href="#" class="btn btn-danger"> <i class="fas fa-trash"></i>Deleted Finished </a>
                         <?php }?>
                            </td>
                           </tr>
                           <?php
                          }
                            }       
                      
                  ?>
                        </tbody>
                      
                    </table>  
                    </div>
