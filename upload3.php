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

    // Acceptable file types
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

        // Define paths
        $path = 'api/files/';
        // Do not modify the file name, keep the original name
        $targetdir = $path . $_SESSION['user_id'] . '_' . $oid; // Directory for order ID and user ID
        $targetzip = $targetdir . '/' . $filename; // Path for the uploaded zip file

        // Check if the directory already exists, and if not, create it
        if (!is_dir($targetdir)) {
            mkdir($targetdir, 0777, true); // Create the folder if it doesn't exist
        }

        // Check if the file already exists in that directory
        if (file_exists($targetzip)) {
            echo "File is already uploaded: " . $filename;
            $flag = 1;
        }

        // If the file doesn't exist, upload and process
        if ($flag == 0) {
            if (move_uploaded_file($source, $targetzip)) {
                // Extract the zip file into the target directory
                $zip = new ZipArchive();
                $x = $zip->open($targetzip);
                if ($x === true) {
                    $zip->extractTo($targetdir);  // Extract contents into the directory
                    $zip->close();
                } else {
                    echo "There was an issue extracting the zip file.";
                    exit;
                }

                // Process the XML file inside the extracted folder
                $filenoext = basename($filename, '.zip');
                $ffname = $targetdir . "/" . $filenoext . "/" . $filenoext . ".xml"; // XML file inside the zip
                $succes = "";
                $unit = 0;
                $t = "";

                // if (!empty($ffname) and file_exists($ffname)) {
                //     $unit = 0;
                //     $t = "";
                //     $xml = simplexml_load_file($ffname);

                //     foreach ($xml->Object[0]->Object as $value) {
                //         if ($value->attributes()->name == 'ToothElementList') {
                //             foreach ($value->List->Object as $tuth) {
                //                 foreach ($tuth->Property as $pr) {
                //                     if ($pr->attributes()->name == "ToothNumber") {
                //                         if ($unit == 0)
                //                             $t = $pr->attributes()->value;
                //                         else
                //                             $t = $t . "," . $pr->attributes()->value;
                //                         $unit++;
                //                     }
                //                 }
                //             }
                //         }
                //     }



                //     $items = "";
                //     $orderComments = "";

                //     // Navigate through XML to find Items and OrderComments
                //     foreach ($xml->Object->List->Object->Property as $property) {
                //         $name = (string) $property['name'];
                //         $value = (string) $property['value'];

                //         if ($name === "Items") {
                //             $items = $value;
                //         } elseif ($name === "OrderComments") {
                //             $orderComments = $value;
                //         }
                //     }

                //     echo "Items: " . $items . "<br>";
                //     echo "Order Comments: " . $orderComments . "<br>";

                //     $succes = $fileName . "," . $t . " " . $unit;
                //     print_r($success);
                // } else {
                //     $succes = $fileName . "0,0, 0";
                // }


                
                if (!empty($ffname) && file_exists($ffname)) {
                    $unit = 0;
                    $t = "";
                    $items = "";
                    $orderComments = "";
                    
                    $xml = simplexml_load_file($ffname);
                    
                    // Check if XML is loaded properly
                    if ($xml === false) {
                        die("Error: Failed to load XML.");
                    }
                    
                    // Extract Tooth Numbers
                    foreach ($xml->Object as $object) {
                        if ((string) $object['name'] === 'ToothElementList' && isset($object->List->Object)) {
                            foreach ($object->List->Object as $tuth) {
                                foreach ($tuth->Property as $pr) {
                                    if ((string) $pr['name'] === "ToothNumber") {
                                        $t = ($unit === 0) ? (string) $pr['value'] : $t . "," . (string) $pr['value'];
                                        $unit++;
                                    }
                                }
                            }
                        }
                    }
                    
                    // Extract Items and OrderComments
                    $itemsFound = false;
                    $orderCommentsFound = false;
                    
                    foreach ($xml->Object as $object) {
                        // Check if the object has a Property (like ToothNumber)
                        if (isset($object->Property)) {
                            foreach ($object->Property as $property) {

                                print_r($object);
                                die();

                                $name = (string) $property['name'];
                                $value = (string) $property['value'];
                                
                                // Extract Items in the same way as Tooth Numbers
                                if ($name === "Items") {
                                    if (!$itemsFound) {
                                        $items = $value;
                                        $itemsFound = true;
                                    } else {
                                        $items .= "," . $value;
                                    }
                                }
                                
                                // Extract OrderComments in the same way as Tooth Numbers
                                if ($name === "OrderComments") {
                                    if (!$orderCommentsFound) {
                                        $orderComments = $value;
                                        $orderCommentsFound = true;
                                    } else {
                                        $orderComments .= "," . $value;
                                    }
                                }
                            }
                        }
                    }
                    
                    // Output results
                    echo "Items: " . htmlspecialchars($items) . "<br>";
                    echo "Order Comments: " . htmlspecialchars($orderComments) . "<br>";
                    echo "Tooth Numbers: " . htmlspecialchars($t) . "<br>";
                    
                    // Fix the undefined variable issue
                    $success = $ffname . "," . $t . " " . $unit;
                    print_r($success);
                } else {
                    echo "File does not exist or is empty.";
                }
                
               
                die();

                // Insert order into the database
                $clientid = $_SESSION['user_id'];
                $tdate = date("Y-m-d h:i:sa");
                $labname = $_SESSION['labname'];
                $sqq = "INSERT INTO orders(orderid,clientid,unit,tooth,message,created_at,status,fname,labname,filename,crown,model,framework,abu,custom,tduration,flag,status_ch_date)VALUES('$oid','$clientid','$unit','$t','','$tdate','New','$fname','$labname','$fileName','Crown','N','N','N','N','Next Day',0,'$tdate')";
                mysqli_query($bd, $sqq);

                echo $oid . "|" . $filename . "|" . $t . "|" . $unit;
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
