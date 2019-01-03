<?php 

session_start();
require_once "databaseUtil.php";
require_once "connect.php";
$error=[];
if(isset($_POST['username']) && ($_POST['password'])){
    if(empty($_POST['username'])){
        array_push($error,"You forgot your Username");        
    }
    if(empty($_POST['password'])){
        array_push($error,"You forgot your Password");
    }
    if(empty($error)){
        if(checkUserExists($_POST['username'],$_POST['password'])){
            $_SESSION['user'] = $_POST['username'];    
            $_REQUEST['user'] = $_POST['username'];
            $obj = new connect;  
            // code to update the otp down there.           
            $inserteduser = $obj->select('*','users','name="'.$_POST['username'].'"');
            //  print_r($inserteduser);
            if($inserteduser){   
                // $userEmail = $inserteduser[0]['email'];
                // $userName = $inserteduser[0]['name'];          
                $_SESSION['id'] = $inserteduser[0]['id'];
                $user_id = $inserteduser[0]['id'];
                $otp = rand(1000,9999);  
                $value = "otp='".$otp."'";
                $obj->update("users",$value,"id ='".$user_id."'");
                $message = 'This is your otp '.$otp;
                //$msg=file_get_contents('http://api.msg91.com/api/sendhttp.php?country=91&sender=HUZEFA&route=4&mobiles='.$inserteduser[0]['number'].'&authkey=253656AgogVzSHgBob5c236755&message='.$message);
                $array_data = array(
                    // 'from'=> 'HUZEFA' .'<huzefapoonawala1999@gmail.com>',
                    // 'to'=>$userName.'<'.$userEmail.'>',            
                    'from'=> 'HUZEFA' .'<huzefapoonawala1999@gmail.com>',
                    'to'=>'huzefa'.'<huzefapoonawala1999@gmail.com>',
                    'subject'=>'U r selected',
                    'html'=>'<h1>Welcome</h1>',
                    'text'=>'hello test',
                    'o:tracking'=>'yes',
                    'o:tracking-clicks'=>'yes',
                    'o:tracking-opens'=>'yes',
                );
                $ch = curl_init();
                curl_setopt_array($ch,[CURLOPT_URL=>'https://api.mailgun.net/v3/sandbox54b64a62ab2e482d84756e99b4ab447a.mailgun.org/messages',
                                        CURLOPT_RETURNTRANSFER=>1,
                                        CURLOPT_POST=>1,
                                        CURLOPT_ENCODING=>'UTF-8',
                                        CURLOPT_SSL_VERIFYPEER=>false,
                                        CURLOPT_POSTFIELDS=>$array_data,
                                        CURLOPT_USERPWD=>"api" . ":" . "af7eafe9dd381c915d97b6012304439d-49a2671e-5116246f"
                                        ]);
                $result = curl_exec($ch);
                if (curl_errno($ch)) {
                    echo 'Error:' . curl_error($ch);
                }
                curl_close ($ch);                                                                
                print_r($result);
                //print_r($msg);
                //header('location: verify.php');
            }    
            
        }else{
            array_push($error,"Wrong Credentials");
        }
    }
}
    if(!empty($error)){
        echo "<ul>";
        foreach($error as $errors){
            echo "<li>".$errors."</li>";
        }
        echo "</ul>";
    }
    if(isset($_SESSION['message'])){ 
        echo $_SESSION['message'];unset($_SESSION['message']); 
    }
?>



<html>
<head>
<title>Sigu Up Page</title>
</head>
<body>
<h2> Login Page</h2>
   <form action="" method="POST">
        <p>Username:</p>
        <input type="text" name="username" placeholder="Enter Username" required>
        <p>Password:</p>
        <input type="password" name="password" placeholder="Enter password" required>
        <input type="submit" name="" value="login" >
        <br>
        <br>
        <a href="create-account.php" >Don't have an account?</a>
        <br><br>
        <a href ="forgot.php">Forgot Password!!!</a>   
    </form> 
</body>

</html>