<?
require_once("noscreen_top.php");
$id = 0 + $_POST['id'];

$status=array();


if( $_POST['type'] == "edit" ){
	$sql = "SELECT COUNT(*) FROM meeting_items WHERE `id`='$id'";
	if( qury_one( $sql, $conn ) == "0" ){		
		$data = array( 
			'id'=>'0', 
			'title'=>$_POST['title'], 
			'subtitle'=>$_POST['subtitle'], 
			'content'=>$_POST['cnt'],
			'start_time'=>$_POST['start_time'],
			'end_time'=>$_POST['end_time'], 
			'start_date'=>$_POST['start_date'], 		  
			'lang'=>$_POST['lang']
		);
		insert_hash( 'meeting_items', $data, $conn );
	} else {
		$data = array( 
			'title'=>$_POST['title'], 
			'subtitle'=>$_POST['subtitle'], 
			'content'=>$_POST['cnt'],
			'start_time'=>$_POST['start_time'],
			'end_time'=>$_POST['end_time'], 
			'start_date'=>$_POST['start_date'], 		  
			'lang'=>$_POST['lang']
		);
		update_hash( 'meeting_items', "`id`='$id'", $data, $conn );
	}
	$now_status["status"] = 'success';
	echo json_encode($now_status);
}
?>