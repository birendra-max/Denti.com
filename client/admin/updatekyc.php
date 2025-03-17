

    <?php
    session_start();
    include('connect.php');
	$x =  $_POST['mid'];
	extract($_POST);
	{

        if (!empty($_FILES['pic']['name'])) {
            
        $name = $_FILES['pic']['name'];
        $tmp_name =  $_FILES['pic']['tmp_name'];
        $location = "images/";
        $new_name = $location.time()."-".rand(1000, 9999)."-".$name;
        
        $allowed = array('gif', 'png', 'jpg','bmp','BMP','JPG','JPEG','PNG');
        $filename = $_FILES['pic']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (in_array($ext, $allowed)) {
            
        if (move_uploaded_file($tmp_name, $new_name)){

                mysqli_query($bd,"update user set pic='$new_name' where id='$x'");            
                }
        }
    }

      if (!empty($_FILES['aadhar']['name'])) {
            
        $name = $_FILES['aadhar']['name'];
        $tmp_name =  $_FILES['aadhar']['tmp_name'];
        $location = "images/";
        $new_name = $location.time()."-".rand(1000, 9999)."-".$name;
        
           $allowed = array('gif', 'png', 'jpg','bmp','BMP','JPG','JPEG','PNG');
        $filename = $_FILES['aadhar']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (in_array($ext, $allowed)) {
            
        if (move_uploaded_file($tmp_name, $new_name)){

                mysqli_query($bd,"update userkyc set aadhar='$new_name' where id='$x'");            
                }
        }
    }


      if (!empty($_FILES['pan']['name'])) {
            
        $name = $_FILES['pan']['name'];
        $tmp_name =  $_FILES['pan']['tmp_name'];
        $location = "images/";
        $new_name = $location.time()."-".rand(1000, 9999)."-".$name;
        
        $allowed = array('gif', 'png', 'jpg','bmp','BMP','JPG','JPEG','PNG');
        $filename = $_FILES['pan']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (in_array($ext, $allowed)) {
            
        if (move_uploaded_file($tmp_name, $new_name)){

                mysqli_query($bd,"update userkyc set pan='$new_name' where id='$x'");            
                }
        }
    }

     if (!empty($_FILES['doc1']['name'])) {
            
        $name = $_FILES['doc1']['name'];
        $tmp_name =  $_FILES['doc1']['tmp_name'];
        $location = "images/";
        $new_name = $location.time()."-".rand(1000, 9999)."-".$name;
        
          $allowed = array('gif', 'png', 'jpg','bmp','BMP','JPG','JPEG','PNG');
        $filename = $_FILES['doc1']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (in_array($ext, $allowed)) {
        if (move_uploaded_file($tmp_name, $new_name)){

                mysqli_query($bd,"update userkyc set doc1='$new_name' where id='$x'");            
                }
        }
    }



     if (!empty($_FILES['doc2']['name'])) {
            
        $name = $_FILES['doc2']['name'];
        $tmp_name =  $_FILES['doc2']['tmp_name'];
        $location = "images/";
        $new_name = $location.time()."-".rand(1000, 9999)."-".$name;
        
         
          $allowed = array('gif', 'png', 'jpg','bmp','BMP','JPG','JPEG','PNG');
        $filename = $_FILES['doc2']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (in_array($ext, $allowed)) {
        if (move_uploaded_file($tmp_name, $new_name)){

                mysqli_query($bd,"update userkyc set doc2='$new_name' where id='$x'");            
                }
        }
    }
    


    
	}
        

	?>
    <script> 
        alert("Your KYC details is updated successfully.");
    window.location="allmember.php";
</script>
   