<?php
session_start();
date_default_timezone_set("Asia/Taipei");

require_once("fun/conn.php");
require_once("fun/function.php");
require_once("fun/magic_quotes.php");

openDB();

$mid	= mysqli_real_escape_string($conn, $_SESSION['mid'] );	
$ep_id	= mysqli_real_escape_string($conn, $_SESSION['ep_id'] );	

?>

