<?php
include 'header.php';
include 'testmail.php';
if (isset($_POST['submit'])) {
    extract($_POST);
    $tfiles = $_POST['total_files'];
    $timeduration = $_POST['timeduration'];
    $f = 1;
    //echo "<script>alert($tfiles)</script>";
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
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- <table class="table table-hover" id="progress_table" style="width: 100% !important"><thead><tr><th>File</th><th>Unit</th><th>Tooth</th><th>Message</th><th>Optional</th></tr></thead><tbody>

  <tr id="tr" style="display: table-row"><td><div class="progress" id="progress_bar'+i+'" style=" height:40px;"><div class="progress-bar bg-success" id="progress_bar_process" role="progressbar" style="width:0%; height:40px;">0%</div></div></td><td><input class="form-control" type="text" id="u" readonly></td><td><input type="text" id="t" class="form-control" readonly ></td><td><textarea class="form-control" name="msg" id="msg"></textarea></td><td><a href="" class="btn btn-primary">Send</a></td></tr>
</tbody>
</table> -->

            <form action="" method="post" enctype="multipart/form-data">
                <div class="card" id="cardd">
                    <?php

                    //            $xml2=$xml = simplexml_load_file("api/files/celese heron/celese heron/celese heron.xml");  
                    //            $t="";
                    //            $unit=0;
                    // foreach ($xml->Object[0]->Object as $value) {

                    //  if($value->attributes()->name=='ToothElementList')
                    //  {

                    //     foreach ($value->List->Object as $tuth) {
                    //       foreach( $tuth->Property as $pr)
                    //       {
                    //        //echo $pr->attributes()->name;
                    //        if($pr->attributes()->name=="ToothNumber")
                    //       {

                    //        if($unit==0)
                    //          $t=$pr->attributes()->value;  
                    //          else                
                    //       $t=$t.",".$pr->attributes()->value;  
                    //       $unit++;
                    //       }
                    //      }
                    //   }

                    //  }      
                    //  }

                    //  echo $t;
                    ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="drag_drop">Drag & Drop File Here</div>
                                <center>
                                    <div class="btn btn-default btn-file">
                                        You can <i class="fas fa-paperclip"></i> Browse or Drag and Drop files to upload orders.
                                        <input type="file" id="selectfile" multiple />
                                    </div>
                                </center>
                            </div>

                        </div>


                    </div>
                </div>

                <br /><br /><br />

                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" name="total_files" id="total_files">
                        <div id="table_div"></div>

                        <center>
                            <div class="row" id="timed" style="display: none;">
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
                            </div>
                        </center>
                        <div class="row">
                            <div class="col-md-5"></div>
                            <div class="col-md-6">
                                <input type="submit" name="submit" id="sbtbtn" style="display: none;" value="Send For Design" class="btn btn-success">
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
</div>


<script type="text/javascript">
    function _(element) {
        return document.getElementById(element);
    }

    _('drag_drop').ondragover = function(event) {
        this.style.borderColor = '#333';
        return false;
    }

    _('drag_drop').ondragleave = function(event) {
        this.style.borderColor = '#ccc';
        return false;
    }




    $("#drag_drop").on("drop", function(e) {
        e.preventDefault();
        //$(this).removeClass("drag_drop");
        //var formData = new FormData();
        var files = e.originalEvent.dataTransfer.files;
        $("#table_div").append('<table class="table table-hover" style="text-align:center" id="progress_table"><thead><tr><th style="width:20% !important;">Orderid</th><th style="width:20% !important;">File</th><th style="width:20% !important">Unit</th><th style="width:20% !important">Tooth</th><th style="width:20% !important">Message</th></tr></thead><tbody>');

        for (var i = 0; i < files.length; i++) {
            $("#progress_table").append('<tr id="tr' + i + '"><td style="width:20% !important"><input class="form-control" type="text" id="odid' + i + '" readonly></td><td style="width:20% !important"><div class="progress" id="progress_bar' + i + '" style="display:none; height:auto;padding:5px;"><div class="progress-bar bg-success" id="progress_bar_process' + i + '" role="progressbar" style="width:0%; height:auto;padding:5px;white-space:pre-wrap">0%</div></div></td><td style="width:20% !important"><input class="form-control" type="text" id="u' + i + '" readonly><input type="hidden" id="u' + i + '"></td><td style="width:20% !important"><input type="text" id="t' + i + '" class="form-control" readonly ><input type="hidden" id="t' + i + '"><input type="hidden" name="orderid' + i + '" id="orderid' + i + '" class="form-control"></td><td style="width:20% !important"><textarea class="form-control" name="msg' + i + '" id="msg' + i + '"></textarea></td></tr>');
            uploadSingleFile(files[i], i);
        }
        $("#progress_table").append('</tbody></table>');
        $('#sbtbtn').show();
        document.getElementById('total_files').setAttribute('value', files.length);

    });

    // _('drag_drop').ondrop = function(event)
    // {
    //     event.preventDefault();
    //     var form_data  = new FormData();
    //     var error = '';
    //     var drop_files = event.dataTransfer.files;
    //     $("#table_div").append('<table class="table table-hover" id="progress_table"><thead><tr><th>File</th><th>Unit</th><th>Tooth</th><th>Message</th><th>Optional</th></tr></thead><tbody>');
    //       $('#sbtbtn').show();
    //       //alert(drop_files.length);
    //     for(var count = 0; count < drop_files.length; count++)
    //     {
    //          $("#table_div").append('<tr id="tr'+count+'" ><td><div class="progress" id="progress_bar'+count+'" style="display:none; height:40px;"><div class="progress-bar bg-success" id="progress_bar_process'+count+'" role="progressbar" style="width:0%; height:40px;">0%</div></div></td><td><input class="form-control" type="text" id="u'+count+'" readonly><input class="form-control" type="hidden" id="u'+count+'"></td><td><input type="text" id="t'+count+'" class="form-control" readonly ><input type="hidden" id="t'+count+'" class="form-control"><input type="hidden" name="orderid'+i+'" id="orderid'+count+'" class="form-control"></td><td><textarea class="form-control" name="msg'+count+'" id="msg'+count+'"></textarea></td><td><a href="" class="btn btn-primary">Send</a></td></tr>');
    //         alert(drop_files[count]);
    //        //uploadSingleFile(drop_files[count], count);
    //     }
    //      $("#table_div").append('</tbody></table>');
    //      document.getElementById('total_files').setAttribute('value',drop_files.length);

    //   }

    $("#selectfile").on("click", function(e) {

        //document.getElementById("selectfile").click();
        document.getElementById("selectfile").onchange = function() {

            files = document.getElementById("selectfile").files;

            $("#table_div").append('<table class="table table-hover" style="text-align:center" id="progress_table"><thead><tr><th style="width:20% !important;">Orderid</th><th style="width:20% !important;">File</th><th style="width:20% !important">Unit</th><th style="width:20% !important">Tooth</th><th style="width:20% !important">Message</th></tr></thead><tbody>');
            $('#sbtbtn').show();

            for (var i = 0; i < files.length; i++) {

                $("#progress_table").append('<tr id="tr' + i + '"><td style="width:20% !important"><input class="form-control" type="text" id="odid' + i + '" readonly></td><td style="width:20% !important"><div class="progress" id="progress_bar' + i + '" style="display:none; height:auto;padding:5px;"><div class="progress-bar bg-success" id="progress_bar_process' + i + '" role="progressbar" style="width:0%; height:auto;padding:5px;white-space:pre-wrap">0%</div></div></td><td style="width:20% !important"><input class="form-control" type="text" id="u' + i + '" readonly><input type="hidden" id="u' + i + '"></td><td style="width:20% !important"><input type="text" id="t' + i + '" class="form-control" readonly ><input type="hidden" id="t' + i + '"><input type="hidden" name="orderid' + i + '" id="orderid' + i + '" class="form-control"></td><td style="width:20% !important"><textarea class="form-control" name="msg' + i + '" id="msg' + i + '"></textarea></td></tr>');
                uploadSingleFile(files[i], i);
            }
            document.getElementById('total_files').setAttribute('value', files.length);
            $("#progress_table").append('</tbody></table>');

        };

    });

    function uploadSingleFile(file, i) {
        var ff = i;
        var formData = new FormData();
        formData.append("file", file);

        document.getElementById("timed").style.display = 'block';

        document.getElementById("cardd").style.display = 'none';
        document.getElementById('tr' + i).style.display = 'table-row';
        document.getElementById('progress_bar' + i).style.display = 'block';

        var ajax_request = new XMLHttpRequest();

        ajax_request.open("post", "upload.php");

        ajax_request.upload.addEventListener('progress', function(event) {

            var percent_completed = Math.round((event.loaded / event.total) * 100);

            document.getElementById('progress_bar_process' + i + '').style.width = percent_completed + '%';

            document.getElementById('progress_bar_process' + i + '').innerHTML = percent_completed + '% completed';

        });

        ajax_request.addEventListener('load', function(event) {

            var bmystr = mystr = event.target.responseText;
            //alert(event.target.responseText);
            var myarr = mystr.split(" ");
            var arrlen = myarr.length;
            var tunit = myarr[arrlen - 1];
            var odid = myarr[0];
            var fname = "";
            var tooth = "";

            for (var i = 0; i < arrlen - 1; i++)
                fname = fname + " " + myarr[i];

            mystr = mystr.split(",");
            for (var i = mystr.length - 1; i > 0; i--) {
                var st = mystr[i].split(" ");
                tooth = tooth + "," + st[0];
            }

            document.getElementById('tr' + ff).style.display = 'table-row';
            document.getElementById('u' + ff + '').setAttribute('value', (tunit));
            document.getElementById('orderid' + ff + '').setAttribute('value', (myarr[0]));
            document.getElementById('odid' + ff + '').setAttribute('value', (myarr[0]));
            document.getElementById('t' + ff + '').setAttribute('value', (tooth));

            if (fname == " File is already") {
                document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-danger" >' + bmystr + ' </div>';

                document.getElementById('progress_bar_process' + ff).style.setProperty('background-color', 'red', 'important');

                //document.getElementById('sbtbtn').style.display = 'none';
                //document.getElementById('timed').style.display = 'none';                  
                //document.getElementById('progress_table').style.display = 'none';
                //alert("File is already uploaded.");                  
            } else {
                if (fname == " File is format is not") {
                    document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-danger" >' + mystr + ' </div>';

                    document.getElementById('progress_bar_process' + ff).style.setProperty('background-color', 'red', 'important');

                    //document.getElementById('sbtbtn').style.display = 'none';
                    //document.getElementById('timed').style.display = 'none';                  
                    //document.getElementById('progress_table').style.display = 'none';
                    // alert("File format is not correct.");                  
                } else {
                    document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="" style="width:250px;">' + fname + ' </div>';

                }
            }
            document.getElementById('drag_drop').style.borderColor = '#ccc';

        });
        //alert("hiello");

        ajax_request.send(formData);
    }
</script>



</div>

<!-- /.card-body -->
</div>


</div>
</div>
</form>
</div>

</div>

<?php
include 'footer.php';
?>