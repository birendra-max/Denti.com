<?php
include 'header.php';
$x = $_SESSION['id'];

if (isset($_POST['submit'])) {
  extract($_POST);

  $rr = mysqli_query($bd, "SELECT * FROM pin WHERE acpinid='$acpin' AND status='N' AND sale='Y'"); // check pin is available or not.

  if (mysqli_num_rows($rr) > 0) {

    $ff = mysqli_query($bd, "SELECT * FROM user WHERE id='$x' AND acpinid='$acpin'"); // check user is already activated or not.

    if (mysqli_num_rows($ff) > 0) {
      echo "<script>alert('You have already activated.')</script>";
    } else {

      mysqli_query($bd, "UPDATE pin SET status='Y' WHERE acpinid='$acpin'"); // set pin is used as
      mysqli_query($bd, "UPDATE user SET acpinid='$acpin' WHERE id='$x'"); // user pin is set here.

      $tdate = date("m/d/Y");

      //IT IS DIRECT COUNTING OF REFERAL THAT HOW MANY MEMBER IS ADDED DIRECT BY SELF

      $data = mysqli_query($bd, "SELECT * FROM user WHERE id='$x'");

      $roo = mysqli_fetch_assoc($data);

      $saveref2 = $mainref = $roo['direct'];
      $sponserid = $roo['sponserid'];

      mysqli_query($bd, "UPDATE `user` SET `counting`=`counting`+1 WHERE id='$mainref' AND acpinid<>0");

      // here added direct income 
      mysqli_query($bd, "INSERT INTO directincome(mid,amount,tdate) VALUES('$mainref','100','$tdate')");
      // end of direct income

      // ring income calculation start
      mysqli_query($bd, "UPDATE `user` SET `point`=`point`+1 WHERE id='$sponserid' AND acpinid<>0");
      $data = mysqli_query($bd, "SELECT * FROM user WHERE id='$sponserid'");
      //mysqli_query($bd,"UPDATE `user` SET `tuser`=`tuser`+1 WHERE id='RSV9999'");

      $roo = mysqli_fetch_assoc($data);

      $point = $roo['point'];
      $sp = $roo['sponserid'];
      if ($point == 4 and mysqli_num_rows(mysqli_query($bd, "SELECT * from llincome where mid='$sponserid' and amount='400' ")) < 1) {


        mysqli_query($bd, "INSERT INTO llincome(mid,amount,spid,todaydate) VALUES('$sponserid','400','$sp','$tdate')");

        mysqli_query($bd, "UPDATE `user` SET `tcount`=`tcount`+1 WHERE id='$sponserid' AND acpinid<>0");

      }

      //mysqli_query($bd,"UPDATE `user` SET `pleft`=`pleft`+1 WHERE id='$sponserid' AND acpinid<>0");


      function getTotalLegss1($bd, $memid, $leg, $table)
      {
        $sql = "SELECT * FROM user where sponserid='$memid' and side='$leg'";
        $res = mysqli_query($bd, $sql);
        $row = mysqli_fetch_array($res);
        global $total;


        if ($row['id'] != '') {
          $total = $row['id'];
          getTotalLegss1($bd, $row['id'], "1", $table);
          getTotalLegss1($bd, $row['id'], "2", $table);
          getTotalLegss1($bd, $row['id'], "3", $table);
          getTotalLegss1($bd, $row['id'], "4", $table);
        }
        return $total;
      }
      $data = mysqli_query($bd, "SELECT * FROM user WHERE id='$sponserid'");

      $roo = mysqli_fetch_assoc($data);

      if ($roo['pleft'] == 1) {
        mysqli_query($bd, "INSERT INTO llincome(mid,amount,spid,todaydate) VALUES('$sponserid','400','','$tdate')");

        if ($sponserid == 'RSV9999') {
          mysqli_query($bd, "INSERT into user1 select * from user where id='RSV9999'");
          mysqli_query($bd, "UPDATE `user` SET `side`='1' WHERE id='RSV9999'");
        } else {

          //
          mysqli_query($bd, "UPDATE `user` SET `dincome`=`dincome`+1 WHERE id='RSV9999'");
          $data = mysqli_query($bd, "SELECT * FROM user WHERE id='$sponserid'");

          $roo = mysqli_fetch_assoc($data);
          $id = $roo['id'];
          $name = $roo['name'];
          $tempvalue = $roo['tempvalue2'];
          $data2 = mysqli_query($bd, "SELECT * FROM user WHERE id='RSV9999'");

          $roo2 = mysqli_fetch_assoc($data2);

          $side = $roo2['dincome'] % 4;
          $total = 0;

          getTotalLegss1($bd, 'RSV9999', $side, 'user1');

          mysqli_query($bd, "INSERT into user1(name,id,tempvalue2,side) VALUES('$name','$id','$tempvalue2','$side')");
          //mysqli_query($bd,"UPDATE `user` SET `pright`=`pright`+1 WHERE id='$total'");

        }

      }





    }


    echo "<script>alert('You have activated successfully.')</script>";
    //echo "<script>window.location='index.php'</script>";


  }

} else {
  echo "<script>alert('This pin is not available.')</script>";

}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Activate Profile</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Activate Profile</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info">
          <div class="card-header">
            <h3 class="card-title">
              Profile Activation
            </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <form action="" method="post" enctype="multipart/form-data">
              <div class="card-body">

                <div class="form-group">
                  <label for="exampleInputPassword1">Enter Pin</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" name="acpin"
                    onblur="showHint(this.value)" placeholder="Enter activation pin" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Amount</label>
                  <div id="txtHint">
                    <input type="text" class="form-control" id="exampleInputPassword1" name="amount"
                      placeholder="Amount" required>
                  </div>
                </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" name="submit" class="btn btn-primary">Activate Now</button>
              </div>
            </form>




          </div>
        </div>
      </div>
    </div>
  </section>
</div>




<script>
  function showHint(str) {
    if (str.length == 0) {
      document.getElementById("txtHint").innerHTML = "";
      return;
    } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("txtHint").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET", "check_activation.php?q=" + str, true);
      xmlhttp.send();
    }
  }
</script>




<?php
include 'footer.php';
?>