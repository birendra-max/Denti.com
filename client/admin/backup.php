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
            <h1>Backup </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Backup</li>
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
                      <h3 class="card-title">Backup</h3>
                    </div>
                    <!-- /.card-header -->
                    <?php 
                       function roundsize($size){
    $i=0;
    $iec = array("B", "Kb", "Mb", "Gb", "Tb");
    while (($size/1024)>1) {
        $size=$size/1024;
        $i++;}
    return(round($size,1)." ".$iec[$i]);
  }
             //  echo  substr(roundsize( disk_free_space("c:")), 0, -2);  ; 

              // echo substr("P210_Kim_TiA_FC_Upper-Lower_York_Tommy_BL2.zip ", 0,strlen("P210_Kim_TiA_FC_Upper-Lower_York_Tommy_BL2.zip")-4)


               ?>
                         <div class="row">
                          <div class="col-3">
                            <div class="form-group">
                              <label>By Date group</label><br>
                            <button name="today" class="btn btn-primary" onclick="showHint('1')">Today</button>
                            <button name="weekly" class="btn btn-primary"  onclick="showHint('2')">Weekly</button>
                            <button name="monthly" class="btn btn-primary"  onclick="showHint('3')">Monthly</button>
                            </div>
                          </div>
                            <div class="col-2">
                              <div class="form-group">
                                <label>Start Date</label>
                                <input type="date" name="sdate" id="sdate" class="form-control">
                              </div>
                            </div>
                            <div class="col-2">
                              <div class="form-group">
                                <label>End Date</label>
                                <input type="date" name="edate" id="edate" class="form-control">
                              </div>
                            </div>
                            <div class="col-2">
                              <div class="form-group">
                                <label>Lab wise</label>
                                <select name="labname" id="labname" class="form-control">
                                  <option value="all">All Labs</option>
                                <?php 
                                $sql="SELECT labname FROM orders group by labname";
                        $res=mysqli_query($bd,$sql);
                        while($row=mysqli_fetch_array($res))
                        {?>
                          <option value="<?php echo $row['labname']?>"><?php echo $row['labname']?></option>
                          <?php 
                        }
                          ?>
                          </select>
                              </div>
                            </div>
                            <div class="col-2">
                              <div class="form-group">
                                <label>.</label><br>
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
    xmlhttp.open("GET", "backup3.php?q=" + str, true);
    xmlhttp.send();
  }
}
function showHint2(str) {
  str=document.getElementById("sdate").value+","+document.getElementById("edate").value+","+document.getElementById("labname").value;
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
    xmlhttp.open("GET", "backup2.php?q=" + str, true);
    xmlhttp.send();
  }
}
</script>


<?php
include 'footer.php';
?>