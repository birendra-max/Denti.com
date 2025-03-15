<?php
include 'connect.php';

$imageData = '';
$flag = 0;

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
            echo "The file you are trying to upload is not a .zip file. Please try again.";
            exit;
        }

        // Generate the order ID
        $tdate = date("d-M-Y h:i:sa");
        $que = "SELECT max(orderid) as sm FROM orders where clientid='" . $_SESSION['user_id'] . "'";
        $resulth = mysqli_query($bd, $que);
        $rowh = mysqli_fetch_array($resulth);
        $oid = ($rowh['sm'] == '') ? 99999 : $rowh['sm'];
        $oid++;

        $path = 'api/files/';
        $targetdir = $path . $_SESSION['user_id'] . $oid;

        if (!file_exists($targetdir)) {
            mkdir($targetdir, 0777, true);
        }

        $targetzip = $targetdir . "/" . $filename;

        if (file_exists($targetzip)) {
            echo "File already uploaded.";
            exit;
        }

        if (move_uploaded_file($source, $targetzip)) {
            $zip = new ZipArchive();
            $x = $zip->open($targetzip);
            if ($x === true) {
                $zip->extractTo($targetdir);
                $zip->close();
            }
            $message = "Your .zip file was uploaded and unpacked.";
        } else {
            echo "There was a problem with the upload. Please try again.";
            exit;
        }

        // // Initialize variables
        // $unit = 0;
        // $t = "";
        // $succes = "";

        // // Check if the XML file exists and parse it
        // $ffname = $targetdir . "/" . basename($filename, '.zip') . ".xml";
        // if (!empty($ffname) and file_exists($ffname)) {
        //     $unit = 0;
        //     $t = "";
        //     $xml = simplexml_load_file($ffname);

        //     // Parse XML for tooth numbers
        //     foreach ($xml->Object[0]->Object as $value) {
        //         if ($value->attributes()->name == 'ToothElementList') {
        //             foreach ($value->List->Object as $tuth) {
        //                 foreach ($tuth->Property as $pr) {
        //                     if ($pr->attributes()->name == "ToothNumber") {
        //                         $t = ($unit == 0) ? $pr->attributes()->value : $t . "," . $pr->attributes()->value;
        //                         $unit++;
        //                     }
        //                 }
        //             }
        //         }
        //     }

        //     /* $toothElements = '';
        //      $productTypes = '';
        //      $orderComments = '';
        //      $crownBridge = '';
        //      $orderDetails = ''; // You can populate this later if needed

        //      // Loop through the XML to find relevant data
        //      foreach ($xml->xpath("//List[@name='Items']/Object") as $object) {
        //          $type = (string) $object['type'];

        //          // Debugging: Output the type
        //          echo "Type: " . $type . "<br>";

        //          // Extract ToothElement details
        //          if (strpos($type, 'ToothElement') !== false) {
        //              // Add JSON encoded object to $toothElements
        //              $toothElements .= json_encode($object, JSON_PRETTY_PRINT) . "; ";
        //          }

        //          // Extract ModelElement and Order details
        //          elseif (strpos($type, 'ModelElement') !== false || strpos($type, 'Order') !== false) {
        //              // Add JSON encoded object to $productTypes
        //              $productTypes .= json_encode($object, JSON_PRETTY_PRINT) . "; ";
        //          }

        //          // Check if the order has comments from the operator (TDM_Item_Order)
        //          if ($type === 'TDM_Item_Order' && isset($object->Property)) {
        //              foreach ($object->Property as $property) {
        //                  $propertyName = strtolower((string) $property['name']);
        //                  $propertyValue = (string) $property['value'];

        //                  // Debugging: Output property name and value
        //                  echo "Property Name: $propertyName, Property Value: $propertyValue <br />";

        //                  // Extract order comments if present
        //                  if ($propertyName === 'operatorcomment' || $propertyName === 'OrderComments') {
        //                      $orderComments .= $propertyValue . "; ";
        //                  }

        //                  // Check for crown and bridge items
        //                  if (strpos(strtolower($propertyValue), 'crown') !== false || strpos(strtolower($propertyValue), 'bridge') !== false) {
        //                      $crownBridge .= $propertyValue . "; ";
        //                  }
        //              }
        //          }
        //      }

        //      // Debugging: Output the final results
        //      echo "Tooth Elements: " . $toothElements . "<br>";
        //      echo "Product Types: " . $productTypes . "<br>";
        //      echo "Order Comments: " . $orderComments . "<br>";
        //      echo "Crown and Bridge: " . $crownBridge . "<br>";

        //      // Concatenate all the information into the $dt variable
        //      $dt = $orderComments . '|' . $toothElements . '|' . $productTypes . '|' . $orderDetails . '|' . $orderComments . '|' . $crownBridge;

        //      // Output the final concatenated result
        //      echo "Final Data: " . $dt . "<br>";
        //     */


        //     $succes = $fileName . "," . $t . " " . $unit;
        // } else {
        //     $succes = $fileName . "0,0, 0";
        // }


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

        $clientid = $_SESSION['user_id'];
        $labname = $_SESSION['labname'];

        // Insert the order into the database
        $sqq = "INSERT INTO orders(orderid, clientid, unit, tooth, message, created_at, status, fname, labname, filename, crown, model, framework, abu, custom, tduration, flag, status_ch_date)
                VALUES('$oid', '$clientid', '$unit', '$t', '', '$tdate', 'New', '$fname', '$labname', '$fileName', 'Crown', 'N', 'N', 'N', 'N', 'Next Day', 0, '$tdate')";
        mysqli_query($bd, $sqq);

        // Return the order ID, file name, tooth numbers, and unit count in the new format
        echo $oid . "|" . $filename . "|" . $t . "|" . $unit;
    } else {
        echo "File format is not correct.";
    }
}
?>