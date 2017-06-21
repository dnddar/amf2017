<?php
	require_once("include_nosession.php");
	$data_rows = array();
	$sql = "SELECT * FROM cards where `show`=1  ORDER BY `order`, `id` desc";
	$result = qury_sel($sql, $conn);
	while($r = mysqli_fetch_assoc($result)) {
    	$data_rows[] = $r;
	}
	$json_data = json_encode($data_rows);
	
	$jsoncallback = htmlspecialchars($_REQUEST ['jsoncallback']);
	echo $jsoncallback . "(" . $json_data . ")";
	
?>