<?php
include 'header.php';
	if (isset($_POST['submit'])) {
		extract($_POST);		
		$toid=$_SESSION['temporderid'];
		if(mysqli_query($bd,"UPDATE orders set message='$msg1',tduration='$timeduration' where orderid='$toid'"))    
      echo "<script>alert('Request is sent successfully.')</script>";
    else
      echo "<script>alert('Sorry something went wrong.')</script>";

  }	
?>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style type="text/css">

#drag_drop{
    background-color : #f9f9f9;
    border : #ccc 4px dashed;
    line-height : 250px;
    padding : 12px;
    font-size : 24px;
    text-align : center;
}
 div.radio-box {
   width: 100px;
   display: inline-block;
   margin: 5px;
   
}
.radio-box label {
   display:block;
   width: 100px;
   text-align: center;
}
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>File Upload Center </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">File Upload Center </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

 <div class="container">
           <?php // if(file_exists("api/ppai")) echo "hello";else echo "bye"; ?>
        <form action="" method="post">
            <div class="card" id="cardd">
                <div class="card-header">Drag & Drop File Here</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">&nbsp;</div>
                        <div class="col-md-6">
                            <div id="drag_drop">Drag & Drop File Here</div>
                            <input type="file" class="" id="selectfile" multiple />
                        </div>
                        <div class="col-md-3">&nbsp;</div>
                        

                    </div>
                </div>
            </div>
            <br />
            <div class="row">
              <div class="col-sm-12">
                <table class="table table-hover" id="progress_table" style="width: 100% !important">
                  <thead>
                  <tr>
                    <th>File</th>
                    <th>Unit</th>
                    
                    <th>Tooth</th>
                    <th>Message</th>
                    <th>Optional</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr id="tr1" style="display:none;">
                    <td>
                    <div class="progress" id="progress_bar1" style="display:none; height:40px;">
                        <div class="progress-bar bg-success" id="progress_bar_process1" role="progressbar" style="width:0%; height:40px;">0%
                        </div>
                    </div>
                    </td>
                    <td><span id="u1"></span></td>
                    <td><span id="t1"></span></td>
                    <td><textarea name="msg1" id="msg1"></textarea></td>
                    <td><a href="">Send</a></td>
                    </tr>

                    <tr id="tr2" style="display: none;">
                    <td>
                    <div class="progress" id="progress_bar2" style="display:none; height:40px;">
                        <div class="progress-bar bg-success" id="progress_bar_process2" role="progressbar" style="width:0%; height:40px;">0%
                        </div>
                    </div>
                    </td>
                    <td><span id="u2"></span></td>
                    <td><span id="t2"></span></td>
                    <td><textarea name="msg2" id="msg2"></textarea></td>
                    <td><a href="">Send</a></td>
                    </tr>

                </tbody>
                </table>
               
               <div class="row" id="timed">
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
              <div class="row">
                <div class="col-md-5"></div>
                 <div class="col-md-6">
                  <input type="submit" name="submit" id="sbtbtn"  value="Send For Design" class="btn btn-success">
                 </div>
               </div>

              </div>
            </div>
          </form>
        </div>
   

</div>

   

<script type="text/javascript">
  var image_number = 1;
   _('sbtbtn').style.display = 'none';
  _('timed').style.display = 'none';                  
  _('progress_table').style.display = 'none';
function _(element)
{
    return document.getElementById(element);
}

_('drag_drop').ondragover = function(event)
{
    this.style.borderColor = '#333';
    return false;
}

_('drag_drop').ondragleave = function(event)
{
    this.style.borderColor = '#ccc';
    return false;
}


_('drag_drop').ondrop = function(event)
{
    event.preventDefault();
   _('sbtbtn').style.display = 'block';
  _('timed').style.display = 'block';                  
  _('progress_table').style.display = 'block';
    var form_data  = new FormData();

  

    var error = '';

    var drop_files = event.dataTransfer.files;

    for(var count = 0; count < drop_files.length; count++)
    {
        if(!['application/x-rar-compressed', 'application/x-zip-compressed'].includes(drop_files[count].type))
        {
            error += '<div class="alert alert-danger"><b>'+drop_files[count].type+'</b> Selected File must be .zip Only.</div>';
        }
        else
        {
            form_data.append("file[]", drop_files[count]);
        }

        //image_number++;
    }

    if(error != '')
    {
        _('uploaded_image').innerHTML = error;
        _('drag_drop').style.borderColor = '#ccc';
    }
    else
    {

        _('cardd').style.display = 'none';
        _('tr'+image_number+'').style.display = ' table-row';
         _('progress_bar'+image_number+'').style.display = 'block';

        var ajax_request = new XMLHttpRequest();

        ajax_request.open("post", "upload.php");

        ajax_request.upload.addEventListener('progress', function(event){

            var percent_completed = Math.round((event.loaded / event.total) * 100);

            _('progress_bar_process'+image_number+'').style.width = percent_completed + '%';

            _('progress_bar_process'+image_number+'').innerHTML = percent_completed + '% completed';

        });

        ajax_request.addEventListener('load', function(event){
          var mystr=event.target.responseText;
            var myarr = mystr.split(" ");
            var arrlen = myarr.length;
              var tooth=myarr[arrlen-1];
              var fname="";
              var tunit="";
              for(var i=0;i<arrlen-1;i++)
                    fname=fname+" "+myarr[i];
                  var myunit=tooth;
                    myunit=myunit.split(",");
                    var tunit=myunit.length;
            _('u'+image_number+'').innerHTML=(tunit);
             _('t'+image_number+'').innerHTML=(tooth);

            _('progress_bar_process'+image_number+'').innerHTML = '<div class="alert alert-success">'+fname+' </div>';
               if(fname==" File is already")
                  {
                  _('sbtbtn').style.display = 'none';
                  _('timed').style.display = 'none';                  
                  _('progress_table').style.display = 'none';
                  alert("File is already uploaded.");                  
                }
            _('drag_drop').style.borderColor = '#ccc';
            image_number++;

        });

        ajax_request.send(form_data);
    } 
}

$("#selectfile").on("click", function(e) {
          document.getElementById("selectfile").click();
          document.getElementById("selectfile").onchange = function() {
               _('sbtbtn').style.display = 'block';
                _('timed').style.display = 'block';                  
                _('progress_table').style.display = 'block';

            files = document.getElementById("selectfile").files;
            var formData = new FormData();

            for (var i = 0; i < files.length; i++) {
              formData.append("file[]", files[i]);
            }
            _('cardd').style.display = 'none';
        _('tr'+image_number+'').style.display = 'table-row';
        _('progress_bar'+image_number+'').style.display = 'block';

        var ajax_request = new XMLHttpRequest();

        ajax_request.open("post", "upload.php");

        ajax_request.upload.addEventListener('progress', function(event){

            var percent_completed = Math.round((event.loaded / event.total) * 100);

            _('progress_bar_process'+image_number+'').style.width = percent_completed + '%';

            _('progress_bar_process'+image_number+'').innerHTML = percent_completed + '% completed';

        });

        ajax_request.addEventListener('load', function(event){

           var mystr=event.target.responseText;
            var myarr = mystr.split(" ");
            var arrlen = myarr.length;
              var tooth=myarr[arrlen-1];
              var fname="";
              var tunit="";
              for(var i=0;i<arrlen-1;i++)
                    fname=fname+" "+myarr[i];
                  var myunit=tooth;
                    myunit=myunit.split(",");
                    var tunit=myunit.length;
            _('u'+image_number+'').innerHTML=(tunit);
             _('t'+image_number+'').innerHTML=(tooth);

            _('progress_bar_process'+image_number+'').innerHTML = '<div class="alert alert-success">'+fname+' </div>';
             if(fname==" File is already")
                  {
                  _('sbtbtn').style.display = 'none';
                  _('timed').style.display = 'none';                  
                  _('progress_table').style.display = 'none';
                  alert("File is already uploaded.");                  
                }
            _('drag_drop').style.borderColor = '#ccc';
            image_number++;

        });

        ajax_request.send(formData);
          };

        });

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