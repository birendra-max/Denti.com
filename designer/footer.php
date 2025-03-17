 
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
                            <div class="col-sm-12" >
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
                                <button type="button"  onclick="postStuff();" class="btn btn-primary">Send</button>
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

                            function postStuff(){
                             // alert($("#msg88").val());

                               var file_data = $('#chat_file2').prop('files')[0];   
                                var form_data = new FormData();                  
                                form_data.append('file', file_data);
                                form_data.append('message_id',document.getElementById("msg88").value);
                                form_data.append('orderid_id',$("#setchatorderid").val());
                                //alert(form_data);                             
                                $.ajax({
                                    url: 'update_chatbox.php', // <-- point to server-side PHP script 
                                    dataType: 'text',  // <-- what to expect back from the PHP script, if anything
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    data: form_data,                         
                                    type: 'post',
                                    success: function(response){
                                    $("#msg88").val('');
                                          //alert(response);
                                          var arr=response.split("____");
                                           $(".chat_live_go").append('<div class="direct-chat-msg"><div class="direct-chat-infos clearfix"><span class="direct-chat-name float-left">You</span><span class="direct-chat-timestamp float-right">"'+arr[1]+'"</span>    </div><img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image"><div class="direct-chat-text"> "'+arr[0]+'"</div></div>');     
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
    <strong>Copyright &copy; 2014-<?php echo date("d-M-Y")?> <a href=""><?php echo $rowcp['cname'] ?></a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b><?php echo $rowcp['cname'] ?></b>
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
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
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>



<script src="../../plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->

<script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="../../plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="../../plugins/dropzone/min/dropzone.min.js"></script>
<!-- AdminLTE App -->


<script src="plugins/summernote/summernote-bs4.min.js"></script>



<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->


<script src="../dist/js/dataTables.buttons.min.js"></script>
<script src="../dist/js/jszip.min.js"></script>
<script src="../dist/js/pdfmake.min.js"></script>

<script src="../dist/js/vfs_fonts.js"></script>
<script src="../dist/js/buttons.html5.min.js"></script>
<script src="../dist/js/buttons.print.min.js"></script>
<script src="../dist/js/buttons.colVis.min.js"></script>


<script>
  $(function () {
    $("#example1").DataTable({
      "lengthMenu":[[100,500,1000,-1],[100,500,1000,"All"]],
       "buttons": [{ 
            extend: 'excel',className: 'btn btn-primary glyphicon glyphicon-list-alt',text: '<i class="fa fa-plus-circle" aria-hidden="true"></i> Export Report Into Excel',
        }],
      "language": {
            
                "search": '<i class="fa fa-search"></i>',
                "searchPlaceholder": "Enter Date",
                "paginate": {
                "previous": '<i class="fa fa-angle-left"></i>',
                    "next": '<i class="fa fa-angle-right"></i>'
            }
        },
      "iDisplayLength":100,
      "responsive": true, "lengthChange": true, "autoWidth": false
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

               $("#table_div_chatbox2").append('<tr id="tr'+i+'" ><td width="45%"><div class="progress" id="progress_bar'+i+'" style="display:none; height:40px;"><div class="progress-bar bg-success" id="progress_bar_process'+i+'" role="progressbar" style="width:0%; height:40px;">0%</div></div></td><td width="100%"><span id="u'+i+'"></td></tr>');
               uploadSingleFile_chatbox2(files[i], i);              
      }
       $("#table_div_chatbox2").append('</tbody></table>');
      
           };

         });



    
function uploadSingleFile_chatbox2(file, i) {
var ff=i;
var color="red";
       var formData = new FormData();
            formData.append("file", file);
         formData.append('orderid_id',document.getElementById("setchatorderid").value);
         formData.append('message_chat',document.getElementById("msg88").value);
       document.getElementById("card_chatfile2").style.display = 'none';
       document.getElementById('tr'+i).style.display='table-row';
       document.getElementById('progress_bar'+i).style.display='block';
       //alert(formData);
         var ajax_request= new XMLHttpRequest();

         ajax_request.open("post", "upload_chatbox_files.php");

        ajax_request.upload.addEventListener('progress', function(event){

            var percent_completed = Math.round((event.loaded / event.total) * 100);

            document.getElementById('progress_bar_process'+i+'').style.width = percent_completed + '%';

            document.getElementById('progress_bar_process'+i+'').innerHTML = percent_completed + '% completed';

        });

        ajax_request.addEventListener('load', function(event){

           var mystr=event.target.responseText;
          
            document.getElementById('u'+ff+'').innerHTML="";
           
            if (mystr.substr(0,23)=="File format not matched") {
              document.getElementById('progress_bar_process'+ff).innerHTML = '<div class="alert alert-danger" >'+mystr+' </div>';
              document.getElementById('progress_bar_process'+ff).style.setProperty('background-color','red','important');
            }else{
            if (mystr.substr(0,33)=="Finished File is already uploaded") {
              document.getElementById('progress_bar_process'+ff).innerHTML = '<div class="alert alert-danger" >'+mystr+' </div>';
              document.getElementById('progress_bar_process'+ff).style.setProperty('background-color','red','important');
            }else
            {
              if (mystr.substr(0,33)=="Finished file not found like this") {
              document.getElementById('progress_bar_process'+ff).innerHTML = '<div class="alert alert-danger" >'+mystr+' </div>';
              document.getElementById('progress_bar_process'+ff).style.setProperty('background-color','red','important');
            }else{
              if (mystr.substr(0,43)=="Finished File can not be saved at this time") {
              document.getElementById('progress_bar_process'+ff).innerHTML = '<div class="alert alert-danger" >'+mystr+' </div>';
              document.getElementById('progress_bar_process'+ff).style.setProperty('background-color','red','important');
            }else{
               if (mystr.substr(0,28)=="STL File is already uploaded") {
              document.getElementById('progress_bar_process'+ff).innerHTML = '<div class="alert alert-danger" >'+mystr+' </div>';
              document.getElementById('progress_bar_process'+ff).style.setProperty('background-color','red','important');
            }else{
               if (mystr.substr(0,28)=="STL file not found like this") {
              document.getElementById('progress_bar_process'+ff).innerHTML = '<div class="alert alert-danger" >'+mystr+' </div>';
              document.getElementById('progress_bar_process'+ff).style.setProperty('background-color','red','important');
            }else{
              if (mystr.substr(0,38)=="STL File can not be saved at this time") {
              document.getElementById('progress_bar_process'+ff).innerHTML = '<div class="alert alert-danger" >'+mystr+' </div>';
              document.getElementById('progress_bar_process'+ff).style.setProperty('background-color','red','important');
            }else{
				
               document.getElementById('progress_bar_process'+ff).innerHTML = '<div class="alert alert-success"><a href="'+mystr+'"> Donwload</a> </div>';

              $(".chat_live_go").append('<div class="direct-chat-msg"><div class="direct-chat-infos clearfix"><span class="direct-chat-name float-left">You</span><span class="direct-chat-timestamp float-right"></span>    </div><img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image"><div class="direct-chat-text"> <a href="'+mystr+'">Download</a></div></div>');
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

               $("#table_div_chatbox").append('<tr id="tr'+i+'" ><td width="45%"><div class="progress" id="progress_bar'+i+'" style="display:none; height:40px;"><div class="progress-bar bg-success" id="progress_bar_process'+i+'" role="progressbar" style="width:0%; height:40px;">0%</div></div></td><td width="100%"><span id="u'+i+'"></td></tr>');
               uploadSingleFile_chatbox(files[i], i);              
      }
       $("#table_div_chatbox").append('</tbody></table>');
      
           };

         });


    
function uploadSingleFile_chatbox(file, i) {
var ff=i;
var color="red";
       var formData = new FormData();
            formData.append("file", file);
         formData.append('orderid_id',document.getElementById("orderid").value);
         formData.append('message_chat',document.getElementById("message_chat").value);
       document.getElementById("card_chatfile").style.display = 'none';
       document.getElementById('tr'+i).style.display='table-row';
       document.getElementById('progress_bar'+i).style.display='block';
       
         var ajax_request= new XMLHttpRequest();

         ajax_request.open("post", "upload_chatbox_files.php");

        ajax_request.upload.addEventListener('progress', function(event){

            var percent_completed = Math.round((event.loaded / event.total) * 100);

            document.getElementById('progress_bar_process'+i+'').style.width = percent_completed + '%';

            document.getElementById('progress_bar_process'+i+'').innerHTML = percent_completed + '% completed';

        });

        ajax_request.addEventListener('load', function(event){

           var mystr=event.target.responseText;
          
            document.getElementById('u'+ff+'').innerHTML="success";
           
            if (mystr.substr(0,23)=="File format not matched") {
              document.getElementById('progress_bar_process'+ff).innerHTML = '<div class="alert alert-danger" >'+mystr+' </div>';
              document.getElementById('progress_bar_process'+ff).style.setProperty('background-color','red','important');
            }else{
            if (mystr.substr(0,33)=="Finished File is already uploaded") {
              document.getElementById('progress_bar_process'+ff).innerHTML = '<div class="alert alert-danger" >'+mystr+' </div>';
              document.getElementById('progress_bar_process'+ff).style.setProperty('background-color','red','important');
            }else
            {
              if (mystr.substr(0,33)=="Finished file not found like this") {
              document.getElementById('progress_bar_process'+ff).innerHTML = '<div class="alert alert-danger" >'+mystr+' </div>';
              document.getElementById('progress_bar_process'+ff).style.setProperty('background-color','red','important');
            }else{
              if (mystr.substr(0,43)=="Finished File can not be saved at this time") {
              document.getElementById('progress_bar_process'+ff).innerHTML = '<div class="alert alert-danger" >'+mystr+' </div>';
              document.getElementById('progress_bar_process'+ff).style.setProperty('background-color','red','important');
            }else{
               if (mystr.substr(0,28)=="STL File is already uploaded") {
              document.getElementById('progress_bar_process'+ff).innerHTML = '<div class="alert alert-danger" >'+mystr+' </div>';
              document.getElementById('progress_bar_process'+ff).style.setProperty('background-color','red','important');
            }else{
               if (mystr.substr(0,28)=="STL file not found like this") {
              document.getElementById('progress_bar_process'+ff).innerHTML = '<div class="alert alert-danger" >'+mystr+' </div>';
              document.getElementById('progress_bar_process'+ff).style.setProperty('background-color','red','important');
            }else{
              if (mystr.substr(0,38)=="STL File can not be saved at this time") {
              document.getElementById('progress_bar_process'+ff).innerHTML = '<div class="alert alert-danger" >'+mystr+' </div>';
              document.getElementById('progress_bar_process'+ff).style.setProperty('background-color','red','important');
            }else{
              document.getElementById('progress_bar_process'+ff).innerHTML = '<div class="alert alert-success">File is uploaded successfully. </div>';
              	$("#chat_live").append('<div class="direct-chat-msg"><div class="direct-chat-infos clearfix"><span class="direct-chat-name float-left">You</span><span class="direct-chat-timestamp float-right"></span>    </div><img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image"><div class="direct-chat-text"> <a href="'+mystr+'">Download</a></div></div>');
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




   $('.chatbtn').click(function(){
   
       var userid = $(this).data('id');
       $("#setchatorderid").val(userid);
       //alert(userid);
       // AJAX request
       $.ajax({
           url: 'chatajax.php',
           type: 'post',
           data: {orderid: userid},
           success: function(response){ 
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

  
  $(function () {
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




<script type="text/javascript">


        $(function() {

            $('#run_button').click(function() {
                var dd="";
                 $('.caseid:checked').each(function() {
              var stt=$("#orderid_update"+($(this).val())).val();
              dd=dd+","+stt;
                             
            });
                $.ajax({
                    type: 'POST',
                    url: 'update_run_self.php',
                    data: {
                        'orderid_update': dd,
                        // other data
                    },
                    success: function(result) {   
                       window.location='index.php';
                    toastr.success("result");                 
                     
                      
                    }
                });

            });

        });



 
</script>
<script type="text/javascript">
 function openredesign(){
    $('.caseid:checked').each(function() {
      $("#redesignorderid").val(($("#redesignid"+$(this).val()).val()));
      });
    var ur=window.location.href;
    $("#linkurl").val(ur);
    if ( $("#redesignorderid").val()=='') {
      alert("Please select at least one case.")
      window.location=ur;
    }
    $('#redesign').modal("show");
} 
</script>


</body>
</html>
