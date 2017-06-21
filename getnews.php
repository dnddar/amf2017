<?php
	require_once("include.php");
	header('Content-type: application/json');
	$jsoncallback = htmlspecialchars($_REQUEST ['jsoncallback']);
	
	$data_rows = array();
	$lang = $_GET["lang"];
	$sql = "SELECT * FROM news ORDER BY `created_at` DESC";
	$result = qury_sel($data_rows, $conn);
	while($r = mysqli_fetch_assoc($result)) {
    	$data_rows[] = $r;
	}
	$json_data = json_encode($data_rows);
	
	
	echo $jsoncallback . "(" . $json_data . ")";
	
	
/*header('Content-type: application/json');
//获取回调函数名
$jsoncallback = htmlspecialchars($_REQUEST ['jsoncallback']);
//json数据
$json_data = '["customername1","customername2"]';
//输出jsonp格式的数据
echo $jsoncallback . "(" . $json_data . ")";*/

?>