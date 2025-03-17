<?php  
include 'header.php';
$orderid=trim($_POST['orderid']);
//die;
 $sql="SELECT * FROM orders where orderid like '%$orderid%' or fname like '%$orderid%'";
//die;
$res=mysqli_query($bd,$sql);
$row=mysqli_fetch_array($res);


if (isset($_POST['submit2'])) {
	$orderid=$_POST['orderid_new'];
	$status=$_POST['status'];
	$sql="UPDATE orders set status='$status' where orderid='$orderid'";

	if (mysqli_query($bd,$sql)) {
		echo "<script> toastr.success('$orderid is updated successfully.');</script>";
	}
	else
	{		
		echo "<script>  toastr.error('Selected case of status can not be change. Plese try after sometime.');</script>";

	}
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style type="text/css">

#drag_drop{
    background-color : #f9f9f9;
    border : #ccc 4px dashed;
    line-height : 250px;
    padding : 12px;
    font-size : 24px;
    text-align : center;
}
 div.radio-box {
   width: 100px;
   display: inline-block;
   margin: 5px;
   
}
.radio-box label {
   display:block;
   width: 100px;
   text-align: center;
}
</style>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <!-- Main content -->
    <section class="content">
      <div class="container-fluid">      


			        <div class="row">
			          <div class="col-12">
			            <div class="card">
			              <div class="card-header">
			                <h3 class="card-title">Order Detail</h3>
			              </div>
			              <div class="card-body">
			               <div class="row">
			               	<input type="hidden" id="order_caseid" value="<?php echo $orderid ?>">
			          			<div class="col-4">
			          				<label>Order ID : </label>	<?php echo $row['orderid'] ?>
			          			</div>
			          			<div class="col-4">
			          				<label><i class="fas fa-clock"></i> </label>  <?php echo $row['status'] ?>	
			          			</div>
			          			<div class="col-4">
			          				<a href="donwline.php" class="btn btn-success">Back</a>
			          			</div>
			          		</div>
			          		<form action="" method="post">
			          		<br><br>
			          		<input type="hidden" name="orderid_new" value="<?php echo $row['orderid'] ?>">
			          		<div class="row">
			          			<div class="col-7">
			          				<label>Initial Scan : </label><a href="../api/files/<?php echo $row['filename'];?>">	<?php echo ($row['filename']); ?></a> || <?php echo $row['created_at'];?>
			          			</div>
			          			<div class="col-3">
			          				<select class="form-control" name="status" required>
			          					<option value="" <?php if($row['status']=='New') echo 'selected' ?>>Select Status</option>

			          					<option value="QC Required" <?php if($row['status']=='QC Required') echo 'selected' ?>>QC Required</option>
			          					<option value="Completed" <?php if($row['status']=='Completed') echo 'selected' ?>>Completed</option>

			          					<option value="Hold" <?php if($row['status']=='Hold') echo 'selected' ?>>Hold</option>
			          					<option value="Cancel" <?php if($row['status']=='Cancel') echo 'selected' ?>>Cancel</option>
			          					
			          				</select>
			          				
			          			</div>
			          			<div class="col-1">
			          				<input type="submit" name="submit2" value="Change" class="btn btn-primary">
			          			</div>
			          			
			          		</div>
			          		</form>
			          		<div class="row">
			          			<div class="col-4">
			          				<div class="form-group">
			          					<label>STL File</label>	
			          					
			          				</div>

			          				<table class="table table-hover">
			          						<thead>
			          							<tr>
			          							<th>Sr.No</th>
			          							<th>File</th>
			          							<th>Created At</th>
			          						</tr>
			          						</thead>
			          					<?php 
			          					$sql22="SELECT * FROM orders_stl_files where orderid='$orderid'";
										$res22=mysqli_query($bd,$sql22);
										$i=1;
										while($row22=mysqli_fetch_array($res22))
										{
											?>
											<tr>
												<td><?php echo $i++ ?></td>
												<td><a href="../api/stl_files/<?php echo $row22['filename'] ?>"><?php echo $row22['filename'] ?></a></td>
												<td><?php echo $row22['created_at'] ?></td>
											</tr>

											<?php
										}
			          					?>		   
			          					</table>
			          			</div>
			          		</div>
			          		<div class="row">
			          			<div class="col-12">
			          				<div class="form-group">
			          					<label>Finished Design</label>
			          						          					
			          				</div>
			          				<?php
			          					$sql23="SELECT * FROM orders_finished where orderid='$orderid'";
										$res23=mysqli_query($bd,$sql23);
										$i=1;
										$row23=mysqli_fetch_array($res23);	
										?>		          			
										<a href="../api/finished_files/<?php echo $row23['finished_file'] ?>"> <?php echo $row23['finished_file'] ?> || <?php echo $row23['created_at'] ?></a>
			          			</div>
			          		</div>

			          		<div class="row">
				              <div class="col-sm-12">
				                <div id="table_div"></div>
				              </div>
				            </div>

			          		<h5>Cases</h5>
			          		<div class="row">
			          			<div class="col-6">
			          				<table class="table table-hover">
			          					<thead>
			          						<tr>
			          							<th>Tooth</th>
			          							<th>Design Type</th>
			          							<th>TAT</th>
			          						</tr>
			          					</thead>
			          				</table>
			          			</div>
			          			<div class="col-6">
			          				<h4>Default Design Preferences</h4>
			          				<?php 
			          				$email=$row['clientid'];
									$sql2="SELECT * FROM user where em='$email'";
									$res2=mysqli_query($bd,$sql2);
									$row2=mysqli_fetch_array($res2);

									?>
			          				<table class="table table-hover">
			          					<thead>
			          						<tr>
			          							<th>Contact : <?php echo $row2['contact']; ?> </th>
			          							<th>Occlusion :  <?php echo $row2['occlusion']; ?> </th>
			          						</tr>
			          						<tr>
			          							<th>Anatomy : <?php echo $row2['anatomy']; ?></th>
			          							<th>Pontic :  <?php echo $row2['pontic']; ?></th>
			          						</tr>
			          						<tr>
			          							<th>Liner Spacer : <?php echo $row2['lspacer']; ?></th>			          							
			          						</tr>
			          						<tr>
			          							<th>Custom :  <?php echo $row2['custom']; ?></th>         							
			          						</tr>
			          					</thead>
			          				</table>
			          				
			          				<h4>Order Messages</h4>

			  <div class="card direct-chat direct-chat-primary">
             
              <!-- /.card-header -->
              <div class="card-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">
                  <!-- Message. Default to the left -->
                  <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left">User</span>
                      <span class="direct-chat-timestamp float-right"><?php echo trim($row['created_at']) ?></span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      <?php echo trim($row['message']) ?>
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->
                <!-- /.direct-chat-msg -->
                  <?php
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
                      	<a href="../api/chatbox/<?php echo $row22['attachment'] ?>">Download </a>
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
                      	<a href="../api/chatbox/<?php echo $row22['attachment'] ?>">Download </a>
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
					                <input type="hidden" id="orderid" name="orderid" value="<?php echo $row['orderid']; ?>">
                					
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
					              </div>
					              <!-- /.card-footer-->
					            </div>
					            <!--/.direct-chat -->
			          			</div>
			          		</div>
			          	</div>
			            </div>
			          </div>
			        </div>
			   

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
               $("#chat_live").html('<div class="direct-chat-msg"><div class="direct-chat-infos clearfix"><span class="direct-chat-name float-left">You</span><span class="direct-chat-timestamp float-right">"'+arr[1]+'"</span>    </div><img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image"><div class="direct-chat-text"> "'+arr[0]+'"</div></div>');        }
     });
});
 });
</script>

</div>
</section>
</div>
<?php
include 'footer.php';
?>