<?php
	require_once("include.php");
	$lang = $_COOKIE['lang'];
	
$id = intval($_GET["id"], 10);
$sql = "SELECT * FROM lecturers WHERE `id`='$id' order by `order`, id DESC";
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
	
	$date = $data["created_at"];
	$news_lang = $data["lang"];
	if( ( $data['image'] != '') && file_exists( '../pic/lecturers/'.$data['image'] ) )
		$pic = "<img src='../pic/lecturers/".$data['image']."'>";
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
		'pic_upload_speaker.php',
		function(filename){
			$('#pic').html('<img src="../pic/lecturers/'+filename+'">');
		},
		function(error){
			alert('Error! '+error);
		}
	);
	$('.del_img').click(function(){
		$(this).closest('td').find('img').remove();
	});
	$("textarea#editor").ckeditor();
	
	$("#save").click(function(){
		var pic = '';
		if( $('#pic img').length > 0 ) pic = $('#pic img').attr('src');
		pic = pic.split("lecturers/")[1]
		
		console.log("time:"+$("#time").val())
		console.log("eeeee:"+$("#editor").val())
		
		if($("#name").val() == "")
			alert("請輸入姓名");
		else if($("#title").val() == "")
			alert("請輸入頭銜");
		else if($("#editor").val() == "")
			alert("請輸入內文");
		else{
			$.ajax({
				url: "speaker_system.php",
				type: "POST",
				data: {
					id: "<?=$id?>", 
					type: "edit", 
					name: $("#name").val(), 
					title: $("#title").val(), 
					image:pic, 
					show: $(".show:checked").val(),
					order:$("#order").val(),
					info: $("#editor").val(), 
					lang:$("#lang").val()},
				error: myErr,
				success: function(msg){
					//alert(msg)
					var rr = JSON.parse(msg);
					if(String(rr["status"])=="success"){
						alert("儲存完成")	
						location.assign("speaker.php")
					}else{
						alert(rr["status"])	
					}
				}//
			});
		}
	});
	$("#cancel").click(function(){
		if(confirm("不儲存直接離開?") == true)
			location.assign("speaker.php");
	});
});
</script>
<style type='text/css'>
#pic img{ width:200px}
</style>
</head>

<body>
<div class="wrap">
<?php
	require_once("header.php");
  ?>
<div class="admin_content">
  <h2>講師 - <?=$typename?></h2>
  <div class="cont_r">
    <table cellpadding="2" cellspacing="2" border="0"class="listtable">
      <tr>
        <th><div class="title">姓名</div></th><td><input type="text" id="name" style="width:755px;" value="<?=$data['name']?>"></td>
      </tr>
      <tr>
        
      </tr>
      <tr>
        <th><div class="title">頭銜</div></th><td><input type="text" id="title" style="width:755px;" value="<?=$data['title']?>"></td>
      </tr>      
      <tr>
      <th><div class="title">語系</div></th>
         <td><select name="" id="lang">
          <option value="1">中文</option>
          <option value="2">英文</option>
        </select></td>
      </tr>
      <tr><th><div class="title">顯示</div></th>
        <td><input type="radio" class="show" name="show" value="1" <?=($data['show']!='0')?"checked='checked'":""?>>
      <span>顯示</span> &nbsp;
      <input type="radio" class="show" name="show" value="0" <?=($data['show']=='0')?"checked='checked'":""?>>
      <span>不顯示</span></td>
      </tr>
      <tr>
        <th><div class="title">排序</div></th><td><input type="text" id="order" style="width:100px;" value="<?=$data['order']?>"></td>
      </tr>
      <tr><th>圖片</th><td><div id='pic_upload'></div>
          <div id='pic'>
            <?=$pic?>
          </div>
          <button class='del_img'>刪除圖片</button></td></tr>
      
      <tr>
        <th>內容</th><td><textarea id="editor" name="editor" style="width:775px; height:350px"><?=$data["info"]?>
</textarea></td>
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
