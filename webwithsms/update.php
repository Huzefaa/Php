<?php
include 'connect.php';
session_start();
$email='';$name='';$number='';$password='';$city='';
if(isset($_REQUEST['user'])){
    $user_id = $_REQUEST['user'];
    if($user_id){
        $obj = new connect();
        $data = $obj->select('*','users','id = "'.$user_id.'"');
    //    print_r($data);
        $name=$data[0]['name'];
        $email=$data[0]['email'];
        $number=$data[0]['number'];
        $password=$data[0]['password'];
        $city=$data[0]['city'];
        $photo = $data[0]['photo'];
    }
    //unset($_SESSION['id']);
}

if(isset($_POST['username'])){
    $obj = new connect();
    $results  = $obj->select("*","users",1);
    $requestedUsername = $_POST['username']; 
    $requestedEmail = $_POST['email'];
    $requestedNumber = $_POST['number'];
    $requestedPassword = $_POST['password'];
    $requestedCity = $_POST['city'];
    $requestedPhoto = $_FILES['photo'];
    
    $value = "name='".$requestedUsername."',email='".$requestedEmail."',number='".$requestedNumber."',password='".$requestedPassword."',city='".$requestedCity."',photo='".$requestedPhoto."'";
    $obj->update("users",$value,'id ="'.$user_id.'"');//"Update users set name = 'Hozefa' where users.id = '1'";
    header('location:links.php');
}    

?>
<html>
<head>
<title>Account Update</title>
</head>
<body>
<form action = "" method = "POST">
    <p>Username:</p>
    <input type="text" required name="username"  placeholder="Enter Username" value="<?php echo $name ?>" > 
    <p>email:</p>
    <input type="email" required name="email" placeholder="Enter your Email" value = "<?php echo $email ?>"> 
    <p>Number:</p>
    <input type="number" required name="number" placeholder="Enter number" value = "<?php echo $number ?>"><br>
    <p>Password:</p>
    <input type="password" required name="password" placeholder="Enter password" value = "<?php echo $password ?>"><br><br>    
    City:<select name = "city" value = "<?php echo $city ?>">
    <option value="mumbai" <?php if($city=="mumbai"){ echo 'selected';} ?>>mumbai</option>
    <option value="panvel" <?php if($city=="panvel"){ echo 'selected';} ?>>panvel</option>
    <option value="vashi" <?php if($city=="vashi"){ echo 'selected';} ?>>vashi</option>
    <p>Select your photo: </p>
    <input type="file" name="photo" required value = "<?php echo $photo ?>">

    <br>
    <input type="submit" namespace="update" value="update">
    <br>
    <br>
<a href = "front.php">Back to sign up page?</a>
</form>
</body>
</html>