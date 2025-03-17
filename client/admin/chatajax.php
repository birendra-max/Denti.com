<?php
include 'connect.php';
$orderid=$_POST['orderid'];
 $frmsgq="SELECT * FROM orders where orderid='$orderid'";
          $frmsgr=mysqli_query($bd,$frmsgq);
   
         $frmsgrow=mysqli_fetch_array($frmsgr);
?>

 <div class="direct-chat-messages">
  <?php if(!empty($frmsgrow['message'])) { ?>
                  <!-- Message. Default to the left -->
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
                        <a href="../api/chatbox/<?php echo $frmsgrow['attachment'] ?>" class="btn btn-primary"><?php echo $frmsgrow['filename'] ?> </a>
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
                        <a href="../api/chatbox/<?php echo $row22['attachment'] ?>" class="btn btn-primary"><?php echo $row22['filename'] ?> </a>
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
                    <div class="direct-chat-text">
                        <?php echo $row22['msg']."<br>";
                     
                      if (!empty($row22['attachment'])) {
                        ?>
                        <a href="../api/chatbox/<?php echo $row22['attachment'] ?>" class="btn btn-primary"><?php echo $row22['filename'] ?> </a>
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
                    <div id="chat_live"></div>
                </div>
                <!--/.direct-chat-messages-->

             
                          <!-- /.direct-chat-pane -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                          <form action="#" method="post" enctype="multipart/form-data">
                          <input type="hidden" id="orderid" name="orderid" value="<?php echo $orderid; ?>">
                            <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <textarea name="message" id="message" class="form-control" rows="3"></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-8">
                              <div class="form-group">
                                <button type="button" id="send" class="btn btn-primary">Send</button>
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                <div class="btn btn-default btn-file">
                                        <i class="fas fa-paperclip"></i> Attachment
                                        <input type="file" name="file" id="file" />
                                      </div>
                              </div>
                            </div>
                          </div>
                          </form>
 <script type="text/javascript">

$(document).ready(function () {
$('#send').on('click', function() {
    var file_data = $('#file').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data);
    form_data.append('message_id',$("#message").val());
    form_data.append('orderid_id',$("#orderid").val());
    //alert(form_data);                             
    $.ajax({
        url: 'update_chatbox.php', // <-- point to server-side PHP script 
        dataType: 'text',  // <-- what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(response){
        $("#message").val('');
              //alert(response);
              var arr=response.split("____");
               $("#chat_live").append('<div class="direct-chat-msg"><div class="direct-chat-infos clearfix"><span class="direct-chat-name float-left">You</span><span class="direct-chat-timestamp float-right">"'+arr[1]+'"</span>    </div><img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image"><div class="direct-chat-text"> "'+arr[0]+'"</div></div>');    
                $(".direct-chat-messages").animate({
                    scrollTop: $("#chat_live").offset().top
               }); 
                   }
     });
});
 });
</script>
