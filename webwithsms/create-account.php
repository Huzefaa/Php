<?php 

require_once "databaseUtil.php";
$errors=[];

// echo "<pre>";
// print_r($users);
// echo "</pre>";


if(isset($_POST['username']) && ($_POST['password']) && ($_POST['email']) && $_FILES['photo'] ){
    if(empty($_POST['username'])){
        array_push($errors,"You forgot your Username");        
    }
    if(empty($_POST['password'])){
        array_push($errors,"You forgot your Password");
    }
    if(empty($_POST['email'])){
        array_push($errors,"You forgot your email");
    }
    if(empty($_FILES['photo'])){
        array_push($errors,"You forgot to upload photo");
    }

    $requestedPhoto = $_FILES['photo']['name'];
    $alreadyexits = false;
     
    if(empty($errors)){
        if(checkUserExists($_POST['username'])){
            echo "Username already Exists";
            echo "<hr>";
            $alreadyexits = true;
        }
        
        if(!$alreadyexits){                          
            // $fileName = false;

            $uploaded=false;
            if(isset($_FILES["photo"])){
                $file = $_FILES["photo"];
                $fileName = time().$file['name'];
                $fileType = $file['type'];
                $allowedTypes = ['image/png','image/jpeg'];
                if(in_array($fileType,$allowedTypes)){
                    if($file['size'] < 1024 * 100){
                        $tempLocation = $file['tmp_name'];
                        if(!file_exists("uploadss")){
                            mkdir("uploadss");
                        }
                        $uploaded = move_uploaded_file($tempLocation,"uploadss/".$fileName);
                        if($uploaded){
                            echo "<br>";
                            echo "Photo Uploaded".$fileName;
                            echo "<br>";
                           
                        }else{
                            echo $fileName;
                            echo $tempLocation;
                            echo "Error";
                        }            
                    }else{
                        echo "Very Large File";
                    }
                }else{
                    echo "Invalid File Type";
                }
             
            }
            if($uploaded){
                $userDetails = ["username" => $_POST['username'],"email" => $_POST['email'],"password" => $_POST['password'],"number" =>$_POST['number'],"city"=>$_POST['city'],"photo"=>$fileName];
                $userCreation = createUser($userDetails);
                if($userCreation['error'] == false){
                    $_SESSION['user'] = $_POST['username'];
                    
                    // header("Location: welcome.php");
                    echo "<br>";
                    echo "Account Created";
                    echo "<br>";
                    echo "<hr>";
                }else{
                    array_push($errors,'Unable to connect to database');
                    array_push($errors,$userCreation['message']);
                }
            }
            
        }
    }
}

?>


<html>
<head>
<title>
Create Account
</title>
</head>
<body>
<h2>Welcom to Registration Page</h2>
<?php
if(count($errors)){
    echo "<ul>";
    foreach($errors as $singlerror){
        echo "<li>".$singlerror."</li>";
    }
    echo "</ul>";
}
?>
<form action="" method = "POST" enctype="multipart/form-data">
    <p>Username:</p>
    <input type="text" required name="username"  placeholder="Enter Username"  > 
    <p>email:</p>
    <input type="email" required name="email" placeholder="Enter your Email" > 
    <p>Password:</p>
    <input type="password" required name="password" placeholder="Enter password" ><br>
    <p>Number:</p>
    <input type="number" required name="number" placeholder="Enter number" ><br>
    <p>
    City:<select name = "city">
    <option value="mumbai">mumbai</option>
    <option value="panvel">panvel</option>
    <option value="vashi">vashi</option>
    </p><br>

    <p>Select your photo: </p>
    <input type="file" name="photo" required >
    <br><br>
    <input type="submit" value="Register">
    <br>
    <br>
    <a href="front.php" >Already have an account!!!</a>
</form>   
</body>
</html>