<?php
include 'header.php';
	if (isset($_POST['submit'])) {
		extract($_POST);		
    $tfiles=$_POST['total_files'];
    // echo $tfiles;
    // die;
    $f=0;
    for ($i=0; $i <$tfiles ; $i++) { 
      $msg1=$_POST['msg'.$i];
      $toid=$_POST['orderid'.$i];
      if(mysqli_query($bd,"UPDATE orders set message='$msg1',tduration='$timeduration' where orderid='$toid'"))  
      $f=0;
      else
      $f=1;  
     
    }
		if ($f==0) 
     echo "<script>alert('Request is sent successfully.')</script>";
    else
      echo "<script>alert('Sorry something went wrong.')</script>";

  }	
?>

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
<!-- <table class="table table-hover" id="progress_table" style="width: 100% !important"><thead><tr><th>File</th><th>Unit</th><th>Tooth</th><th>Message</th><th>Optional</th></tr></thead><tbody>

  <tr id="tr" style="display: table-row"><td><div class="progress" id="progress_bar'+i+'" style=" height:40px;"><div class="progress-bar bg-success" id="progress_bar_process" role="progressbar" style="width:0%; height:40px;">0%</div></div></td><td><input class="form-control" type="text" id="u" readonly></td><td><input type="text" id="t" class="form-control" readonly ></td><td><textarea class="form-control" name="msg" id="msg"></textarea></td><td><a href="" class="btn btn-primary">Send</a></td></tr>
</tbody>
</table> -->
 <div class="container">
           <?php // if(file_exists("api/ppai")) echo "hello";else echo "bye"; ?>
        <form action="" method="post" enctype="multipart/form-data">
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
                  <input type="submit" name="submit" id="sbtbtn" style="display: none;"  value="Send For Design" class="btn btn-success">
                 </div>
               </div>

              </div>
            </div>
          </form>
        </div>
   

</div>

<script type="text/javascript">
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
    var form_data  = new FormData();
    var error = '';
    var drop_files = event.dataTransfer.files;
    $("#table_div").append('<table class="table table-hover" id="progress_table"><thead><tr><th>File</th><th>Unit</th><th>Tooth</th><th>Message</th><th>Optional</th></tr></thead><tbody>');
      $('#sbtbtn').show();
    for(var count = 0; count < drop_files.length; count++)
    {
        $("#table_div").append('<tr id="tr'+count+'" ><td><div class="progress" id="progress_bar'+count+'" style="display:none; height:40px;"><div class="progress-bar bg-success" id="progress_bar_process'+count+'" role="progressbar" style="width:0%; height:40px;">0%</div></div></td><td><input class="form-control" type="text" id="u'+count+'" readonly><input class="form-control" type="hidden" id="u'+count+'"></td><td><input type="text" id="t'+count+'" class="form-control" readonly ><input type="hidden" id="t'+count+'" class="form-control"><input type="hidden" name="orderid'+i+'" id="orderid'+count+'" class="form-control"></td><td><textarea class="form-control" name="msg'+count+'" id="msg'+count+'"></textarea></td><td><a href="" class="btn btn-primary">Send</a></td></tr>');
       uploadSingleFile(drop_files[count], count);
    }
     $("#table_div").append('</tbody></table>');
     document.getElementById('total_files').setAttribute('value',drop_files.length);

  }

$("#selectfile").on("click", function(e) {
      
          document.getElementById("selectfile").click();
          document.getElementById("selectfile").onchange = function() {
                           
             files = document.getElementById("selectfile").files;
            
             $("#table_div").append('<table class="table table-hover" id="progress_table"><thead><tr><th>File</th><th>Unit</th><th>Tooth</th><th>Message</th><th>Optional</th></tr></thead><tbody>');
                    $('#sbtbtn').show();
                  
             for (var i = 0; i < files.length; i++) {

               $("#table_div").append('<tr id="tr'+i+'" ><td><div class="progress" id="progress_bar'+i+'" style="display:none; height:40px;"><div class="progress-bar bg-success" id="progress_bar_process'+i+'" role="progressbar" style="width:0%; height:40px;">0%</div></div></td><td><input class="form-control" type="text" id="u'+i+'" readonly><input type="hidden" id="u'+i+'"></td><td><input type="text" id="t'+i+'" class="form-control" readonly ><input type="hidden" id="t'+i+'"><input type="hidden" name="orderid'+i+'" id="orderid'+i+'" class="form-control"></td><td><textarea class="form-control" name="msg'+i+'" id="msg'+i+'"></textarea></td><td><a href="" class="btn btn-primary">Send</a></td></tr>');
               uploadSingleFile(files[i], i);              
      }
       document.getElementById('total_files').setAttribute('value',files.length);
       $("#table_div").append('</tbody></table>');
      
           };

         });

function uploadSingleFile(file, i) {
var ff=i;
       var formData = new FormData();
            formData.append("file", file);
            
        document.getElementById("timed").style.display = 'block';

       document.getElementById("cardd").style.display = 'none';
       document.getElementById('tr'+i).style.display='table-row';
       document.getElementById('progress_bar'+i).style.display='block';
       
         var ajax_request= new XMLHttpRequest();

         ajax_request.open("post", "upload.php");

        ajax_request.upload.addEventListener('progress', function(event){

            var percent_completed = Math.round((event.loaded / event.total) * 100);

            document.getElementById('progress_bar_process'+i+'').style.width = percent_completed + '%';

            document.getElementById('progress_bar_process'+i+'').innerHTML = percent_completed + '% completed';

        });

        ajax_request.addEventListener('load', function(event){

           var mystr=event.target.responseText;
           //alert(event.target.responseText);
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
                    if (tooth==0) {tunit=0;}
            document.getElementById('tr'+ff).style.display='table-row';
            document.getElementById('u'+ff+'').setAttribute('value',(tunit));
            document.getElementById('orderid'+ff+'').setAttribute('value',(myarr[0]));
             document.getElementById('t'+ff+'').setAttribute('value',(tooth));

            document.getElementById('progress_bar_process'+ff).innerHTML = '<div class="alert alert-success">'+fname+' </div>';
             if(fname==" File is already")
                  {
                  document.getElementById('sbtbtn').style.display = 'none';
                  document.getElementById('timed').style.display = 'none';                  
                  document.getElementById('progress_table').style.display = 'none';
                  alert("File is already uploaded.");                  
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