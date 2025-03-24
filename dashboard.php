<?php
include 'header.php';
$clientid = $_SESSION['user_id'];

echo $clientid;
?>

<script>
    document.title = 'Dashboard';
    if (window.location.pathname.indexOf('/client/') === 0) {
        // Get the current path and remove "/client" part
        var newUrl = window.location.pathname.replace('/client', '');
        // Update the browser's URL without reloading the page
        window.history.replaceState(null, null, newUrl);
    }
</script>



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

    #datePickerContainer {
        margin-bottom: 500vh;
    }

    input[type="checkbox"] {
        zoom: 1.5;
    }
</style>



<!-- Content Wrapper -->
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <?php include('dashboard1.php') ?>

            <div class="card" style="padding: 1%;">

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


                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">

                        <thead>
                            <tr>
                                <th>OrderID</th>
                                <th>Name</th>
                                <th>TAT</th>
                                <th>Status</th>
                                <th>Unit</th>
                                <th>Tooth</th>
                                <th>Lab Name</th>
                                <th style="position: relative;">
                                    Date
                                    <span id="datePickerIcon" style="cursor: pointer; float: right;">
                                        <i class="fas fa-calendar-alt"></i>
                                    </span>
                                    <!-- Datepicker will be placed inside this div -->
                                    <div id="datePickerContainer" style="position: absolute; top: 30px; left: 0; display: none; background: white; z-index: 9999;"></div>
                                </th>
                                <th>Message</th>
                            </tr>
                        </thead>

                        <script>
                            $(document).ready(function() {
                                // Initialize Bootstrap Datepicker with custom styling
                                $("#datePickerContainer").datepicker({
                                    format: "yyyy-mm-dd",
                                    autoclose: true,
                                    todayHighlight: true
                                }).on("changeDate", function(e) {
                                    let selectedDate = $("#datePickerContainer").datepicker("getFormattedDate");

                                    // Hide the date picker
                                    $("#datePickerContainer").hide();

                                    // Fetch filtered data via AJAX
                                    $.ajax({
                                        url: "fetch_orders.php",
                                        type: "POST",
                                        data: {
                                            date: selectedDate
                                        },
                                        success: function(response) {
                                            $("#example1 tbody").html(response); // Update the table
                                        }
                                    });
                                });

                                // Show datepicker below the icon on click
                                $("#datePickerIcon").click(function() {
                                    $("#datePickerContainer").toggle();
                                });

                                // Hide when clicking outside
                                $(document).click(function(e) {
                                    if (!$(e.target).closest("#datePickerIcon, #datePickerContainer").length) {
                                        $("#datePickerContainer").hide();
                                    }
                                });
                            });
                        </script>

                        <tbody>
                            <?php
                            $clientid = $_SESSION['user_id'];
                            $i = 0;
                            $sql = "SELECT * FROM orders WHERE user_id='$clientid' AND status='New'";
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
                                        <input type="checkbox" name="caseid" class="caseid" style="zoom:1.5;" id="caseid<?php echo $i ?>"
                                            value="<?php echo $i ?>"><span id="orderid"> <?php echo $row['orderid'] ?></span>
                                        <input type="hidden" id="redesignid<?php echo $i ?>"
                                            value="<?php echo $row['orderid'] ?>">

                                        <input type="hidden" id="initial<?php echo $i ?>"
                                            value="api/files/<?php echo $row['filename'] ?>">
                                        <?php
                                        $orderid = $row['orderid'];
                                        $sql2 = "SELECT * FROM orders_finished where orderid='$orderid'";
                                        $res2 = mysqli_query($bd, $sql2);
                                        $row2 = mysqli_fetch_array($res2);

                                        ?>
                                        <input type="hidden" id="finished_file<?php echo $i ?>"
                                            value="api/finished_files/<?php echo $row2['finished_file'] ?>">
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
                                        <input type="hidden" size="5000" id="stl_file<?php echo $i ?>"
                                            value="api/stl_files/<?php echo implode("|", $st); ?>">
                                    </td>
                                    <td><?php echo $row['fname'] ?></td>
                                    <td> <i class="fas fa-running" style="font-size: 18px;font-weifs-bold;"></i><?php if ($row['tduration'] == "Rush") {
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
                                    <td>
                                        <div class="">
                                            <div class=" <?php if ($row['status'] == 'New')
                                                                echo 'bg-white';
                                                            if ($row['status'] == 'Cancel')
                                                                echo 'bg-danger';
                                                            if ($row['status'] == 'Completed')
                                                                echo 'bg-success';
                                                            if ($row['status'] == 'QC Required')
                                                                echo 'bg-primary';
                                                            if ($row['status'] == 'Hold')
                                                                echo 'bg-danger';
                                                            if ($row['status'] == 'Redesign')
                                                                echo 'bg-warning'; ?>" style="width:<?php if ($row['status'] == 'New')
                                                                                                        echo '100%';
                                                                                                    if ($row['status'] == 'Cancel')
                                                                                                        echo '40%';
                                                                                                    if ($row['status'] == 'Completed')
                                                                                                        echo '100%';
                                                                                                    if ($row['status'] == 'QC Required')
                                                                                                        echo '90%';
                                                                                                    if ($row['status'] == 'Hold')
                                                                                                        echo '50%';
                                                                                                    if ($row['status'] == 'Redesign')
                                                                                                        echo '100%'; ?>">
                                                <h3 class="btn bg-empty" style="width:100%;border-radius: 20px; "><i class="fas fa-clock"> </i><?php echo $row['status'] ?></h3>
                                            </div>
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
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
</div>


<?php
$clientid = $_SESSION['user_id'];
?>


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

<?php include 'footer.php'; ?>