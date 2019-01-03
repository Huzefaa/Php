<?php 
    $databaseConfig = [
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'login'
    ];
    $databaseUtilDatabaseConn = mysqli_connect($databaseConfig['host'],$databaseConfig['username'],$databaseConfig['password'],$databaseConfig['database']);
    if(isset($_POST['number'])){
        //print_r($_POST);
        $number=$_POST['number'];

        $res = mysqli_query($databaseUtilDatabaseConn,"Select * from users where number = '".$number."'");
        $user= mysqli_fetch_array($res,MYSQLI_ASSOC);
        // print_r($user);

        if($number == $user['number']){
            $message = 'This is your password '.$user['password'];
            $msg=file_get_contents('http://api.msg91.com/api/sendhttp.php?country=91&sender=HUZEFA&route=4&mobiles='.$number.'&authkey=253656AgogVzSHgBob5c236755&message='.$message);
            // print_r($msg);
        }else{
            echo $error='this number is not register to any account';
        }
        $email = $_POST['email'];
        if($email == $user['email']){

        }else{
            echo $error='this email is not register to any account';
        }
    }
    if(mysqli_connect_errno()){
        die("Some Error occurred. Please try again later! ");
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>Forgot Password</title>
</head>
<body>
    <form action ="" method="POST">
    <p>Enter Your Mobile Number for Password</p>
    <input type="text" name="number" placeholder="Mobile Number" required>
    <br>
    <h3>or</h3>
    <p>Enter your email here for Password: </p>
    <input type="email" name = "email" placeholder = "Enter your Email"><br><br>
    <input type="submit" name="" value="Submit" ><br><br>
    <a href = "front.php">Return to Sign Up Page?</a>
    </form> 




</body>
</html>