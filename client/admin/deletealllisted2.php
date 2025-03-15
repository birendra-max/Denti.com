<?php
include 'connect.php';
if (isset($_GET['edate']) and isset($_GET['sdate'])) {
    $edate = $_GET['edate'];
    $sdate = $_GET['sdate'];
    $tdate = date('d-M-Y');
    $tdateu = date('d-M-Y h:i:sa');

    $cntt = 0;
    
    function delTree($dir) { 
        $files = array_diff(scandir($dir), array('.', '..')); 
        foreach ($files as $file) { 
            (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
        }
        return rmdir($dir); 
    }

    if (isset($_GET['labname']) && $_GET['labname'] != "all") {
        $sql = "SELECT * FROM orders WHERE labname = '$_GET[labname]'";
    } else {
        $sql = "SELECT * FROM orders";
    }

    $res = mysqli_query($bd, $sql);
    while ($row = mysqli_fetch_array($res)) {
        if (strtotime($sdate) <= strtotime(date("d-M-Y", strtotime($row["created_at"]))) && strtotime(date("d-M-Y", strtotime($row["created_at"]))) <= strtotime($edate)) {
            $ordid = $row['orderid'];

            // Query to fetch from orders_finished
            $sql2 = "SELECT * FROM orders_finished WHERE orderid = '$ordid'";
            $res2 = mysqli_query($bd, $sql2);
            
            // Check if the query returned a row
            if ($row2 = mysqli_fetch_array($res2)) {
                $filepid2 = "../api/finished_files/" . $row2['finished_file'];
                $pid2 = $row2['id'];
                
                // Update the orders_finished table
                mysqli_query($bd, "UPDATE orders_finished SET delete_status = '1', d_date = '$tdate' WHERE id = $pid2");
                
                // Check if the file exists and delete it
                if (file_exists($filepid2)) {
                    if (unlink(trim($filepid2))) {
                        echo ""; // File deleted
                        $cntt = $cntt + 1;
                    }
                }
            }
        }
    }

    if ($cntt < 10) {
        $cntt = 10;
    }

    echo "Wait for ............" . round($cntt / 10, 0) . " Minute";
    $vv = 60 * round($cntt / 10, 0);
}

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