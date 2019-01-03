<?php 
require_once "connect.php";
session_start();
$databaseConfig = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'login'
];
$databaseUtilDatabaseConn = mysqli_connect($databaseConfig['host'],$databaseConfig['username'],$databaseConfig['password'],$databaseConfig['database']);
$user = mysqli_query($databaseUtilDatabaseConn,"Select * from users");

// print_r($user);
$login = false;
if(isset($_SESSION['user'])){
    foreach($user as $newUser){
        if($newUser["name"] == $_SESSION['user']){
            echo "Welcome user ".$newUser['name'];
            if(isset($newUser["photo"]) && $newUser["photo"]){
                echo "<br> <img src='uploadss/".$newUser['photo']."' />";
            }
            $login = true;
            break;
        }
    }    
}else{
    header('Location: front.php');
}
?>  
<html>
<body>
<br>
<br>
<a href="logout1">Logout</a><br><br>
<a href = "update.php">Edit Account?</a>
<?php

echo "<hr>";

$obj = new connect();
$results  = $obj->select("*","users",1);

echo "<h3>ALL USERS</h3>";


for($i=0; $i<count($results);$i++){
    echo "Name :  <a href='update.php?user=".$results[$i]['id']."'>".$results[$i]['name']."</a> <br/>";
}


?>
</body>
</html>
