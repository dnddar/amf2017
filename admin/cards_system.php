<?
require_once("noscreen_top.php");
$id = 0 + $_POST['id'];




if( $_POST['type'] == "edit" ){
	$sql = "SELECT COUNT(*) FROM cards WHERE `id`='$id'";
	if( qury_one( $sql, $conn ) == "0" ){		
		$data = array( 
			'id'=>'0', 
			'name'=>$_POST['name'], 
			'unit'=>$_POST['unit'],
			'title'=>$_POST['title'],
			'content'=>$_POST['content'], 
			'order'=>$_POST['order'],			
			'show'=>$_POST['show']
		);
		insert_hash( 'cards', $data, $conn );		
		
	} else {
		$data = array( 			
			'name'=>$_POST['name'], 
			'unit'=>$_POST['unit'],
			'title'=>$_POST['title'],
			'content'=>$_POST['content'], 
			'order'=>$_POST['order'],			
			'show'=>$_POST['show']
		);
		update_hash( 'cards', "`id`='$id'", $data, $conn );
		
	}
	$now_status["status"] = 'success';
	echo json_encode($now_status);
}
?>