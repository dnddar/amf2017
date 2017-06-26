<?php
	require_once("include.php");
	$lang = $_COOKIE['lang'];
	
$id = intval($_GET["id"], 10);

	$sql = "SELECT * FROM meeting_items where lang=$lang and `id`='$id' ORDER BY `start_time`";
	$result = qury_sel( $sql, $conn );
	//echo $sql;



if( mysqli_num_rows( $result ) == 0 ){
	$type = "add";
	$newformat = "2016-09-07";
	$typename = "新增";
	$news_lang = $_COOKIE['lang'];
} else {
	$type = "edit";
	$data = mysqli_fetch_assoc( $result );
	$typename = "編輯";
	
	$date = $data["start_date"];	
	$time = strtotime($date);
	$newformat = date('Y-m-d',$time);
	$news_lang = $data["lang"];
	$start_time = explode(":", $data["start_time"]);
	$end_time = explode(":", $data["end_time"]);
	$start_h = $start_time[0] ;
	$start_m = $start_time[1] ;
	$end_h = $end_time[0] ;
	$end_m = $end_time[1] ;
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
	initTime()
	$("#lang").val(<?=$news_lang?>)
	
	$("textarea#editor").ckeditor();
	$("#date").datepick({dateFormat: "yyyy-mm-dd"});
	$("#save").click(function(){
		
		var start_time = $("#start_h").val()+":"+$("#start_m").val()
		var end_time = $("#end_h").val()+":"+$("#end_m").val()
		
		console.log("date:"+$("#date").val())
		console.log("start_time:"+start_time)
		console.log("end_time:"+end_time)
		
		if($("#title").val() == "")
			alert("請輸入標題");
		else if($("#date").val() == "")
			alert("請輸入日期");
		else if(start_time == "")
			alert("請輸入開始時間");
		else if(end_time == "")
			alert("請輸入結束時間");
		else{
			$.ajax({
				url: "schedule_system.php",
				type: "POST",
				data: {
					id: "<?=$id?>", 
					type: "edit", 
					title: $("#title").val(), 
					subtitle:$("#subtitle").val(), 
					start_date: $("#date").val(), 
					start_time: start_time,
					end_time: end_time,
					cnt: $("#editor").val(), 
					lang:$("#lang").val()
				},
				error: myErr,
				success: function(msg){
					var rr = JSON.parse(msg);
					if(String(rr["status"])=="success"){
						alert("儲存完成")	
						location.assign("schedule.php")
					}else{
						alert(rr)	
					}
				}
			});
		}
	});
	$("#cancel").click(function(){
		if(confirm("不儲存直接離開?") == true)
			location.assign("schedule.php");
	});
});

function initTime(){
	var str_h = ""	
	var str_m = ""
	str_h+='<option value="">請選擇</option>'
	str_m+='<option value="">請選擇</option>'
	for(var i=0;i<24;i++){
		var hh = i
		if(i<10){
			hh = "0"+i		
		}
		str_h+='<option value="'+hh+'">'+hh+'</option>'
	}
	for(var i=0;i<60;i++){
		var mm = i
		if(i<10){
			mm = "0"+i		
		}
		str_m+='<option value="'+mm+'">'+mm+'</option>'
	}
	$("#start_h").html(str_h)
	$("#end_h").html(str_h)
	$("#start_m").html(str_m)
	$("#end_m").html(str_m)
	
	$("#start_h").val('<?=$start_h?>')
	$("#start_m").val('<?=$start_m?>')
	$("#end_h").val('<?=$end_h?>')
	$("#end_m").val('<?=$end_m?>')
}
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
  <h2>議程 - <?=$typename?></h2>
  <div class="cont_r">
    <table cellpadding="2" cellspacing="2" border="0"class="listtable">
      <tr>
        <th><div class="title">標題</div></th><td><input type="text" id="title" style="width:755px;" value="<?=$data['title']?>"></td>
      </tr>
      <tr>
        <th><div class="title">副標題</div></th><td><input type="text" id="subtitle" style="width:755px;" value="<?=$data['subtitle']?>"></td>
      </tr>
      <tr>
        <th><div class="title">日期</div></th><td><input type="text" id="date" value="<?=$newformat?>"></td>
      </tr> 
      <tr>
        <th><div class="title">開始時間</div></th><td><select id="start_h" name="start_h"></select><select name="start_m" id="start_m"></select></td>
      </tr> 
      <tr>
        <th><div class="title">結束時間</div></th><td><select id="end_h" name="end_h"></select><select name="end_m" id="end_m"></select></td>
      </tr>      
      <tr>
      <th><div class="title">語系</div></th>
         <td><select name="" id="lang">
          <option value="1">中文</option>
          <option value="2">英文</option>
        </select></td>
      </tr>
      </tr>
      <tr>
        <th>內容</th><td><textarea id="editor" name="editor" style="width:775px; height:350px"><?=$data["content"]?>
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
