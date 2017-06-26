<?php
	require_once("include.php");
	$lang = $_COOKIE['lang'];
	
$id = intval($_GET["id"], 10);
$sql = "SELECT * FROM album WHERE `id`='$id'";
$result = qury_sel( $sql, $conn );
$pic = '';
if( mysqli_num_rows( $result ) == 0 ){
	$type = "add";
	$newformat = date('Y-m-d');
	$typename = "新增";
	$news_lang = $_COOKIE['lang'];
} else {
	$type = "edit";
	$data = mysqli_fetch_assoc( $result );
	$typename = "編輯";
	
	$news_lang = $data["lang"];
	$time = strtotime($date);
	$newformat = date('Y-m-d',$time);
	if( ( $data['image'] != '') && file_exists( '../pic/album/'.$data['image'] ) )
		$pic = "<img src='../pic/album/".$data['image']."'>";
}
	

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<?php
require_once("meta.php");
?>
<link href="css/jquery.datepick.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.datepick.js"></script>
<script type="text/javascript" src="js/uploader.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckeditor/adapters/jquery.js"></script>
<script type="text/javascript">
$(function(){
	$("#lang").val(<?=$news_lang?>)
	
	$('#pic_upload').uploader(
		'pic_upload_album.php',
		function(filename){
			$('#pic').html('<img src="../pic/album/'+filename+'">');
		},
		function(error){
			alert('Error! '+error);
		}
	);
	$('.del_img').click(function(){
		$(this).closest('td').find('img').remove();
	});
	
	$("#save").click(function(){
		var pic = '';
		if( $('#pic img').length > 0 ) pic = $('#pic img').attr('src');
		
		pic = pic.split("album/")[1]
		
		
		if(pic == ""){
			alert("請上傳圖片");
		}else{
			$.ajax({
				url: "photo_system.php",
				type: "POST",
				data: {
					id: "<?=$id?>", 
					type: "edit", 
					order:$("#order").val(),
					image:pic
				},
				error: myErr,
				success: function(msg){
					var rr = JSON.parse(msg);
					if(String(rr["status"])=="success"){
						alert("儲存完成")	
						location.assign("photo.php")
					}else{
						alert(rr)	
					}
				}
			});
		}
	});
	$("#cancel").click(function(){
		if(confirm("不儲存直接離開?") == true)
			location.assign("photo.php");
	});
});
</script>
<style type='text/css'>
#pic img{ width:400px}
</style>
</head>

<body>
<div class="wrap">
<?php
	require_once("header.php");
  ?>
<div class="admin_content">
  <h2>公益活動 - <?=$typename?></h2>
  <div class="cont_r">
    <table cellpadding="2" cellspacing="2" border="0"class="listtable">      
      <tr><th>圖片</th><td><div id='pic_upload'></div>
          <div id='pic'>
            <?=$pic?>
          </div>
          <button class='del_img'>刪除圖片</button></td><th>排序</th><td><input type="text" id="order" style="width:50px;" value="<?=$data['order']?>"></td></tr>
      <tr>
        
      </tr>
      <tr>
        <td align="center" colspan="2" style="text-align:center"><button id="save">儲存</button>
          &nbsp;
          <button id="cancel">取消</button></td>
      </tr>
    </table>
  </div>
</div>
<?php
require_once("footer.php"); 
?>
<!--wrap end-->
</body>
