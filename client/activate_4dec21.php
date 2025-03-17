
<?php
include 'header.php';
$x=$_SESSION['id'];

    if (isset($_POST['submit'])) {
      extract($_POST);

    $rr=mysqli_query($bd,"SELECT * FROM pin WHERE acpinid='$acpin' AND status='N' AND sale='Y'"); // check pin is available or not.

    if (mysqli_num_rows($rr)>0) {

      $ff=mysqli_query($bd,"SELECT * FROM user WHERE id='$x' AND acpinid='$acpin'"); // check user is already activated or not.

      if (mysqli_num_rows($ff)>0) {
        echo "<script>alert('You have already activated.')</script>";
      }else{

      mysqli_query($bd,"UPDATE pin SET status='Y' WHERE acpinid='$acpin'"); // set pin is used as
      mysqli_query($bd,"UPDATE user SET acpinid='$acpin' WHERE id='$x'"); // user pin is set here.
  
  $tdate=date("m/d/Y");

//IT IS DIRECT COUNTING OF REFERAL THAT HOW MANY MEMBER IS ADDED DIRECT BY SELF

      $data=mysqli_query($bd,"SELECT * FROM user WHERE id='$x'");

      $roo=mysqli_fetch_assoc($data);

      $saveref2=$mainref=$roo['direct'];

    mysqli_query($bd,"UPDATE `user` SET `counting`=`counting`+1 WHERE id='$mainref' AND acpinid<>0");

    // here added direct income 
     mysqli_query($bd,"INSERT INTO directincome(mid,amount,tdate) VALUES('$mainref','100','$tdate')"); 
     // end of direct income
    //now here going for autopool income     
    $auto=mysqli_query($bd,"SELECT * FROM user WHERE id='$mainref' AND counting>=2");
    if (mysqli_num_rows($auto)>0) {
      
      $auto=mysqli_query($bd,"SELECT * FROM autopooluser WHERE mid='$mainref'");
        if (mysqli_num_rows($auto)<1) {
          $auto=mysqli_query($bd,"SELECT * FROM autopooluser");
        if (mysqli_num_rows($auto)<1) 
        {
          mysqli_query($bd,"INSERT INTO autopooluser(mid,level,side,tot,amount,sponserid,todaydate) VALUES('$mainref','0','0','0','0','0','$tdate')");
        }else
        {
            $auto=mysqli_query($bd,"SELECT * FROM autopooluser WHERE tot<3");
            $rowauto=mysqli_fetch_assoc($auto);
            if($rowauto['tot']==0)
             {
              mysqli_query($bd,"INSERT INTO autopooluser(mid,level,side,tot,amount,sponserid,todaydate) VALUES('$mainref','0','L','0','0','$rowauto[mid]','$tdate')");             
             } 
             if($rowauto['tot']==1)
             {
              mysqli_query($bd,"INSERT INTO autopooluser(mid,level,side,tot,amount,sponserid,todaydate) VALUES('$mainref','0','M','0','0','$rowauto[mid]','$tdate')");             
             } 
             if($rowauto['tot']==2)
             {
              mysqli_query($bd,"INSERT INTO autopooluser(mid,level,side,tot,amount,sponserid,todaydate) VALUES('$mainref','0','R','0','0','$rowauto[mid]','$tdate')");             
             } 
            $auto=mysqli_query($bd,"SELECT * FROM autopooluser WHERE mid='$rowauto[mid]'");
            $sp=$rowauto['mid'];
            $amnt=$rowauto['amount']+10;
            $t=$rowauto['tot']+1;
            $le=$rowauto['level']+1;
             do
             {              
                mysqli_query($bd,"UPDATE autopooluser SET tot='$t',amount='$amnt' WHERE mid='$sp'");
                $auto=mysqli_query($bd,"SELECT * FROM autopooluser WHERE mid='$sp'");
                $ro=mysqli_fetch_assoc($auto);
                $sp=$ro['sponserid'];
                $t=$ro['tot']+1;
                $amnt=$ro['amount']+10;
             }while($sp!=0);


        }
    }

    }
       


//calculating leadership level income
    $x=$_SESSION['id'];
    $spo=$x;
$i=1;
do{
      $lli=mysqli_query($bd,"SELECT sponserid FROM user WHERE id='$spo'");
      $rowlli=mysqli_fetch_assoc($lli);
      $spo=$rowlli['sponserid'];
      //echo "<script>alert('sponser id $spo')</script>";
      //echo "<script>alert('i of value $i')</script>";
      $lli1=mysqli_query($bd,"SELECT * FROM user WHERE id='$spo' AND acpinid!='0'");
      $rowlli1=mysqli_fetch_assoc($lli1);
      if ($i<=10 AND mysqli_num_rows($lli1)>0) {        
        if ($i==1) 
          mysqli_query($bd,"INSERT INTO llincome(mid,amount,spid,todaydate) VALUES('','0','','$tdate')");
        if ($i==2) 
          mysqli_query($bd,"INSERT INTO llincome(mid,amount,spid,todaydate) VALUES('$spo','10','$x','$tdate')");
        if ($i==3) 
          mysqli_query($bd,"INSERT INTO llincome(mid,amount,spid,todaydate) VALUES('$spo','6','$x','$tdate')");
        if ($i==4) 
          mysqli_query($bd,"INSERT INTO llincome(mid,amount,spid,todaydate) VALUES('$spo','5','$x','$tdate')");
        if ($i==5) 
          mysqli_query($bd,"INSERT INTO llincome(mid,amount,spid,todaydate) VALUES('$spo','5','$x','$tdate')");
        if ($i==6) 
          mysqli_query($bd,"INSERT INTO llincome(mid,amount,spid,todaydate) VALUES('$spo','2.4','$x','$tdate')");
        if ($i==7) 
          mysqli_query($bd,"INSERT INTO llincome(mid,amount,spid,todaydate) VALUES('$spo','2.4','$x','$tdate')");
        if ($i==8) 
          mysqli_query($bd,"INSERT INTO llincome(mid,amount,spid,todaydate) VALUES('$spo','4','$x','$tdate')");
        if ($i==9) 
          mysqli_query($bd,"INSERT INTO llincome(mid,amount,spid,todaydate) VALUES('$spo','4','$x','$tdate')");
        if ($i==10) 
          mysqli_query($bd,"INSERT INTO llincome(mid,amount,spid,todaydate) VALUES('$spo','5','$x','$tdate')");
        $i++;
      }
      if ($i>10 OR $spo=='0') 
        break;
}while($spo!='0');//end of while of leader and direct income


//IT INCREASE THE LEFT AND RIGHT BALANCE


$gf=0;

// pair income and reward calculation
  function pbalance($bd,$sp,$side)
  {
  if ($sp!='0') {     
    $rr=mysqli_query($bd,"SELECT * FROM user WHERE id='$sp'");
    $gg=mysqli_fetch_assoc($rr);
    if ($gg['acpinid']!=0) {  


      $tdate=date("m/d/Y");


      $date2=strtotime(date('m/d/Y'));
      $date1=strtotime(date("m/d/Y",strtotime($gg['todaydate'])));
      $diff = abs($date2 - $date1);              
  
  
      // To get the year divide the resultant date into 
      // total seconds in a year (365*60*60*24) 
      $nodays = floor($diff / (60*60*24));  


      // Start of rewad calculation
      //  if ($gg['pleft']>=5 AND $gg['pright']>=5 AND $nodays<=7) {
        
      //   $rrk=mysqli_query($bd,"SELECT count(*) as cnn FROM reward WHERE mid='$sp' AND ramount='Wallet'");
      //   $ggk=mysqli_fetch_assoc($rrk);
      //   if($ggk['cnn']>0)
      //   {

      //   }else
      //   {
      //   mysqli_query($bd,"INSERT INTO reward(mid,ramount,todaydate,status,type,desig)VALUES('$sp','Wallet','$tdate','N','Advisor')");
      //   }        
      // }

      // if ($gg['pleft']>=10 AND $gg['pright']>=10 AND $nodays<=15) {
        
      //   $rrk=mysqli_query($bd,"SELECT count(*) as cnn FROM reward WHERE mid='$sp' AND ramount='Shirt'");
      //   $ggk=mysqli_fetch_assoc($rrk);
      //   if($ggk['cnn']>0)
      //   {

      //   }else
      //   {
      //   mysqli_query($bd,"INSERT INTO reward(mid,ramount,todaydate,status,type,desig)VALUES('$sp','Shirt','$tdate','N','Promoter')");
      //   }   

      // }
      if ($gg['pleft']>=25 AND $gg['pright']>=25 AND $gg['counting']>=5) {

         $rrk=mysqli_query($bd,"SELECT count(*) as cnn FROM reward WHERE mid='$sp' AND ramount='Star Level'");
        $ggk=mysqli_fetch_assoc($rrk);
        if($ggk['cnn']>0)
        {

        }else
        {
        mysqli_query($bd,"INSERT INTO reward(mid,ramount,amount,todaydate,status,type)VALUES('$sp','Star Level','4000','$tdate','N','Team Leader')");
        }   
      }

      if ($gg['pleft']>=50 AND $gg['pright']>=50 AND $gg['counting']>=5) {

         $rrk=mysqli_query($bd,"SELECT count(*) as cnn FROM reward WHERE mid='$sp' AND ramount='Silver'");
        $ggk=mysqli_fetch_assoc($rrk);
        if($ggk['cnn']>0)
        {

        }else
        {
        mysqli_query($bd,"INSERT INTO reward(mid,ramount,amount,todaydate,status,type)VALUES('$sp','Silver','8000','$tdate','N','Bronze')");
        }   
      }


      if ($gg['pleft']>=100 AND $gg['pright']>=100 AND $gg['counting']>=5) {

         $rrk=mysqli_query($bd,"SELECT count(*) as cnn FROM reward WHERE mid='$sp' AND ramount='Gold'");
        $ggk=mysqli_fetch_assoc($rrk);
        if($ggk['cnn']>0)
        {

        }else
        {
        mysqli_query($bd,"INSERT INTO reward(mid,ramount,amount,todaydate,status,type)VALUES('$sp','Gold','16000','$tdate','N','Silver')");
        }   
      }

        if ($gg['pleft']>=210 AND $gg['pright']>=210 AND $gg['counting']>=10) {

         $rrk=mysqli_query($bd,"SELECT count(*) as cnn FROM reward WHERE mid='$sp' AND ramount='Gold Star'");
        $ggk=mysqli_fetch_assoc($rrk);
        if($ggk['cnn']>0)
        {

        }else
        {
        mysqli_query($bd,"INSERT INTO reward(mid,ramount,amount,todaydate,status,type)VALUES('$sp','Gold Star','33600','$tdate','N','Gold')");
        }   
      }

    if ($gg['pleft']>=450 AND $gg['pright']>=450 AND $gg['counting']>=10) {

         $rrk=mysqli_query($bd,"SELECT count(*) as cnn FROM reward WHERE mid='$sp' AND ramount='Diamond'");
        $ggk=mysqli_fetch_assoc($rrk);
        if($ggk['cnn']>0)
        {

        }else
        {
        mysqli_query($bd,"INSERT INTO reward(mid,ramount,amount,todaydate,status,type)VALUES('$sp','Diamond','72000','$tdate','N','Star')");
        }   
      }


       if ($gg['pleft']>=950 AND $gg['pright']>=950 AND $gg['counting']>=10) {

         $rrk=mysqli_query($bd,"SELECT count(*) as cnn FROM reward WHERE mid='$sp' AND ramount='Diamond Star'");
        $ggk=mysqli_fetch_assoc($rrk);
        if($ggk['cnn']>0)
        {

        }else
        {
        mysqli_query($bd,"INSERT INTO reward(mid,ramount,amount,todaydate,status,type)VALUES('$sp','Diamond Star','152000','$tdate','N','Ruby')");
        }   
      }

      if ($gg['pleft']>=2000 AND $gg['pright']>=2000 AND $gg['counting']>=10) {

         $rrk=mysqli_query($bd,"SELECT count(*) as cnn FROM reward WHERE mid='$sp' AND ramount='Pearl'");
        $ggk=mysqli_fetch_assoc($rrk);
        if($ggk['cnn']>0)
        {

        }else
        {
        mysqli_query($bd,"INSERT INTO reward(mid,ramount,amount,todaydate,status,type)VALUES('$sp','Pearl','320000','$tdate','N','Crown')");
        }   
      }


    if ($gg['pleft']>=4500 AND $gg['pright']>=4500 AND $gg['counting']>=10) {

         $rrk=mysqli_query($bd,"SELECT count(*) as cnn FROM reward WHERE mid='$sp' AND ramount='Pearl Star'");
        $ggk=mysqli_fetch_assoc($rrk);
        if($ggk['cnn']>0)
        {

        }else
        {
        mysqli_query($bd,"INSERT INTO reward(mid,ramount,amount,todaydate,status,type)VALUES('$sp','Pearl Star','720000','$tdate','N','Diamond')");
        }   
      }

       if ($gg['pleft']>=9500 AND $gg['pright']>=9500 AND $gg['counting']>=10) {

         $rrk=mysqli_query($bd,"SELECT count(*) as cnn FROM reward WHERE mid='$sp' AND ramount='Ruby'");
        $ggk=mysqli_fetch_assoc($rrk);
        if($ggk['cnn']>0)
        {

        }else
        {
        mysqli_query($bd,"INSERT INTO reward(mid,ramount,amount,todaydate,status,type)VALUES('$sp','Ruby','1520000','$tdate','N','Double Diamond')");
        }   
      }

        if ($gg['pleft']>=19500 AND $gg['pright']>=19500 AND $gg['counting']>=10) {

         $rrk=mysqli_query($bd,"SELECT count(*) as cnn FROM reward WHERE mid='$sp' AND ramount='Ruby Star'");
        $ggk=mysqli_fetch_assoc($rrk);
        if($ggk['cnn']>0)
        {

        }else
        {
        mysqli_query($bd,"INSERT INTO reward(mid,ramount,amount,todaydate,status,type)VALUES('$sp','Ruby Star','3120000','$tdate','N','Emerald')");
        }   
      }


        if ($gg['pleft']>=40200 AND $gg['pright']>=40200 AND $gg['counting']>=10) {

         $rrk=mysqli_query($bd,"SELECT count(*) as cnn FROM reward WHERE mid='$sp' AND ramount='Ambestor'");
        $ggk=mysqli_fetch_assoc($rrk);
        if($ggk['cnn']>0)
        {

        }else
        {
        mysqli_query($bd,"INSERT INTO reward(mid,ramount,amount,todaydate,status,type)VALUES('$sp','Ambestor','6432000','$tdate','N','Co-Partner')");
        }   
      }


      if ($gg['pleft']>=80500 AND $gg['pright']>=80500 AND $gg['counting']>=10) {

         $rrk=mysqli_query($bd,"SELECT count(*) as cnn FROM reward WHERE mid='$sp' AND ramount='Core Ambestor'");
        $ggk=mysqli_fetch_assoc($rrk);
        if($ggk['cnn']>0)
        {

        }else
        {
        mysqli_query($bd,"INSERT INTO reward(mid,ramount,amount,todaydate,status,type)VALUES('$sp','Core Ambestor','1288000','$tdate','N','10% Profit Share(Life Time)')");
        }   
      }

       if ($gg['pleft']>=161500 AND $gg['pright']>=161500 AND $gg['counting']>=10) {

         $rrk=mysqli_query($bd,"SELECT count(*) as cnn FROM reward WHERE mid='$sp' AND ramount='Double Core Ambestor'");
        $ggk=mysqli_fetch_assoc($rrk);
        if($ggk['cnn']>0)
        {

        }else
        {
        mysqli_query($bd,"INSERT INTO reward(mid,ramount,amount,todaydate,status,type)VALUES('$sp','Double Core Ambestor','1288000','$tdate','N','10% Profit Share(Life Time)')");
        }   
      }  
      // end of reward calculation.

    }
  }else
  {
    return;
  }
      $ff=mysqli_query($bd,"SELECT * FROM user WHERE id='$sp'");
      $row=mysqli_fetch_assoc($ff);      
      $gf=2;
      pbalance($bd,$row['sponserid'],$row['side']);
    
  } // end of pair and reward calculation.



  
  function balance($bd,$sp,$side)
  {
     //$ll="";
    //global $gf;

    if ($sp!='0') {     
    //echo "<script>alert('$sp')</script>";
    $rr=mysqli_query($bd,"SELECT * FROM user WHERE id='$sp'");
    $gg=mysqli_fetch_assoc($rr);

    if ($gg['acpinid']!=0) {
      
      if ($side=="left") {      
           if(empty($gg['pleft']))
            $ll=1;
          else
            $ll=$gg['pleft']+1;
               // pair income calculated
      if ($gg['counting']>=2) {

        $tdate=date("m/d/Y");
        if($gg['pright']>=$gg['pleft'])
        mysqli_query($bd,"INSERT INTO pincome(mid,amount,tdate)VALUES('$sp','100','$tdate')");
      }
      //end of pair income calculation



          //echo "<script>alert('$sp')</script>";
          //echo "<script>alert('$ll')</script>";
        mysqli_query($bd,"UPDATE user SET pleft='$ll' WHERE id='$sp'");             

      }else{     
       
          if(empty($gg['pright']))
            $ll=1;
          else
            $ll=$gg['pright']+1;          

      // pair income calculated
      if ($gg['counting']>=2) {

        $tdate=date("m/d/Y");
        if($gg['pleft']>=$gg['pright'])
        mysqli_query($bd,"INSERT INTO pincome(mid,amount,tdate)VALUES('$sp','100','$tdate')");
      }
      //end of pair income calculation


          //echo "<script>alert('$sp')</script>";
          //echo "<script>alert('$ll')</script>";
        mysqli_query($bd,"UPDATE user SET pright='$ll' WHERE id='$sp'");        
      }

      }
      
    }else
    {
      return;
    }
    $ff=mysqli_query($bd,"SELECT * FROM user WHERE id='$sp'");
      $row=mysqli_fetch_assoc($ff);            
      balance($bd,$row['sponserid'],$row['side']); 
         
  } // end of left and right balancing.
  

//INCREAMENTING ALL MEMBER OF LEFT AND RIGHT BALANCING
  $x=$_SESSION['id'];
    $fff=mysqli_query($bd,"SELECT * FROM user WHERE id='$x'");
    $rs=mysqli_fetch_assoc($fff);

    $savemember1=$member1=$ownid=$dirref=$rs['sponserid'];

    //echo "<script>alert('$rs[side]');</script>";
    balance($bd,$ownid,$rs['side']);  
     

        
  //HERE PAIR INCOME AND REWARD OF CALCULATION
    pbalance($bd,$dirref,$rs['side']);  


echo "<script>alert('You have activated successfully.')</script>";
 //echo "<script>window.location='index.php'</script>";

}
}else
{
  echo "<script>alert('This pin is not available.')</script>";
}



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
                    <input type="text" class="form-control" id="exampleInputPassword1" name="acpin" onblur="showHint(this.value)" placeholder="Enter activation pin" required>
                  </div>                  
                    <div class="form-group">
                      <label for="exampleInputPassword1">Amount</label>
                      <div id="txtHint">                  
                      <input type="text" class="form-control" id="exampleInputPassword1" name="amount" placeholder="Amount" required>
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
    xmlhttp.onreadystatechange = function() {
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