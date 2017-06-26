<?
require_once("noscreen_top.php");
$id = 0 + $_POST['id'];

/* 日期 */
if(isset($_POST["time"])) $time_f = $_POST["time"];
//$time_array = explode("-", $time_f);
//$time = mktime( 0, 0, 0, $time_array[1], $time_array[2], $time_array[0]);
/* 圖片名稱 */
$pic = substr( $_POST['pic'], strrpos( $_POST['pic'], '/' ) + 1 );

if( $_POST['type'] == "edit" ){
	$sql = "SELECT COUNT(*) FROM csr WHERE `id`='$id'";
	if( qury_one( $sql, $conn ) == "0" ){
		$data = array( 
			'id'=>'0', 
			'title'=>$_POST['title'],
			'rights'=>$_POST['rights'], 
			'content'=>$_POST['cnt'],			 
			'image'=>$_POST['image'], 
			'created_at'=>$time_f, 
			'updated_at'=>$time_f, 
			'lang'=>$_POST['lang'] );
		insert_hash( 'csr', $data, $conn );
	} else {
		$data = array( 'title'=>$_POST['title'],
			'rights'=>$_POST['rights'], 
			'content'=>$_POST['cnt'],			 
			'image'=>$_POST['image'],
			'updated_at'=>date("Y-m-d H:i:s"),
			'lang'=>$_POST['lang']  );
		update_hash( 'csr', "`id`='$id'", $data, $conn );
	}
	$now_status["status"] = 'success';
	echo json_encode($now_status);
}
?>