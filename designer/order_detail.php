<?php
include 'header.php';

?>
<style>
	#divLoading {
		margin: 0px;
		display: none;
		padding: 0px;
		position: absolute;
		right: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		background-color: rgb(255, 255, 255);
		z-index: 30001;
		opacity: 0.8;
	}

	#loading {
		position: absolute;
		color: White;
		top: 50%;
		left: 45%;
	}
</style>

<div id="divLoading">
	<p id="loading">
		<img src="sample.gif">
	</p>
</div>
<?php
$orderid = $_GET['orderid'];
$sql = "SELECT * FROM orders where orderid='$orderid'";
$res = mysqli_query($bd, $sql);
$row = mysqli_fetch_array($res);
if (isset($_POST['submitp'])) {
	$orderid = $_POST['orderid'];
	extract($_POST);
	//$status=$_POST['crown'];
	$sql = "UPDATE orders set crown='$crown',tooth='$tooth',unit='$unit',model='$model',framework='$framework',abu='$abu',custom='$custom',remark='$remark' where orderid='$orderid'";

	if (mysqli_query($bd, $sql)) {
		echo "<script> toastr.success('$orderid is updated successfully.');</script>";
	} else {
		echo "<script>  toastr.error('Selected case of status can not be change. Plese try after sometime.');</script>";
	}
}
if (isset($_POST['submit2'])) {
	$orderid = $_POST['orderid'];
	$status = $_POST['status'];
	$tdate = date("d-M-Y h:i:sa");
	$sql = "UPDATE orders set status='$status',status_ch_date='$tdate',status_c='$status',c_date='$tdate',c_id='$em' where orderid='$orderid'";

	if (mysqli_query($bd, $sql)) {
		echo "<script> toastr.success('$orderid is updated successfully.');</script>";
	} else {
		echo "<script>  toastr.error('Selected case of status can not be change. Plese try after sometime.');</script>";
	}
}
if (isset($_GET['stl_id_o']) && isset($_GET['stl_filename_o'])) {
	$stl_id = intval($_GET['stl_id_o']); // Ensure the ID is an integer
	$stl_filename = $_GET['stl_filename_o']; // No need to urldecode here unless filename is URL encoded

	// Sanitize the filename to avoid path traversal issues
	$stl_filename = basename($stl_filename);

	// SQL query to delete the entry from the database
	$sql = "DELETE FROM orders_stl_files WHERE id = $stl_id";

	if (mysqli_query($bd, $sql)) {
		// Full file path
		$file_path = "../api/stl_files/" . $stl_filename;

		// Check if the file exists before attempting to delete
		if (file_exists($file_path)) {
			if (unlink($file_path)) {
				echo "<script> toastr.error('$stl_id is deleted successfully.'); window.location.reload(); </script>";
			} else {
				echo "<script> toastr.error('Could not delete the file. Please try again later.');</script>";
			}
		} else {
			echo "<script> toastr.error('File does not exist.');</script>";
		}
	} else {
		echo "<script> toastr.error('Database operation failed.');</script>";
	}
}
if (isset($_GET['finished_id_o'])) {
	$finished_id = $_GET['finished_id_o'];
	$finished_filename = urldecode($_GET['finished_filename_o']);
	$file_path = "../api/finished_file" . $finished_filename;

	// Delete from database
	$sql = "DELETE FROM orders_finished WHERE id = $finished_id";
	mysqli_query($bd, $sql);
	ob_clean();
	flush();

	// Check if the file exists before deleting
	if (file_exists($file_path)) {
		if (unlink($file_path)) {
			echo "<script> toastr.error('$finished_id is deleted successfully.'); window.location.reload(); </script>";
		} else {
			echo "<script> toastr.error('Could not delete the file. Please try again later.');</script>";
		}
	} else {
		echo "<script> toastr.error('File does not exist.');</script>";
	}
}

?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<title><?php echo $_GET['orderid']; ?></title>
<style type="text/css">
	#drag_drop {
		background-color: #f9f9f9;
		border: #ccc 4px dashed;
		line-height: 0px;
		padding: 12px;
		font-size: 24px;
		text-align: center;
	}

	div.radio-box {
		width: auto;
		display: inline-block;
		margin: 5px;

	}

	.radio-box label {
		display: block;
		width: auto;
		text-align: center;
	}
</style>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Order Detail</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Order Detail</li>
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

						<div class="card-body">
							<div class="row">
								<div class="col-4">
									<label>Order ID : </label> <?php echo $row['orderid'];
																$sql23 = "SELECT * FROM orders_finished where orderid='$orderid'";
																$res23 = mysqli_query($bd, $sql23);
																$i = 1;
																$row23 = mysqli_fetch_array($res23);
																?>
								</div>
								<div class="col-4">
									<label><i class="fas fa-clock"></i> </label> <span style="font-size: 20px;font-weight: bold" class="btn btn-<?php if ($row['status'] == 'Completed') echo 'success';
																																				else echo 'warning' ?>"> <?php if ($row['status'] == 'progress') echo "In Progress";
																																											else echo $row['status'] ?> </span> <?php if (!empty($row['status_ch_date'])) echo "(" . $row['status_ch_date'] . ")" ?>
								</div>
								<div class="col-4">
									<a href="index.php" class="btn btn-success">Back</a>
								</div>
							</div>
							<form action="" method="post">
								<br><br>
								<div class="row">
									<input type="hidden" id="orderid" name="orderid" value="<?php echo $row['orderid']; ?>">
									<div class="col-7">
										<label>Initial Scan : </label>
										<?php
										if (strpos($row['fname'], "#") > 0) {
										?>
											<a href="download_file.php?id=<?php echo urlencode($row['fname']) ?>" target="_blank"> <?php echo ($row['fname']); ?></a>
										<?php } else { ?>
											<a href="../api/files/<?php echo $row['user_id'] . '_' . $row['orderid'] . '/' . urlencode($row['fname']); ?>"> <?php echo $row['fname']; ?></a>

										<?php } ?>
										|| <?php echo $row['created_at']; ?>
									</div>
									<div class="col-3">
										<select class="form-control" name="status" required>
											<option value="" <?php if ($row['status'] == 'New') echo 'selected' ?>>Select Status</option>

											<option value="QC Required" <?php if ($row['status'] == 'QC Required') echo 'selected' ?>>QC Required</option>
											<option value="Completed" <?php if ($row['status'] == 'Completed') echo 'selected' ?>>Completed</option>

											<option value="Hold" <?php if ($row['status'] == 'Hold') echo 'selected' ?>>Hold</option>
											<option value="Cancel" <?php if ($row['status'] == 'Cancel') echo 'selected' ?>>Cancel</option>

										</select>

									</div>
									<div class="col-1">
										<input type="submit" name="submit2" value="Change" class="btn btn-primary">
									</div>

								</div>
							</form>
							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<label>Upload STL/Finished Files</label>
										<form action="" method="post" enctype="multipart/form-data">
											<div class="card" id="cardd">
												<div class="card-body">
													<div class="row">
														<div class="col-md-12">
															<div id="drag_drop" style="display: none;"></div>
															<center>
																<div class="btn btn-default btn-file">
																	You can <i class="fas fa-plus"></i> Upload STL/Finished Files
																	<input type="file" id="selectfile" multiple />
																</div>
															</center>
														</div>


													</div>
												</div>
											</div>
											<br />

											<div class="row">
												<div class="col-sm-12">
													<input type="hidden" name="total_files" id="total_files">
													<div id="table_div"></div>

												</div>
											</div>
										</form>
									</div>
									<div class="table table-responsive">
										<table class="table table-hover">
											<thead>
												<tr>
													<th>Sr.No</th>
													<th>File</th>
													<th>Created At</th>
													<th>Action</th>
												</tr>
											</thead>
											<?php
											$sql22 = "SELECT * FROM orders_stl_files where orderid='$orderid'";
											$res22 = mysqli_query($bd, $sql22);
											$i = 1;
											while ($row22 = mysqli_fetch_array($res22)) {
											?>
												<tr>
													<td><?php echo $i++ ?></td>
													<td>
														<?php
														if (strpos($row22['filename'], "#") > 0) {
														?>
															<a href="download_stl.php?id=<?php echo urlencode($row22['filename']) ?>"><?php echo $row22['user_id'] . '_' . $row22['orderid'] . '/' . $row22['filename']; ?></a>
														<?php } else { ?>

															<a href="../api/stl_files/<?php echo  $row22['filename']; ?>"><?php echo $row22['filename'] ?></a>

														<?php } ?>
													</td>
													<td><?php echo $row22['created_at'] ?></td>
													<td><a href="order_detail.php?orderid=<?php echo $orderid ?>&stl_o=1&stl_id_o=<?php echo $row22['id'] ?>&stl_filename_o=<?php echo $row22['filename'] ?>" class="btn btn-danger"><i class="fas fa-trash"></i> Delete </a></td>
												</tr>

											<?php
											}
											?>
										</table>
									</div>
								</div>
								<div class="col-1"></div>

							</div>
							<div class="row">
								<div class="col-4">
									<div class="form-group">
										<label>Finished Design</label>

									</div>
									<?php

									if (!empty($row23['finished_file'])) {

									?>
										<?php
										if (strpos($row23['finished_file'], "#") > 0) {
										?>
											<a href="download_finished.php?id=<?php echo urlencode($row23['finished_file']) ?>"> <?php echo $row23['finished_file'] ?> || <?php echo $row23['created_at'] ?></a> || <a href="order_detail.php?orderid=<?php echo $orderid ?>&finished_o=1&finished_id_o=<?php echo $row23['id'] ?>&finished_filename_o=<?php echo $row23['finished_file'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this.')"> <i class="fas fa-trash"></i> Delete</a>
										<?php 	} else { ?>

											<a href="../api/finished_files/<?php echo $row['user_id'] . '_' . $row['orderid'] . '/' . urlencode($row23['finished_file']); ?>"> <?php echo $row23['finished_file'] ?> || <?php echo $row23['created_at'] ?></a> ||
											<a href="order_detail.php?orderid=<?php echo $orderid ?>&finished_o=1&finished_id_o=<?php echo $row23['id'] ?>&finished_filename_o=<?php echo urlencode($row23['finished_file']) ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this.')"> <i class="fas fa-trash"></i> Delete</a>
									<?php }
									}
									?>
								</div>
							</div>
							<div class="row">
								<div class="col-6">
									<div class="table table-responsive">
										<table class="table table-hover">
											<thead>
												<tr>
													<th>Tooth</th>
													<th>Unit</th>
													<th>Design Type</th>
													<th>TAT</th>
													<th>Model</th>
													<th>Custom Tray</th>
													<th>RPD Framework</th>
													<th>Abutment</th>
													<th>Remark</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><?php echo $row['tooth'] ?></td>
													<td><?php echo $row['unit'] ?></td>
													<td><?php echo $row['crown'] ?></td>
													<td><?php if (trim($row['tduration']) == 'Rush') echo '1-2 Hour';
														if (trim($row['tduration']) == 'Same Day') echo '6 Hour';
														if (trim($row['tduration']) == 'Next Day') echo '12 Hour';
														if (empty(trim($row['tduration']))) echo '12 Hour'; ?></td>
													<td><?php echo $row['model'] ?></td>
													<td><?php echo $row['custom'] ?></td>
													<td><?php echo $row['framework'] ?></td>
													<td><?php echo $row['abu'] ?></td>
													<td><?php echo $row['remark'] ?></td>
													<td><button class="btn btn-primary" data-toggle="modal" data-target="#modal-default2">Edit</button></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="col-6">
									<h4><b>Default Design Preferences</b></h4>
									<?php
									$email = $row['user_id'];
									$sql2 = "SELECT * FROM user where user_id='$email'";
									$res2 = mysqli_query($bd, $sql2);
									$row2 = mysqli_fetch_array($res2);

									?>
									<div class="table table-responsive">
										<table class="table table-hover">
											<thead>
												<tr>
													<th>Contact : <?php echo $row2['contact']; ?> </th>
													<th>Occlusion : <?php echo $row2['occlusion']; ?> </th>
												</tr>
												<tr>
													<th>Anatomy : <?php echo $row2['anatomy']; ?></th>
													<th>Pontic : <?php echo $row2['pontic']; ?></th>
												</tr>
												<tr>
													<th>Liner Spacer : </th>
												</tr>
												<tr>
													<th>Custom : </th>
												</tr>
											</thead>
										</table>
									</div>
								</div>

							</div>
							<div class="row">
								<div class="col-6">

								</div>
								<div class="col-6">

									<h4>Chat</h4>
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
												<?php
												$sql22 = "SELECT * FROM chatbox where orderid='$orderid'";
												$res22 = mysqli_query($bd, $sql22);
												$i = 1;
												while ($row22 = mysqli_fetch_array($res22)) {
													if ($row22['user_type'] == "user") {
												?>
														<!-- Message to the right -->
														<div class="direct-chat-msg">
															<div class="direct-chat-infos clearfix">
																<span class="direct-chat-name float-left" style="color: #000 !important">Client</span>
																<span class="direct-chat-timestamp float-right"><?php echo $row22['created_at'] ?></span>
															</div>
															<!-- /.direct-chat-infos -->
															<img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image">
															<!-- /.direct-chat-img -->
															<div class="direct-chat-text">
																<?php

																if (!empty($row22['attachment'])) {
																?>
																	<a href="../api/chatbox/<?php echo $row22['attachment'] ?>" class="btn btn-warning"><?php echo $row22['filename'] ?> </a>
																<?php
																}
																echo "<br>" . $row22['msg'];
																?>
															</div>
															<!-- /.direct-chat-text -->
														</div>
														<!-- /.direct-chat-msg -->
													<?php } else { ?>
														<!-- Message. Default to the left -->
														<div class="direct-chat-msg right">
															<div class="direct-chat-infos clearfix">
																<span class="direct-chat-name float-right" style="color: #000 !important"><?php echo $row22['user_type'] ?></span>
																<span class="direct-chat-timestamp float-left"><?php echo $row22['created_at'] ?></span>
															</div>
															<!-- /.direct-chat-infos -->
															<img class="direct-chat-img " src="dist/img/user1-128x128.jpg" alt="message user image">
															<!-- /.direct-chat-img -->
															<div class="direct-chat-text" style="background-color: #007BFF !important;color: #FFF !important;font-weight: bold !important;">
																<?php

																if (!empty($row22['attachment'])) {
																?>
																	<a href="../api/chatbox/<?php echo $row22['attachment'] ?>" class="btn btn-warning" download="download"><?php echo $row22['filename'] ?> </a>
																<?php
																}
																echo "<br>" . $row22['msg'];
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
															<textarea name="message" id="message_chat" class="form-control" rows="3"></textarea>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-12">

														<div id="table_div_chatbox"></div><br>
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
															<div class="card_chatfile" id="card_chatfile">
																<div class="card-body">
																	<div class="btn btn-default btn-file">
																		<i class="fas fa-plus"></i> Attachment
																		<input type="file" name="chat_file" id="chat_file" multiple />
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>

											</form>
										</div>
										<!-- /.card-footer-->
									</div>

								</div>
							</div>

							<div class="modal fade" id="modal-default2">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Update Product</h4>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="" method="post">

												<div class="row">
													<div class="col-4">
														<div class="form-group">
															<label>Tooth</label>
															<input type="hidden" name="orderid" value="<?php echo $orderid ?>">
															<input type="text" name="tooth" class="form-control" placeholder="tooth" value="<?php echo $row['tooth']; ?>">
														</div>
													</div>
													<div class="col-4">
														<div class="form-group">
															<label>Unit</label>
															<input type="text" name="unit" class="form-control" placeholder="unit" value="<?php echo $row['unit']; ?>">
														</div>
													</div>
													<div class="col-4">
														<div class="form-group">
															<label>Design Type</label>
															<input type="text" name="crown" class="form-control" placeholder="crown" value="<?php echo $row['crown']; ?>">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-6">
														<div class="form-group">
															<label>TAT</label>
															<input type="text" class="form-control" placeholder="TAT" value="<?php if ($row['tduration'] == 'Rush') echo '1 -2 Hour';
																																if ($row['tduration'] == 'Same Day') echo '6 Hour';
																																if ($row['tduration'] == 'Same Day') echo '12 Hour';
																																if (empty($row['tduration'])) echo '1 -2 Hour'; ?>" readonly>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label>Model</label>
															<select class="form-control" name="model">
																<option value="Y" <?php if ($row['model'] == 'Y') echo 'selected' ?>>Y</option>
																<option value="N" <?php if ($row['model'] == 'N') echo 'selected' ?>>N</option>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-6">
														<div class="form-group">
															<label>Custom Tray</label>
															<select class="form-control" name="custom">
																<option value="Y" <?php if ($row['custom'] == 'Y') echo 'selected' ?>>Y</option>
																<option value="N" <?php if ($row['custom'] == 'N') echo 'selected' ?>>N</option>
															</select>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label>RPD Framework</label>
															<select class="form-control" name="framework">
																<option value="Y" <?php if ($row['framework'] == 'Y') echo 'selected' ?>>Y</option>
																<option value="N" <?php if ($row['framework'] == 'N') echo 'selected' ?>>N</option>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-6">
														<div class="form-group">
															<label>Abutment</label>
															<select class="form-control" name="abu">
																<option value="Y" <?php if ($row['abu'] == 'Y') echo 'selected' ?>>Y</option>
																<option value="N" <?php if ($row['abu'] == 'N') echo 'selected' ?>>N</option>
															</select>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label>Remark</label>
															<textarea class="form-control" rows="4" name="remark">

												</textarea>
														</div>
													</div>
												</div>

										</div>
										<div class="modal-footer justify-content-between">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											<input type="submit" name="submitp" value="Save Changes" class="btn btn-primary">

										</div>
									</div>
									</form>
								</div>
							</div>
						</div>
					</div>


					<!--/.direct-chat -->
				</div>
			</div>
		</div>
</div>
</div>
</div>



<script type="text/javascript">
	$(document).ready(function() {
		$(".direct-chat-messages").animate({
			scrollTop: $("#chat_live").offset().top
		});
		$('#send').on('click', function() {
			var file_data = $('#chat_file').prop('files')[0];
			var form_data = new FormData();
			form_data.append('file', file_data);
			form_data.append('message_id', $("#message_chat").val());
			form_data.append('orderid_id', $("#orderid").val());
			//alert(form_data);                             
			$.ajax({
				url: 'update_chatbox.php', // <-- point to server-side PHP script 
				dataType: 'text', // <-- what to expect back from the PHP script, if anything
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function(response) {

					$("#message_chat").val('');
					//alert(response);
					var arr = response.split("____");
					$("#chat_live").append('<div class="direct-chat-msg"><div class="direct-chat-infos clearfix"><span class="direct-chat-name float-left">You</span><span class="direct-chat-timestamp float-right">"' + arr[1] + '"</span>    </div><img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image"><div class="direct-chat-text"> "' + arr[0] + '"</div></div>');
					$(".direct-chat-messages").animate({
						scrollTop: $(".direct-chat-messages").prop('scrollHeight')
					});
				}
			});
		});
	});



	function _(element) {
		return document.getElementById(element);
	}

	_('drag_drop').ondragover = function(event) {
		this.style.borderColor = '#333';
		return false;
	}

	_('drag_drop').ondragleave = function(event) {
		this.style.borderColor = '#ccc';
		return false;
	}


	$("#drag_drop").on("drop", function(e) {
		e.preventDefault();
		//$(this).removeClass("drag_drop");
		//var formData = new FormData();
		var files = e.originalEvent.dataTransfer.files;
		$("#table_div").append('<table class="table table-hover" id="progress_table"><thead><tr><th>File</th><th>Status</th></tr></thead><tbody>');
		$('#sbtbtn').show();
		$('#sbtbtn').show();
		for (var i = 0; i < files.length; i++) {
			$("#table_div").append('<tr id="tr' + i + '" ><td width="45%"><div class="progress" id="progress_bar' + i + '" style="display:none; height:40px;"><div class="progress-bar bg-success" id="progress_bar_process' + i + '" role="progressbar" style="width:0%; height:40px;">0%</div></div></td><td width="100%"><span id="u' + i + '"></td></tr>');
			uploadSingleFile(files[i], i);
		}
		$("#table_div").append('</tbody></table>');

	});



	$("#selectfile").on("click", function(e) {

		// document.getElementById("selectfile").click();
		document.getElementById("selectfile").onchange = function() {

			files = document.getElementById("selectfile").files;

			$("#table_div").append('<table class="table table-hover" id="progress_table"><thead><tr><th>File</th><th>Status</th></tr></thead><tbody>');
			$('#sbtbtn').show();

			for (var i = 0; i < files.length; i++) {

				$("#table_div").append('<tr id="tr' + i + '" ><td width="45%"><div class="progress" id="progress_bar' + i + '" style="display:none; height:40px;"><div class="progress-bar bg-success" id="progress_bar_process' + i + '" role="progressbar" style="width:0%; height:40px;">0%</div></div></td><td width="100%"><span id="u' + i + '"></td></tr>');
				uploadSingleFile(files[i], i);
			}
			$("#table_div").append('</tbody></table>');

		};

	});

	function uploadSingleFile(file, i) {
		var ff = i;
		var color = "red";
		var formData = new FormData();
		formData.append("file", file);

		document.getElementById("cardd").style.display = 'none';
		document.getElementById('tr' + i).style.display = 'table-row';
		document.getElementById('progress_bar' + i).style.display = 'block';

		var ajax_request = new XMLHttpRequest();

		ajax_request.open("post", "upload.php");

		ajax_request.upload.addEventListener('progress', function(event) {

			var percent_completed = Math.round((event.loaded / event.total) * 100);

			document.getElementById('progress_bar_process' + i + '').style.width = percent_completed + '%';

			document.getElementById('progress_bar_process' + i + '').innerHTML = percent_completed + '% completed';

		});

		ajax_request.addEventListener('load', function(event) {

			var mystr = event.target.responseText;

			document.getElementById('u' + ff + '').innerHTML = mystr;

			if (mystr.substr(0, 23) == "File format not matched") {
				document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-danger" >' + mystr + ' </div>';
				document.getElementById('progress_bar_process' + ff).style.setProperty('background-color', 'red', 'important');
			} else {
				if (mystr.substr(0, 33) == "Finished File is already uploaded") {
					document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-danger" >' + mystr + ' </div>';
					document.getElementById('progress_bar_process' + ff).style.setProperty('background-color', 'red', 'important');
				} else {
					if (mystr.substr(0, 33) == "Finished file not found like this") {
						document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-danger" >' + mystr + ' </div>';
						document.getElementById('progress_bar_process' + ff).style.setProperty('background-color', 'red', 'important');
					} else {
						if (mystr.substr(0, 43) == "Finished File can not be saved at this time") {
							document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-danger" >' + mystr + ' </div>';
							document.getElementById('progress_bar_process' + ff).style.setProperty('background-color', 'red', 'important');
						} else {
							if (mystr.substr(0, 28) == "STL File is already uploaded") {
								document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-danger" >' + mystr + ' </div>';
								document.getElementById('progress_bar_process' + ff).style.setProperty('background-color', 'red', 'important');
							} else {
								if (mystr.substr(0, 28) == "STL file not found like this") {
									document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-danger" >' + mystr + ' </div>';
									document.getElementById('progress_bar_process' + ff).style.setProperty('background-color', 'red', 'important');
								} else {
									if (mystr.substr(0, 38) == "STL File can not be saved at this time") {
										document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-danger" >' + mystr + ' </div>';
										document.getElementById('progress_bar_process' + ff).style.setProperty('background-color', 'red', 'important');
									} else {
										document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-success">' + mystr + ' </div>';
									}
								}
							}
						}
					}
				}
			}

			document.getElementById('drag_drop').style.borderColor = '#ccc';

		});
		//alert("hiello");

		ajax_request.send(formData);
	}
</script>


<script type="text/javascript">
	$("#finished_file").on("click", function(e) {

		document.getElementById("finished_file").click();
		document.getElementById("finished_file").onchange = function() {

			files = document.getElementById("finished_file").files;

			$("#table_div_stl").append('<table class="table table-hover" id="progress_table"><thead><tr><th>File</th><th>Status</th></tr></thead><tbody>');
			$('#sbtbtn').show();

			for (var i = 0; i < files.length; i++) {

				$("#table_div_stl").append('<tr id="tr' + i + '" ><td width="45%"><div class="progress" id="progress_bar' + i + '" style="display:none; height:40px;"><div class="progress-bar bg-success" id="progress_bar_process' + i + '" role="progressbar" style="width:0%; height:40px;">0%</div></div></td><td width="100%"><span id="u' + i + '"></td></tr>');
				uploadSingleFile_stl(files[i], i);
			}
			$("#table_div_stl").append('</tbody></table>');

		};

	});



	$("#stl_file").on("click", function(e) {

		document.getElementById("stl_file").click();
		document.getElementById("stl_file").onchange = function() {

			files = document.getElementById("stl_file").files;

			$("#table_div_stl").append('<table class="table table-hover" id="progress_table"><thead><tr><th>File</th><th>Status</th></tr></thead><tbody>');
			$('#sbtbtn').show();

			for (var i = 0; i < files.length; i++) {

				$("#table_div_stl").append('<tr id="tr' + i + '" ><td width="45%"><div class="progress" id="progress_bar' + i + '" style="display:none; height:40px;"><div class="progress-bar bg-success" id="progress_bar_process' + i + '" role="progressbar" style="width:0%; height:40px;">0%</div></div></td><td width="100%"><span id="u' + i + '"></td></tr>');
				uploadSingleFile_stl(files[i], i);
			}
			$("#table_div_stl").append('</tbody></table>');

		};

	});

	function uploadSingleFile_stl(file, i) {
		var ff = i;
		var color = "red";
		var formData = new FormData();
		formData.append("file", file);
		formData.append('orderid_id', document.getElementById("orderid").value);
		document.getElementById("cardd_stl").style.display = 'none';
		document.getElementById('tr' + i).style.display = 'table-row';
		document.getElementById('progress_bar' + i).style.display = 'block';

		var ajax_request = new XMLHttpRequest();

		ajax_request.open("post", "upload_stl_files.php");

		ajax_request.upload.addEventListener('progress', function(event) {

			var percent_completed = Math.round((event.loaded / event.total) * 100);

			document.getElementById('progress_bar_process' + i + '').style.width = percent_completed + '%';

			document.getElementById('progress_bar_process' + i + '').innerHTML = percent_completed + '% completed';

		});

		ajax_request.addEventListener('load', function(event) {

			var mystr = event.target.responseText;

			document.getElementById('u' + ff + '').innerHTML = mystr;

			if (mystr.substr(0, 23) == "File format not matched") {
				document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-danger" >' + mystr + ' </div>';
				document.getElementById('progress_bar_process' + ff).style.setProperty('background-color', 'red', 'important');
			} else {
				if (mystr.substr(0, 33) == "Finished File is already uploaded") {
					document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-danger" >' + mystr + ' </div>';
					document.getElementById('progress_bar_process' + ff).style.setProperty('background-color', 'red', 'important');
				} else {
					if (mystr.substr(0, 33) == "Finished file not found like this") {
						document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-danger" >' + mystr + ' </div>';
						document.getElementById('progress_bar_process' + ff).style.setProperty('background-color', 'red', 'important');
					} else {
						if (mystr.substr(0, 43) == "Finished File can not be saved at this time") {
							document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-danger" >' + mystr + ' </div>';
							document.getElementById('progress_bar_process' + ff).style.setProperty('background-color', 'red', 'important');
						} else {
							if (mystr.substr(0, 28) == "STL File is already uploaded") {
								document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-danger" >' + mystr + ' </div>';
								document.getElementById('progress_bar_process' + ff).style.setProperty('background-color', 'red', 'important');
							} else {
								if (mystr.substr(0, 28) == "STL file not found like this") {
									document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-danger" >' + mystr + ' </div>';
									document.getElementById('progress_bar_process' + ff).style.setProperty('background-color', 'red', 'important');
								} else {
									if (mystr.substr(0, 38) == "STL File can not be saved at this time") {
										document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-danger" >' + mystr + ' </div>';
										document.getElementById('progress_bar_process' + ff).style.setProperty('background-color', 'red', 'important');
									} else {
										document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-success">' + mystr + ' </div>';
									}
								}
							}
						}
					}
				}
			}

			document.getElementById('drag_drop').style.borderColor = '#ccc';

		});
		//alert("hiello");

		ajax_request.send(formData);
	}
</script>

<?php
include 'footer.php';
?>