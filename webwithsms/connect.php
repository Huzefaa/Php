<?php
$accessurl =  basename($_SERVER['PHP_SELF']);
if ($accessurl == 'connect.php') {
    header('HTTP/1.0 403 Forbidden');
    exit('Forbidden');
}
/* Connect Class Defination Starts Here */
class connect
{
private $conn = "";
	
	/* Construction For Database Connection */
	function __construct()
	{
		$this -> conn = new mysqli("localhost","root","","login");
	}
	
	/* Select Function Starts Here */
	function select($fields,$table,$condition)
        {
     
		    $str="select ".$fields." from ".$table." where ".$condition ;
      $result=$this-> conn -> query($str) or die($this-> conn -> error);
      // print_r($result); 
            if($result->num_rows > 0)
            {
                $count=0;
                while($row=$result->fetch_array(MYSQLI_ASSOC))
                {
                    $data[$count]=$row;
                    $count ++;   
                }
                return $data;
            }
        }
	/* Select Function Ends Here */
	
	/* Insert Function Starts Here */
	function insert($table,$fields,$value)
	{
	$sql = "Insert into ".$table.$fields. "values" .$value;
  $inserted = $this -> conn -> query($sql) or die($this -> conn -> error);
  if($inserted){
    return true;
  }else{
    return false;
  }
	}
	/* Insert Function Ends Here */	

	/* Update Function Starts Here */	
	function update($table,$value,$condition)
	{
    $sql = "Update ".$table." set ".$value." where ".$condition;
    //echo $sql;
		$this -> conn -> query($sql) or die($this -> conn -> error);
	}
	/* Update Function Ends Here */		
	
	/* Delete Function Starts Here */	
	function delete($table,$condition)
	{
		$sql = "Delete from ".$table." where ".$condition;
		$this -> conn -> query($sql) or die($this -> conn -> error);
	}
	/* Delete Function Ends Here */	
	
function assign_rand_value($num)
{
// accepts 1 - 36
  switch($num)
  {
    case "1":
     $rand_value = "a";
    break;
    case "2":
     $rand_value = "b";
    break;
    case "3":
     $rand_value = "c";
    break;
    case "4":
     $rand_value = "d";
    break;
    case "5":
     $rand_value = "e";
    break;
    case "6":
     $rand_value = "f";
    break;
    case "7":
     $rand_value = "g";
    break;
    case "8":
     $rand_value = "h";
    break;
    case "9":
     $rand_value = "i";
    break;
    case "10":
     $rand_value = "j";
    break;
    case "11":
     $rand_value = "k";
    break;
    case "12":
     $rand_value = "l";
    break;
    case "13":
     $rand_value = "m";
    break;
    case "14":
     $rand_value = "n";
    break;
    case "15":
     $rand_value = "o";
    break;
    case "16":
     $rand_value = "p";
    break;
    case "17":
     $rand_value = "q";
    break;
    case "18":
     $rand_value = "r";
    break;
    case "19":
     $rand_value = "s";
    break;
    case "20":
     $rand_value = "t";
    break;
    case "21":
     $rand_value = "u";
    break;
    case "22":
     $rand_value = "v";
    break;
    case "23":
     $rand_value = "w";
    break;
    case "24":
     $rand_value = "x";
    break;
    case "25":
     $rand_value = "y";
    break;
    case "26":
     $rand_value = "z";
    break;
    case "27":
     $rand_value = "0";
    break;
    case "28":
     $rand_value = "1";
    break;
    case "29":
     $rand_value = "2";
    break;
    case "30":
     $rand_value = "3";
    break;
    case "31":
     $rand_value = "4";
    break;
    case "32":
     $rand_value = "5";
    break;
    case "33":
     $rand_value = "6";
    break;
    case "34":
     $rand_value = "7";
    break;
    case "35":

     $rand_value = "8";
    break;
    case "36":
     $rand_value = "9";
    break;
  }
return $rand_value;
}	
function get_rand_id($length)
{
  if($length>0) 
  { 
  $rand_id="";
   for($i=1; $i<=$length; $i++)
   {
   mt_srand((double)microtime() * 1000000);
   $num = mt_rand(1,36);
   $rand_id .= $this -> assign_rand_value($num);
   }
  }
return $rand_id;
}
function get_rand_no($length)
{
  if($length>0) 
  { 
  $rand_id="";
   for($i=1; $i<=$length; $i++)
   {
   mt_srand((double)microtime() * 1000000);
   $num = mt_rand(1,10);
   $rand_id .= $this -> assign_rand_no($num);
   }
  }
return $rand_id;
}

function assign_rand_no($num)
{
	 switch($num)
  {
    case "1":
     $rand_value = "0";
    break;
    case "2":
     $rand_value = "1";
    break;
    case "3":
     $rand_value = "2";
    break;
    case "4":
     $rand_value = "3";
    break;
    case "5":
     $rand_value = "4";
    break;
    case "6":
     $rand_value = "5";
    break;
    case "7":
     $rand_value = "6";
    break;
    case "8":
     $rand_value = "7";
    break;
    case "9":
     $rand_value = "8";
    break;
    case "10":
     $rand_value = "9";
    break;
  }
  return $rand_value;
}
}



?>