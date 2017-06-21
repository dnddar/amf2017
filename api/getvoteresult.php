<?php
	require_once("include_nosession.php");
	$data_rows = array();
	$ques_id = $_GET["id"];
	
	
	$sql = "SELECT *, (select SUM(result) from `vote_items` where vote_id=$ques_id) AS total FROM `vote_items` where vote_id=$ques_id order by `order`";
	

	$result = qury_sel($sql, $conn);
	while($r = mysqli_fetch_assoc($result)) {
    	$data_rows[] = $r;
	}
	$json_data = json_encode($data_rows);
	
	$jsoncallback = htmlspecialchars($_REQUEST ['jsoncallback']);
	echo $jsoncallback . "(" . $json_data . ")";
	
?>