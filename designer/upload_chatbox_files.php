<?php
include 'connect.php';
$imageData = '';
$flag=0;
// $_SESSION['userid']="1";
// $_SESSION['labname']="papi lab";
$em= $_SESSION['email'];
if (isset($_FILES['file']['name'])) {
 $flag=0;
$tdate=date("d-M-Y h:i:sa");
  $filename="";
 $source="";
 $type="";
    $fileName = $_FILES['file']['name'];
   $filename = $_FILES["file"]["name"];
    $source = $_FILES["file"]["tmp_name"];
    $type = $_FILES["file"]["type"];

  /* PHP checking stl file */
 
$imageFileType1 = strtolower(pathinfo(basename($_FILES["file"]["name"]),PATHINFO_EXTENSION));

  if ($imageFileType1=="jpg" OR $imageFileType1=="JPG" OR $imageFileType1=="jpeg" OR $imageFileType1=="JPEG" OR $imageFileType1=="png"OR $imageFileType1=="PNG"OR $imageFileType1=="gif" OR $imageFileType1=="GIF" OR $imageFileType1=="bmp" OR $imageFileType1=="BMP") {
             $success="";
            $flag=0;
             $em=$_SESSION['email'];
              $orderid=$_POST['orderid_id'];
              $fname2="";
              $msg=$_POST['message_chat'];
            if (isset($_FILES["file"]["name"])) {
              $imagePath = '../api/chatbox/';
              $uniquesavename=time().uniqid(rand());
              $ext=strtolower(pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION));
              $fname=$uniquesavename.".". $ext;
              $destFile = $imagePath . $uniquesavename.".". $ext;
              $filename = $_FILES["file"]["tmp_name"];
              $fname2 = $_FILES["file"]["name"];
              //list($width, $height) = getimagesize( $filename );       
              move_uploaded_file($filename,  $destFile);
              $sql2="INSERT INTO chatbox (orderid,msg,user_type,created_at,attachment,userid,filename) VALUES('$orderid','','SKYDENT TEAM','$tdate','$fname','$em','$fname2')";
            mysqli_query($bd,$sql2);
            echo $destFile;
            }
        
  }else
  {

  // end of stl file updation

  // checking finished files

  if ($imageFileType1=="zip" OR $imageFileType1=="ZIP") {
            $success="";
            $flag=0;
             $em=$_SESSION['email'];
              $orderid=$_POST['orderid_id'];
              $fname2="";
              $msg=$_POST['message_chat'];
            if (isset($_FILES["file"]["name"])) {
              $imagePath = '../api/chatbox/';
              $uniquesavename=time().uniqid(rand());
              $ext=strtolower(pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION));
              $fname=$uniquesavename.".". $ext;
              $destFile = $imagePath . $uniquesavename.".". $ext;
              $filename = $_FILES["file"]["tmp_name"];
              $fname2 = $_FILES["file"]["name"];
              //list($width, $height) = getimagesize( $filename );       
              move_uploaded_file($filename,  $destFile);
              $sql2="INSERT INTO chatbox (orderid,msg,user_type,created_at,attachment,userid,filename) VALUES('$orderid','','SKYDENT TEAM','$tdate','$fname','$em','$fname2')";
            mysqli_query($bd,$sql2);
            echo $destFile;
            }
}else
{
  echo "File format not matched";
}

// end of stl file updation
    

}
}
