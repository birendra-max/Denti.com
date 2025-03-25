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
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Search Result</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Search Result</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card" style="padding:1%;">

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

            <div class="form-group">
              <input type="checkbox" name="select_all" id="select_all" onclick='selects()' value="all"> Select All Cases
            </div>

            <div class="table table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>OrderID</th>
                    <th>Name</th>
                    <th>TAT</th>
                    <th width="100">Status</th>
                    <th>Unit</th>
                    <th>Tooth</th>

                    <th>Lab Name</th>
                    <th>Date</th>
                    <th>Message</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  //$clientid=$_SESSION['email'];
                  if (strlen($_POST['orderid']) > 0 and !empty($_POST['orderid'])) {
                    $i = 0;
                    $orderid = trim($_POST['orderid']);
                    //die;
                    $clientid = $_SESSION['user_id'];
                    $sql = "SELECT * FROM orders where user_id='$clientid' and ( orderid like '%$orderid%' or fname like '%$orderid%')";
                    //die;
                    $res = mysqli_query($bd, $sql);
                    //$tdate=date('d-M-Y', strtotime('-1 day', strtotime(date("d-M-Y"))));

                    while ($row = mysqli_fetch_array($res)) {

                  ?>
                      <tr>
                        <td>

                          <input type="checkbox" name="caseid" class="caseid" id="caseid<?php echo $i ?>" value="<?php echo $i ?>">
                          <span><?php echo $row['orderid'] ?></span>

                          <input type="hidden" id="initial<?php echo $i ?>" value="api/files/<?php echo $row['filename'] ?>">



                          <input type="hidden" id="orderid_update<?php echo $i ?>" value="<?php echo $row['orderid'] ?>">

                          <?php
                          $orderid = $row['orderid'];
                          $sql2 = "SELECT * FROM orders_finished where orderid='$orderid'";
                          $res2 = mysqli_query($bd, $sql2);
                          $row2 = mysqli_fetch_array($res2);

                          ?>
                          <input type="hidden" id="finished_file<?php echo $i ?>" value="api/finished_files/<?php echo $row2['finished_file'] ?>">
                          <?php
                          $orderid = $row['orderid'];
                          $sql23 = "SELECT * FROM orders_stl_files where orderid='$orderid'";
                          $res23 = mysqli_query($bd, $sql23);
                          $st = "";
                          $f = 0;
                          $st = array();
                          while ($row23 = mysqli_fetch_assoc($res23)) {
                            $st[$f] = $row23['filename'];
                            $f++;
                          }

                          ?>
                          <input type="hidden" size="5000" id="stl_file<?php echo $i ?>" value="api/stl_files/<?php echo implode("|", $st); ?>">

                        </td>
                        <td><?php echo $row['fname'] ?></td>
                        <td> <i class="fas fa-running" style="font-size: 18px;font-weight: bold;"></i><?php if ($row['tduration'] == "Rush") {
                                                                                                        echo "1 - 2 Hour";
                                                                                                      }
                                                                                                      if ($row['tduration'] == "Same Day") {
                                                                                                        echo "6 Hour";
                                                                                                      }
                                                                                                      if ($row['tduration'] == "Next Day") {
                                                                                                        echo "12 Hour <i class='fas fa-moon' style='font-size:18px'></i>";
                                                                                                      }
                                                                                                      if (empty($row['tduration'])) {
                                                                                                        echo "12 Hour <i class='fas fa-moon' style='font-size:18px'></i>";
                                                                                                      }
                                                                                                      ?></td>
                        <td> <i class="fas fa-clock"> </i>
                          <div class="progress">
                            <div class="progress-bar <?php if ($row['status'] == 'New') echo 'bg-white';
                                                      if ($row['status'] == 'Cancel') echo 'bg-danger';
                                                      if ($row['status'] == 'Completed') echo 'bg-success';
                                                      if ($row['status'] == 'QC Required') echo 'bg-primary';
                                                      if ($row['status'] == 'Hold') echo 'bg-danger';
                                                      if ($row['status'] == 'Redesign') echo 'bg-warning'; ?>" style="width:<?php if ($row['status'] == 'New') echo '100%';
                                                                                                                            if ($row['status'] == 'Cancel') echo '40%';
                                                                                                                            if ($row['status'] == 'Completed') echo '100%';
                                                                                                                            if ($row['status'] == 'QC Required') echo '90%';
                                                                                                                            if ($row['status'] == 'Hold') echo '50%';
                                                                                                                            if ($row['status'] == 'Redesign') echo '100%'; ?>"> <?php echo $row['status'] ?> </div>
                          </div>
                        </td>
                        <td><?php echo $row['unit'] ?></td>
                        <td><?php echo implode("-", explode(",", $row['tooth'])) ?></td>

                        <td><?php echo $row['labname'] ?></td>

                        <td><?php echo $row['created_at'] ?></td>
                        <td> <button data-id="<?php echo $row['orderid'] ?>" class="btn btn-primary chatbtn">
                            <?php
                            $orderid = $row['orderid'];
                            $msgq = "SELECT count(*) as cnt FROM chatbox where orderid='$orderid'";
                            $resmsg = mysqli_query($bd, $msgq);

                            $msgrow = mysqli_fetch_array($resmsg);

                            if (!empty($row['message']))
                              echo ($msgrow['cnt'] + 1);
                            else
                              echo ($msgrow['cnt']);
                            ?> <i class="fas fa-comments"></i>
                          </button>
                        </td>
                      </tr>
                  <?php
                      $i++;
                    }
                  } else {
                    echo "<tr><td colspan='9' style='color:white'><h3 class='text-center'>Enter valid value for search.</h3></td></tr>";
                  }
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>orderID</th>
                    <th>Name</th>
                    <th>Turn Around Time</th>
                    <th>Status</th>
                    <th>Unit</th>
                    <th>Tooth</th>

                    <th>Lab Name</th>
                    <th>Date</th>
                    <th>Message</th>
                  </tr>
                </tfoot>

              </table>
            </div>
            <!-- /.row (main row) -->
          </div>
        </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<script type="text/javascript">
  $(function() {

    $('#run_button').click(function() {
      var dd;
      $('.caseid:checked').each(function() {
        var stt = $("#orderid_update" + ($(this).val())).val();
        dd = dd + "," + stt;

      });
      $.ajax({
        type: 'POST',
        url: 'update_run_self.php',
        data: {
          'orderid_update': dd,
          // other data
        },
        success: function(result) {
          alert(result);
          window.location = 'index.php';
        }
      });

    });

  });
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
        var orderId = row.find("td:first-child a").text().trim();
        var nameColumnValue = row.find("td:nth-child(2)").text().trim();

        // Step 3: Remove existing extension before adding new one
        var baseFileName = nameColumnValue.replace(/\.[^/.]+$/, ""); // Remove existing extension

        selectedFileTypes.forEach(function(fileType) {
          var filePath = "";

          if (fileType === 'STL') {
            var stlFileName = baseFileName + ".stl"; // Correct STL file name
            filePath = "api/stl_files/" + stlFileName;
            urls.push(filePath);
          }

          if (fileType === 'Finished') {
            var finishedFileName = baseFileName + ".zip"; // Correct ZIP file name
            filePath = "api/finished_files/" + finishedFileName;
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