<?php

$lang = "1";
function getLang(){
	

}

function checkSessionFront($conn){
	
	$mid = mysqli_real_escape_string($conn, $_SESSION['mid'] );	
	// echo "session:".$mid;
	// exit;
	if(!$mid){
		echo '<script type="text/javascript">window.location = "index.php"</script>';
	}
		
}

function qury_arr($sql, $conn){
	$result = qury_sel($sql, $conn);
	$row = array();
// var_dump($result->num_rows);
	if ($result->num_rows) {
		$j = 0;
		while ($d = mysqli_fetch_assoc($result)){
			$row[$j++] = $d;
		}
	}
	return $row;
}

function qury_sel($sql, $conn){
	$result = $conn->query($sql) or die('select error: '.mysqli_error($conn));
	return $result;
}

function qury_one($sql, $conn){
	$result = $conn->query($sql) or die('query one error: '.mysqli_error($conn));
	$num = mysqli_fetch_array($result, MYSQLI_NUM);
	return $num[0];
}

function qury_non($sql, $conn){
	$result = $conn->query($sql) or die("query error: ".mysqli_error($conn));
	return true;
}

function alert_and_go( $alert, $go ){
	echo "<script type='text/javascript'>alert('".$alert."'); location.assign('".$go."');</script>";
}
function just_go( $go ){
	echo "<script type='text/javascript'>location.assign('".$go."');</script>";
}
function insert_hash($table, $data, $conn){
        $key = array();
        $val = array();
        foreach( $data as $k => $v ){
            $key[] = "`$k`";
            if( $v===null )
                $val[] = 'NULL';
            else
                $val[] = "'".mysqli_real_escape_string($conn ,$v)."'";
        }
        $key = implode(',', $key);
        $val = implode(',', $val);
        return $conn->query("insert into $table ($key) values ($val)") or die("insert_hash error: ".mysqli_error($conn));
}

function update_hash($table, $where, $data, $conn){
        $set = array();
        foreach( $data as $k => $v ){
            if( $v===null )
                $set[] = "`$k`=NULL";
            else
                $set[] = "`$k`='".mysqli_real_escape_string($conn, $v )."'";
        }
        $set = implode(',', $set);
//        echo "update $table set $set where $where";
        return $conn->query("update $table set $set where 1=1 and $where") or die("update_hash error: ".mysqli_error($conn));
}

function get_option( $array, $select ){
	$option = "";
	foreach( $array as $k => $v ){
		$s = "";
		if( $k == $select )
			$s = "selected='selected'";
		$option .= "<option value='$k' $s>$v</option>";
	}
	return $option;
}

function gen_option($d) {
	$r = '';
	foreach ($d as $k => $v) {
		$r .= ('<option value="' . $v['item'] . '">' . $v['item'] . '</option>');
	}
	return $r;
}

function array2url ( $arr ){
	$arr2 = array();
	foreach( $arr as $key => $value ){
		$arr2[] = $key."=".$value ;
	}
	return implode( "&", $arr2 );
}
function isInDB( $field, $value, $table, $conn ){
	$sql = "SELECT COUNT(*) FROM `$table` WHERE 1=1 and `$field`='$value'";
	if( qury_one( $sql, $conn ) == '0' )
		return false;
	else
		return true;
}

//=================================================================
//
//取得資料function
//
//=================================================================
//取得玩家資料
function getUserData($conn, $mid){
	$sql = "SELECT * FROM users WHERE 1=1 and mid ='$mid'";	
	$result = qury_sel($sql, $conn);
	return $result;
}
//取得遊戲中文名稱
function getGameName_Chinese($_gtype){
	$gameCName = $GLOBALS['gameName_Chinese'][$_gtype-1];	
	return $gameCName;
}
//取得遊戲英文名稱
function getGameName($_gtype){
	$gameName = $GLOBALS['gameName'][$_gtype-1];	
	return $gameName;
}
//取得資料表名稱
function getTableName($_gtype){	
	$tbname = $GLOBALS['dbtableName'][$_gtype-1];	
	return $tbname;
}
function getPeriodbyPage($conn, $gametype, $per, $page){
	$result = getTopPeriod($conn, $gametype, "", "", $per, $page);
	return $result;
}
function getPeriodbyLong($conn, $gametype, $topnum){	
	$result = getTopPeriod($conn, $gametype, $topnum, "", "", "");
	return $result;
}
function getPeriodLast($conn, $gametype){	
	$result = getTopPeriod($conn, $gametype, 1, "", "", "");
	return $result;
}
function getTopPeriod($conn, $gametype, $topnum, $date, $per, $page){
	$tablename = getTableName($gametype);
	$sql = "SELECT * FROM ".$tablename." ";	
	
	if($date!=""){
		$date_ary = explode("/",$date); 
		$newdate = implode("-",$date_ary);
		$yy =$date_ary[0];
		$mm =$date_ary[1];
		$dd =$date_ary[2]; 
		$nextdd = (int)$dd+1;
		$sql .= " and (time > ".$newdate." and time < ".$yy."-".$mm."-".$nextdd;
	}
		
	$sql .= "ORDER BY `id` DESC ";
	
	if($page!=""){
		//如果有分頁
		$st = ((int)$page-1)*$per;
		$sql .= "LIMIT $st , $per "; 	
	}else{
		//如果沒有分頁	
		if($topnum!=""){
		$limitnum=$topnum;	
	}else{
		$limitnum=12;	
	}
		$sql .= "LIMIT 0 , ".$limitnum." ";	
	}	
	$result = qury_sel($sql, $conn);	
	return $result;
}

function getPeriodTotalNum($conn, $gametype){
	$tablename = getTableName($gametype);
	$sql = "SELECT COUNT(*) FROM $tablename where 1=1";
	//echo $sql;
	$count = qury_one( $sql, $conn );
	return $count;
}
function echoValue($valuename,$value){
	echo $valuename.":".$value."<br/>";
}

function getBetInfobyUserId($conn, $mid, $limit){
	return getBetInfo($conn, $mid, "", $limit, "", "", "");
}
function getBetInfobyGametype($conn, $gametype, $limit){
	return getBetInfo($conn, "", $gametype, $limit, "", "", "");
}
function getBetInfobyUserBetInGame($conn, $mid, $gametype, $limit){
	return getBetInfo($conn, $mid, $gametype, $limit, "", "", "");
}
function getBetInfobyUserBettodayInGame($conn, $mid, $gametype, $date){	
	//echo "date:".$date;
	return getBetInfo($conn, $mid, $gametype, "", $date, "", "");
}
function getBetInfobyUserNoPass($conn, $mid, $gametype, $date){	
	//echo "date:".$date;
	return getBetInfo($conn, $mid, "", "", $date, "N", "");
}

function getBetInfo($conn, $mid, $gametype, $limit, $date, $pass, $per){
	$sql = "SELECT * FROM betdata WHERE 1=1 ";
	if($mid!=""){
		$sql .=" and uid ='$mid' ";	
	}
	if($gametype!=""){
		$sql .="and gametype='$gametype' ";	
	}
	if($date!=""){
		$startDate = $date;
		$newdate = explode("-",$date);	
		$aa = 	(int)$newdate[2]+1;
		if($aa<10){
			$aa="0".$aa;	
		}
		//echo $aa;
		$limitDate = $newdate[0]."-".$newdate[1]."-".$aa;
		//echo $startDate.":".$limitDate ;
		$sql .="and (time >='$startDate' and time<'$limitDate') ";
	}
	if($pass!=""){
		$sql .="and pass='$pass' ";
	}
	$sql .="order by id DESC ";
	if($limit!=""){
		$sql .= "LIMIT 0, $limit";	
	}else{
		$sql .= "LIMIT 0, 20";	
	}	
	//echo $sql;
	$result = qury_sel($sql, $conn);	
	return $result;
}
function getBetInfobyAccount($conn, $mid, $gametype, $limit, $date, $pass){
	$sql = "SELECT uid, gametype, DATE_FORMAT( time, '%Y-%m-%d' ) AS newtime, count( * ) AS betnum, sum( betmoney ) AS betmoney, sum( winmoney ) AS winmoney 
FROM betdata WHERE 1=1 ";
	$sql .= "and uid ='$mid' and pass='Y' ";
	if($gametype!=""){
		$sql .= "and gametype ='$gametype' ";
	}
	if($date!=""){
		$startDate = $date;
		$newdate = explode("-",$date);	
		$aa = 	(int)$newdate[2]+1;
		if($aa<10){
			$aa="0".$aa;	
		}
		//echo $aa;
		$limitDate = $newdate[0]."-".$newdate[1]."-".$aa;
		//echo $startDate.":".$limitDate ;
		$sql .="and (time >='$startDate' and time<'$limitDate') ";
	}	
	$sql .= "GROUP BY newtime, uid, gametype ";
	$sql .= "ORDER BY gametype, newtime DESC ";
	if($limit!=""){	
		if($limit=="no"){
			
		}else{
			$sql .= "LIMIT 0, $limit";	
		}
	}else{
		$sql .= "LIMIT 0, 21";	
	}
		
	$result = qury_sel($sql, $conn);	
	return $result;
}
function getBetInfobyAccountPage($conn, $mid, $gametype, $limit){	

	$sql = "SELECT uid, DATE_FORMAT( time, '%Y-%m-%d' ) AS newtime, count( * ) AS betnum, sum( betmoney ) AS betmoney, sum( winmoney ) AS winmoney
FROM `betdata` where 1=1 and pass='Y' ";
	if($mid!=""){
		$sql .= "and uid ='$mid' ";
	}
	if($gametype!=""){
		$sql .= "and gametype ='$gametype' ";
	}	
	$sql .= "GROUP BY newtime, uid ";
	$sql .= "ORDER BY newtime DESC ";
	if($limit!=""){	
		if($limit=="no"){
			
		}else{
			$sql .= "LIMIT 0, $limit";	
		}
	}else{
		$sql .= "LIMIT 0, 21";	
	}
		
	$result = qury_sel($sql, $conn);	
	return $result;
}
function getBetInfobyAccountPage2($conn, $mid, $gametype, $per, $page, $date, $pass){	

	$sql = "SELECT * FROM betdata WHERE 1=1 ";
	if($mid!=""){
		$sql .=" and uid ='$mid' ";	
	}
	if($gametype!=""){
		$sql .="and gametype='$gametype' ";	
	}
	if($date!=""){
		$startDate = $date;
		$newdate = explode("-",$date);	
		$aa = 	(int)$newdate[2]+1;
		if($aa<10){
			$aa="0".$aa;	
		}
		//echo $aa;
		$limitDate = $newdate[0]."-".$newdate[1]."-".$aa;
		//echo $startDate.":".$limitDate ;
		$sql .="and (time >='$startDate' and time<'$limitDate') ";
	}
	if($pass!=""){
		$sql .="and pass='$pass' ";
	}
	$sql .="order by id DESC ";
	if($page!=""){
		$st = ($page-1)*$per;
		$sql .= "LIMIT $st, $per";	
	}else{
		$sql .= "LIMIT 0, 20";	
	}	
	//echo $sql;
	$result = qury_sel($sql, $conn);	
	return $result;
}
function getTodyWin($conn, $mid, $gametype, $limit){	
	return getBetInfobyAccountPage($conn, $mid, "", $limit);
}
function checkNum($s1, $s2, $s3){
		$ary=array((int)$s1, (int)$s2, (int)$s3);
		sort($ary);
		//echo $ary[0].$ary[1].$ary[2]."<br>";
		$a2 =  (string)($ary[2]-$ary[1]);
		$a1 =  (string)($ary[1]-$ary[0]);
		//echo $a1.":".$a2."<br>";
		$_type=0;		
		if($ary[0]==$ary[1] && $ary[1]==$ary[2]){
			//豹子
			$_type=1;	
		}else if($ary[0]==$ary[1] or $ary[0]==$ary[2] or $ary[1]==$ary[2]){
			//對子
			$_type=3;	
		}else if($a1=="1" && $a2=="1"){
			//順子
			$_type=2;
		}else if($a1=="1" || $a2=="1"){
			//半順
			$_type=4;
		}else if($ary[0]==0){
			//含0的順子
			if($ary[1]==1 && $ary[2]==9){				
				$_type=2;	
			}else if($ary[1]==8 && $ary[2]==9){
				$_type=2;
			}else if($ary[2]==9){
				//含0的半順			
				$_type=4;
			}else{
				$_type=5;
			}
		}else{
			$_type=5;
		}
		//echo $_type."<br>";
		//echo "====<br>";
		return $_type;
	}
	
function makeperiodList($periodlist,$_gtype){
	$award = explode(",",$periodlist);
	for($i=0;$i<count($award);$i++){
		if($_gtype==2){					
			if($i==0){
				echo "<span class=\"pk p".$award[$i]."\">".$award[$i]."</span>";
			}else{
				echo "<span class=\"pk p".$award[$i]."\">".$award[$i]."</span>";	
			}
				
		}else{
			if($gametype==3 || $gametype==4){				
				if($award[$i]%2==0 ){
					echo "<span class=\"ball pink p22\">".$award[$i]."</span>";
				}else{
					echo "<span class=\"ball blue p22\">".$award[$i]."</span>";	
				}
				
			}else if($gametype==5){				
				echo "<span class=\"ball yellow p22\">".$award[$i]."</span>";
				/*if($award[$i]%2==0 ){
					echo "<span class=\"ball yellow p22\">".$award[$i]."</span>";
				}else{
					echo " <span class=\"ball yellow p22\">".$award[$i]."</span>";	
				}*/
				
			}else{
				$award = explode(",",$result["award"]);				
				if($i==0){
					echo "<span class=\"ball red p22 nn\">".$award[$i]."</span>";
				}else{
					echo "<span class=\"ball yellow p22 nn\">".$award[$i]."</span>";	
				}
			}			
		}
	}
}






//=================================================================
//
//Amdin取得資料function
//
//=================================================================
//取得會員類型名稱
function getMemberTypeName($type){	
	$typeName = $GLOBALS["agencyName"][$type];
	return $typeName;
}
//取得下線代理數
function getSubAgencyCount($conn, $mid){
	$sql = "SELECT COUNT(*) FROM users where `parent` = '$mid'";
	$result = qury_one($sql, $conn);
	return $result;
}
function getSubLevelCount($conn, $mid){
	$sql = "SELECT COUNT(*) FROM users where `parent` = '$mid'";
	$result = qury_one($sql, $conn);
	return $result;
}
//取得下線代理資料
function getSubAgencyListByPage($conn, $mid, $page, $per){
	return getSubAgencyList($conn, $mid, $page, $per);
}
//取得代理資料
function getSubAgencyList($conn, $mid, $page, $per){
	$sql = "SELECT * FROM users  where `parent` = '$mid' and level != 9 ";	
	$sql .= "ORDER BY `mid` ASC ";
	if($page!=""){
		$start = ($page - 1) * $per;
		$sql .= "LIMIT $start , $per ";
	}	
	$result = qury_sel($sql, $conn);	
	return $result;	
}
function getSubLevelList($conn, $mid, $page, $per){
	$sql = "SELECT * FROM users  where `parent` = '$mid'";	
	$sql .= "ORDER BY `mid` ASC ";
	if($page!=""){
		$start = ($page - 1) * $per;
		$sql .= "LIMIT $start , $per ";
	}	
	$result = qury_sel($sql, $conn);	
	return $result;	
}
function getSubMemberCountByoneAgency($conn, $mid){
	$sql = "SELECT COUNT(*) FROM users where `parent` = '$mid' and level = 9";
	$result = qury_one($sql, $conn);
	return $result;
}

//取得下線會員資料
function getSubMemberListByPage($conn, $mid, $page, $per){
	return getSubMemberList($conn, $mid, $page, $per);
}
//取得代理資料
function getSubMemberList($conn, $mid, $page, $per){
	$sql = "SELECT * FROM users  where `parent` = '$mid' and level = 9";	
	$sql .= "ORDER BY `mid` ASC ";
	if($page!=""){
		$start = ($page - 1) * $per;
		$sql .= "LIMIT $start , $per ";
	}	
	$result = qury_sel($sql, $conn);	
	return $result;	
}
//取得會員狀況
function getStatusName($status){
	$typeName = $GLOBALS["statusAry"][$status-1];
	return $typeName;
}
//取得會員資料
function getMemberData($conn, $mid){
	$sql = "SELECT * FROM users  where `mid` = '$mid'";	
	$result = qury_sel($sql, $conn);	
	return $result;		
}
function getMemberDataById($conn, $uid){
	$sql = "SELECT * FROM users  where `id` = '$uid'";	
	$result = qury_sel($sql, $conn);	
	return $result;		
}
//帳號是否重覆
function checkUidCanUse($conn, $mid){
	$sql = "SELECT * FROM users WHERE 1=1 and mid='$mid'";
	$result = qury_sel($sql, $conn);
	if( mysqli_num_rows( $result ) == 1 ){
		//用過了，不能用		
		return false;	
	} else {
		//沒用過，可以用
		return true;
	}
}
function getSubMemberListAry($conn, $mid){	
	$mary=array();
	//先找出直屬會員
	$sql = "SELECT * FROM users where `parent` = '$mid' and level = 9";
	$result = qury_sel($sql, $conn);
	while($data = mysqli_fetch_assoc($result)){
		$mary[] = $data["mid"];		
	}
	//找出代理下的會員
	$sql2 = "SELECT * FROM users where `parent` = '$mid' and level != 9";
	$result2 = qury_sel($sql2, $conn);
	while($data2 = mysqli_fetch_assoc($result2)){
		//代理的id
		$aid = $data2["mid"];
		$sql3 = "SELECT * FROM users where `parent` = '$aid' and level = 9";
		$result3 = qury_sel($sql3, $conn);
		while($data3 = mysqli_fetch_assoc($result3)){
			$mary[] = $data3["mid"];		
		}
	}
	return $mary;
}
function getSubMemberListAll($conn, $mid){	
	
	$mary = getSubMemberListAry($conn, $mid);
	
	//產生帳號sql
	$ss = "(";
	$len = count($mary);
	if($len>0){
		for($i=0;$i<$len;$i++){
			$ss.=" `mid` = '$mary[$i]' ";
			if($i<$len-1){
				$ss.="or ";
			}else{
				$ss.=") ";
			}
		}
		$sql4 = "SELECT * FROM users  where ".$ss;
		$sql4 .="ORDER BY `mid` ASC ";
		$result4 = qury_sel($sql4, $conn);
		return $result4;
	}else{
		return null;	
	}
}
//取得下會員理數
function getSubMemberCount($conn, $mid){
	$mary = getSubMemberListAry($conn, $mid);
	$len = count($mary);
	return $len;
}
function getParentLeft($conn, $mid, $money_max){	
	$sresult = getSubMemberListAll($conn, $mid);
	
	$moneyTotal = 0;
	//$aa = mysql_num_rows($sresult);
	//phpalert($aa);
	//if(mysql_num_rows($sresult)>0){
	
	if($sresult != null){
		while($data = mysqli_fetch_assoc($sresult)){
			$moneyTotal+=(int)$data["money_max"];
		}
	}
	//}
		
		$parentLeft = $money_max-$moneyTotal;
		return $parentLeft;
	
}
function phpalert($value){
	echo "<script language=\"javascript\">";
    echo "phpalert='".$sresult."'";
    echo "</script>"; 
}
function getReport($gametype ){
	$sql = "SELECT uid, DATE_FORMAT( time, '%Y-%m-%d' ) AS newtime, count( * ) AS betnum, sum( betmoney ) AS betmoney, sum( winmoney ) AS winmoney
FROM `betdata` a inner where 1=1 and pass='Y' ";
	if($mid!=""){
		$sql .= "and uid ='$mid' ";
	}
	if($gametype!=""){
		$sql .= "and gametype ='$gametype' ";
	}	
	$sql .= "GROUP BY newtime, uid ";
	$sql .= "ORDER BY newtime DESC ";
	if($limit!=""){	
		if($limit=="no"){
			
		}else{
			$sql .= "LIMIT 0, $limit";	
		}
	}else{
		$sql .= "LIMIT 0, 21";	
	}
		
	$result = qury_sel($sql, $conn);	
	return $result;
}
function number2($_num){
	$newnum = floor($_num*100)/100;
	return $newnum;
}
function checkColor($_num){
	if((int)$_num<0){
		return "<span class=\"c_red\">$_num</span>"	;
	}else{
		return 	$_num;
	}
}
function getReportSql($_mid){
	$aaa = "SELECT mid FROM `users` WHERE `parent` in (" . $_mid . ")";
  return $aaa;
	
}



?>