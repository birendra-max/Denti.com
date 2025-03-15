

    <?php
    session_start();
    include('connect.php');
	$x = $_POST['mid'];
	extract($_POST);
	{
    mysqli_query($bd,"update bank set phonepe='$phonepe',googlepay='$googlepay',paytm='$paytm' where id='$x'");
	}
        

	?>
    <script> 
        alert("Your bank details is updated successfully.We can enable to transfer amount in your bank account.");
    window.location="allmember.php";
</script>
   