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
	$sql = "SELECT COUNT(*) FROM news WHERE `id`='$id'";
	if( qury_one( $sql, $conn ) == "0" ){
		$data = array( 'id'=>'0', 'title'=>$_POST['title'], 'image'=>$_POST['image'],  'content'=>$_POST['cnt'], 'created_at'=>$time_f, 'updated_at'=>$time_f, 'lang'=>$_POST['lang'] );
		insert_hash( 'news', $data, $conn );
	} else {
		$data = array( 'title'=>$_POST['title'], 'image'=>$_POST['image'], 'lang'=>$_POST['lang'], 'content'=>$_POST['cnt'],  'updated_at'=>$time_f );
		update_hash( 'news', "`id`='$id'", $data, $conn );
	}
	$now_status["status"] = 'success';
	echo json_encode($now_status);
}
?>