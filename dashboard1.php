<?php
$clientid = $_SESSION['user_id'];

function Total_row($bd, $status, $clid)
{
  if ($status == "All")
    $sql = "SELECT count(*) as cnt FROM orders where user_id='$clid'";
  else
    $sql = "SELECT count(*) as cnt FROM orders where user_id='$clid' and status='$status'";

  $res = mysqli_query($bd, $sql);
  $row = mysqli_fetch_array($res);
  return $row['cnt'];
}
?>

<!-- Small boxes (Stat box) -->
<div class="row" style="padding: 10px;">
  <!-- New Order -->
  <div class="col-lg-3 col-6">
    <a href="dashboard.php" class="small-box-footer">
      <div class="small-box">
        <div class="inner text-center">
          <div class="circle-container">
            <h3 class="text-green">
              <?php
              $resulth = mysqli_query($bd, "SELECT count(*) as sm FROM orders WHERE user_id='$clientid' and status='New'");
              $rowh = mysqli_fetch_assoc($resulth);
              echo $rowh['sm'];
              ?>
            </h3>
            <p class="text-green">New Order</p>
          </div>
        </div>
        <div class="icon">
          <i class="fas fa-dollar-sign"></i>
        </div>
        <i class="fas fa-arrow-circle-right text-green"></i>
      </div>
    </a>
  </div>

  <!-- Rush Order -->
  <div class="col-lg-3 col-6">
    <a href="index2.php" class="small-box-footer">
      <div class="small-box bg-rush">
        <div class="inner text-center">
          <div class="circle-container">
            <h3 class="text-black">
              <?php
              $resulth = mysqli_query($bd, "SELECT count(*) as sm FROM orders WHERE user_id='$clientid' and tduration='Rush' and status='New'");
              $rowh = mysqli_fetch_array($resulth);
              echo $rowh['sm'];
              ?>
            </h3>
            <p class="text-black">Rush Order</p>
          </div>
        </div>
        <div class="icon">
          <i class="fas fa-money-bill-alt"></i>
        </div>
        <i class="fas fa-arrow-circle-right text-black"></i>
      </div>
    </a>
  </div>

  <!-- Completed Order -->
  <div class="col-lg-3 col-6">
    <a href="pagination.php?type=<?php echo base64_encode('Completed') ?>&user_id=<?php echo base64_encode($clientid) ?>" class="small-box-footer">
      <div class="small-box bg-completed">
        <div class="inner text-center">
          <div class="circle-container">
            <h3 class="text-green">
              <?php
              $resulth = mysqli_query($bd, "SELECT count(*) as sm FROM orders WHERE user_id='$clientid' and status='Completed'");
              $rowh = mysqli_fetch_array($resulth);
              echo $rowh['sm'];
              ?>
            </h3>
            <p class="text-green">Completed Order</p>
          </div>
        </div>
        <div class="icon">
          <i class="fas fa-dollar-sign"></i>
        </div>
        <i class="fas fa-arrow-circle-right text-green"></i>
      </div>
    </a>
  </div>

  <!-- Hold Order -->
  <div class="col-lg-3 col-6">
    <a href="pagination.php?type=<?php echo base64_encode('Hold') ?>&user_id=<?php echo base64_encode($clientid) ?>" class="small-box-footer">
      <div class="small-box bg-hold">
        <div class="inner text-center">
          <div class="circle-container">
            <h3 class="text-red">
              <?php
              $resulth = mysqli_query($bd, "SELECT count(*) as sm FROM orders WHERE user_id='$clientid' and status='Hold'");
              $rowh = mysqli_fetch_array($resulth);
              echo $rowh['sm'];
              ?>
            </h3>
            <p class="text-red">Order On Hold</p>
          </div>
        </div>
        <div class="icon">
          <i class="fas fa-money-bill-alt"></i>
        </div>
        <i class="fas fa-arrow-circle-right text-red"></i>
      </div>
    </a>
  </div>
</div>

<!-- Second row of boxes -->
<div class="row" style="padding: 10px;">
  <!-- In Progress -->
  <div class="col-lg-3 col-6">
    <a href="index3.php" class="small-box-footer">
      <div class="small-box bg-white">
        <div class="inner text-center">
          <div class="circle-container">
            <h3 class="text-blueviolet">
              <?php
              $resulth = mysqli_query($bd, "SELECT count(*) as sm FROM orders WHERE user_id='$clientid' and status='progress'");
              $rowh = mysqli_fetch_array($resulth);
              echo $rowh['sm'];
              ?>
            </h3>
            <p class="text-blueviolet">In Progress</p>
          </div>
        </div>
        <div class="icon">
          <i class="fas fa-tasks"></i>
        </div>
        <i class="fas fa-arrow-circle-right text-blueviolet"></i>
      </div>
    </a>
  </div>

  <!-- QC Required -->
  <div class="col-lg-3 col-6">
    <a href="index7.php" class="small-box-footer">
      <div class="small-box bg-qc">
        <div class="inner text-center">
          <div class="circle-container">
            <h3 class="text-black">
              <?php
              $resulth = mysqli_query($bd, "SELECT count(*) as sm FROM orders WHERE user_id='$clientid' and status='QC Required'");
              $rowh = mysqli_fetch_array($resulth);
              echo $rowh['sm'];
              ?>
            </h3>
            <p class="text-black">QC Required</p>
          </div>
        </div>
        <div class="icon">
          <i class="fas fa-money-bill-alt"></i>
        </div>
        <i class="fas fa-arrow-circle-right text-black"></i>
      </div>
    </a>
  </div>

  <!-- All Order -->
  <div class="col-lg-3 col-6">
    <a href="pagination.php?type=<?php echo base64_encode('All') ?>&user_id=<?php echo base64_encode($clientid) ?>" class="small-box-footer">
      <div class="small-box bg-all-Order">
        <div class="inner text-center">
          <div class="circle-container">
            <h3 class="text-primary">
              <?php
              $resulth = mysqli_query($bd, "SELECT count(*) as sm FROM orders WHERE user_id='$clientid'");
              $rowh = mysqli_fetch_array($resulth);
              echo $rowh['sm'];
              ?>
            </h3>
            <p class="text-primary">All Order</p>
          </div>
        </div>
        <div class="icon">
          <i class="fas fa-tasks"></i>
        </div>
        <i class="fas fa-arrow-circle-right text-primary"></i>
      </div>
    </a>
  </div>

  <!-- Canceled Order -->
  <div class="col-lg-3 col-6">
    <a href="pagination.php?type=<?php echo base64_encode('Cancel') ?>&user_id=<?php echo base64_encode($clientid) ?>" class="small-box-footer">
      <div class="small-box bg-cancel">
        <div class="inner text-center">
          <div class="circle-container">
            <h3 class="text-red">
              <?php
              $resulth = mysqli_query($bd, "SELECT count(*) as sm FROM orders WHERE user_id='$clientid' and status='Cancel'");
              $rowh = mysqli_fetch_array($resulth);
              echo $rowh['sm'];
              ?>
            </h3>
            <p class="text-red">Canceled Order</p>
          </div>
        </div>
        <div class="icon">
          <i class="fas fa-money-bill-alt"></i>
        </div>
        <i class="fas fa-arrow-circle-right text-red"></i>
      </div>
    </a>
  </div>
</div>

<!-- Yesterday's and Today's Order -->
<div class="row" style="padding: 10px;">
  <!-- Yesterday's Order -->
  <div class="col-lg-3 col-6">
    <a href="index8.php" class="small-box-footer">
      <div class="small-box bg-white">
        <div class="inner text-center">
          <div class="circle-container">
            <h3 class="text-blue">
              <?php
              $tdate = date('d-M-Y', strtotime('-1 day'));
              $cc = 0;
              $resulth = mysqli_query($bd, "SELECT created_at FROM orders WHERE user_id='$clientid'");
              while ($rowh = mysqli_fetch_array($resulth)) {
                if (strtotime($tdate) == strtotime(date("d-M-Y", strtotime($rowh['created_at'])))) $cc++;
              }
              echo $cc;
              ?>
            </h3>
            <p class="text-blue">Yesterday's Order</p>
          </div>
        </div>
        <div class="icon">
          <i class="fas fa-tasks"></i>
        </div>
        <i class="fas fa-arrow-circle-right text-blue" style="margin-top: 2%;"></i>
      </div>
    </a>
  </div>

  <!-- Today's Order -->
  <div class="col-lg-3 col-6">
    <a href="index10.php" class="small-box-footer">
      <div class="small-box bg-today">
        <div class="inner text-center">
          <div class="circle-container">
            <h3 class="text-teal">
              <?php
              $tdate = date('d-M-Y');
              $cc = 0;
              $resulth = mysqli_query($bd, "SELECT created_at FROM orders WHERE user_id='$clientid'");
              while ($rowh = mysqli_fetch_array($resulth)) {
                if (strtotime($tdate) == strtotime(date("d-M-Y", strtotime($rowh['created_at'])))) $cc++;
              }
              echo $cc;
              ?>
            </h3>
            <p class="text-teal">Today's Order</p>
          </div>
        </div>
        <div class="icon">
          <i class="fas fa-money-bill-alt"></i>
        </div>
        <i class="fas fa-arrow-circle-right text-teal" style="margin-top: 2%;"></i>
      </div>
    </a>
  </div>

  <div class="col-lg-3 col-6">
    <a href="weeklycase.php" class="small-box-footer">
      <div class="small-box bg-today">
        <div class="inner text-center">
          <div class="circle-container">
            <h3 class="text-teal">
              <?php
              $tdate = date('d-M-Y');
              $cc = 0;
              $resulth = mysqli_query($bd, "SELECT * FROM orders  WHERE user_id='$clientid' and STR_TO_DATE(created_at, '%Y-%m-%d') >= CURDATE() - INTERVAL 7 DAY");
              while ($rowh = mysqli_fetch_array($resulth)) {
                $cc++;
              }
              echo $cc;
              ?>
            </h3>
            <p class="text-black">Weekly Order</p>
          </div>
        </div>
        <div class="icon">
          <i class="fas fa-money-bill-alt"></i>
        </div>
        <i class="fas fa-arrow-circle-right text-teal" style="margin-top: 2%;"></i>
      </div>
    </a>
  </div>
</div>

<style>
  /* General row settings */
  .row {
    margin-top: 2px !important;
    padding-top: 0 !important;
  }

  /* Adjust the padding of the small-box */
  .small-box {
    background-color: #ffffff !important;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    position: relative;
    padding: 10px 20px;
  }

  /* Adjust padding inside the inner section */
  .small-box .inner {
    padding: 4px 0;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
  }

  /* Adjust column spacing */
  .col-lg-3.col-6 {
    padding-top: 0 !important;
    margin-top: 0 !important;
  }

  /* Icon positioning */
  .small-box .icon {
    position: absolute;
    top: 40px;
    right: 10px;
    font-size: 4em;
  }

  /* Arrow icon positioning */
  .small-box .fas.fa-arrow-circle-right {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 2em;
    margin-top: 5px;
  }

  /* Specific text colors for each box */
  .text-green {
    color: green !important;
  }

  .text-black {
    color: black !important;
  }

  .text-chartreuse {
    color: chartreuse !important;
  }

  .text-red {
    color: red !important;
  }

  .text-blueviolet {
    color: blueviolet !important;
  }

  .text-primary {
    color: #399793 !important;
  }

  .text-blue {
    color: blue !important;
  }

  .text-teal {
    color: #399793 !important;
  }

  /* Circle container styling */
  .small-box .circle-container {
    background-color: #f0f0f0;
    /* Light background for better visibility */
    border-radius: 50%;
    /* Makes the shape circular */
    width: 170px;
    /* Control the size of the circle */
    height: 150px;
    /* Control the size of the circle */
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    border: 6px solid black;
    margin: 0 auto;
  }

  /* Styling for number (h3) inside the circle */
  .small-box .circle-container h3 {
    font-size: 2em;
    margin: 0;
  }

  /* Styling for text (p) inside the circle */
  .small-box .circle-container p {
    font-size: 1.2em;
    margin: 0;
  }
</style>