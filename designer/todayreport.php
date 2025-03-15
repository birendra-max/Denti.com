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
            <h1>Report </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Report</li>
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
                      <h3 class="card-title">Report</h3>
                    </div>
                    <!-- /.card-header -->
                    
                         <div class="row">
                          <!-- <div class="col-3"><br>
                            <div class="form-group">
                            <button name="today" class="btn btn-primary" onclick="showHint('1')">Today</button>
                            <button name="weekly" class="btn btn-primary"  onclick="showHint('2')">Weekly</button>
                            <button name="monthly" class="btn btn-primary"  onclick="showHint('3')">Monthly</button>
                            </div>
                          </div> -->
                            <div class="col-3">
                              <div class="form-group">
                                <label> Date</label>
                                <input type="date" name="sdate" id="sdate" class="form-control">
                              </div>
                            </div>
                            <div class="col-3">
                              <div class="form-group">
                                <label> Status</label>
                                 <select name="status" id="edate" class="form-control">
                                  <option value="">---Select---</option>
                                  <option value="abc@gmail.com">abc@gmail.com</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-3">
                              <div class="form-group">
                                <label>Select Client</label>
                                <select name="edate" id="edate" class="form-control">
                                  <option value="">---Select---</option>
                                  <option value="abc@gmail.com">abc@gmail.com</option>
                                 <?php  $sql="SELECT * FROM user where acpinid='1'";
                        $res=mysqli_query($bd,$sql);
                        while($row=mysqli_fetch_array($res))
                        {
                          ?>
                          <option value="<?php echo $row['em'] ?>"><?php echo $row['em'] ?></option>
                        <?php }  ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-3">
                              <div class="form-group">
                                <label></label><br>
                                <input type="submit" name="submit" value="Submit" onclick="showHint2('1')" class="btn btn-success">
                              </div>
                            </div>
                          </div>

                      <div id="report_data"></div>
                    
                    </div>
                  
                </div>
            </div>

          </div>
      </section>
    </div>
<script>
  $(function () {
    $("#example1").DataTable({
      buttons: [ 
        'excelHtml5', 
    ]
    });
   
  });
</script>


<script>
function showHint(str) {
  if (str.length == 0) {
    document.getElementById("report_data").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("report_data").innerHTML = this.responseText;
         $(function () {
          $("#example1").DataTable({
            "lengthMenu":[[100,500,1000,-1],[100,500,1000,"All"]],
            "buttons": ['excel'],
            "iDisplayLength":100,
            "responsive": true, "lengthChange": true, "autoWidth": false
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
      }
    };
    xmlhttp.open("GET", "report3.php?q=" + str, true);
    xmlhttp.send();
  }
}
function showHint2(str) {
  str=document.getElementById("sdate").value+","+document.getElementById("edate").value;
  if (str.length == 0) {
    document.getElementById("report_data").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("report_data").innerHTML = this.responseText;
         $(function () {
          $("#example1").DataTable({
            "lengthMenu":[[100,500,1000,-1],[100,500,1000,"All"]],
            "buttons": ['excel'],
            "iDisplayLength":100,
            "responsive": true, "lengthChange": true, "autoWidth": false
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
      }
    };
    xmlhttp.open("GET", "todayreport2.php?q=" + str, true);
    xmlhttp.send();
  }
}
</script>


<?php
include 'footer.php';
?>