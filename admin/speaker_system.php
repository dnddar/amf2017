<?
require_once("noscreen_top.php");
$id = 0 + $_POST['id'];



if( $_POST['type'] == "edit" ){
	$sql = "SELECT COUNT(*) FROM lecturers WHERE `id`='$id'";
	if( qury_one( $sql, $conn ) == "0" ){		
		$data = array( 
			'id'=>'0', 
			'name'=>$_POST['name'], 
			'title'=>$_POST['title'], 
			'image'=>$_POST['image'],
			'info'=>$_POST['info'],
			'created_at'=>date("Y-m-d H:i:s"), 
			'updated_at'=>date("Y-m-d H:i:s"),
			'show'=> $_POST['show'],
			'order'=> $_POST['order'],		  
			'lang'=>$_POST['lang']
		);
		$now_status["type"]='insert'; 
		insert_hash( 'lecturers', $data, $conn );
	} else {
		$data = array( 
			'name'=>$_POST['name'], 
			'title'=>$_POST['title'], 
			'image'=>$_POST['image'],
			'info'=>$_POST['info'],
			'updated_at'=>date("Y-m-d H:i:s"),
			'show'=> $_POST['show'],
			'order'=> $_POST['order'],		  
			'lang'=>$_POST['lang']
		);
		$now_status["type"]='update'; 
		update_hash( 'lecturers', "`id`='$id'", $data, $conn );
	}
	$now_status["status"] = 'success';
	echo json_encode($now_status);
}else{
	$now_status["status"] = 'fail';
	echo json_encode($now_status);
}
?>