<?php
	require_once("include.php");
	$lang = $_COOKIE['lang'];
	
$id = intval($_GET["id"], 10);
$sql = "SELECT * FROM votes where `id`='$id'";
$result = qury_sel( $sql, $conn );
$resultqus=array();


if( mysqli_num_rows( $result ) == 0 ){
	$type = "add";
	$newformat = "2016-09-07";
	$typename = "新增";
	$news_lang = $_COOKIE['lang'];
} else {
	$type = "edit";
	$data = mysqli_fetch_assoc( $result );
	$typename = "編輯";
	$vote_id = $data["id"];
	
	$sql = "SELECT * FROM vote_items where `vote_id`='$id' order by `order`, `id` ";
	$resultqus = qury_sel( $sql, $conn );	
	while($data2 = mysqli_fetch_assoc($resultqus)){	
		$qusdata[] = $data2;
	}
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
	
	
	$("textarea#editor").ckeditor();
	$("#date").datepick({dateFormat: "yyyy-mm-dd"});
	$("#save").click(function(){		
		
		if($("#title").val() == "")
			alert("請輸入主題");
		else{
			$.ajax({
				url: "vote_system.php",
				type: "POST",
				data: {
					id: "<?=$id?>", 
					type: "edit", 
					topic: $("#title").val(), 
					switch: $(".show:checked").val(),
					order: $("#order").val(),
					qus1: $("#qus1").val(), 
					qus2: $("#qus2").val(), 
					qus3: $("#qus3").val(), 
					qus4: $("#qus4").val(),
					qus1_id:$("#qus1").attr("data-id"), 
					qus2_id: $("#qus2").attr("data-id"), 
					qus3_id: $("#qus3").attr("data-id"), 
					qus4_id: $("#qus4").attr("data-id")
				},
				error: myErr,
				success: function(msg){
					var rr = JSON.parse(msg);
					if(String(rr["status"])=="success"){
						alert("儲存完成")	
						location.assign("vote.php")
					}else{
						alert(rr)	
					}
				}
			});
		}
	});
	$("#cancel").click(function(){
		if(confirm("不儲存直接離開?") == true)
			location.assign("vote.php");
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
        <th><div class="title">主題</div></th><td><textarea name="" cols="" rows="5" id="title" style="width:755px;"><?=$data['topic']?></textarea></td>
      </tr>
      <tr>
        <th><div class="title">狀態</div></th><td><input type="radio" class="show" name="show" value="1" <?=($data['switch']!='0')?"checked='checked'":""?>>
      <span>開始</span> &nbsp;
      <input type="radio" class="show" name="show" value="0" <?=($data['switch']=='0')?"checked='checked'":""?>>
      <span>關閉</span></td>
      </tr>
      <tr>
        <th><div class="title">排序</div></th><td><input name="" type="text" id="order" value="<?=$data['order']?>"></td>
      </tr>
      <?php
      for($i=0;$i<4;$i++){
		  $cur = $i+1;
		  $qusid = $qusdata[$i]["id"];
		  $qus = $qusdata[$i]["name"];
      ?> 
      <tr>
        <th><div class="title">選項<?=$cur?></div></th><td><textarea data-id="<?=$qusid?>" name="" cols="" rows="3" id="qus<?=$cur?>" style="width:755px;"><?=$qus?></textarea></td>
      </tr>  
      <?php
	  }
      ?>    
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
