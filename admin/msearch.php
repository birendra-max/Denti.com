<?php
include 'header.php';
?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  

          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                   
                    <!-- /.card-header -->
                    
                      <h2 class="text-center"><b>Multiple Search</b></h2>
                      <br>
                         <div class="row" style="margin-top: 20px !important">
                          <div class="col-3">
                            <!-- <div class="form-group">
                            <button name="today" class="btn btn-primary" onclick="showHint('1')">Today</button>
                            <button name="weekly" class="btn btn-primary"  onclick="showHint('2')">Weekly</button>
                            <button name="monthly" class="btn btn-primary"  onclick="showHint('3')">Monthly</button>
                            </div> -->
                          </div>
                            <div class="col-3">
                              <div class="form-group">
                                <label style="display: none;">Start Number</label>
                                <input type="text" id="snumber" class="form-control" placeholder="Start Number">
                              </div>
                            </div>
                            <div class="col-3">
                              <div class="form-group">
                                <label style="display: none;">End Number</label>
                                <input type="text" id="enumber" class="form-control" placeholder="End Number" onkeyup="showHint('1')">
                              </div>
                            </div>
                            <div class="col-3">
                              <div class="form-group">
                                <label></label>
                                <input type="submit" name="submit" value="Clean" onclick="showHint2('1')" class="btn btn-success">
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-sm-3">
                               <div class="row">          
                                <div class="col-4">
                                    <div class="form-group">
                                     
                                      <input type="checkbox" name="select_all" id="select_all" onclick='selects()' value="all"> Select All 
                                    </div>
                                  </div>
                                <div class="col-4">
                                  <div class="form-group">
                                  
                                  <select class="form-control" id="download_file">
                                    <option value="Initial">Initial File</option>
                                    <option value="STL">STL File</option>
                                    <option value="Finished">Finished File</option>
                                  </select>
                                  </div>
                                </div>
                                <div class="col-3">
                                  <div class="form-group">
                                   
                                    <input type="button" name="donload_button" id="download_button" value="Donwload" class="btn btn-primary">
                                  </div>
                                </div>
                              </div>
                            </div>
                          <div class="col-sm-9">
                            <div class="form-group">
                            <button class="btn btn-primary" onclick="showHint('1')"> <input type="radio" name="search">  All</button>
                            <button class="btn btn-primary"  onclick="showHint('2')"> <input type="radio" name="search"> New </button>
                            <button class="btn btn-primary"  onclick="showHint('3')"> <input type="radio" name="search">  In Progress</button>
                            <button class="btn btn-primary"  onclick="showHint('4')"> <input type="radio" name="search">  QC Required</button>
                            <button class="btn btn-primary"  onclick="showHint('5')"> <input type="radio" name="search"> On Hold</button>
                            
                            <button class="btn btn-primary"  onclick="showHint('6')"> <input type="radio" name="search"> Desgined Completed</button>
                            <button class="btn btn-primary"  onclick="showHint('7')"> <input type="radio" name="search"> Canceled </button>
                            <button class="btn btn-primary"  onclick="showHint('8')"> <input type="radio" name="search"> Cases Completed </button>
                            </div>
                          </div>
                        </div>

                      <div id="report_data">
                         <table id="example1" class="table table-bordered table-striped">
                           <thead>
                            <tr>                          
                              <th>OrderID</th>
                              <th>Name</th>
                              <th>Turn Around Time</th>
                              <th width="100">Status</th>
                              <th>Unit</th>
                              <th>Tooth</th>
                              
                              <th>Lab Name</th>
                              <th>Date</th>
                              <th>Message</th>
                            </tr>
                            </thead>
                      </table>



                      </div>
                    
                    </div>
                  
                </div>
            </div>

          </div>
      </section>
    </div>

    

<script>
function showHint(str) {
  str=str+","+document.getElementById("snumber").value+","+document.getElementById("enumber").value;

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
    xmlhttp.open("GET", "msearch2.php?q=" + str, true);
    xmlhttp.send();
  }
}
function showHint2(str) {
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
    xmlhttp.open("GET", "report2.php?q=" + str, true);
    xmlhttp.send();
  }
}
</script>
<script type="text/javascript">

  $('#download_button').on('click', function() {
            var urls = [];
          var cnt=0;
      if ($("#download_file").val()=='Initial') {
            $('.caseid:checked').each(function() {
                urls.push($("#initial"+($(this).val())).val());              
            });
    }
      if ($("#download_file").val()=='Finished') {
            $('.caseid:checked').each(function() {
                urls.push($("#finished_file"+($(this).val())).val());              
            });
    }
     if ($("#download_file").val()=='STL') {
      var txt="";
            $('.caseid:checked').each(function() {
              var stt=($("#stl_file"+($(this).val())).val()).split("|");
             //alert(stt);
              for (var i = 0; i<stt.length; i++) {
                //alert(stt[i]);
                if (i==0) 
                 txt=stt[i];
              else
                txt="../api/stl_files/"+stt[i];
                urls.push(txt); 
              }
                             
            });
    }         
    downloadAll(urls);  
        });
function downloadAll(urls) {

  for (var i = 0; i < urls.length; i++) {
    
    window.open(urls[i],"_blank");
  }


}
var c=0;

  function selects(){  
             if( c%2==0)
              {
                var ele=document.getElementsByName('caseid');  
                for(var i=0; i<ele.length; i++){  
                    if(ele[i].type=='checkbox')  
                        ele[i].checked=true;  
                }
            }
             if(c%2!=0)
              {
        var ele=document.getElementsByName('caseid');  
                for(var i=0; i<ele.length; i++){  
                    if(ele[i].type=='checkbox')  
                        ele[i].checked=false;  
                      
                } 
              }   
              c++;
            } 
</script>


<?php
include 'footer.php';
?>