<?php
	require_once("include.php");
	$lang = $_COOKIE['lang'];
	$sql = "SELECT * FROM meeting_items where lang=$lang ORDER BY `start_date` DESC, `start_time`";
	$result = qury_sel($sql, $conn);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<?php
require_once("meta.php");
?>
<link href="css/jquery.datepick.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.datepick.js"></script>

<script type="text/javascript">

$( document ).ready(function() {
	
	$(".delete").click(function(){
		if(confirm("確認要刪除 "+$(this).closest("tr").find("td:eq(1)").text()+" ?")){
			myDelete( 'meeting_items', 'id', $(this).data("id") );
		}
	});

	
})

</script>
<style type='text/css'>

</style>
</head>

<body>
<div class="wrap"> 
  <!--header start-->
  <?php
	require_once("header.php");
  ?>
  <!--header end--> 
  
  <!--admin_content start-->
  
  <div class="admin_content"><input name="" type="button" value="新增" style="float:right" onclick="location.href='schedule_edit.php'" />
    <h2>議程</h2>
    <div class="cont_r"> 
     
      <h3>議程列表</h3>
      <table width="100%" border="1" cellspacing="0" cellpadding="0" id='list_table'>
        <tr>
		<th width="100">日期</th>
		<th width="100">開始時間</th>
		<th width="100">結束時日</th>
		<th>標題</th>
        <th width="40"></th>
        <th width="40"></th>
	</tr>
	<?
	while($schedule = mysqli_fetch_assoc($result)){
		$date = $schedule["start_date"];
		$time = strtotime($date);
		$newformat = date('Y-m-d',$time);
	?>
		<tr>
			<td align="center"><?=$newformat?></td>
			<td align="center"><?=$schedule["start_time"]?></td>
            <td align="center"><?=$schedule["end_time"]?></td>
            <td align="center"><?=$schedule["title"]?></td>
			<td align="center"><button onclick="location.assign('schedule_edit.php?id=<?=$schedule["id"]?>');">編輯</td>
			<td align="center"><button class="delete" data-id="<?=$schedule["id"]?>">刪除</td>
		</tr>
	<?
	}
	?>
      </table>
      
    </div>
  </div>
  <!--admin_content end--> 
</div>
<?php
require_once("footer.php"); 
?>
<!--wrap end-->
</body>
