<script>
    document.title = 'File Upload Center';
</script>

<?php

include 'header.php';
include 'testmail.php';
if (isset($_POST['submit'])) {
    extract($_POST);
    $tfiles = $_POST['total_files'];
    $timeduration = (isset($_POST['timeduration'])) ? $_POST['timeduration'] : '';
    $f = 1;
    $foid = "";
    $i = 0;
    for (; $i < $tfiles; $i++) {
        $msg1 = $_POST['msg' . $i];
        if ($foid == "")
            $foid = $_POST['orderid' . $i];
        $toid = $_POST['orderid' . $i];
        if (mysqli_query($bd, "UPDATE orders set message='$msg1',tduration='$timeduration' where orderid='$toid'"))
            $f = 0;
        else
            $f = 1;
    }
    $i = $i - 1;
    $loid = $foid + $i;
    if ($timeduration == 'Rush') {
        $to = 'bravodent@bravodentdesigns.com';
        $em = $_SESSION['email'];
        $resulth = mysqli_query($bd, "SELECT * FROM user where em='$em'");
        $rowh = mysqli_fetch_array($resulth);
        $cname = $rowh['name'];
        $subject = ' Name (' . $_SESSION['labname'] . ') (' . ($i + 1) . ') RUSH Order Recieved : (' . $foid . '-' . $loid . ')';

        $headers  = "From: " . strip_tags("bravodent@bravodentdesigns.com") . "\r\n";
        $headers .= "Reply-To: " . strip_tags("bravodent@bravodentdesigns.com") . "\r\n";
        $headers .= "CC: bravodent@bravodentdesigns.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        $message = '<p><strong>You have received <b> NEW RUSH </b>order ID  (' . $foid . '-' . $loid . ') Total ' . ($i + 1) . '</strong> </p>';
        //mail($to, $subject, $message, $headers);
        sendEmail($email, $subject, $message);

        // Sending the email
        // mail($to, $subject, $message, $headers);
    }

    if ($f == 0)
        echo "<script> toastr.success('Request is sent successfully.');</script>";
    else
        echo "<script> toastr.error('Sorry something went wrong.'); </script>";
}

// $to = 'amittiwari92119211@gmail.com';
// $subject = 'skydent';
// $message = 'hello papi';
// $headers = 'From: skydent@skydentdesigns.com' . "\r\n" .
//     'Reply-To: skydent@skydentdesigns.com' . "\r\n" .
//     'Cc: skydent@skydentdesigns.com' . "\r\n" . // Add the CC email address here
//     'X-Mailer: PHP/' . phpversion();

// mail($to, $subject, $message, $headers);

?>

<script>
    toastr.success('Request is sent successfully.');
</script>

<style type="text/css">
    #drag_drop {
        background-color: #f9f9f9;
        border: #ccc 4px dashed;
        line-height: 500px;
        padding: 12px;
        font-size: 24px;
        text-align: center;
    }

    div.radio-box {
        width: 100px;
        display: inline-block;
        margin: 5px;
    }

    .radio-box label {
        display: block;
        width: 100px;
        text-align: center;
    }

    .custom-file-input::before {
        content: 'Select some files';
        display: inline-block;
        background: linear-gradient(top, #f9f9f9, #e3e3e3);
        border: 1px solid #999;
        border-radius: 3px;
        padding: 5px 8px;
        outline: none;
        white-space: nowrap;
        -webkit-user-select: none;
        cursor: pointer;
        text-shadow: 1px 1px #fff;
        font-weight: 700;
        font-size: 10pt;
    }

    .custom-file-input:hover::before {
        border-color: black;
    }

    .custom-file-input:active::before {
        background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
    }
</style>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="card" id="cardd">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="drag_drop">Drag & Drop File Here</div>
                                <center>
                                    <div class="btn btn-default btn-file">

                                        <!-- Bigger Up Arrow Icon -->
                                        <div id="cloudIcon" class="cloud-icon">
                                            <i class="bi bi-cloud-arrow-up-fill"></i>
                                        </div>

                                        <!-- Floating Drop Indicator -->
                                        <div id="floatingDropIndicator" class="floating-drop-indicator">
                                            <span>Drop files to upload them to</span>
                                        </div>

                                        You can <i class="fas fa-paperclip"></i> Browse or Drag and Drop files to upload
                                        orders.
                                        <input type="file" id="selectfile" multiple webkitdirectory />

                                    </div>
                                    <section>
                                        <link
                                            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
                                            rel="stylesheet">
                                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                        <link rel="stylesheet"
                                            href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

                                        <style>
                                            /* Bigger Up Arrow Icon */
                                            .cloud-icon {
                                                position: fixed;
                                                bottom: 150px;
                                                /* Positioned above the button */
                                                left: 50%;
                                                transform: translateX(-50%) scale(0.8);
                                                background: white;
                                                color: #1967D2;
                                                width: 140px;
                                                /* Bigger size */
                                                height: 140px;
                                                /* Bigger size */
                                                display: flex;
                                                align-items: center;
                                                justify-content: center;
                                                font-size: 100px;
                                                /* Bigger arrow */
                                                border-radius: 50%;
                                                box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.25);
                                                /* Stronger shadow */
                                                opacity: 0;
                                                transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
                                                pointer-events: none;
                                            }

                                            /* Floating Drop Indicator (Now Separate) */
                                            .floating-drop-indicator {
                                                position: fixed;
                                                bottom: 50px;
                                                left: 50%;
                                                transform: translateX(-50%) scale(0.8);
                                                background: #1967D2;
                                                color: white;
                                                padding: 15px 30px;
                                                border-radius: 30px;
                                                display: flex;
                                                align-items: center;
                                                gap: 10px;
                                                font-weight: 500;
                                                font-size: 40px;
                                                opacity: 0;
                                                transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
                                                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
                                                font-family: Arial, sans-serif;
                                                pointer-events: none;
                                            }

                                            /* My Drive Button */
                                            .drive-button {
                                                background: rgba(255, 255, 255, 0.2);
                                                padding: 5px 12px;
                                                border-radius: 15px;
                                                font-size: 20px;
                                                display: flex;
                                                align-items: center;
                                                gap: 6px;
                                                cursor: pointer;
                                            }

                                            .drive-button i {
                                                font-size: 16px;
                                            }

                                            /* Show Elements on Drag */
                                            .show {
                                                opacity: 1 !important;
                                                transform: translateX(-50%) scale(1) !important;
                                                pointer-events: auto !important;
                                            }

                                            /* Bounce Effect */
                                            .bounce {
                                                animation: bounce 0.3s ease-in-out;
                                            }

                                            @keyframes bounce {
                                                0% {
                                                    transform: translateX(-50%) scale(1);
                                                }

                                                50% {
                                                    transform: translateX(-50%) scale(1.1);
                                                }

                                                100% {
                                                    transform: translateX(-50%) scale(1);
                                                }
                                            }
                                        </style>


                                        <script>
                                            $(document).ready(function() {
                                                let floatingIndicator = $("#floatingDropIndicator");
                                                let cloudIcon = $("#cloudIcon");

                                                $(document).on("dragenter dragover", function(event) {
                                                    event.preventDefault();
                                                    floatingIndicator.addClass("show");
                                                    cloudIcon.addClass("show");
                                                });

                                                $(document).on("dragleave drop", function(event) {
                                                    event.preventDefault();
                                                    setTimeout(() => {
                                                        floatingIndicator.removeClass("show");
                                                        cloudIcon.removeClass("show");
                                                    }, 300);
                                                });

                                                $(document).on("drop", function(event) {
                                                    event.preventDefault();
                                                    let files = event.originalEvent.dataTransfer.files;
                                                    console.log("Dropped Files:", files);

                                                    // Add bounce effect
                                                    floatingIndicator.addClass("bounce");
                                                    cloudIcon.addClass("bounce");

                                                    setTimeout(() => {
                                                        floatingIndicator.removeClass("bounce");
                                                        cloudIcon.removeClass("bounce");
                                                    }, 300);
                                                });
                                            });
                                        </script>
                                    </section>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" name="total_files" id="total_files">
                        <div id="table_div"></div>

                        <center>
                            <!-- <div class="row" id="timed" style="display: none;">
                                <div class="col-md-4"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="radio-box">
                                            <input type="radio" name="timeduration" value="Rush"> Rush
                                            <label> <i class="fas fa-ambulance"></i> 1 -2 Hour </label>
                                        </div>
                                        <div class="radio-box">
                                            <input type="radio" name="timeduration" value="Same Day"> Same Day
                                            <label> <i class="fas fa-ambulance"></i> 6 Hour </label>
                                        </div>
                                        <div class="radio-box">
                                            <input type="radio" name="timeduration" value="Next Day"> Next Day
                                            <label> <i class="fas fa-ambulance"></i> 12 Hour </label>
                                        </div>
                                    </div>
                                </div>
                            </div> -->


                            <section>
                                <div class="row" id="timed" style="display: none;">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="rush" name="timeduration" value="Rush" onclick="toggleRadio(this)">
                                                <label class="form-check-label d-flex align-items-center" for="rush">
                                                    <span class="radio-btn-container">
                                                        <i class="fas fa-ambulance mr-2" style="font-size: 18px; color: #007bff;"></i> Rush - 1 - 2 Hour
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="sameDay" name="timeduration" value="Same Day" onclick="toggleRadio(this)">
                                                <label class="form-check-label d-flex align-items-center" for="sameDay">
                                                    <span class="radio-btn-container">
                                                        <i class="fas fa-ambulance mr-2" style="font-size: 18px; color: #007bff;"></i> Same Day - 6 Hour
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="nextDay" name="timeduration" value="Next Day" onclick="toggleRadio(this)">
                                                <label class="form-check-label d-flex align-items-center" for="nextDay">
                                                    <span class="radio-btn-container">
                                                        <i class="fas fa-ambulance mr-2" style="font-size: 18px; color: #007bff;"></i> Next Day - 12 Hour
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    function toggleRadio(radio) {
                                        const radios = document.querySelectorAll('input[type="radio"][name="timeduration"]');
                                        radios.forEach((item) => {
                                            item.checked = false; // Uncheck other radio buttons
                                        });
                                        radio.checked = true; // Check the clicked radio button
                                    }
                                </script>

                                <!-- Include Bootstrap 4 or 5 CSS here -->
                                <!-- Example: -->
                                <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> -->

                                <style>
                                    /* Custom radio button design */
                                    .form-check-input {
                                        position: absolute;
                                        opacity: 0;
                                        /* Hide the default radio button */
                                    }

                                    .form-check-label {
                                        display: block;
                                        position: relative;
                                        padding-left: 35px;
                                        /* Create space for the radio button */
                                        font-size: 16px;
                                        cursor: pointer;
                                        padding: 10px 20px;
                                        border-radius: 25px;
                                        background-color: #fff;
                                        border: 2px solid #007bff;
                                        transition: background-color 0.3s ease, color 0.3s ease;
                                    }

                                    .form-check-label:hover {
                                        background-color: #007bff;
                                        color: #fff;
                                    }

                                    .form-check-input:checked+.form-check-label {
                                        background-color: #007bff;
                                        color: white;
                                        border-color: #007bff;
                                    }

                                    .form-check-label .radio-btn-container {
                                        display: inline-block;
                                        padding-left: 40px;
                                        position: relative;
                                        font-size: 16px;
                                    }

                                    .form-check-input:checked+.form-check-label .radio-btn-container::before {
                                        content: '';
                                        position: absolute;
                                        left: 10px;
                                        top: 50%;
                                        transform: translateY(-50%);
                                        width: 20px;
                                        height: 20px;
                                        border-radius: 50%;
                                        background-color: white;
                                        border: 2px solid #007bff;
                                    }

                                    .form-check-input:checked+.form-check-label .radio-btn-container {
                                        padding-left: 40px;
                                    }

                                    .form-check-label .radio-btn-container::before {
                                        content: '';
                                        position: absolute;
                                        left: 10px;
                                        top: 50%;
                                        transform: translateY(-50%);
                                        width: 20px;
                                        height: 20px;
                                        border-radius: 50%;
                                        background-color: #007bff;
                                        border: 2px solid #007bff;
                                    }

                                    .form-check-inline {
                                        margin-bottom: 10px;
                                    }
                                </style>
                            </section>

                        </center>
                        <div class="row">
                            <div class="col-md-5"></div>
                            <div class="col-md-6">
                                <input type="submit" name="submit" id="sbtbtn" style="display: none;"
                                    value="Send For Design" class="btn btn-success">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>


<script type="text/javascript">
    function _(element) {
        return document.getElementById(element);
    }

    // Handle drag events to highlight the drop area
    _('drag_drop').ondragover = function(event) {
        this.style.borderColor = '#333';
        return false;
    };

    _('drag_drop').ondragleave = function(event) {
        this.style.borderColor = '#ccc';
        return false;
    };

    // Handle the drop event for files and folders
    $("#drag_drop").on("drop", function(e) {
        e.preventDefault();
        var files = e.originalEvent.dataTransfer.files;
        processFiles(files);
    });

    // Handle the file select button click
    $("#selectfile").on("change", function(e) {
        var files = document.getElementById("selectfile").files;
        processFiles(files);
    });

    // Process files (both files and files inside folders)

    function processFiles(files) {
        // Clear previous table content
        $("#table_div").html(`
        <table class="table table-hover" style="text-align:center" id="progress_table">
            <thead>
                <tr>
                    <th style="width:7% !important;">Orderid</th>
                    <th style="width:20% !important;">File</th>
                    <th style="width:20% !important;">Product Type</th>
                    <th style="width:7% !important;">Unit</th>
                    <th style="width:20% !important;">Tooth</th>
                    <th style="width:20% !important;">Message</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    `);

        // Loop over the files (and folders) and prepare the table for each file
        for (var i = 0; i < files.length; i++) {
            var fileName = files[i].name;

            $("#progress_table tbody").append(`
            <tr id="tr${i}">
                <td style="width:7% !important;">
                    <input class="form-control" type="text" id="odid${i}" readonly>
                </td>
                <td style="width:20% !important;">
                    <div class="progress" id="progress_bar${i}" style="display:none; height:auto;padding:5px;">
                        <div class="progress-bar bg-success" id="progress_bar_process${i}" role="progressbar" style="width:0%; height:auto;padding:5px;white-space:pre-wrap">0%</div>
                    </div>
                </td>
                <td style="width:20% !important;">
                    <input class="form-control" type="text" id="p_typ${i}" readonly>
                    <input type="hidden" id="p_typ${i}">
                </td>
                <td style="width:5% !important;">
                    <input class="form-control" type="text" id="u${i}" readonly>
                    <input type="hidden" id="u${i}">
                </td>
                <td style="width:20% !important;">
                    <input type="text" id="t${i}" class="form-control" readonly>
                    <input type="hidden" id="t${i}">
                    <input type="hidden" name="orderid${i}" id="orderid${i}" class="form-control">
                </td>
                <td style="width:20% !important;">
                    <textarea class="form-control" name="msg${i}" id="msg${i}" width="100%"></textarea>
                </td>
                <td id="error_message${i}" style="color:red; display:none;"></td>
            </tr>
        `);

            // Send AJAX request to check if the file exists
            (function(i) { // We use an IIFE to capture the index
                $.ajax({
                    url: 'file_exists.php',
                    type: 'POST',
                    data: {
                        fileName: fileName
                    },
                    success: function(response) {
                        var fileIndex = i; // Use the captured index for correct handling

                        if (response === 'exists') {
                            var confirmUpload = confirm(`${fileName} already exists. Do you want to upload it again?`);
                            if (confirmUpload) {
                                uploadSingleFile(files[fileIndex], fileIndex);
                            } else {
                                window.location.reload();
                            }
                        } else {
                            uploadSingleFile(files[fileIndex], fileIndex);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Error checking file: ' + error);
                    }
                });
            })(i);
        }

        $('#sbtbtn').show();
        document.getElementById('total_files').setAttribute('value', files.length);
    }

    function uploadSingleFile(file, i) {
        var formData = new FormData();
        formData.append("file", file);

        document.getElementById("timed").style.display = 'block';
        document.getElementById("cardd").style.display = 'none';
        document.getElementById('tr' + i).style.display = 'table-row';
        document.getElementById('progress_bar' + i).style.display = 'block';

        var ajax_request = new XMLHttpRequest();
        ajax_request.open("POST", "upload.php");

        // Upload progress bar update
        ajax_request.upload.addEventListener('progress', function(event) {
            var percent_completed = Math.round((event.loaded / event.total) * 100);
            document.getElementById('progress_bar_process' + i).style.width = percent_completed + '%';
            document.getElementById('progress_bar_process' + i).innerHTML = percent_completed + '% completed';
        });

        // On load event after file is uploaded
        ajax_request.addEventListener('load', function(event) {
            var responseText = event.target.responseText;
            console.log(responseText);

            var responseArray = responseText.split("|");

            var orderId = responseArray[0];
            var fname = responseArray[1];
            var tooth = responseArray[2];
            var tunit = responseArray[3];
            var message = responseArray[4];
            var product_type = responseArray[5];

            document.getElementById('tr' + i).style.display = 'table-row';
            document.getElementById('u' + i).setAttribute('value', tunit);
            document.getElementById('orderid' + i).setAttribute('value', orderId);
            document.getElementById('odid' + i).setAttribute('value', orderId);
            document.getElementById('t' + i).setAttribute('value', tooth);

            document.getElementById('msg' + i).value = message;
            document.getElementById('p_typ' + i).value = product_type;

            document.getElementById('progress_bar_process' + i).innerHTML = '<div class="" style="width:250px;">' + fname + '</div>';
            document.getElementById('error_message' + i).style.display = "none";
            document.getElementById('drag_drop').style.borderColor = '#ccc';
        });

        // Send the file to PHP backend
        ajax_request.send(formData);
    }
</script>


<?php
include 'footer.php';
?>