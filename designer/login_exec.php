    <?php
    //Start session    
    
    require_once('connect.php'); 
     if (isset($_SESSION['id'])) {
         header("location:home.php");
     }else{
    //Include database connection details
    
     
    //Array to store validation errors
    $errmsg_arr = array();
     
    //Validation error flag
    $errflag = false;
     
    //Function to sanitize values received from the form. Prevents SQL injection
    function clean($bd,$str) {
    $str = @trim($str);
    if(get_magic_quotes_gpc()) {
    $str = stripslashes($str);
    }
    return mysqli_real_escape_string($bd,$str);
    }
     
    //Sanitize the POST values
    $username = clean($bd,$_POST['id']);
    $password = clean($bd,$_POST['password']);
     
    //Input Validations
    if($username == '') {
    $errmsg_arr[] = 'Username missing';
    $errflag = true;
    }
    if($password == '') {
    $errmsg_arr[] = 'Password missing';
    $errflag = true;
    }
     
    //If there are input validations, redirect back to the login form
    if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
	?>
    <script>window.location="index.php";</script>
    <?php
	exit();
    }
     
    //Create query
    $qry="SELECT * FROM user1 WHERE em='$username' AND password='$password' and acpinid='1'";
    $result=mysqli_query($bd,$qry);
     
    //Check whether the query was successful or not    
    if(mysqli_num_rows($result) > 0) {
    //Login Successful
    session_regenerate_id();
    $member = mysqli_fetch_assoc($result);
    $_SESSION['id'] = $member['id'];
    $_SESSION['userid'] = $member['userid'];
    $_SESSION['email'] = $member['em'];
    $_SESSION['labname'] = $member['labname'];

    $_SESSION['name'] = $member['name'];
	
	$_SESSION['status'] = $member['status'];
    if (isset($_SESSION['pname'])) {
    $pname=$_SESSION['pname'];      
    $pprice=$_SESSION['pprice'];
    $imag=$_SESSION['imag'];
    $tdate=date("m/d/Y");
    mysqli_query($bd,"INSERT INTO product(mid,name,price,tdate,status,imag) VALUES('$username','$pname','$pprice','$tdate','N','$imag')");
    }

    session_write_close();
	?>
    <script>window.location="index.php";</script>
	<?php
    exit();
    }else {
              //  echo "  <script> alert('User Name Or Password Invalid');   <script>";

    //Login failed
    $errmsg_arr[] = 'user name and password not found';
    $errflag = true;
    if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
	?>
    <script>
        alert('User Name Or Password Invalid'); 
    window.location="index.php";</script>
	<?php
    exit();
    }
    }
  
}
    ?>