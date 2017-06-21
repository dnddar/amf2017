<?php
	require_once("include_nosession.php");
	$data_rows = array();
	$deviceid = $_GET["deviceid"];
	
	
	$sql = "SELECT a.*, b.name, b.vote_id, b.id as aid FROM `votes` as a inner join `vote_items` as b on a.id = b.vote_id WHERE 1 = 1 and switch = 1 and a.id not in (SELECT ques_id FROM `vote_users` where phone = '$deviceid' and ques_id <>0 group by ques_id ) order by a.order, a.id, b.order, b.id";
	

	$result = qury_sel($sql, $conn);
	while($r = mysqli_fetch_assoc($result)) {
    	$data_rows[] = $r;
	}
	$json_data = json_encode($data_rows);
	
	$jsoncallback = htmlspecialchars($_REQUEST ['jsoncallback']);
	echo $jsoncallback . "(" . $json_data . ")";
	
?>