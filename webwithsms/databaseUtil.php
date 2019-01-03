<?php 
/*
Functions needed in database
-> Get All Users
-> Check User Exists
-> Create User
-> Update
-> Delete
*/
$databaseConfig = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'login'
];
$databaseUtilDatabaseConn = mysqli_connect($databaseConfig['host'],$databaseConfig['username'],
$databaseConfig['password'],$databaseConfig['database']);
$getQuery = "Select * from users";
$res = mysqli_query($databaseUtilDatabaseConn,$getQuery);
$databaseUtilUsers = [];
if(mysqli_num_rows($res)){
    while($row = mysqli_fetch_assoc($res)){
        $newRow = [
            "name" => $row['name'],
            "email" => $row['email'],
            "passs" => $row['password'],
            "photo" => $row['photo']
        ];
        array_push($databaseUtilUsers,$newRow);
    }
}
// print_r($databaseUtilUsers);

function getAllUsers(){
    global $databaseUtilUsers;
    return $databaseUtilUsers;    
}

function checkUserExists($userName,$password = false){
    global $databaseUtilUsers;
    foreach($databaseUtilUsers as $databaseUtilSingleUser){
        if(isset($databaseUtilSingleUser['name']) && $databaseUtilSingleUser['name'] === $userName){
            if($password){
                if($databaseUtilSingleUser['passs'] == $password){
                    return true;
                }
                return false;
            }
            return true;
        }
    }
    return false;
}

function createUser($userDetails){
    global $databaseUtilUsers;
    global $databaseUtilDatabaseConn;
    

    if(isset($userDetails['username']) && isset($userDetails['email']) && isset($userDetails['password']) && isset($userDetails['number']) && isset($userDetails['photo'])){
        if(!checkUserExists($userDetails['username'])){
                // print_r(explode('/',$userDetails['photo']));
            $sql = "Insert Into users (name,email,password,number,city,photo) 
            values ('".$userDetails['username']."','".$userDetails["email"]."','".$userDetails['password']."','".$userDetails['number']."','".$userDetails['city']."','".$userDetails['photo']."')";

            // values ($_POST['username'],$_POST['email'],$_POST['password'])";

            if(mysqli_query($databaseUtilDatabaseConn,$sql) == TRUE){
                array_push($databaseUtilUsers,$sql);
                return ["error"=>false, "message"=>"Account Created"];

            }else{
                return ["error" => true,"message" => "<br><br>Error is ".mysqli_error($databaseUtilDatabaseConn) ];
            }

        }
        return ["error"=>true,"message"=>"Username Already Exists!"];
    }
    return ["error"=>true,"message"=>"Invalid Details Provided"];
}




?>