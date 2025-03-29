<?php
include 'connect.php';

$dd = $_GET['q'];
$dd = explode(",", $dd);
$d = $dd[0];
$snumber = $dd[1];
$enumber = $dd[2];
$odate = date("d-M-Y");

$status = "";
$f = 0;
if ($d == '1') {
  $status = "All";
  $f = 1;
}
if ($d == '2') {
  $status = "New";
  $f = 1;
}
if ($d == '3') {
  $status = "progress";
  $f = 1;
}
if ($d == '4') {
  $status = "QC Required";
  $f = 1;
}
if ($d == '5') {
  $status = "Hold";
  $f = 1;
}
if ($d == '6') {
  $status = "Completed";
  $f = 1;
}
if ($d == '7') {
  $status = "Cancel";
  $f = 1;
}
if ($d == '8') {
  $status = "Completed";
  $f = 1;
}

if ($f == 1) {
  $clientid = $_SESSION['user_id'];

  // Validate and sanitize the $snumber and $enumber values
  $snumber = filter_var($snumber, FILTER_SANITIZE_NUMBER_INT);
  $enumber = filter_var($enumber, FILTER_SANITIZE_NUMBER_INT);

  // Ensure both $snumber and $enumber are valid numbers
  if (is_numeric($snumber) && is_numeric($enumber)) {
    // Construct the SQL query based on the selected status
    if ($status == 'All') {
      $sql = "SELECT * FROM orders WHERE user_id='$clientid' AND orderid BETWEEN $snumber AND $enumber";
    } else {
      $sql = "SELECT * FROM orders WHERE user_id='$clientid' AND status='$status' AND orderid BETWEEN $snumber AND $enumber";
    }

    $res = mysqli_query($bd, $sql);
    $rows_found = mysqli_num_rows($res);  // Count how many rows are returned

    if ($rows_found > 0) {
?>

      <div class="table table-responsive">
        <table id="example2" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>File Name</th>
              <th>Delivery Time</th>
              <th width="100">Order Status</th>
              <th>Total Unit</th>
              <th>#Tooth</th>
              <th>Lab Name</th>
              <th>USA Date</th>
              <th>Message</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 0;
            while ($row = mysqli_fetch_array($res)) {
            ?>
              <tr>
                <td>
                  <input type="checkbox" name="caseid" class="caseid" id="caseid<?php echo $i ?>" value="<?php echo $i ?>">
                  <span><?php echo $row['orderid'] ?></span>
                </td>
                <td><?php echo $row['fname'] ?></td>
                <td>
                  <i class="fas fa-running" style="font-size: 18px;font-weight: bold;"></i>
                  <?php if ($row['tduration'] == "Rush") {
                    echo "1 - 2 Hour";
                  }
                  if ($row['tduration'] == "Same Day") {
                    echo "6 Hour";
                  }
                  if ($row['tduration'] == "Next Day") {
                    echo "12 Hour <i class='fas fa-moon' style='font-size:18px'></i>";
                  }
                  if (empty($row['tduration'])) {
                    echo "12 Hour <i class='fas fa-moon' style='font-size:18px'></i>";
                  }
                  ?>
                </td>
                <td> <i class="fas fa-clock"> </i>
                  <div class="progress">
                    <div class="progress-bar <?php if ($row['status'] == 'New')
                                                echo 'bg-white';
                                              if ($row['status'] == 'Cancel')
                                                echo 'bg-danger';
                                              if ($row['status'] == 'Completed')
                                                echo 'bg-success';
                                              if ($row['status'] == 'QC Required')
                                                echo 'bg-primary';
                                              if ($row['status'] == 'Hold')
                                                echo 'bg-danger';
                                              if ($row['status'] == 'Redesign')
                                                echo 'bg-warning'; ?>" style="width:<?php if ($row['status'] == 'New')
                                                                                        echo '100%';
                                                                                      if ($row['status'] == 'Cancel')
                                                                                        echo '40%';
                                                                                      if ($row['status'] == 'Completed')
                                                                                        echo '100%';
                                                                                      if ($row['status'] == 'QC Required')
                                                                                        echo '90%';
                                                                                      if ($row['status'] == 'Hold')
                                                                                        echo '50%';
                                                                                      if ($row['status'] == 'Redesign')
                                                                                        echo '100%'; ?>">
                      <?php echo $row['status'] ?>
                    </div>
                  </div>
                </td>
                <td><?php echo $row['unit'] ?></td>
                <td><?php echo implode("-", explode(",", $row['tooth'])) ?></td>
                <td><?php echo $row['labname'] ?></td>
                <td><?php echo $row['created_at'] ?></td>
                <td>
                  <button data-id="<?php echo $row['orderid'] ?>" class="btn btn-primary chatbtn">
                    <?php
                    $orderid = $row['orderid'];
                    $msgq = "SELECT count(*) as cnt FROM chatbox WHERE orderid='$orderid'";
                    $resmsg = mysqli_query($bd, $msgq);
                    $msgrow = mysqli_fetch_array($resmsg);
                    if (!empty($row['message']))
                      echo ($msgrow['cnt'] + 1);
                    else
                      echo ($msgrow['cnt']);
                    ?>
                    <i class="fas fa-comments"></i>
                  </button>
                </td>
              </tr>
            <?php
              $i++;
            }
            ?>
          </tbody>
        </table>
      </div>

    <?php
    } else {
      // If no rows are found, show a message in the table
    ?>
      <div class="table table-responsive">
        <table id="example2" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>File Name</th>
              <th>Delivery Time</th>
              <th>Order Status</th>
              <th>Total Unit</th>
              <th>#Tooth</th>
              <th>Lab Name</th>
              <th>USA Date</th>
              <th>Message</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="9" style="text-align: center;">No data found</td>
            </tr>
          </tbody>
        </table>
      </div>
<?php
    }
  } else {
    echo "<h1 style='text-align:center;color:red;'>No Data Found</h1>";
  }
}
?>