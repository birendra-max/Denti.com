<?php
include 'header.php';



if (isset($_POST['submit'])) {
  $id=$_POST['id'];
  $rr=mysqli_query($bd,"SELECT * FROM product_item1 WHERE id=$id");
  $row=mysqli_fetch_assoc($rr);
  if(unlink($row['image']))
  {
  if (mysqli_query($bd,"DELETE FROM product_item1 WHERE id=$id")) {
    echo "<script>alert('You have deleted successfully.')</script>";  
    }else
    {
      echo "<script>alert('Sorry can not be deleted this item.')</script>";       
    } 
  }else
  {

    echo "<script>alert('Image file can not be deleted.')</script>";        
  }
}


?>

<style type="text/css"> 

  .sty
  {
    box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.5);
    padding: 25px;    
    border-radius: 2%;
    margin:25px;
  }
  .sty:hover
  {
    box-shadow: 4px 4px 8px 8px rgba(0,0,0,0.8);
    transition: 0.2s ease-out;
  }
</style>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Product List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <hr>
                      <h2 class="text-center"><b>Product List</b></h2>
                      <hr>
                        
                            <?php
                            $i=0;
                            $rr=mysqli_query($bd,"SELECT * FROM product_item1");
                            while ($row=mysqli_fetch_assoc($rr)) {
                              if ($i%3==0) {
                                ?>
                                <div class="row">
                                <?php
                              }
                              ?>
                            <div class="col-sm-3 sty">
                              <center>
                              <img src="<?php echo $row['image'] ?>" width="250" height="250"><br>
                              <h4 style="color:#000;font-size: 22px;font-weight: bold;"><?php echo $row['name'] ?></h4><br>   
                              <h5 style="color:green;font-size: 22px;"> <span class="fa fa-inr"></span> <?php echo $row['amount'] ?></h5><br>
                              <div class="row">
                                  <div class="col-sm-6">
                                      <form action="" method="post">
                                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                        <input type="submit" name="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are sure to delete this item')">
                                      </form>  
                                </div>
                                <div class="col-sm-6">
                                  <a href="proupdate1.php?idd=<?php echo $row['id'] ?>" onclick="return confirm('Are sure to update this item')" class="btn btn-info">Update</a>
                                       
                                </div>
                              </div>
                              </center>
                            </div>
                            <?php
                            $i++;
                              if ($i%3==0) {
                                ?>
                                </div>
                                <?php
                              }
                              ?>
                              <?php
                              
                            }
                            ?>
                      </div>
                  </div>
                </div>
            </div>

          </div>
      </section>
    </div>

    




<?php
include 'footer.php';
?>