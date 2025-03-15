<?php
include 'header.php';
include 'testmail.php';
$orderid = $_GET['orderid'];
$sql = "SELECT * FROM orders where orderid='$orderid'";
$res = mysqli_query($bd, $sql);
$row = mysqli_fetch_array($res);
if (isset($_POST['submit2'])) {
	$orderid = $_POST['orderid'];
	$tdate = date("d-M-Y h:i:sa");

	$status = $_POST['status'];
	$sql = "UPDATE orders set status='New', tduration='$status',status_ch_date='$tdate',status_r='$status',r_date='$tdate' where orderid='$orderid'";

	if (mysqli_query($bd, $sql)) {


		if ($status == 'Rush') {
			$to = 'bravodent@bravodentdesigns.com';

			$subject = '(' . $_SESSION['labname'] . ') Redesign Case';

			$headers = "From: " . strip_tags("bravodent@bravodentdesigns.com") . "\r\n";
			$headers .= "Reply-To: " . strip_tags("bravodent@bravodentdesigns.com") . "\r\n";
			$headers .= "CC: bravodent@bravodentdesigns.com\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

			$message = '<p><strong>There are new redesign case. Orderid :  ' . $orderid . '</strong> </p>';
			sendEmail($email, $subject, $message);
			//mail($to, $subject, $message, $headers);
		}



		echo "<script> toastr.success('$orderid is updated successfully.');</script>";
	} else {
		echo "<script>  toastr.error('Selected case of status can not be change. Plese try after sometime.');</script>";
	}
}


if (isset($_POST['submitd'])) {
	extract($_POST);
	$email = $_POST['email'];
	// $status=$_POST['status'];
	$sql = "UPDATE user set lspacer='$lspacer',contact='$contact',anatomy='$anatomy',pontic='$pontic',custom='$custom',occlusion='$occlusion' where em='$email'";

	if (mysqli_query($bd, $sql)) {
		echo "<script> toastr.success('Updated successfully.');</script>";
	} else {
		echo "<script> toastr.error('Selected case can not be update. Plese try after sometime.');</script>";
	}
}
?>


<title><?php echo $_GET['orderid']; ?></title>

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
									<label><i class="fas fa-clock"></i> </label> <span
										style="font-size: 20px;font-weight: bold" class="btn btn-<?php if ($row['status'] == 'Completed')
											echo 'success';
										else
											echo 'warning' ?>">
										<?php if ($row['status'] == 'progress')
											echo "In Progress";
										else
											echo $row['status'] ?>
										</span>
									<?php if (!empty($row['status_ch_date']))
											echo "(" . $row['status_ch_date'] . ")" ?>
									</div>
									<div class="col-4">
										<a href="index.php" class="btn btn-success">Back</a>
									</div>
								</div>
								<br><br>
								<form action="" method="post">
									<div class="row">
										<input type="hidden" name="orderid" value="<?php echo $row['orderid'] ?>">
									<div class="col-7">
										<label>Initial Scan : </label>
										<?php
										if (strpos($row['filename'], "#") > 0) {
											?>
											<a href="designer/download_file.php?id=<?php echo urlencode($row['filename']) ?>"
												target="_blank"> <?php echo ($row['filename']); ?></a>
										<?php } else { ?>
											<a
												href="api/files/<?php echo urlencode($_SESSION['user_id'] . $row['orderid']) ?>/<?php echo $row['filename']; ?>">
												<?php echo ($row['filename']); ?></a>

										<?php } ?>
										|| <?php echo $row['created_at']; ?>
									</div>
									<div class="col-3">
										<select class="form-control" name="status">
											<option value="" <?php if ($row['status'] == 'New')
												echo 'selected' ?>>Select
													Status</option>

												<option value="Rush" <?php if ($row['status'] == 'Rush')
												echo 'selected' ?>>
													Redesign and Rush</option>

											</select>
										</div>
										<div class="col-1">
											<input type="submit" name="submit2" value="Change" class="btn btn-primary">
										</div>

									</div>
								</form>
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<label>STL File</label>
											<table class="table table-hover">
												<thead>
													<tr>
														<th>Sr.No</th>
														<th>File</th>
														<th>Created At</th>
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
															<a
																href="designer/download_stl.php?id=<?php echo urlencode($row22['filename']) ?>"><?php echo $row22['filename'] ?></a>
														<?php } else { ?>

															<a
																href="api/stl_files/<?php echo $row22['filename'] ?>"><?php echo $row22['filename'] ?></a>

														<?php } ?>

													</td>
													<td><?php echo $row22['created_at'] ?></td>
												</tr>

												<?php
											}
											?>
										</table>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<div class="form-group">
										<label>Finished Design</label>
										<?php
										$sql23 = "SELECT * FROM orders_finished where orderid='$orderid'";
										$res23 = mysqli_query($bd, $sql23);
										$i = 1;
										$row23 = mysqli_fetch_array($res23);
										if (strpos($row23['finished_file'], "#") > 0) {
											?>

											<a
												href="designer/download_finished.php?id=<?php echo urlencode($row23['finished_file']) ?>">
												<?php echo $row23['finished_file'] ?> ||
												<?php echo $row23['created_at'] ?></a>
										<?php } else { ?>
											<a href="api/finished_files/<?php echo $row23['finished_file'] ?>">
												<?php echo $row23['finished_file'] ?> ||
												<?php echo $row23['created_at'] ?></a>
										<?php } ?>
									</div>
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
										<tbody>
											<tr>
												<td><?php echo $row['tooth']; ?></td>
												<td><?php echo 'Crown'; ?></td>
												<td><?php if ($row['tduration'] == "Rush") {
													echo "1-2 Hour";
												}
												if ($row['tduration'] == "Same Day") {
													echo "6 Hour";
												}
												if ($row['tduration'] == "Next Day") {
													echo "12 Hour";
												}
												?></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="col-6">
									<h4>Default Design Preferences</h4>
									<?php
									$email = $_SESSION['email'];
									$sql2 = "SELECT * FROM user where em='$email'";
									$res2 = mysqli_query($bd, $sql2);
									$row2 = mysqli_fetch_array($res2);

									?>
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
												<th>Liner Spacer : <?php echo $row2['lspacer']; ?></th>
											</tr>
											<tr>
												<th>Custom : <?php echo $row2['custom']; ?></th>
											</tr>
										</thead>
									</table>
									<button type="button" class="btn btn-primary" data-toggle="modal"
										data-target="#modal-default">Edit</button>
								</div>
							</div>



							<div class="modal fade" id="modal-default">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Default Design Preferences</h4>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="" method="post">
												<?php
												$email = $_SESSION['email'];
												$sql2 = "SELECT * FROM user where em='$email'";
												$res2 = mysqli_query($bd, $sql2);
												$row2 = mysqli_fetch_array($res2);

												?>
												<div class="row">
													<div class="col-6">
														<div class="form-group">
															<label>Contact</label>
															<input type="hidden" name="email"
																value="<?php echo $email ?>">
															<input type="text" name="contact" class="form-control"
																placeholder="Contact"
																value="<?php echo $row2['contact']; ?>">
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label>Occlusion</label>
															<input type="text" name="occlusion" class="form-control"
																placeholder="occlusion"
																value="<?php echo $row2['occlusion']; ?>">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-6">
														<div class="form-group">
															<label>Anatomy</label>
															<input type="text" name="anatomy" class="form-control"
																placeholder="anatomy"
																value="<?php echo $row2['anatomy']; ?>">
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label>Pontic</label>
															<input type="text" name="pontic" class="form-control"
																placeholder="pontic"
																value="<?php echo $row2['pontic']; ?>">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-6">
														<div class="form-group">
															<label>Liner Spacer</label>
															<input type="text" name="lspacer" class="form-control"
																placeholder="Liner Spacer"
																value="<?php echo $row2['lspacer']; ?>">
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label>Custom</label>
															<input type="text" name="custom" class="form-control"
																placeholder="Custom"
																value="<?php echo $row2['custom']; ?>">
														</div>
													</div>
												</div>

										</div>
										<div class="modal-footer justify-content-between">
											<button type="button" class="btn btn-default"
												data-dismiss="modal">Close</button>
											<input type="submit" name="submitd" value="Save Changes"
												class="btn btn-primary">

										</div>
									</div>
									</form>
									<!-- /.modal-content -->
								</div>
								<!-- /.modal-dialog -->
							</div>
							<!-- /.modal -->






							<div class="row">
								<div class="col-6">

								</div>
								<div class="col-6">

									<div class="card direct-chat direct-chat-primary">

										<!-- /.card-header -->
										<div class="card-body">
											<!-- Conversations are loaded here -->
											<div class="direct-chat-messages">
												<!-- Message. Default to the left -->
												<div class="direct-chat-msg">
													<div class="direct-chat-infos clearfix">
														<span class="direct-chat-name float-left">User</span>
														<span
															class="direct-chat-timestamp float-right"><?php echo trim($row['created_at']) ?></span>
													</div>
													<!-- /.direct-chat-infos -->
													<img class="direct-chat-img" src="dist/img/user1-128x128.jpg"
														alt="message user image">
													<!-- /.direct-chat-img -->
													<div class="direct-chat-text">
														<?php echo trim($row['message']) ?>
													</div>
													<!-- /.direct-chat-text -->
												</div>
												<!-- /.direct-chat-msg -->
												<!-- /.direct-chat-msg -->
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
																<span class="direct-chat-name float-left">You</span>
																<span
																	class="direct-chat-timestamp float-right"><?php echo $row22['created_at'] ?></span>
															</div>
															<!-- /.direct-chat-infos -->
															<img class="direct-chat-img" src="dist/img/user3-128x128.jpg"
																alt="message user image">
															<!-- /.direct-chat-img -->
															<div class="direct-chat-text"
																style="color: #000 !important;font-weight: bold !important;">
																<?php

																if (!empty($row22['attachment'])) {
																	?>
																	<a href="api/chatbox/<?php echo $row22['attachment'] ?>"
																		download="<?php echo $row22['filename'] ?>"
																		class="btn btn-warning"><?php echo $row22['filename'] ?>
																	</a>
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
																<span
																	class="direct-chat-name float-right"><?php echo $row22['user_type'] ?></span>
																<span
																	class="direct-chat-timestamp float-left"><?php echo $row22['created_at'] ?></span>
															</div>
															<!-- /.direct-chat-infos -->
															<img class="direct-chat-img " src="dist/img/user1-128x128.jpg"
																alt="message user image">
															<!-- /.direct-chat-img -->
															<div class="direct-chat-text">
																<?php echo $row22['msg'] . "<br>";

																if (!empty($row22['attachment'])) {
																	?>
																	<a href="api/chatbox/<?php echo $row22['attachment'] ?>"
																		download="<?php echo $row22['filename'] ?>"
																		class="btn btn-warning"> <?php echo $row22['filename'] ?>
																	</a>
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
												<input type="hidden" id="orderid" name="orderid"
													value="<?php echo $row['orderid']; ?>">

												<div class="row">
													<div class="col-sm-12">
														<div class="form-group">
															<textarea name="message" id="message_chat"
																class="form-control" rows="3"></textarea>
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
															<button type="button" id="send"
																class="btn btn-primary">Send</button>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group">
															<div class="card_chatfile" id="card_chatfile">
																<div class="card-body">
																	<div class="btn btn-default btn-file">
																		<i class="fas fa-plus"></i> Attachment
																		<input type="file" name="chat_file"
																			id="chat_file" multiple />
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
									<!--/.direct-chat -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>


<script type="text/javascript">

	$(document).ready(function () {
		$(".direct-chat-messages").animate({
			scrollTop: $("#chat_live").offset().top
		});
		$('#send').on('click', function () {
			var file_data = $('#chat_file').prop('files')[0];
			var form_data = new FormData();
			form_data.append('file', file_data);
			form_data.append('message_id', $("#message_chat").val());
			form_data.append('orderid_id', $("#orderid").val());
			//alert(form_data);                             
			$.ajax({
				url: 'update_chatbox.php', // <-- point to server-side PHP script 
				dataType: 'text',  // <-- what to expect back from the PHP script, if anything
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {

					$("#message_chat").val('');
					//alert(response);
					var arr = response.split("____");
					$("#chat_live").append('<div class="direct-chat-msg"><div class="direct-chat-infos clearfix"><span class="direct-chat-name float-left">You</span><span class="direct-chat-timestamp float-right">"' + arr[1] + '"</span>    </div><img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image"><div class="direct-chat-text"> "' + arr[0] + '"</div></div>');
					$(".direct-chat-messages").animate({
						scrollTop: $("#chat_live").offset().top
					});
				}
			});
		});
	});
</script>





<?php
include 'footer.php';
?>