<?php
include 'header.php';

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
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <?php
  echo $_SESSION['user_id'];
  ?>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- <table class="table table-hover" id="progress_table" style="width: 100% !important"><thead><tr><th>File</th><th>Unit</th><th>Tooth</th><th>Message</th><th>Optional</th></tr></thead><tbody>

  <tr id="tr" style="display: table-row"><td><div class="progress" id="progress_bar'+i+'" style=" height:40px;"><div class="progress-bar bg-success" id="progress_bar_process" role="progressbar" style="width:0%; height:40px;">0%</div></div></td><td><input class="form-control" type="text" id="u" readonly></td><td><input type="text" id="t" class="form-control" readonly ></td><td><textarea class="form-control" name="msg" id="msg"></textarea></td><td><a href="" class="btn btn-primary">Send</a></td></tr>
</tbody>
</table> -->

      <form action="" method="post" enctype="multipart/form-data">
        <div class="card" id="cardd">

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
        <br />

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

          </div>
      </form>
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
        $("#table_div").append('<table class="table table-hover" id="progress_table"><thead><tr><th>File</th><th>Status</th></tr></thead><tbody>');
        $('#sbtbtn').show();
        $('#sbtbtn').show();
        for (var i = 0; i < files.length; i++) {
          $("#table_div").append('<tr id="tr' + i + '" ><td width="45%"><div class="progress" id="progress_bar' + i + '" style="display:none; height:40px;"><div class="progress-bar bg-success" id="progress_bar_process' + i + '" role="progressbar" style="width:0%; height:40px;">0%</div></div></td><td width="100%"><span id="u' + i + '"></td></tr>');
          uploadSingleFile(files[i], i);
        }
        $("#table_div").append('</tbody></table>');

      });


      $("#selectfile").on("click", function(e) {

        document.getElementById("selectfile").click();
        document.getElementById("selectfile").onchange = function() {

          files = document.getElementById("selectfile").files;

          $("#table_div").append('<table class="table table-hover" id="progress_table"><thead><tr><th>File</th><th>Status</th></tr></thead><tbody>');
          $('#sbtbtn').show();

          for (var i = 0; i < files.length; i++) {

            $("#table_div").append('<tr id="tr' + i + '" ><td width="45%"><div class="progress" id="progress_bar' + i + '" style="display:none; height:40px;"><div class="progress-bar bg-success" id="progress_bar_process' + i + '" role="progressbar" style="width:0%; height:40px;">0%</div></div></td><td width="100%"><span id="u' + i + '"></td></tr>');
            uploadSingleFile(files[i], i);
          }
          $("#table_div").append('</tbody></table>');

        };

      });

      function uploadSingleFile(file, i) {
        var ff = i;
        var color = "red";
        var formData = new FormData();
        formData.append("file", file);

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

          var mystr = event.target.responseText;

          document.getElementById('u' + ff + '').innerHTML = mystr;


          if (mystr.substr(0, 33) == "Finished File is already uploaded") {
            document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-danger" >' + mystr + ' </div>';
            document.getElementById('progress_bar_process' + ff).style.setProperty('background-color', 'red', 'important');
          } else {
            if (mystr.substr(0, 33) == "Finished file not found like this") {
              document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-danger" >' + mystr + ' </div>';
              document.getElementById('progress_bar_process' + ff).style.setProperty('background-color', 'red', 'important');
            } else {
              if (mystr.substr(0, 43) == "Finished File can not be saved at this time") {
                document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-danger" >' + mystr + ' </div>';
                document.getElementById('progress_bar_process' + ff).style.setProperty('background-color', 'red', 'important');
              } else {
                if (mystr.substr(0, 28) == "STL File is already uploaded") {
                  document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-danger" >' + mystr + ' </div>';
                  document.getElementById('progress_bar_process' + ff).style.setProperty('background-color', 'red', 'important');
                } else {
                  if (mystr.substr(0, 28) == "STL file not found like this") {
                    document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-danger" >' + mystr + ' </div>';
                    document.getElementById('progress_bar_process' + ff).style.setProperty('background-color', 'red', 'important');
                  } else {
                    if (mystr.substr(0, 38) == "STL File can not be saved at this time") {
                      document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-danger" >' + mystr + ' </div>';
                      document.getElementById('progress_bar_process' + ff).style.setProperty('background-color', 'red', 'important');
                    } else {
                      document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-success">' + mystr + ' </div>';
                    }
                  }
                }
              }
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