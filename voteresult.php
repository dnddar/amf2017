<?php
	require_once("admin/include.php");
	$id = $_GET['id'];
	if(!$id){
		exit;	
	}
	if($id==-1){
		echo '
<table width="100%" height="80%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="middle" align="center" style="font-size:60px; color:#3D608E;">Thank You</td>
  </tr>
</table>';
		exit;
	}else{
		$sql = "SELECT a.*, b.name, b.vote_id, b.id as aid FROM `votes` as a inner join `vote_items` as b on a.id = b.vote_id WHERE 1 = 1 and switch = 1 and a.id=$id order by a.order, a.id, b.order, b.id";
		$result = qury_sel($sql, $conn);
		$ary=array();	
		while($data = mysqli_fetch_assoc($result)){	
			if(sizeof($ary)==0){
				$ary[] = $data["topic"];
			}
			$ary[] = array($data["name"],$data["aid"]);
		}
		$qus_topic = $ary[0];
		$qus_ary = explode('?', $qus_topic);
		$qus_ch = $qus_ary[0]."?";
		if($qus_ary[1]){
			$qus_en = $qus_ary[1]."?";
		}else{
			$qus_en = "";
		}
			
		$nextid = -1;
		if($_COOKIE["qusid"]){
			//echo "qusid:".$_COOKIE["qusid"];
			$qusid_ary = explode(',', $_COOKIE["qusid"]);	
			$nextid = getNext($qusid_ary, $id);
			
		}else{
			$sql = "SELECT * FROM votes where switch=1 order by `order` ,id DESC ";
			$result = qury_sel($sql, $conn);
			while($r = mysqli_fetch_assoc($result)) {
				$data_rows[] = $r["id"];
			}
			$nextid = getNext($data_rows, $id);
		}
		$nextpage ="";
		if($nextid>0){
			$nextpage = '<a href="voteresult.php?id='.$nextid.'" class="btn next">下一題</a>'	;
		}else{
			$nextpage ='<a href="voteresult.php?id=-1" class="btn next">活動結束</a>';
		}
	}
	function getNext($ary, $_id){
		$next = -1;
		$len = sizeof($ary)-1;	
			
		for($i=0;$i<$len;$i++){
			if($ary[$i]==$_id){
				$next = $ary[$i+1];	
			}
		}
		return $next;
	}
	
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
<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/plugins/CSSPlugin.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/easing/EasePack.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenLite.min.js"></script>

<script type="text/javascript">
var ww = 680;
$( document ).ready(function() {
	$(".box").css("background","rgba(240,240,240,0)")
	$("a.result").css("display","block")		
	$("a.next").css("display","none")	
	var qus = "<?=$ary[0]?>".split("?");
	var qus_ch = qus[0]+"?"
	var qus_en = qus[1]+"?"
	if(!qus_ch){
		qus_ch=""
	}
	if(qus.length<=1){
		qus_en=""
	}
	//$(".q_ch").html(qus_ch) 
	//$(".q_en").html(qus_en) 
	
	$("a.result").click(function(){
		getResult()
	})
	/*$(".next").click(function(){
		goNext()	
	})*/
})

	
	function getResult(){
		$.getJSON( "http://www.amf.com.tw/api/getvoteresult.php?lang=1&id=<?=$id?>&jsoncallback=?", setData);
	}
	function setData(data){
		var totalvotes = 0;
		
		
		if(data.length<=0){	
			alert("資料讀取錯誤，請再試一次")
			return
		}
		for(var i=0;i<4;i++){
			var total = data[i]["total"]
			totalvotes = total	
			var id = data[i]["id"]	
			var value = data[i]["result"]
			if(value>0){
				var pc = Math.round(value/total*100)
				
				var neww = Math.round(pc * ww/100)
				//$("#a"+id+" span.pc").css("width",neww)
				var obj = $("#a"+id+" span.pc")
				TweenLite.to(obj, 1.5, {width:neww, onComplete:setValue, onCompleteParams:[id, pc]});
				var obj2 = $(".box")
				TweenLite.to(obj2, 0.8, {background:"rgba(240,240,240,1)"});
			}else{
				//$("#a"+id+" span.pc").html("0%　")
				$("#a"+id+" span.ppc").html(" 0%")
			}
		}
		$("a.result").css("display","none")		
		$("a.next").css("display","block")		
		//$("h3").html("總票數："+totalvotes)
	}

	function setValue(id, pc){
		$("#a"+id+" span.ppc").html(" "+pc+"%")
	}
</script>
<style type='text/css'>

</style>
</head>

<body>
<div class="wrap"> 

<h2 class="title"><span class="q_ch"><?=$qus_ch?></span><br><span class="q_en"><?=$qus_en?></span></h2>
<ul class="qus">
<?php
for($i=1;$i<=4;$i++){
?>
	<li id="a<?=$ary[$i][1]?>"><?=$ary[$i][0]?><br><span class="ppc"></span><span class="box"><span class="pc p<?=$i?>">&nbsp;</span></span></li>
<?php
}
?>
	
</ul>
<h3></h3>
  <a href="#" class="btn result">檢視投票結果</a>
  <?=$nextpage?>
</div>
<?php
require_once("admin/footer.php"); 
?>


<!--wrap end-->
</body>
