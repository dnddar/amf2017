<?php
	require_once("include_nosession.php");
	
	$mb_table = "vote_users";
	$mb_table2 = "vote_items";
	
	
	$mb	= json_decode($_GET['mb']);
	
	$uid = $mb->phone;
	$voteid = $mb->vote_id;
	
	$sql = "SELECT * FROM `vote_items` where `id`='$voteid'";
	$resultqus = qury_sel( $sql, $conn );	
	while($data2 = mysqli_fetch_assoc($resultqus)){	
		$ques_id = $data2["vote_id"];
		$mb->ques_id = $ques_id;
	}
	
	insert_hash($mb_table, $mb, $conn);
	
	$sql = "UPDATE $mb_table2 SET result = result + 1 WHERE id = $voteid";
	qury_non($sql, $conn);

	$json_data = json_encode("success");
	
	$jsoncallback = htmlspecialchars($_REQUEST ['jsoncallback']);
	echo $jsoncallback . "(" . $json_data . ")";

	
	closeDB();
	
?>