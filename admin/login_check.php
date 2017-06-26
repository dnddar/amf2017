<?php
//session_start();
//session_destroy();
require_once('include_access.php');

//session_start();
require_once('./securimage/securimage.php');
$securimage = new Securimage();
if ($securimage->check($_POST['captcha_code']) == false) {
	echo '請輸入正確的驗證碼';
	exit();
}


$mid = mysqli_real_escape_string($conn,  $_POST["mid"] );
$pw = mysqli_real_escape_string($conn,  $_POST["pw"] );
$ppp = MD5('$pw'); 
// var_dump($mid);
// exit;
//$sql = "SELECT * FROM admins WHERE 1=1 and name='$mid' AND password=MD5('$pw')";
$sql = "SELECT * FROM admins WHERE 1=1 and name='$mid' AND password='$pw'";
//var_dump($sql);
$result = qury_sel($sql, $conn);
if( mysqli_num_rows( $result ) == 1 ){
	$row = mysqli_fetch_assoc($result);
//	$time = $row[17];
//	echo "time = ".$time;
	$_SESSION["mid"]	= $mid;
	$_SESSION["ep_id"]	= $row['id'];
	$_SESSION["lang"]	= '1';
	setcookie("lang", 1);
	echo "success";	
} else {
	echo "帳號或密碼錯誤，請重試";
}
?>