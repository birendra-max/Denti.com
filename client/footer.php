

<div class="modal fade" id="redesign">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Redesign</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="redesign_post.php" method="post">
          <div class="row" style="display: none;">
            <input type="hidden" name="redesignorderid" id="redesignorderid">
            <input type="hidden" name="linkurl" id="linkurl">
            <div class="col-12">
              <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status">
                  <option value="Rush" selected>Redesign and Rush</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label>Message</label>
                <textarea name="msg" id="msg3" class="form-control" rows="4" required></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">

              <div id="table_div_chatbox3"></div><br>
            </div>
          </div>
          <div class="row">
            <div class="col-5">
              <div class="form-group">
                <input type="submit" name="submit2" value="Submit" class="btn btn-primary">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <div class="card_chatfile3" id="card_chatfile3">
                  <div class="card-body">
                    <div class="btn btn-default btn-file">
                      <i class="fas fa-plus"></i> File
                      <input type="file" name="chat_file3" id="chat_file3" multiple />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Chat</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <form action="#" method="post" enctype="multipart/form-data">
          <input type="hidden" id="setchatorderid" name="orderid">

          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <!--  <input type="text" name="mmm" id="mmm" value="hello"> -->
                <textarea name="msg88" id="msg88" class="form-control" rows="3"></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">

              <div id="table_div_chatbox2"></div><br>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-8">
              <div class="form-group">
                <button type="button" onclick="postStuff();" class="btn btn-primary">Send</button>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <div class="card_chatfile2" id="card_chatfile2">
                  <div class="card-body">
                    <div class="btn btn-default btn-file">
                      <i class="fas fa-plus"></i> File
                      <input type="file" name="chat_file2" id="chat_file2" multiple />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </form>
      </div>

    </div>
  </div>
</div>


<script type="text/javascript">
  function postStuff() {
    // alert($("#msg88").val());

    var file_data = $('#chat_file2').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('message_id', document.getElementById("msg88").value);
    form_data.append('orderid_id', $("#setchatorderid").val());
    //alert(form_data);                             
    $.ajax({
      url: 'update_chatbox.php', // <-- point to server-side PHP script 
      dataType: 'text', // <-- what to expect back from the PHP script, if anything
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'post',
      success: function(response) {
        $("#msg88").val('');
        // alert(response);
        var arr = response.split("____");
        $(".chat_live_go").append('<div class="direct-chat-msg"><div class="direct-chat-infos clearfix"><span class="direct-chat-name float-left">You</span><span class="direct-chat-timestamp float-right">"' + arr[1] + '"</span>    </div><img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image"><div class="direct-chat-text"> "' + arr[0] + '"</div></div>');
        $(".direct-chat-messages").animate({
          scrollTop: 9999
        });
      }
    });
  }
</script>
<!-- /.content-wrapper -->
</div>
<footer class="main-footer" style="background-color: #343A40 !important;margin-left:0px !important;">
  <strong>Copyright &copy; 2015 <a href="dashboard.php">Dentigo Designs</a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Dentigo Designs</b>
  </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>


<script src="plugins/summernote/summernote-bs4.min.js"></script>



<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->


<script src="dist/js/dataTables.buttons.min.js"></script>
<script src="dist/js/jszip.min.js"></script>
<script src="dist/js/pdfmake.min.js"></script>

<script src="dist/js/vfs_fonts.js"></script>
<script src="dist/js/buttons.html5.min.js"></script>
<script src="dist/js/buttons.print.min.js"></script>
<script src="dist/js/buttons.colVis.min.js"></script>



<!-- CodeMirror -->
<script src="plugins/codemirror/codemirror.js"></script>
<script src="plugins/codemirror/mode/css/css.js"></script>
<script src="plugins/codemirror/mode/xml/xml.js"></script>
<script src="plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->

<script type="text/javascript">
  $("#chat_file2").on("click", function(e) {

    //document.getElementById("chat_file").click();
    document.getElementById("chat_file2").onchange = function() {

      files = document.getElementById("chat_file2").files;

      $("#table_div_chatbox2").append('');
      $('#sbtbtn').show();

      for (var i = 0; i < files.length; i++) {

        $("#table_div_chatbox2").append('<tr id="tr' + i + '" ><td width="45%"><div class="progress" id="progress_bar' + i + '" style="display:none; height:40px;"><div class="progress-bar bg-success" id="progress_bar_process' + i + '" role="progressbar" style="width:0%; height:40px;">0%</div></div></td><td width="100%"><span id="u' + i + '"></td></tr>');
        uploadSingleFile_chatbox2(files[i], i);
      }
      $("#table_div_chatbox2").append('</tbody></table>');

    };

  });



  $("#chat_file3").on("click", function(e) {

    //document.getElementById("chat_file").click();
    document.getElementById("chat_file3").onchange = function() {

      files = document.getElementById("chat_file3").files;

      $("#table_div_chatbox3").append('');
      $('#sbtbtn').show();

      for (var i = 0; i < files.length; i++) {

        $("#table_div_chatbox3").append('<tr id="tr' + i + '" ><td width="45%"><div class="progress" id="progress_bar' + i + '" style="display:none; height:40px;"><div class="progress-bar bg-success" id="progress_bar_process' + i + '" role="progressbar" style="width:0%; height:40px;">0%</div></div></td><td width="100%"><span id="u' + i + '"></td></tr>');
        uploadSingleFile_chatbox3(files[i], i);
      }
      $("#table_div_chatbox3").append('</tbody></table>');

    };

  });

  function uploadSingleFile_chatbox3(file, i) {
    var ff = i;
    var color = "red";
    var formData = new FormData();
    formData.append("file", file);
    formData.append('orderid_id', document.getElementById("redesignorderid").value);
    formData.append('message_chat', document.getElementById("msg3").value);
    document.getElementById("card_chatfile3").style.display = 'none';
    document.getElementById('tr' + i).style.display = 'table-row';
    document.getElementById('progress_bar' + i).style.display = 'block';
    //alert(formData);
    var ajax_request = new XMLHttpRequest();

    ajax_request.open("post", "upload_chatbox_files.php");

    ajax_request.upload.addEventListener('progress', function(event) {

      var percent_completed = Math.round((event.loaded / event.total) * 100);

      document.getElementById('progress_bar_process' + i + '').style.width = percent_completed + '%';

      document.getElementById('progress_bar_process' + i + '').innerHTML = percent_completed + '% completed';

    });

    ajax_request.addEventListener('load', function(event) {

      var mystr = event.target.responseText;

      document.getElementById('u' + ff + '').innerHTML = "";

      if (mystr.substr(0, 23) == "File format not matched") {
        document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-danger" >' + mystr + ' </div>';
        document.getElementById('progress_bar_process' + ff).style.setProperty('background-color', 'red', 'important');
      } else {
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
                    document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-success"><a href="' + mystr + '"> Donwload</a> </div>';

                    $("#chat_live").append('<div class="direct-chat-msg"><div class="direct-chat-infos clearfix"><span class="direct-chat-name float-left">You</span><span class="direct-chat-timestamp float-right"></span>    </div><img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image"><div class="direct-chat-text"> <a href="' + mystr + '">Download</a></div></div>');
                    $(".direct-chat-messages").animate({
                      scrollTop: 9999
                    });


                  }
                }
              }
            }
          }
        }
      }

      document.getElementById('drag_drop').style.borderColor = '#ccc';

    });

    ajax_request.send(formData);
  }


  function uploadSingleFile_chatbox2(file, i) {
    var ff = i;
    var color = "red";
    var formData = new FormData();
    formData.append("file", file);
    formData.append('orderid_id', document.getElementById("setchatorderid").value);
    formData.append('message_chat', document.getElementById("msg88").value);
    document.getElementById("card_chatfile2").style.display = 'none';
    document.getElementById('tr' + i).style.display = 'table-row';
    document.getElementById('progress_bar' + i).style.display = 'block';
    //alert(formData);
    var ajax_request = new XMLHttpRequest();

    ajax_request.open("post", "upload_chatbox_files.php");

    ajax_request.upload.addEventListener('progress', function(event) {

      var percent_completed = Math.round((event.loaded / event.total) * 100);

      document.getElementById('progress_bar_process' + i + '').style.width = percent_completed + '%';

      document.getElementById('progress_bar_process' + i + '').innerHTML = percent_completed + '% completed';

    });

    ajax_request.addEventListener('load', function(event) {

      var mystr = event.target.responseText;

      document.getElementById('u' + ff + '').innerHTML = "";

      if (mystr.substr(0, 23) == "File format not matched") {
        document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-danger" >' + mystr + ' </div>';
        document.getElementById('progress_bar_process' + ff).style.setProperty('background-color', 'red', 'important');
      } else {
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
                    document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-success"><a href="' + mystr + '"> Donwload</a> </div>';

                    $(".chat_live_go").append('<div class="direct-chat-msg"><div class="direct-chat-infos clearfix"><span class="direct-chat-name float-left">You</span><span class="direct-chat-timestamp float-right"></span>    </div><img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image"><div class="direct-chat-text"> <a href="' + mystr + '">Download</a></div></div>');
                    $(".direct-chat-messages").animate({
                      scrollTop: 9999
                    });

                  }
                }
              }
            }
          }
        }
      }

      document.getElementById('drag_drop').style.borderColor = '#ccc';

    });

    ajax_request.send(formData);
  }




  $("#chat_file").on("click", function(e) {

    //document.getElementById("chat_file").click();
    document.getElementById("chat_file").onchange = function() {

      files = document.getElementById("chat_file").files;

      $("#table_div_chatbox").append('');
      $('#sbtbtn').show();

      for (var i = 0; i < files.length; i++) {

        $("#table_div_chatbox").append('<tr id="tr' + i + '" ><td width="45%"><div class="progress" id="progress_bar' + i + '" style="display:none; height:40px;"><div class="progress-bar bg-success" id="progress_bar_process' + i + '" role="progressbar" style="width:0%; height:40px;">0%</div></div></td><td width="100%"><span id="u' + i + '"></td></tr>');
        uploadSingleFile_chatbox(files[i], i);
      }
      $("#table_div_chatbox").append('</tbody></table>');

    };

  });



  function uploadSingleFile_chatbox(file, i) {
    var ff = i;
    var color = "red";
    var formData = new FormData();
    formData.append("file", file);
    formData.append('orderid_id', document.getElementById("orderid").value);
    formData.append('message_chat', document.getElementById("message_chat").value);
    document.getElementById("card_chatfile").style.display = 'none';
    document.getElementById('tr' + i).style.display = 'table-row';
    document.getElementById('progress_bar' + i).style.display = 'block';

    var ajax_request = new XMLHttpRequest();

    ajax_request.open("post", "upload_chatbox_files.php");

    ajax_request.upload.addEventListener('progress', function(event) {

      var percent_completed = Math.round((event.loaded / event.total) * 100);

      document.getElementById('progress_bar_process' + i + '').style.width = percent_completed + '%';

      document.getElementById('progress_bar_process' + i + '').innerHTML = percent_completed + '% completed';

    });

    ajax_request.addEventListener('load', function(event) {

      var mystr = event.target.responseText;

      document.getElementById('u' + ff + '').innerHTML = "Success";

      if (mystr.substr(0, 23) == "File format not matched") {
        document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-danger" ><a href="' + mystr + '"> Donwload</a> </div>';
        document.getElementById('progress_bar_process' + ff).style.setProperty('background-color', 'red', 'important');
      } else {
        if (mystr.substr(0, 33) == "Finished File is already uploaded") {
          document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-danger" ><a href="' + mystr + '"> Donwload</a> </div>';
          document.getElementById('progress_bar_process' + ff).style.setProperty('background-color', 'red', 'important');
        } else {
          if (mystr.substr(0, 33) == "Finished file not found like this") {
            document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-danger" ><a href="' + mystr + '"> Donwload</a> </div>';
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
                    document.getElementById('progress_bar_process' + ff).innerHTML = '<div class="alert alert-success"><a href="' + mystr + '"> Donwload</a> </div>';

                    $("#chat_live").append('<div class="direct-chat-msg"><div class="direct-chat-infos clearfix"><span class="direct-chat-name float-left">You</span><span class="direct-chat-timestamp float-right"></span>    </div><img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image"><div class="direct-chat-text"> <a href="' + mystr + '">Download</a></div></div>');
                    $(".direct-chat-messages").animate({
                      scrollTop: $(".direct-chat-messages").prop('scrollHeight')
                    });

                  }
                }
              }
            }
          }
        }
      }

      document.getElementById('drag_drop').style.borderColor = '#ccc';

    });
    ajax_request.send(formData);
  }
</script>


<script>
  $('.chatbtn').click(function() {

    var userid = $(this).data('id');
    $("#setchatorderid").val(userid);
    //alert(userid);
    // AJAX request
    $.ajax({
      url: 'chatajax.php',
      type: 'post',
      data: {
        orderid: userid
      },
      success: function(response) {
        // Add response in Modal body
        $('.modal-body').html(response);

        // Display Modal
        $('#modal-default').modal('show');
        $(".direct-chat-messages").animate({
          scrollTop: 9999
        });

      }
    });
  });


  $(function() {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>


<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>




<script>
  $(function() {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', {
      'placeholder': 'dd/mm/yyyy'
    })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', {
      'placeholder': 'mm/dd/yyyy'
    })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservationdate').datetimepicker({
      format: 'L'
    });
    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker({
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
      },
      function(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function() {
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function() {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  });

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false;

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template");
  previewNode.id = "";
  var previewTemplate = previewNode.parentNode.innerHTML;
  previewNode.parentNode.removeChild(previewNode);

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  });

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() {
      myDropzone.enqueueFile(file);
    };
  });

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
  });

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1";
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
  });

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0";
  });

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
  };
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true);
  };
  // DropzoneJS Demo Code End
</script>


<script>
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
      "language": {

        "search": '<i class="fa fa-search"></i>',
        "searchPlaceholder": "Enter Date",
        "paginate": {
          "previous": '<i class="fa fa-angle-left"></i>',
          "next": '<i class="fa fa-angle-right"></i>'
        }
      },
      "iDisplayLength": 100,
      "responsive": true,
      "lengthChange": true,
      "autoWidth": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script type="text/javascript">
  function openredesign() {
    $('.caseid:checked').each(function() {
      $("#redesignorderid").val(($("#redesignid" + $(this).val()).val()));
    });
    var ur = window.location.href;
    $("#linkurl").val(ur);
    //alert($("#redesignorderid").val());
    if ($("#redesignorderid").val() == '') {
      alert("Please select at least one case.")
      window.location = ur;
    }
    $('#redesign').modal("show");
  }
</script>
<style>
  #smale_box{
    background-color: #FFFFFF !important;
  }
</style>
</body>

</html>