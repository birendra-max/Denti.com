<?php
include 'header.php';
$em = $_SESSION['email'];
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">

      <?php include('dashboard.php') ?>

      <div class="row">
        <div class="col-3">
          <div class="form-group">
            <label>Selection Type</label><br>
            <input type="checkbox" name="select_all" id="select_all" onclick="selects()" value="all"> Select All Cases
          </div>
        </div>
        <div class="col-3">
          <div class="form-group">
            <label>Download</label>
            <div class="dropdown col-12">
              <button class="btn btn-white border border-2 border-warning dropdown-toggle w-100 text-left" type="button"
                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Select File Type
              </button>
              <div class="dropdown-menu col-8 shadow-lg" aria-labelledby="dropdownMenuButton">
                <label class="dropdown-item">
                  <input type="checkbox" value="STL" class="cursor-pointer file-type-checkbox"
                    style=" transform: scale(1.5); margin-right: 5px; " />
                  STL File
                </label>
                <label class="dropdown-item">
                  <input type="checkbox" value="Finished" class="cursor-pointer file-type-checkbox"
                    style=" transform: scale(1.5); margin-right: 5px; " />
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
      </div>

      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>OrderID</th>
              <th>Name</th>
              <th>TAT</th>
              <th>Status</th>
              <th>Product Type</th>
              <th>Unit</th>
              <th>Tooth</th>
              <th>Lab Name</th>
              <th>Date</th>
              <th>Message</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $clientid = $_SESSION['email'];
            $i = 0;
            $sql = "SELECT * FROM orders WHERE clientid='$clientid' AND status='New'";
            $res = mysqli_query($bd, $sql);

            while ($row = mysqli_fetch_array($res)) {
              $orderid = $row['orderid'];

              // Fetch Finished File
              $finishedFile = '';
              $sql2 = "SELECT finished_file FROM orders_finished WHERE orderid='$orderid'";
              $res2 = mysqli_query($bd, $sql2);
              if ($res2 && $row2 = mysqli_fetch_assoc($res2)) {
                $finishedFile = $row2['finished_file'];
              }

              // Fetch STL Files
              $stlFiles = [];
              $sql3 = "SELECT filename FROM orders_stl_files WHERE orderid='$orderid'";
              $res3 = mysqli_query($bd, $sql3);
              while ($row3 = mysqli_fetch_assoc($res3)) {
                $stlFiles[] = $row3['filename'];
              }
              ?>
              <tr>
                <td>
                  <input type="checkbox" name="caseid" class="caseid" id="caseid<?php echo $i; ?>"
                    value="<?php echo $i; ?>">
                  <a href="order_detail.php?orderid=<?php echo $orderid; ?>"><?php echo $orderid; ?></a>
                  <input type="hidden" id="initial<?php echo $i; ?>" value="api/files/<?php echo $row['filename']; ?>">
                  <input type="hidden" id="finished_file<?php echo $i; ?>"
                    value="api/finished_files/<?php echo $finishedFile; ?>">
                  <input type="hidden" id="stl_file<?php echo $i; ?>" value="<?php echo implode("|", $stlFiles); ?>">
                </td>
                <td><?php echo $row['fname']; ?></td>
                <td><?php echo $row['tduration'] ? $row['tduration'] : "12 Hour"; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td>
                  <?php
                  $teeth = explode(",", $row['tooth']);
                  foreach ($teeth as $t) {
                    if ($t > 1 && $t < 32) {
                      echo "Crown & Bridge";
                    }
                  }
                  ?>
                </td>

                <td><?php echo $row['unit']; ?></td>
                <td><?php echo str_replace(",", "-", $row['tooth']); ?></td>
                <td><?php echo $row['labname']; ?></td>
                <td><?php echo $row['created_at']; ?></td>
                <td>
                  <button data-id="<?php echo $orderid; ?>" class="btn btn-primary chatbtn">
                    <?php
                    $msgq = "SELECT COUNT(*) as cnt FROM chatbox WHERE orderid='$orderid'";
                    $resmsg = mysqli_query($bd, $msgq);
                    $msgrow = mysqli_fetch_assoc($resmsg);
                    echo $msgrow['cnt'];
                    ?> <i class="fas fa-comments"></i>
                  </button>
                </td>
              </tr>
              <?php
              $i++;
            }
            ?>
          </tbody>
        </table>
      </div>

    </div>
  </section>
</div>


<script>
  $(document).ready(function () {
    $('#download_button').on('click', function () {
      var urls = [];
      var selectedFileTypes = [];

      // Step 1: Check selected file types
      $('.file-type-checkbox:checked').each(function () {
        selectedFileTypes.push($(this).val());
      });

      console.log("Selected file types:", selectedFileTypes);

      if (selectedFileTypes.length === 0) {
        alert("Please select a file type to download.");
        return;
      }

      // Step 2: Loop through each checked row and get the name column value
      $('.caseid:checked').each(function () {
        var row = $(this).closest("tr");
        var rowId = $(this).val();
        var orderId = row.find("td:first-child a").text().trim();
        var nameColumnValue = row.find("td:nth-child(2)").text().trim(); // Extract original file name

        console.log("Processing Order ID:", orderId);
        console.log("Original File Name:", nameColumnValue);

        // Step 3: Remove existing extension before adding new one
        var baseFileName = nameColumnValue.replace(/\.[^/.]+$/, ""); // Remove existing extension

        selectedFileTypes.forEach(function (fileType) {
          var filePath = "";

          if (fileType === 'STL') {
            var stlFileName = baseFileName + ".stl"; // Correct STL file name
            filePath = "api/stl_files/" + stlFileName;
            console.log("Adding STL File:", filePath);
            urls.push(filePath);
          }

          if (fileType === 'Finished') {
            var finishedFileName = baseFileName + ".zip"; // Correct ZIP file name
            filePath = "api/finished_files/" + finishedFileName;
            console.log("Adding Finished File:", filePath);
            urls.push(filePath);
          }
        });
      });

      console.log("Final Files to Download:", urls);

      if (urls.length === 0) {
        alert("No files selected for download.");
      } else {
        downloadFiles(urls);
      }
    });

    // Function to trigger downloads
    function downloadFiles(urls) {
      urls.forEach(function (url, index) {
        setTimeout(function () {
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

  $(document).ready(function () {
    // Select All Cases Checkbox Functionality
    $("#select_all").on("click", function () {
      var isChecked = $(this).prop("checked");
      $(".caseid").prop("checked", isChecked); // Check or Uncheck all case checkboxes
    });

    // If any case checkbox is unchecked, uncheck "Select All"
    $(".caseid").on("click", function () {
      if (!$(this).prop("checked")) {
        $("#select_all").prop("checked", false);
      } else if ($(".caseid:checked").length === $(".caseid").length) {
        $("#select_all").prop("checked", true);
      }
    });
  });
</script>

<?php include 'footer.php'; ?>