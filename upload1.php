<?php
include 'connect.php';

$imageData = '';
$flag = 0;

if (isset($_FILES['file']['name']) && isset($_SESSION['userid'])) {
    $flag = 0;
    $filename = $_FILES["file"]["name"];
    $source = $_FILES["file"]["tmp_name"];
    $type = $_FILES["file"]["type"];
    $fname = basename($_FILES["file"]["name"]);
    $okay = false;

    $name = explode(".", $filename);
    $accepted_types = ['application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed'];
    foreach ($accepted_types as $mime_type) {
        if ($mime_type == $type) {
            $okay = true;
            break;
        }
    }

    if ($okay) {
        if (strtolower($name[1]) != 'zip') {
            echo "The file you are trying to upload is not a .zip file. Please try again.";
            exit;
        }

        $tdate = date("d-M-Y h:i:sa");
        $que = "SELECT max(orderid) as sm FROM orders where user_id='" . $_SESSION['user_id'] . "'";
        $resulth = mysqli_query($bd, $que);
        $rowh = mysqli_fetch_array($resulth);
        $oid = ($rowh['sm'] == '') ? 99999 : $rowh['sm'];
        $oid++;

        $path = 'api/files/';
        $targetdir = $path . $_SESSION['user_id'] . '_' . $oid;
        $targetzip = $targetdir . '/' . $filename;

        if (!is_dir($targetdir)) {
            mkdir($targetdir, 0777, true);
        }

        if (file_exists($targetzip)) {
            echo "File is already uploaded: " . $filename;
            $flag = 1;
        }

        if ($flag == 0) {
            if (move_uploaded_file($source, $targetzip)) {
                $zip = new ZipArchive();
                if ($zip->open($targetzip) === true) {
                    $zip->extractTo($targetdir);
                    $zip->close();
                } else {
                    echo "There was an issue extracting the zip file.";
                    exit;
                }

                $filenoext = basename($filename, '.zip');
                $ffname = "$targetdir/$filenoext/$filenoext.xml";
                $succes = "";
                $unit = 0;
                $t = "";

                if (!empty($ffname) && file_exists($ffname)) {
                    $xml = simplexml_load_file($ffname);
                    foreach ($xml->Object[0]->Object as $value) {
                        if ($value->attributes()->name == 'ToothElementList') {
                            foreach ($value->List->Object as $tuth) {
                                foreach ($tuth->Property as $pr) {
                                    if ($pr->attributes()->name == "ToothNumber") {
                                        $t = ($unit == 0) ? $pr->attributes()->value : "$t," . $pr->attributes()->value;
                                        $unit++;
                                    }
                                }
                            }
                        }
                    }

                    $orderComment = (string) simplexml_load_file($ffname)->xpath('//Property[@name="OrderComments"]')[0]['value'];
                    $items = (string) simplexml_load_file($ffname)->xpath('//Property[@name="Items"]')[0]['value'];
                    $succes = "$fileName,$t , $unit";
                } else {
                    $succes = "$fileName 0,0, 0";
                }


                $clientid = $_SESSION['user_id'];
                $tdate = date("Y-m-d h:i:sa");
                $labname = $_SESSION['labname'];

                $sqq = "INSERT INTO orders(orderid, user_id, unit, product_type, tooth, message, created_at, status, fname, labname, filename, crown, model, framework, abu, custom, tduration, flag, status_ch_date) 
                        VALUES ('$oid', '$clientid', '$unit', '$items', '$t', '$orderComment', '$tdate', 'New', '$fname', '$labname', '$fileName', 'Crown', 'N', 'N', 'N', 'N', 'Next Day', 0, '$tdate')";

                mysqli_query($bd, $sqq);

                echo "$oid|$filename|$t|$unit|$orderComment|$items";
            } else {
                echo "There was an issue with uploading the file.";
                exit;
            }
        }
    } else {
        echo "The file format is not correct.";
        exit;
    }
}
