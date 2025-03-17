<?php

 $ori='../api/files/'.urldecode($_GET['ori']);
   $oldfilename ='../api/files/'.urldecode($_GET['filename']);
    // Use basename() function to return the base name of file
     $file_name = basename($oldfilename);
 $nn=str_replace("#",'',urldecode($_GET['filename']));
$newfilename='../api/files/'.$nn;
 rename($oldfilename,$newfilename);
 $url2 ='https://skydentclouds.com/api/files/'.$nn;
      

	 header("Content-type: application/zip"); 
    header("Content-Disposition: attachment; filename=$file_name"); 
    header("Pragma: no-cache"); 
    header("Expires: 0"); 
    readfile("$url2");
//$nn=str_replace("#",'',urldecode($_GET['filename']));
rename($newfilename,$ori);
    exit;

?>