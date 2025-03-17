<?php
include 'connect.php';
 if (isset($_GET['edate']) and isset($_GET['sdate'])) {
          $edate=$_GET['edate'];
          $sdate=$_GET['sdate'];
          $tdate=date('d-M-Y');
          $tdateu=date('d-M-Y h:i:sa');
$cntt=0;
 function delTree($dir)
    { 
        $files = array_diff(scandir($dir), array('.', '..')); 

        foreach ($files as $file) { 
            (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
        }
        return rmdir($dir); 
    }

          if (isset($_GET['labname']) and $_GET['labname']!="all") 
                      $sql="SELECT * FROM orders where labname='$_GET[labname]'";
                  else
                      $sql="SELECT * FROM orders";
                        $res=mysqli_query($bd,$sql);
                        while($row=mysqli_fetch_array($res))
                        {
                          if (strtotime($sdate)<=strtotime(date("d-M-Y",strtotime($row["created_at"]))) and strtotime(date("d-M-Y",strtotime($row["created_at"]))) <=strtotime($edate)) {
                            $pid=$row['id'];
                            $filepid=trim("../api/files/".$row['filename']);
                            mysqli_query($bd,"UPDATE orders set delete_status='1',d_date='$tdateu' where id=$pid");
                            if(file_exists($filepid))
                            {
                              unlink(trim($filepid));
                              //echo $filepid." is deleting , please wait..";
                              $cntt=$cntt+1;
                              delTree(substr($filepid,0,strlen($filepid)-4));
                            }
              }
              }
            }
            //$cntt=50;
             if ($cntt<10) {
        $cntt=10;
       
      }
      
      //$cntt=1000;

                      echo "Wait for ............".round($cntt/10,0)." Minute";
                      $vv=60*round($cntt/10,0);

?>
<script type="text/javascript">
function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
          //window.close();
          alert("Deletion is completed. Now Redirecting on home.");
          window.location='backup.php';
          
            //timer = duration;
        }
    }, 1000);
}

window.onload = function () {

    var fiveMinutes = "<?php echo $vv ?>",
        display = document.querySelector('#time');
    startTimer(fiveMinutes, display);
};
</script>
<body>
    <div>Deletion complete in <span id="time">05:00</span> minutes!</div>
</body>