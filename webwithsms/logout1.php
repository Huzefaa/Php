<?php
session_start();
session_destroy();
session_start();
$_SESSION['message'] = "You have been Suspended";
header("Location: front.php");
?>