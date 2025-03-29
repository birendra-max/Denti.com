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
					<h1>All Client List</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">All Client List</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>


	<?php

	function check_status($bd, $id)
	{
		$rr = mysqli_query($bd, "SELECT * FROM user WHERE id='$id' AND status='active'");
		$row = mysqli_fetch_assoc($rr);
		if ($row['acpinid'] != 0)
			return 1;
		else
			return 0;
	}
	?>




	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">All Client List</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<h2 class="text-center"><b>All Client List</b></h2>
							<hr>
							<div class="table table-responsive">
								<table class="table table-bordered table-striped" style="zoom:70% !important">
									<thead>
										<th>S.N</th>
										<th>ID</th>
										<th>Name</th>
										<th>Designation</th>
										<th>User Id</th>
										<th>Lab Name</th>
										<th>Phone Number</th>
										<th>Password</th>
										<th>Created Date</th>
										<th>Status</th>
										<th>Action</th>
									</thead>
									<tbody>
										<?php
										$total = 0;
										$co = 1;
										$rr = mysqli_query($bd, "SELECT * FROM user WHERE status='active'");

										while ($row = mysqli_fetch_assoc($rr)) {
										?>
											<tr>
												<td><?php echo $co++ ?></td>
												<td><?php echo $row['id'] ?></td>
												<td><?php echo $row['name'] ?></td>
												<td><?php echo $row['designation'] ?></td>
												<td><?php echo $row['user_id'] ?></td>
												<td><?php echo $row['labname'] ?></td>
												<td><?php echo $row['mobile'] ?></td>
												<td><?php echo $row['password'] ?></td>
												<td><?php echo date("d-M-Y", strtotime($row['todaydate'])) ?></td>
												<?php
												if (($row['acpinid'] == 1)) {
												?>
													<td><button class='btn btn-danger' onclick="update_status(0, '<?php echo $row['id']; ?>')">Deactivate</button></td>
												<?php
												} else {
												?>

													<td><button class='btn btn-success' onclick="update_status(1, '<?php echo $row['id']; ?>')">Activated</button></td>
												<?php
												}
												?>
												<td><a href="editmem.php?id=<?php echo $row['userid'] ?>" class="btn btn-info">Edit/Update </a></td>
											</tr>
										<?php
										}
										?>

									</tbody>

								</table>

							</div>
							<hr>
							<hr>

						</div>
					</div>
				</div>
			</div>

		</div>
	</section>
</div>

<script>
	function update_status(status, id) {
		let obj = {
			status: status,
			id: id,
		}

		let json_d = JSON.stringify(obj);
		$.ajax({
			type: "POST",
			url: "update_status.php",
			data:{
				data: json_d,
			},
			contentType: "application/x-www-form-urlencoded",
			success: function(data) {
				if (data == 'success') {
					alert("Status updated successfully");
					window.location.reload();
				} else {
					alert("Error in updating status");
				}
			},
			error: function(data) {
				alert("Error in updating status");
			}
		})
	}
</script>

<?php
include 'footer.php';
?>