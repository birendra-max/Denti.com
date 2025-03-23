<?php
include 'connect.php';
$orderid=$_POST['orderid'];
 $frmsgq="SELECT * FROM orders where orderid='$orderid'";
          $frmsgr=mysqli_query($bd,$frmsgq);
   
         $frmsgrow=mysqli_fetch_array($frmsgr);
?>

 <div class="direct-chat-messages">
                  <!-- Message. Default to the left -->
                  <?php if(!empty($frmsgrow['message'])) { ?>
                   <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left">You</span>
                      <span class="direct-chat-timestamp float-right"><?php echo $frmsgrow['created_at'] ?></span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      <?php echo $frmsgrow['message']."<br>" ;
                     
                      if (!empty($frmsgrow['attachment'])) {
                        ?>
                        <a href="api/chatbox/<?php echo $frmsgrow['attachment'] ?>" class="btn btn-primary"><?php echo $frmsgrow['filename'] ?> </a>
                        <?php
                      }
                      ?>
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->
                 <!-- /.direct-chat-msg -->
                  <!-- /.direct-chat-msg -->
                  <?php
                }
                    $sql22="SELECT * FROM chatbox where orderid='$orderid'";
          $res22=mysqli_query($bd,$sql22);
          $i=1;
          while($row22=mysqli_fetch_array($res22))
          {
            if ($row22['user_type']=="user") 
            {       
                      ?>
                  <!-- Message to the right -->
                  <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left">You</span>
                      <span class="direct-chat-timestamp float-right"><?php echo $row22['created_at'] ?></span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      <?php echo $row22['msg']."<br>" ;
                     
                      if (!empty($row22['attachment'])) {
                        ?>
                        <a href="api/chatbox/<?php echo $row22['attachment'] ?>" class="btn btn-primary" download="<?php echo $row22['filename'] ?>"><?php echo $row22['filename'] ?>  </a>
                        <?php
                      }
                      ?>
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->
              <?php }else{ ?>
                  <!-- Message. Default to the left -->
                  <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-right"><?php echo $row22['user_type']?></span>
                      <span class="direct-chat-timestamp float-left"><?php echo $row22['created_at'] ?></span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img " src="dist/img/user1-128x128.jpg" alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text" style="background-color: #007BFF !important;color: #FFF !important;font-weight: bold !important;">
                        <?php echo $row22['msg']."<br>";
                     
                      if (!empty($row22['attachment'])) {
                        ?>
                        <a href="api/chatbox/<?php echo $row22['attachment'] ?>" download="<?php echo $row22['filename'] ?>" class="btn btn-warning"><?php echo $row22['filename'] ?>  </a>
                        <?php
                      }
                      ?>
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->
              <?php 
              }
              } 
              ?>
                
                  <!-- /.direct-chat-msg -->
                    <div class="chat_live_go"></div>
                </div>
                <!--/.direct-chat-messages-->

             
                          <!-- /.direct-chat-pane -->
                       
                     
