<script>
  document.title = "Reports";
</script>

<?php
include 'header.php';
?>




<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

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
          <div class="card" style="padding: 2%;">
            <div class="card-header">
              <h3 class="card-title">Report</h3>
            </div>
            <!-- /.card-header -->

            <div class="row mt-4">
              <div class="col-3"><br>
                <div class="form-group">
                  <button name="today" class="btn btn-primary" onclick="showHint('1')">Today</button>
                  <button name="weekly" class="btn btn-primary" onclick="showHint('2')">Weekly</button>
                  <button name="monthly" class="btn btn-primary" onclick="showHint('3')">Monthly</button>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label>Start Date</label>
                  <input type="date" name="sdate" id="sdate" class="form-control">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label>End Date</label>
                  <input type="date" name="edate" id="edate" class="form-control">
                </div>
              </div>
              <div class="col-3 mt-4">
                <div class="form-group">
                  <label></label><br>
                  <input type="submit" name="submit" value="Submit" onclick="showHint2('1')" class="btn btn-success">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-3">
                <div class="form-group">
                  <label>Download</label>
                  <div class="dropdown col-12">
                    <button class="btn btn-white border border-2 border-primary dropdown-toggle w-100 text-left"
                      type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="false">
                      Select File Type
                    </button>
                    <div class="dropdown-menu col-8 shadow-lg" aria-labelledby="dropdownMenuButton">
                      <label class="dropdown-item">
                        <input type="checkbox" value="STL" class="cursor-pointer file-type-checkbox"
                          style="margin-right: 5px; " />
                        STL File
                      </label>
                      <label class="dropdown-item">
                        <input type="checkbox" value="Finished" class="cursor-pointer file-type-checkbox"
                          style="margin-right: 5px; " />
                        Finished File
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label>Action</label><br>
                  <input type="button" name="download_button" id="download_button" value="Download Now"
                    class="btn btn-primary">
                </div>
              </div>

              <div class="col-2" style="display:none;">
                <div class="form-group">
                  <label>Status</label>
                  <select name="filestatus" id="filestatus" class="form-control">
                    <option value="Rush">Redesign and Rush</option>
                  </select>

                </div>
              </div>
              <div class="col-2">
                <div class="form-group">
                  <label>Action</label><br>
                  <input type="button" name="redesign_button" id="redesign_button" onclick="openredesign()"
                    value="Send For Redesign" class="btn btn-primary">
                </div>
              </div>
            </div>


            <div class="form-group">
              <input type="checkbox" name="select_all" id="select_all" onclick='selects()' value="all"> Select All Cases
            </div>

            <div id="report_data"></div>

          </div>

        </div>
      </div>

    </div>
  </section>
</div>


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
          $(function() {
            $("#example1").DataTable({
              "lengthMenu": [
                [100, 500, 1000, -1],
                [100, 500, 1000, "All"]
              ],
              "buttons": [{
                extend: 'excel',
                className: 'btn btn-primary glyphicon glyphicon-list-alt',
                text: '<i class="fa fa-plus-circle" aria-hidden="true"></i> Export Report Into Excel',
              }],
              "iDisplayLength": 100,
              "responsive": true,
              "lengthChange": true,
              "autoWidth": false
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
          });
        }
      };
      xmlhttp.open("GET", "report3.php?q=" + str, true);
      xmlhttp.send();
    }
  }

  function showHint2(str) {
    str = document.getElementById("sdate").value + "," + document.getElementById("edate").value;
    if (str.length == 0) {
      document.getElementById("report_data").innerHTML = "";
      return;
    } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("report_data").innerHTML = this.responseText;
          $(function() {
            $("#example1").DataTable({
              "lengthMenu": [
                [100, 500, 1000, -1],
                [100, 500, 1000, "All"]
              ],
              "buttons": [{
                extend: 'excel',
                className: 'btn btn-primary glyphicon glyphicon-list-alt',
                text: '<i class="fa fa-plus-circle" aria-hidden="true"></i> Export Report Into Excel',
              }],
              "iDisplayLength": 100,
              "responsive": true,
              "lengthChange": true,
              "autoWidth": false
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
          });
        }
      };
      xmlhttp.open("GET", "report2.php?q=" + str, true);
      xmlhttp.send();
    }
  }
</script>


<script>
  $(document).ready(function() {
    $('#download_button').on('click', function() {
      var urls = [];
      var selectedFileTypes = [];

      // Step 1: Check selected file types
      $('.file-type-checkbox:checked').each(function() {
        selectedFileTypes.push($(this).val());
      });


      if (selectedFileTypes.length === 0) {
        alert("Please select a file type to download.");
        return;
      }

      // Step 2: Loop through each checked row and get the name column value
      $('.caseid:checked').each(function() {
        var row = $(this).closest("tr");
        var rowId = $(this).val();
        var orderId = row.find("td:first-child span").text().trim();
        var nameColumnValue = row.find("td:nth-child(2)").text().trim();

        // Step 3: Remove existing extension before adding new one
        var baseFileName = nameColumnValue.replace(/\.[^/.]+$/, ""); // Remove existing extension

        selectedFileTypes.forEach(function(fileType) {
          var filePath = "";

          if (fileType === 'STL') {
            var stlFileName = baseFileName + ".stl"; // Correct STL file name
            filePath = "api/stl_files/" + encodeURIComponent(stlFileName);

            urls.push(filePath);
          }

          if (fileType === 'Finished') {
            var finishedFileName = baseFileName + ".zip"; // Correct ZIP file name
            filePath = "api/finished_files/" + encodeURIComponent(finishedFileName);
            urls.push(filePath);
          }
        });
      });


      if (urls.length === 0) {
        alert("No files selected for download.");
      } else {
        downloadFiles(urls);
      }
    });

    // Function to trigger downloads
    function downloadFiles(urls) {
      urls.forEach(function(url, index) {
        setTimeout(function() {
          var link = document.createElement('a');
          link.href = url;
          link.setAttribute('download', '');
          document.body.appendChild(link);
          link.click();
          document.body.removeChild(link);
        }, index * 1000);
      });
    }
  });

  $(document).ready(function() {
    // Select All Cases Checkbox Functionality
    $("#select_all").on("click", function() {
      var isChecked = $(this).prop("checked");
      $(".caseid").prop("checked", isChecked); // Check or Uncheck all case checkboxes
    });

    // If any case checkbox is unchecked, uncheck "Select All"
    $(".caseid").on("click", function() {
      if (!$(this).prop("checked")) {
        $("#select_all").prop("checked", false);
      } else if ($(".caseid:checked").length === $(".caseid").length) {
        $("#select_all").prop("checked", true);
      }
    });
  });
</script>

<?php
include 'footer.php';
?>