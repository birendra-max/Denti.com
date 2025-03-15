<?php
$filepath="../api/finished_files/";
 $fileName=urldecode($_GET['id']);
 
 
 $filePath = $filepath . $fileName; // Replace with the actual path

if (file_exists($filePath)) {
    // Set the appropriate headers for downloading the file
    // header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . ($fileName) . '"');
    header('Content-Length: ' . filesize($filePath));

    // Output the file content
    readfile($filePath);
} else {
    // File not found
    echo "File not found.";
}
?>