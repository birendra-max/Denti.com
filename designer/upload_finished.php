<?php
include 'connect.php';
$imageData = '';
$flag=0;
if (isset($_FILES['file']['name'][0])) {
 $flag=0;
 $tdate=date("d-M-Y h:i:sa");
  function rmdir_recursive($dir) {
   //  foreach(scandir($dir) as $file) {
   //     if ('.' === $file || '..' === $file) continue;
   //     if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
   //     else unlink("$dir/$file");
   // }
   // rmdir($dir);
}
$orderid=$_POST['orderid'];

 foreach ($_FILES['file']['name'] as $keys => $values) {
  $filename="";
 $source="";
 $type="";
    $fileName = $_FILES['file']['name'][$keys];
   $filename = $_FILES["file"]["name"][$keys];
    $source = $_FILES["file"]["tmp_name"][$keys];
    $type = $_FILES["file"]["type"][$keys];

  

    $name = explode(".", $filename);
    $accepted_types = array('stl');
    foreach($accepted_types as $mime_type) {
        if($mime_type == $type) {
            $okay = true;
            break;
        } 
    }

    $continue = strtolower($name[1]) == 'zip' ? true : false;
    if(!$continue) {
        $message = "The file you are trying to upload is not a .zip file. Please try again.";
    }

  /* PHP current path */
  $path = '../api/stl_files/';  // absolute path to the directory where zipper.php is in
  //$ffname=$path.$name[0]."/".$name[0].'/'.$name[0].".xml";
  $filenoext = basename ($filename, '.zip');  // absolute path to the directory where zipper.php is in (lowercase)
  $filenoext = basename ($filenoext, '.ZIP');  // absolute path to the directory where zipper.php is in (when uppercase)

  $targetdir = $path . $filenoext; // target directory
  $targetzip = $path . $filename; // target zip file

  /* create directory if not exists', otherwise overwrite */
  /* target directory is same as filename without extension */

  //if (is_dir($targetdir))  rmdir_recursive ( $targetdir);


if (file_exists($targetdir)) {
  $flag=1;
}else
{
  //mkdir($targetdir, 0777);
}
  /* here it is really happening */
if ($flag==0) {
  
    if(move_uploaded_file($source, $targetzip)) {
        // $zip = new ZipArchive();
        // $x = $zip->open($targetzip);  // open the zip file to extract
        // if ($x === true) {
        //     $zip->extractTo($targetdir); // place in the directory with same name  
        //     $zip->close();

        //     //unlink($targetzip);
        // }
        $message = "Your .zip file was uploaded successfully ".$filename;
    } else {    
        $message = "There was a problem with the upload. Please try again.".$filename;
    }
    $succes="";
     // $xml = simplexml_load_file($ffname);          
     // foreach ($xml->Object[0]->Object->List->Object->Property as $value) {
     //    if($value->attributes()->name=="Items")
     //    {
     //      $succes= $value->attributes()->value;
     //      break;
     //    }
     //  }


      //        $myarr = explode(" ", $succes);
      //       $arrlen = count($myarr);
      //          $tooth=$myarr[$arrlen-1];
      //          $fname="";
      //         $tunit="";
      //         for($i=0;$i<$arrlen-1;$i++)
      //               $fname=$fname." ".$myarr[$i];
      //              $myunit=$tooth;
      //               $myunit=explode(",", $myunit);
      //               $tunit=count($myunit);
      // $resulth = mysqli_query($bd,"SELECT max(id) as sm FROM orders");
      // $rowh = mysqli_fetch_array($resulth);
      // $orderid= $rowh['sm'];
      // if ($orderid>=0 and $orderid<10) 
      //   $oid=$_SESSION['userid']."0000".$orderid;
      //   elseif($orderid>=10 and $orderid<100)
      //     $oid=$_SESSION['userid']."000".$orderid;
      //   elseif($orderid>=100 and $orderid<1000)
      //     $oid=$_SESSION['userid']."00".$orderid;
      //   elseif($orderid>=1000 and $orderid<10000)
      //     $oid=$_SESSION['userid']."0".$orderid;
      //   elseif($orderid>=10000)
      //     $oid=$_SESSION['userid'].$orderid;
      //   $clientid=$_SESSION['email'];
      //   $tdate=date("d-M-Y h:i:sa");
      //   $labname=$_SESSION['labname'];
          mysqli_query($bd,"INSERT INTO orders_finished(orderid,finished_file,created_at) VALUES('$orderid','$targetzip','$tdate')");

     // mysqli_query($bd,"UPDATE orders_stl SET stl_file='$targetzip' where orderid='$orderid'");
      echo $message;      
    }else
    {
      echo "STL File is already uploaded.";
    }
    }

}

