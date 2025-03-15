<?php

$clientid = $_SESSION['user_id'];

function Total_row($bd, $status, $clid)
{
  if ($status == "All")

    $sql = "SELECT count(*) as cnt FROM orders where user_id='$clid'";
  else
    $sql = "SELECT count(*) as cnt FROM orders where  user_id='$clid' and status='$status'";
  $res = mysqli_query($bd, $sql);
  $row = mysqli_fetch_array($res);
  return $row['cnt'];
}
?>


<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <a href="dashboard.php" class="small-box-footer" style="background-color: #ffffff;">
      <div class="small-box" id="smale_box">
        <div class="inner" style="color: green !important;font-weight: bold;">
          <h3 style="color: green;">
            <?php

            $resulth = mysqli_query($bd, "SELECT count(*) as sm FROM orders WHERE user_id='$clientid' and status='New'");
            $rowh = mysqli_fetch_assoc($resulth);
            echo $rowh['sm']; ?>
          </h3>
          <p style="color: green !important;font-weight: bold;">New Cases</p>
        </div>
        <div class="icon">
          <i class="fas fa-dollar-sign"></i>
        </div>
        <i class="fas fa-arrow-circle-right" style="color: green;"></i>
    </a>
  </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
  <!-- small box -->
  <a href="index2.php" class="small-box-footer" style="background-color: #ffffff;">
    <div class="small-box" style="background-color: #399793 !important">
      <div class="inner" style="color: #000 !important">
        <h3 style="color: #black !important;font-weight: bold;"><?php

        $resulth = mysqli_query($bd, "SELECT count(*) as sm FROM orders WHERE user_id='$clientid' and tduration='Rush' and status='New'");
        $rowh = mysqli_fetch_array($resulth);
        echo $rowh['sm']; ?>
        </h3>

        <p style="color: black !important;font-weight: bold;">Rush Cases</p>
      </div>
      <div class="icon">
        <i class="fas fa-money-bill-alt"></i>
      </div>
      <i class="fas fa-arrow-circle-right" style="color: black;"></i>
  </a>
</div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
  <!-- small box -->
  <a href="pagination.php?type=<?php echo base64_encode('Completed') ?>&user_id=<?php echo base64_encode($clientid) ?>"
    class="small-box-footer" style="background-color: #ffffff;">
    <div class="small-box" style="background-color: #E6CF86 !important">
      <div class="inner">
        <h3 style="color:chartreuse !important;font-weight: bold;"> <?php
        $resulth = mysqli_query($bd, "SELECT count(*) as sm FROM orders WHERE user_id='$clientid' and status='Completed'");
        $rowh = mysqli_fetch_array($resulth);
        echo $rowh['sm'];
        ?>

        </h3>

        <p style="color:chartreuse !important;font-weight: bold;">Completed Cases</p>
      </div>
      <div class="icon">
        <i class="fas fa-dollar-sign"></i>
      </div>
      <i class="fas fa-arrow-circle-right" style="color:chartreuse;"></i>
  </a>
</div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
  <!-- small box -->
  <a href="pagination.php?type=<?php echo base64_encode('Hold') ?>&user_id=<?php echo base64_encode($clientid) ?>"
    class="small-box-footer" style="background-color: #ffffff;">
    <div class="small-box" style="background-color: #C01E22 !important">
      <div class="inner">
        <h3 style="color: red !important;font-weight: bold;">
          <?php
          $resulth = mysqli_query($bd, "SELECT count(*) as sm FROM orders WHERE user_id='$clientid' and status='Hold'");
          $rowh = mysqli_fetch_array($resulth);
          echo $rowh['sm'];
          ?>
        </h3>

        <p style="color: red !important;font-weight: bold;">Case On Hold</p>
      </div>
      <div class="icon">
        <i class="fas fa-money-bill-alt"></i>
      </div>
      <i class="fas fa-arrow-circle-right" style="color:red;"> </i>
  </a>
</div>
</div>
<!-- ./col -->

</div>


<!-- Small boxes (Stat box) -->
<div class="row">

  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <a href="index3.php" class="small-box-footer" style="background-color: #ffffff;">
      <div class="small-box" style="background-color: #FFFFFF !important">
        <div class="inner" style="color: #000 !important;font-weight: bold;">
          <h3 style="color: blueviolet !important"> <?php
          $resulth = mysqli_query($bd, "SELECT count(*) as sm FROM orders WHERE user_id='$clientid' and status='progress'");
          $rowh = mysqli_fetch_array($resulth);
          echo $rowh['sm'];
          ?>

          </h3>

          <p style="color: blueviolet !important;font-weight: bold;">In Progress</p>
        </div>
        <div class="icon">
          <i class="fas fa-tasks"></i>
        </div>
        <i class="fas fa-arrow-circle-right" style="color: blueviolet;"></i>
    </a>
  </div>
</div>

<div class="col-lg-3 col-6">
  <!-- small box -->
  <a href="index7.php" class="small-box-footer" style="background-color: #ffffff;">
    <div class="small-box" style="background-color: #399793 !important">
      <div class="inner">
        <h3 style="color: black !important;font-weight: bold;"><?php
        $resulth = mysqli_query($bd, "SELECT count(*) as sm FROM orders WHERE user_id='$clientid' and status='QC Required'");
        $rowh = mysqli_fetch_array($resulth);
        echo $rowh['sm'];

        ?>
        </h3>
        <p style="color: black !important;font-weight: bold;">QC Required</p>
      </div>
      <div class="icon">
        <i class="fas fa-money-bill-alt"></i>
      </div>
      <i class="fas fa-arrow-circle-right" style="color:black"></i>
  </a>
</div>
</div>
<div class="col-lg-3 col-6">
  <!-- small box -->
  <a href="pagination.php?type=<?php echo base64_encode('All') ?>&user_id=<?php echo base64_encode($clientid) ?>"
    class="small-box-footer" style="background-color: #ffffff;">
    <div class="small-box" style="background-color: #E6CF86 !important">
      <div class="inner">
        <h3 style="color: #399793 !important;font-weight: bold;"><?php
        $tdate = date('d-M-Y', strtotime('-1 day', strtotime(date("d-M-Y"))));
        $resulth = mysqli_query($bd, "SELECT count(*) as sm FROM orders WHERE user_id='$clientid'");
        $rowh = mysqli_fetch_array($resulth);
        echo $rowh['sm'];
        ?>

        </h3>

        <p style="color: #399793 !important;font-weight: bold;">All Cases</p>
      </div>
      <div class="icon">
        <i class="fas fa-tasks"></i>
      </div>
      <i class="fas fa-arrow-circle-right" style="color:#399793"></i>
  </a>
</div>
</div>
<div class="col-lg-3 col-6">
  <!-- small box -->
  <a href="pagination.php?type=<?php echo base64_encode('Cancel') ?>&user_id=<?php echo base64_encode($clientid) ?>"
    class="small-box-footer" style="background-color: #ffffff;">
    <div class="small-box" style="background-color: #C01E22  !important">
      <div class="inner">
        <h3 style="color: red !important;font-weight: bold;">
          <?php
          $resulth = mysqli_query($bd, "SELECT count(*) as sm FROM orders WHERE user_id='$clientid' and status='Cancel'");
          $rowh = mysqli_fetch_array($resulth);
          echo $rowh['sm'];
          ?>
        </h3>

        <p style="color: red !important;font-weight: bold;">Canceled Case</p>
      </div>
      <div class="icon">
        <i class="fas fa-money-bill-alt"></i>
      </div>
      <i class="fas fa-arrow-circle-right" style="color:red;"></i>
  </a>
</div>
</div>
</div>
<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <a href="index8.php" class="small-box-footer" style="background-color: #ffffff;">
      <div class="small-box" style="background-color: #FFFFFF !important">
        <div class="inner" style="color: blue;font-weight: bold;">
          <h3> <?php
          $tdate = date('d-M-Y', strtotime('-1 day', strtotime(date("d-M-Y"))));
          $cc = 0;
          $resulth = mysqli_query($bd, "SELECT created_at FROM orders WHERE user_id='$clientid'");
          while ($rowh = mysqli_fetch_array($resulth)) {

            if (strtotime($tdate) == strtotime(date("d-M-Y", strtotime($rowh['created_at']))))
              $cc++;
          }
          echo $cc;
          ?>

          </h3>

          <p style="color: blue;font-weight: bold;">Yesterday's Cases</p>
        </div>
        <div class="icon">
          <i class="fas fa-tasks"></i>
        </div>
        <i class="fas fa-arrow-circle-right" style="color:blue"></i>
    </a>
  </div>
</div>

<div class="col-lg-3 col-6">
  <!-- small box -->
  <a href="index10.php" class="small-box-footer" style="background-color: #ffffff;">
    <div class="small-box" style="background-color: #399793 !important">
      <div class="inner">
        <h3 style="color: #399793 !important;font-weight: bold;">
          <?php
          $tdate = date('d-M-Y');
          $cc = 0;
          $resulth = mysqli_query($bd, "SELECT created_at FROM orders WHERE user_id='$clientid'");
          while ($rowh = mysqli_fetch_array($resulth)) {

            if (strtotime($tdate) == strtotime(date("d-M-Y", strtotime($rowh['created_at']))))
              $cc++;
          }
          echo $cc;
          ?>

        </h3>
        <p style="color: #399793 !important;font-weight: bold;">Today's Cases</p>
      </div>
      <div class="icon">
        <i class="fas fa-money-bill-alt"></i>
      </div>
      <i class="fas fa-arrow-circle-right" style="color:#399793;"></i>
  </a>
</div>
</div>
</div>