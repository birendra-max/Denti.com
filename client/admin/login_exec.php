

    <?php
    //Start session
    //session_start();
     
    //Include database connection details
    require_once('connect.php');
     
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
    $qry="SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result=mysqli_query($bd,$qry);
    
     
    //Check whether the query was successful or not
    if($result) {
    if(mysqli_num_rows($result) > 0) {
    //Login Successful
    $member = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $member['username'];
    
    session_write_close();
	?>
    <script>window.location="index.php";</script>
    <?php
	exit();
    }else {
    //Login failed
    $errmsg_arr[] = 'user name and password not found';
    $errflag = true;
    if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
	?>
    <script>window.location="login.php";</script>
	<?php
	echo "user name and password not found";
    exit();
    }
    }
    }else {
    die("Query failed");
    }
    ?>