<?php
$path = urlencode("http://skydentclouds.com/api/files/".'YOUNAN_BECK_WAX_#1025175955.zip');
$path2 = 'YOUNA1025175955.zip';
header("Content-Description: File Transfer");
header("Content-Type: application/force-download");
header("Content-Disposition: attachment; filename=\"" . basename($path . $path2) . "\"" );
@readfile($path);
?>
