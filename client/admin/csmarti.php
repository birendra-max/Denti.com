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
            <h1>Calculate Smart Income</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Calculate Smart Income</li>
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
			              <div class="card-header">
			                <h3 class="card-title">Calculate Smart Income</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			              	<h2 class="text-center"><b>Calculate Smart Income</b></h2>
			              	<div class="row">
			              		<div class="col-sm-4">
			              			<div class="form-group">
			              				<label>Start Date</label>			              				
			              				<input type="date" name="sdate" id="sdate" class="form-control">
			              			</div>			              			
			              		</div>			              		
			              		<div class="col-sm-4">
			              			<div class="form-group">
			              				<label>Start Date</label>			              				
			              				<input type="date" name="sdate" id="sdate" class="form-control" onblur="showHint(this.value)">
			              			</div>			              			
			              		</div>			              		
			              		<div class="col-sm-4">
			              			<div class="form-group">
			              				<br>
			              				<label class="btn btn-success">Calculate</label>			              				
			              			</div>			              			
			              		</div>			              		
			              	</div>
			              	<div id="txtHint">
			              		
			              	</div>

			          		</div>
			          	</div>
			          </div>
			      </div>

			    </div>
			</section>
		</div>

		
<script>
function showHint(str) {
  if (str.length == 0) {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
  	str=str+","+document.getElementById("sdate").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "csmarti2.php?q=" + str, true);
    xmlhttp.send();
  }
}
</script>



<?php
include 'footer.php';
?>