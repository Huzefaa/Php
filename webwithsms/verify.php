<?php 
session_start();
require_once 'connect.php';

$obj = new connect;
$res = $obj->select('*','users',"id = '".$_SESSION['id']."'");
// print_r($res);
$userotp = $res[0]['otp'];
if(isset($_POST['otp'])){
    $requestedotp = $_POST['otp'];

    if($userotp == $requestedotp){

        header('location: welcome.php');

    }else{
        echo "Login Failed";
    }
}
?>


<html>
<head></head>
<body>
<form method="POST">
<p>Enter your otp here : </p>
<input type="number" name = "otp" placeholder = "Enter your OTP"><br>

<a href = "front.php">Back to Sign up Page</a>
<input type="submit"/>
</form>
</body>
</html>