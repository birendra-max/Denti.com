  <?php 
   $to="himanshupandey.9000@gmail.com";
   $subject="hello";
   $message="This is a tetsing.";
   $headers = array("From: himanshupandey.9000@gmail.com",
    "Reply-To: himanshupandey.9000@gmail.com",
    "X-Mailer: PHP/" . PHP_VERSION
);
$headers = implode("\r\n", $headers);
mail($to, $subject, $message, $headers);

die;

    function roundsize($size){
    $i=0;
    $iec = array("B", "Kb", "Mb", "Gb", "Tb");
    while (($size/1024)>1) {
        $size=$size/1024;
        $i++;}
    return(round($size,1)." ".$iec[$i]);
  }
                 $freespace=   roundsize( disk_free_space("/home/bravoden/public_html/")); 
                $totspace= substr($freespace,0,-2);
if ($totspace<100) {
 $msg=" this is a testing";
mail("himanshupandey.9000@gmail.com","From Server",$msg);
echo "sended";
  // $to = 'himanshupandey.9000@gmail.com';

  //     $subject = 'Server Reach 80% disk uses ';

  //     $headers  = "From: " . strip_tags("Bravodent@bravodentdesigns.com") . "\r\n";
  //     $headers .= "Reply-To: " . strip_tags("Bravodent@bravodentdesigns.com") . "\r\n";
  //     $headers .= "CC: magicmove.in@gmail.com\r\n";
  //     $headers .= "MIME-Version: 1.0\r\n";
  //     $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

  //     $message = "this is a test";
  //     if(mail($to, $subject, $message, $headers))
  //     {
  //       echo "send success";
  //     }else
  //     {
  //       echo "Sorry mail can not be send";
  //     }


  // $to = 'Skydent@skydentdesigns.com';

  //     $subject = 'Server Reach 80% disk uses ';

  //     $headers  = "From: " . strip_tags("Skydent@skydentdesigns.com") . "\r\n";
  //     $headers .= "Reply-To: " . strip_tags("Skydent@skydentdesigns.com") . "\r\n";
  //     $headers .= "CC: himanshupandey.9000@gmail.com\r\n";
  //     $headers .= "MIME-Version: 1.0\r\n";
  //     $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

  //     $message = "<p><strong>Please check at once your server reach near to full , kindly do backup and delete the file for more space. The currently avaible space is :<span style='color:red;font-weight:bold;font-size:35px;'> $freespace </span></strong> </p>";
  //     mail($to, $subject, $message, $headers);
    }
                 ?>