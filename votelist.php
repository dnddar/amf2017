<?php
	require_once("admin/include.php");
	$lang = $_COOKIE['lang'];
	$sql = "SELECT * FROM votes where switch=1 order by `order` ,id DESC ";
	$result = qury_sel($sql, $conn);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>AMF - 投票結果</title>
<link rel="stylesheet" type="text/css" href="css/vote.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">

<script type="text/javascript" src="admin/js/json2.js"></script>
<script type="text/javascript" src="admin/js/jquery.js"></script> 
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script type="text/javascript" src="admin/tree/jquery.cookie.js" ></script>



<script type="text/javascript">

$( document ).ready(function() {
	
	$(".delete").click(function(){
		if(confirm("確認要刪除 "+$(this).closest("tr").find("td:eq(1)").text()+" ?")){
			myDelete( 'votes', 'id', $(this).data("id") );
		}
	});
	$(".clear").click(function(){
		if(confirm("確認要清除 \""+$(this).closest("tr").find("td:eq(0)").text()+"\" 的投票記錄嗎?")){
			var ques_id = $(this).data("id")
			myClear( 'vote_users', 'ques_id', ques_id );
		}
	});

	
})

</script>
<style type='text/css'>

</style>
</head>

<body>
<div class="wrap"> 

<ul class="list">
<?php
$qusid_ary = array();
while($data = mysqli_fetch_assoc($result)){	
$qusid_ary[] =  $data["id"];
?>
	<li><a href="voteresult.php?id=<?=$data["id"]?>" target="_blank" data-id="<?=$data["id"]?>"><?=$data["topic"]?></a></li>
<?php
setcookie("qusid", implode(', ', $qusid_ary));
}
?>
	
</ul>
  
</div>
<?php
require_once("admin/footer.php"); 
?>
<!--wrap end-->
</body>
