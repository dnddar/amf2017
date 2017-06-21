<?php
	require_once("include.php");
	$lang = $_COOKIE['lang'];
	
$id = intval($_GET["id"], 10);
$sql = "SELECT * FROM cards where `id`='$id'";
$result = qury_sel( $sql, $conn );



if( mysqli_num_rows( $result ) == 0 ){
	$type = "add";
	$newformat = "2016-09-07";
	$typename = "新增";
	$news_lang = $_COOKIE['lang'];
} else {
	$type = "edit";
	$data = mysqli_fetch_assoc( $result );
	$typename = "編輯";
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
	
	$("#date").datepick({dateFormat: "yyyy-mm-dd"});
	$("#save").click(function(){		
		
		if($("#name").val() == "")
			alert("請輸入姓名");
		else{
			$.ajax({
				url: "cards_system.php",
				type: "POST",
				data: {
					id: "<?=$id?>", 
					type: "edit", 
					name: $("#name").val(), 
					unit: $("#unit").val(), 
					title: $("#title").val(), 
					content: $("#content").val(), 
					order: $("#order").val(),					
					show: $(".show:checked").val()
				},
				error: myErr,
				success: function(msg){
					var rr = JSON.parse(msg);
					if(String(rr["status"])=="success"){
						alert("儲存完成")	
						location.assign("cards.php")
					}else{
						alert(rr)	
					}
				}
			});
		}
	});
	$("#cancel").click(function(){
		if(confirm("不儲存直接離開?") == true)
			location.assign("cards.php");
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
  <h2>投票主題 - <?=$typename?></h2>
  <div class="cont_r">
    <table cellpadding="2" cellspacing="2" border="0"class="listtable">
      <tr>
        <th><div class="title">姓名</div></th><td>
        <input name="" type="text" id="name" style="width:755px;" value="<?=$data['name']?>"></td>
      </tr>
      <tr>
        <th><div class="title">狀態</div></th><td><input type="radio" class="show" name="show" value="1" <?=($data['show']!='0')?"checked='checked'":""?>>
      <span>顯示</span> &nbsp;
      <input type="radio" class="show" name="show" value="0" <?=($data['show']=='0')?"checked='checked'":""?>>
      <span>不顯示</span></td>
      </tr> 
      <tr>
        <th><div class="title">單位</div></th><td>
        <input name="" type="text" id="unit" style="width:755px;" value="<?=$data['unit']?>"></td>
      </tr>
      <tr>
        <th><div class="title">職稱</div></th><td>
        <input name="" type="text" id="title" style="width:755px;" value="<?=$data['title']?>"></td>
      </tr>
      <tr>
        <th><div class="title">Email</div></th><td>
        <input name="" type="text" id="content" style="width:755px;" value="<?=$data['content']?>"></td>
      </tr> 
      <tr>
        <th><div class="title">排序</div></th><td>
        <input name="" type="text" id="order" value="<?=$data['order']?>"></td>
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
