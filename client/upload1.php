<?php
include 'connect.php';
$imageData = '';
$flag = 0;
// $_SESSION['userid']="1";
// $_SESSION['labname']="papi lab";
// $_SESSION['email']="abc@gmail.com";
if (isset($_FILES['file']['name']) && isset($_SESSION['userid'])) {
    $flag = 0;

    $filename = "";
    $source = "";
    $type = "";
    $fileName = $_FILES['file']['name'];
    $filename = $_FILES["file"]["name"];
    $source = $_FILES["file"]["tmp_name"];
    $type = $_FILES["file"]["type"];
    $fname = basename($_FILES["file"]["name"]);
    $okay = false;

    $name = explode(".", $filename);
    $accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
    foreach ($accepted_types as $mime_type) {
        if ($mime_type == $type) {
            $okay = true;
            break;
        }
    }
    if ($okay) {



        $continue = strtolower($name[1]) == 'zip' ? true : false;
        if (!$continue) {
            $message = "The file you are trying to upload is not a .zip file. Please try again.";
        }


        // Generate the order ID
        $tdate = date("d-M-Y h:i:sa");
        $que = "SELECT max(orderid) as sm FROM orders where clientid='" . $_SESSION['user_id'] . "'";
        $resulth = mysqli_query($bd, $que);
        $rowh = mysqli_fetch_array($resulth);
        $oid = ($rowh['sm'] == '') ? 99999 : $rowh['sm'];
        $oid++;


        /* PHP current path */
        $path = 'api/files/';  // absolute path to the directory where zipper.php is in
        $ffname = $path . $name[0] . "/" . $name[0] . '/' . $name[0] . ".xml";
        $filenoext = basename($filename, '.zip');  // absolute path to the directory where zipper.php is in (lowercase)
        $filenoext = basename($filenoext, '.ZIP');  // absolute path to the directory where zipper.php is in (when uppercase)

        $targetdir = $path . $filenoext; // target directory
        $targetzip = $path . $filename; // target zip file

        /* create directory if not exists', otherwise overwrite */
        /* target directory is same as filename without extension */

        //if (is_dir($targetdir))  rmdir_recursive ( $targetdir);


        if (file_exists($targetdir)) {
            echo "File is already uploaded." . $filename;
            $flag = 1;
        }
        /* here it is really happening */
        if ($flag == 0) {

            if (move_uploaded_file($source, $targetzip)) {
                $zip = new ZipArchive();
                $x = $zip->open($targetzip);  // open the zip file to extract
                if ($x === true) {
                    $zip->extractTo($targetdir); // place in the directory with same name  
                    $zip->close();

                    //unlink($targetzip);
                }
                $message = "Your .zip file was uploaded and unpacked.";
            } else {
                $message = "There was a problem with the upload. Please try again.";
            }
            $succes = "";
            $unit = 0;
            $t = "";
            //echo $ffname;
            if (!empty($ffname) and file_exists($ffname)) {

                $unit = 0;
                $t = "";
                $xml2 = $xml = simplexml_load_file($ffname);

                foreach ($xml->Object[0]->Object as $value) {

                    if ($value->attributes()->name == 'ToothElementList') {

                        foreach ($value->List->Object as $tuth) {
                            foreach ($tuth->Property as $pr) {
                                //echo $pr->attributes()->name;
                                if ($pr->attributes()->name == "ToothNumber") {

                                    if ($unit == 0)
                                        $t = $pr->attributes()->value;
                                    else
                                        $t = $t . "," . $pr->attributes()->value;
                                    $unit++;
                                }
                            }
                        }

                    }
                }
                //echo "hello ". $unit. ", hello";

                $succes = $fileName . "," . $t . " " . $unit;
            } else {
                $succes = $fileName . "0,0, 0";
            }

            $tdate = date("d-M-Y h:i:sa");


            $clientid = $_SESSION['user_id'];
            $tdate = date("d-M-Y h:i:sa");
            $labname = $_SESSION['labname'];
            $sqq = "INSERT INTO orders(orderid,clientid,unit,tooth,message,created_at,status,fname,labname,filename,crown,model,framework,abu,custom,tduration,flag,status_ch_date)VALUES('$oid','$clientid','$unit','$t','','$tdate','New','$fname','$labname','$fileName','Crown','N','N','N','N','Next Day',0,'$tdate')";
            //die;
            mysqli_query($bd, $sqq);



            echo $oid . " " . $succes;

        }
    } else {
        echo "File is format is not correct.";
    }

}

