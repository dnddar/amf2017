<?
require_once("noscreen_top.php");
$id = 0 + $_POST['id'];

//$time_array = explode("-", $time_f);
//$time = mktime( 0, 0, 0, $time_array[1], $time_array[2], $time_array[0]);
/* 圖片名稱 */
$pic = substr( $_POST['pic'], strrpos( $_POST['pic'], '/' ) + 1 );

if( $_POST['type'] == "edit" ){
	$sql = "SELECT COUNT(*) FROM album WHERE `id`='$id'";
	if( qury_one( $sql, $conn ) == "0" ){
		$data = array( 
			'id'=>'0',		 
			'image'=>$_POST['image'],
			'order'=>$_POST['order'],
			'lang'=>1 );
		insert_hash( 'album', $data, $conn );
	} else {
		$data = array( 
			'image'=>$_POST['image'],
			'order'=>$_POST['order'],
			'lang'=>1  );
		update_hash( 'album', "`id`='$id'", $data, $conn );
	}
	$now_status["status"] = 'success';
	echo json_encode($now_status);
}
?>