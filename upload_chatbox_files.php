<?php
include 'connect.php';
$imageData = '';
$flag = 0;
// $_SESSION['userid']="1";
// $_SESSION['labname']="papi lab";
$em = $_SESSION['user_id'];
if (isset($_FILES['file']['name'])) {
  $flag = 0;
  $tdate = date("d-M-Y h:i:sa");
  $filename = "";
  $source = "";
  $type = "";
  $fileName = $_FILES['file']['name'];
  $filename = $_FILES["file"]["name"];
  $source = $_FILES["file"]["tmp_name"];
  $type = $_FILES["file"]["type"];

  /* PHP checking stl file */

  $imageFileType1 = strtolower(pathinfo(basename($_FILES["file"]["name"]), PATHINFO_EXTENSION));

  if ($imageFileType1 == "jpg" or $imageFileType1 == "JPG" or $imageFileType1 == "jpeg" or $imageFileType1 == "JPEG" or $imageFileType1 == "png" or $imageFileType1 == "PNG" or $imageFileType1 == "gif" or $imageFileType1 == "GIF" or $imageFileType1 == "bmp" or $imageFileType1 == "BMP") {
    $success = "";
    $flag = 0;
    $em = $_SESSION['user_id'];
    $orderid = $_POST['orderid_id'];
    $fname2 = "";
    $msg = $_POST['message_chat'];
    if (isset($_FILES["file"]["name"])) {
      $imagePath = 'api/chatbox/';
      $uniquesavename = time() . uniqid(rand());
      $ext = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
      $fname = $uniquesavename . "." . $ext;
      $destFile = $imagePath . $uniquesavename . "." . $ext;
      $filename = $_FILES["file"]["tmp_name"];
      $fname2 = $_FILES["file"]["name"];
      //list($width, $height) = getimagesize( $filename );       
      move_uploaded_file($filename,  $destFile);
      $sql2 = "INSERT INTO chatbox (orderid,msg,user_type,created_at,attachment,userid,filename) VALUES('$orderid','','user','$tdate','$fname','$em','$fname2')";
      mysqli_query($bd, $sql2);
      echo "uploaded successfully.";
    }
  } else {

    // end of stl file updation

    // checking finished files

    if ($imageFileType1 == "zip" or $imageFileType1 == "ZIP") {
      $success = "";
      $flag = 0;
      $em = $_SESSION['user_id'];
      $orderid = $_POST['orderid_id'];
      $fname2 = "";
      $msg = $_POST['message_chat'];
      if (isset($_FILES["file"]["name"])) {
        $imagePath = 'api/chatbox/';
        $uniquesavename = time() . uniqid(rand());
        $ext = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
        $fname = $uniquesavename . "." . $ext;
        $destFile = $imagePath . $uniquesavename . "." . $ext;
        $filename = $_FILES["file"]["tmp_name"];
        $fname2 = $_FILES["file"]["name"];
        //list($width, $height) = getimagesize( $filename );       
        move_uploaded_file($filename,  $destFile);
        $sql2 = "INSERT INTO chatbox (orderid,msg,user_type,created_at,attachment,userid,filename) VALUES('$orderid','','user','$tdate','$fname','$em','$fname2')";
        mysqli_query($bd, $sql2);
        echo "uploaded successfully.";
      }
    } else {
      echo "File format not matched";
    }

    // end of stl file updation


  }
}
