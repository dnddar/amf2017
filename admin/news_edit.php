<?php
	require_once("include.php");
	$lang = $_COOKIE['lang'];
	
$id = intval($_GET["id"], 10);
$sql = "SELECT * FROM news WHERE `id`='$id'";
$result = qury_sel( $sql, $conn );
$pic = '';
if( mysqli_num_rows( $result ) == 0 ){
	$type = "add";
	$newformat = date('Y-m-d');
	$typename = "新增";
	$news_lang = $_COOKIE['lang'];
} else {
	$type = "edit";
	$news = mysqli_fetch_assoc( $result );
	$typename = "編輯";
	
	$date = $news["created_at"];
	$news_lang = $news["lang"];
	$time = strtotime($date);
	$newformat = date('Y-m-d',$time);
	if( ( $news['image'] != '') && file_exists( '../pic/news/'.$news['image'] ) )
		$pic = "<img src='../pic/news/".$news['image']."'>";
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
		'pic_upload_news.php',
		function(filename){
			$('#pic').html('<img src="../pic/news/'+filename+'">');
		},
		function(error){
			alert('Error! '+error);
		}
	);
	$('.del_img').click(function(){
		$(this).closest('td').find('img').remove();
	});
	$("textarea#editor").ckeditor();
	$("#time").datepick({dateFormat: "yyyy-mm-dd"});
	$("#save").click(function(){
		var pic = '';
		if( $('#pic img').length > 0 ) pic = $('#pic img').attr('src');
		pic = pic.split("news/")[1]
		
		console.log("time:"+$("#time").val())
		
		if($("#title").val() == "")
			alert("請輸入標題");
		else if($("#time").val() == "")
			alert("請輸入日期");
		else if($("#editor").val() == "")
			alert("請輸入內文");
		else{
			$.ajax({
				url: "news_system.php",
				type: "POST",
				data: {id: "<?=$id?>", type: "edit", title: $("#title").val(), image:pic, time: $("#time").val(),  cnt: $("#editor").val(), lang:$("#lang").val()},
				error: myErr,
				success: function(msg){
					var rr = JSON.parse(msg);
					if(String(rr["status"])=="success"){
						alert("儲存完成")	
						location.assign("news.php")
					}else{
						alert(rr)	
					}
				}
			});
		}
	});
	$("#cancel").click(function(){
		if(confirm("不儲存直接離開?") == true)
			location.assign("news.php");
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
  <h2>新聞中心 - <?=$typename?></h2>
  <div class="cont_r">
    <table cellpadding="2" cellspacing="2" border="0"class="listtable">
      <tr>
        <th><div class="title">標題</div></th><td><input type="text" id="title" style="width:755px;" value="<?=$news['title']?>"></td>
      </tr>
      <tr>
        
      </tr>
      <tr>
        <th><div class="title">日期</div></th><td><input type="text" id="time" value="<?=$newformat?>"></td>
      </tr>      
      <tr>
      <th><div class="title">語系</div></th>
         <td><select name="" id="lang">
          <option value="1">中文</option>
          <option value="2">英文</option>
        </select></td>
      </tr>
      <tr><th>圖片</th><td><div id='pic_upload'></div>
          <div id='pic'>
            <?=$pic?>
          </div>
          <button class='del_img'>刪除圖片</button></td></tr>
      <tr>
        
      </tr>
      <tr>
        <th>內容</th><td><textarea id="editor" name="editor" style="width:775px; height:350px"><?=$news["content"]?>
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
