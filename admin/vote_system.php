<?
require_once("noscreen_top.php");
$id = 0 + $_POST['id'];




if( $_POST['type'] == "edit" ){
	$sql = "SELECT COUNT(*) FROM votes WHERE `id`='$id'";
	if( qury_one( $sql, $conn ) == "0" ){		
		$data = array( 
			'id'=>'0', 
			'topic'=>$_POST['topic'], 
			'switch'=>$_POST['switch'],
			'order'=>$_POST['order']
		);
		insert_hash( 'votes', $data, $conn );
		
		
		$topic = $_POST['topic'];
		$sql = "SELECT id FROM votes WHERE `topic`='$topic' ";
		$result = qury_sel($sql, $conn);
		while($r = mysqli_fetch_assoc($result)) {
			$vote_id = $r["id"];
		}
		for($i=1;$i<=4;$i++){
			$data2 = array( 
				'name'=>$_POST['qus'.$i],				
				'vote_id'=>$vote_id,
				'order'=>$i
			);		
			insert_hash( 'vote_items', $data2, $conn );
		}
	} else {
		$data = array( 
			'topic'=>$_POST['topic'], 
			'switch'=>$_POST['switch'],
			'order'=>$_POST['order']
		);
		update_hash( 'votes', "`id`='$id'", $data, $conn );
		
		for($j=1;$j<=4;$j++){
			$itemid = $_POST['qus'.$j."_id"];
			$data2 = array( 
				'name'=>$_POST['qus'.$j],
				'order'=>$j
			);		
			update_hash( 'vote_items', "`id`='$itemid'", $data2, $conn );
		}
	}
	$now_status["status"] = 'success';
	echo json_encode($now_status);
}
?>