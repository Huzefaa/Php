<?php
include 'connect.php';

$obj = new connect();
$results  = $obj->select("*","users",1);

/*//This is use for displaying..
if(isset($_REQUEST['user'])){
    $id = $_REQUEST['user']; 

    $res= $obj->select('*','users','id="'.$id.'"');
    print_r($res);   
}
*/



?>
<html>
<head>
<title>
Links
</title>
</head>
<body>

<?php
for($i=0; $i<count($results);$i++){
    echo "Name :  <a href='update.php?user=".$results[$i]['id']."'>".$results[$i]['name']."</a> <br/>";
}


?>
</body>
</html>