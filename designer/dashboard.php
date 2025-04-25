<?php
function Total_row($bd, $status)
{
  if ($status == "All")

    $sql = "SELECT count(*) as cnt FROM orders";
  else
    $sql = "SELECT count(*) as cnt FROM orders where  status='$status'";
  $res = mysqli_query($bd, $sql);
  $row = mysqli_fetch_array($res);
  return $row['cnt'];
}

?>


<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <a href="index.php" class="small-box-footer">
      <div class="small-box " style="background-color: #399793 !important">
        <div class="inner" style="font-weight: bold;">
          <h3>
            <?php

            $resulth = mysqli_query($bd, "SELECT count(*) as sm FROM orders WHERE status='New'");
            $rowh = mysqli_fetch_assoc($resulth);
            echo $rowh['sm'];   ?>
          </h3>

          <p style="font-weight: bold;">New Cases</p>
        </div>
        <div class="icon">

        </div>
        <i class="fas fa-arrow-circle-right"></i>
    </a>
  </div>
</div>

<div class="col-lg-3 col-6">
  <!-- small box -->
  <a href="index2.php" class="small-box-footer">
    <div class="small-box" style="background-color: #E6CF86 !important">
      <div class="inner" style="color: #000 !important;font-weight: bold;">
        <h3>
          <?php

          $resulth = mysqli_query($bd, "SELECT count(*) as sm FROM orders WHERE  tduration='Rush' and status='New'");
          $rowh = mysqli_fetch_array($resulth);
          echo $rowh['sm'];   ?>
        </h3>
        <p style="color: #000 !important;font-weight: bold;">Rush Hour Cases</p>
      </div>
      <div class="icon">

      </div>
      <i class="fas fa-arrow-circle-right"></i>
  </a>
</div>
</div>
<div class="col-lg-3 col-6">
  <!-- small box -->
  <a href="index3.php" class="small-box-footer">
    <div class="small-box" style="background-color: #399793 !important">
      <div class="inner" style="font-weight: bold;">
        <h3> <?php
              $tdate = date('d-M-Y');
              $cc = 0;
              $resulth = mysqli_query($bd, "SELECT created_at FROM orders");
              while ($rowh = mysqli_fetch_array($resulth)) {

                if (strtotime($tdate) == strtotime(date("d-M-Y", strtotime($rowh['created_at']))))
                  $cc++;
              }
              echo $cc;
              ?>

        </h3>

        <p style="font-weight: bold;">Today Cases</p>
      </div>
      <div class="icon">

      </div>
      <i class="fas fa-arrow-circle-right"></i>
  </a>
</div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
  <!-- small box -->
  <a href="pagination.php?type=<?php echo base64_encode('All') ?>" class="small-box-footer">
    <div class="small-box" style="background-color: #E6CF86 !important">
      <div class="inner" style="font-weight: bold;">
        <h3 style="color: #000 !important"><?php
                                            $tdate = date('d-M-Y', strtotime('-1 day', strtotime(date("d-M-Y"))));
                                            $resulth = mysqli_query($bd, "SELECT count(*) as sm FROM orders");
                                            $rowh = mysqli_fetch_array($resulth);
                                            echo $rowh['sm'];
                                            ?>

        </h3>

        <p style="color: #000 !important;font-weight: bold;">All Cases</p>
      </div>
      <div class="icon">
        <i class="fas fa-tasks"></i>
      </div>
      <i class="fas fa-arrow-circle-right"></i>
  </a>
</div>
</div>

<!-- ./col -->
</div>
<!-- /.row -->
<!-- Main row -->
<div class="row">
  <!-- Left col -->

  <div class="col-lg-3 col-6">
    <!-- small box -->
    <a href="index55.php" class="small-box-footer">
      <div class="small-box" style="background-color: #399793 !important">
        <div class="inner" style="font-weight: bold;">
          <h3 style="color: #FFF !important"> <?php
                                              $resulth = mysqli_query($bd, "SELECT count(*) as sm FROM orders WHERE status='progress'");
                                              $rowh = mysqli_fetch_array($resulth);
                                              echo $rowh['sm'];
                                              ?>

          </h3>

          <p style="color: #FFF !important;font-weight: bold;">In Progress</p>
        </div>
        <div class="icon">
          <i class="fas fa-tasks"></i>
        </div>
        <i class="fas fa-arrow-circle-right"></i>
    </a>
  </div>
</div>

<div class="col-lg-3 col-6">
  <!-- small box -->
  <a href="index5.php" class="small-box-footer">
    <div class="small-box" style="background-color:#E6CF86 !important">
      <div class="inner" style="color: #000 !important;font-weight: bold;">
        <h3><?php

            $resulth = mysqli_query($bd, "SELECT count(*) as sm FROM orders WHERE tduration='Same Day'  and status='New'");
            $rowh = mysqli_fetch_array($resulth);
            echo $rowh['sm'];   ?>
        </h3>

        <p style="color: #000 !important;font-weight: bold;">6 Hour Cases</p>
      </div>
      <div class="icon">

      </div>
      <i class="fas fa-arrow-circle-right"></i>
  </a>
</div>
</div>
<!-- ./col -->
<!-- Left col -->
<div class="col-lg-3 col-6">
  <!-- small box -->
  <a href="index8.php" class="small-box-footer">
    <div class="small-box" style="background-color:#399793 !important">
      <div class="inner">
        <h3 style="color: #FFF !important;font-weight: bold;"><?php
                                                              $resulth = mysqli_query($bd, "SELECT count(*) as sm FROM orders WHERE status='QC Required'");
                                                              $rowh = mysqli_fetch_array($resulth);
                                                              echo $rowh['sm'];

                                                              ?>
        </h3>
        <p style="color: #FFF !important;font-weight: bold;">QC Required</p>
      </div>
      <div class="icon">
        <i class="fas fa-money-bill-alt"></i>
      </div>
      <i class="fas fa-arrow-circle-right"></i>
  </a>
</div>
</div>
<div class="col-lg-3 col-6">
  <!-- small box -->
  <a href="pagination.php?type=<?php echo base64_encode('Completed') ?>" class="small-box-footer">
    <div class="small-box" style="background-color: #E6CF86 !important">
      <div class="inner">
        <h3 style="color: #000 !important;font-weight: bold;"> <?php
                                                                $resulth = mysqli_query($bd, "SELECT count(*) as sm FROM orders WHERE status='Completed'");
                                                                $rowh = mysqli_fetch_array($resulth);
                                                                echo $rowh['sm'];
                                                                ?>

        </h3>

        <p style="color: #000 !important;font-weight: bold;">Completed Cases</p>
      </div>
      <div class="icon">
        <i class="fas fa-dollar-sign"></i>
      </div>
      <i class="fas fa-arrow-circle-right"></i>
  </a>
</div>
</div>


</div>

<div class="row">

  <div class="col-lg-3 col-6">
    <!-- small box -->
    <a href="pagination.php?type=<?php echo base64_encode('Cancel') ?>" class="small-box-footer">
      <div class="small-box" style="background-color: #C01E22 !important">
        <div class="inner" style="font-weight: bold;">
          <h3>
            <?php
            $resulth = mysqli_query($bd, "SELECT count(*) as sm FROM orders WHERE status='Cancel'");
            $rowh = mysqli_fetch_array($resulth);
            echo $rowh['sm'];
            ?>
          </h3>

          <p style="font-weight: bold;">Canceled Case</p>
        </div>
        <div class="icon">
          <i class="fas fa-money-bill-alt"></i>
        </div>
        <i class="fas fa-arrow-circle-right"></i>
    </a>
  </div>
</div>
<div class="col-lg-3 col-6">
  <!-- small box -->
  <a href="pagination.php?type=<?php echo base64_encode('Hold') ?>" class="small-box-footer">
    <div class="small-box" style="background-color: #C01E22 !important">
      <div class="inner" style="font-weight: bold;">
        <h3>
          <?php

          $resulth = mysqli_query($bd, "SELECT count(*) as sm FROM orders WHERE status='Hold'");
          $rowh = mysqli_fetch_assoc($resulth);
          echo $rowh['sm'];   ?>
        </h3>

        <p style="font-weight: bold;">Case On Hold</p>
      </div>
      <div class="icon">

      </div>
      <i class="fas fa-arrow-circle-right"></i>
  </a>
</div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
  <!-- small box -->
  <a href="index9.php" class="small-box-footer">
    <div class="small-box" style="background-color: #338884 !important">
      <div class="inner" style="color: #FFF;font-weight: bold;">
        <h3> <?php
              $tdate = date('d-M-Y', strtotime('-1 day', strtotime(date("d-M-Y"))));
              $cc = 0;
              $resulth = mysqli_query($bd, "SELECT created_at FROM orders");
              while ($rowh = mysqli_fetch_array($resulth)) {

                if (strtotime($tdate) == strtotime(date("d-M-Y", strtotime($rowh['created_at']))))
                  $cc++;
              }
              echo $cc;
              ?>

        </h3>

        <p style="color: #FFF;font-weight: bold;">Yesterday Cases</p>
      </div>
      <div class="icon">
        <i class="fas fa-tasks"></i>
      </div>
      <i class="fas fa-arrow-circle-right"></i>
  </a>
</div>
</div>


<div class="col-lg-3 col-6">
  <!-- Important Cases -->
  <a href="importantcase.php" class="small-box-footer">
    <div class="small-box" style="background-color: #338884 !important">
      <div class="inner" style="color: #FFF;font-weight: bold;">
        <h3> <?php
              $tdate = date('d-M-Y', strtotime('-1 day', strtotime(date("d-M-Y"))));
              $cc = 0;
              $resulth = mysqli_query($bd, "SELECT * FROM chatbox WHERE orderid not in(SELECT c1.orderid FROM chatbox as c1 , chatbox as c2 WHERE c1.orderid = c2.orderid and c1.user_type='user' and c2.user_type='SKYDENT TEAM');");
              while ($rowh = mysqli_fetch_array($resulth)) {
                  $cc++;
              }
              echo $cc;
              ?>

        </h3>

        <p style="color: #FFF;font-weight: bold;">Important & Alert Cases</p>
      </div>
      <div class="icon">
        <i class="fas fa-tasks"></i>
      </div>
      <i class="fas fa-arrow-circle-right"></i>
  </a>
</div>
</div>

</div>