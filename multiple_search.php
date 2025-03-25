<script>
  document.title = "Multiple Search";
</script>

<?php
include 'header.php';
?>

<style>
  .buttons-excel {
    display: none;
  }

  #example1_length {
    display: none;
  }

  #example1_filter {
    display: none;
  }
</style>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->


  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card" style="padding:2%;">
            <div class="row"
              style="display:flex;justify-content:center;align-items:center;">
              <div class="col-md-3">

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
                  <input type="text" id="enumber" class="form-control" placeholder="End Number" onkeyup="showHint('1', this)">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label></label>
                  <button type="button" class="btn btn-success" onclick="showHint2('1')">
                    <i class="fa fa-search"></i> Search
                  </button>
                </div>
              </div>
            </div>

            <section>
              <div class="row mt-4 text-center">
                <div class="col-12 d-flex flex-wrap justify-content-center">
                  <button class="btn btn-outline-primary mx-2" style="font-size:1em;" onclick="showHint('1', this)">All</button>
                  <button class="btn btn-outline-primary mx-2" style="font-size:1em;" onclick="showHint('2', this)">New</button>
                  <button class="btn btn-outline-primary mx-2" style="font-size:1em;" onclick="showHint('3', this)">In Progress</button>
                  <button class="btn btn-outline-primary mx-2" style="font-size:1em;" onclick="showHint('4', this)">QC Required</button>
                  <button class="btn btn-outline-primary mx-2" style="font-size:1em;" onclick="showHint('5', this)">On Hold</button>
                  <button class="btn btn-outline-primary mx-2" style="font-size:1em;" onclick="showHint('7', this)">Canceled</button>
                  <button class="btn btn-outline-primary mx-2" style="font-size:1em;" onclick="showHint('8', this)">Completed</button>
                </div>
              </div>

              <style>
                /* Styling for the active button */
                .btn-outline-primary.active {
                  background-color: #007bff;
                  border-color: #007bff;
                  color: white;
                }

                /* Ensure font size stays consistent for all buttons */
                .btn-outline-primary {
                  font-size: 1em;
                }
              </style>
            </section>


            <div class="row">
              <div class="col-2">
                <div class="form-group">
                  <label>Download</label>
                  <div class="dropdown col-12">
                    <button class="btn btn-white border border-2 border-primary dropdown-toggle w-100 text-left"
                      type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="false">
                      Select File Type
                    </button>
                    <div class="dropdown-menu col-11 shadow-lg" aria-labelledby="dropdownMenuButton">
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
              <div class="col-1">
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

            <div class="form-group mt-4">
              <input type="checkbox" name="select_all" id="select_all" value="all"> Select All Cases
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
  function showHint(str, buttonElement) {
    str = str + "," + document.getElementById("snumber").value + "," + document.getElementById("enumber").value;

    const buttons = document.querySelectorAll('.btn-outline-primary');
    buttons.forEach(button => {
      button.classList.remove('active');
    });

    // Add the 'active' class to the clicked button
    buttonElement.classList.add('active');

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