function myErr(){
	alert("發生錯誤，請重試或洽程式設計師");
}
function htmlspecialchars(ch) {
	if (ch===null) return '';
	ch = ch.replace(/&/g,"&amp;");
	ch = ch.replace(/\"/g,"&quot;");
	ch = ch.replace(/\'/g,"&#039;");
	ch = ch.replace(/</g,"&lt;");
	ch = ch.replace(/>/g,"&gt;");
	return ch;
}

function showAlertWin(){
	$('body').css('overflow',"hidden")
	$("#mask").css("visibility","visible");
	$("#alert_win").css("visibility","visible");
	$("#alert_cancle").click(function(){
		hideAlertWin()	
	})
}
function hideAlertWin(){
	$('body').css('overflow',"auto")
	$("#mask").css("visibility","hidden");
	$("#alert_win").css("visibility","hidden");
}

function myTimeout(){
	alert("連線逾時，請重新輸入");
	location.assign("logout.php");
}

function myDelete( table_name, key, value ){
	$.ajax({
		url: "fun/myDelete.php",
		type: "POST",
		data: { table_name: table_name, key: key, value: value },
		error: function(){
			myErr();
		}, 
		success: function( back ){
			var aa = $.trim( String(back) );
			if( aa == "success" ){
				alert("已刪除");
				location.reload();
			} else if ( aa == "timeout" ){
				myTimeout();
			} else {
				alert( aa );
			}
		}
	});
}

function myClear( table_name, key, value ){
	$.ajax({
		url: "fun/myClear.php",
		type: "POST",
		data: { table_name: table_name, key: key, value: value },
		error: function(){
			myErr();
		}, 
		success: function( back ){
			var aa = $.trim( String(back) );
			if( aa == "success" ){
				alert("已刪除");
				location.reload();
			} else if ( aa == "timeout" ){
				myTimeout();
			} else {
				alert( aa );
			}
		}
	});
}


function checkUidCanUse(uid){
	$.ajax({
		url: 'data_checkuiduse.php',
		data: { mid: uid},
		type: 'POST',
		success: function(back){
			 alert("+"+back+"+");
			var aa = $.trim( String(back) );
			alert("aa = "+aa)			
			if(aa == "success"){
				return true;				
			} else {
				return false;
			}
		},
		error: function(){
			//alert("確認發生錯誤");
			return "確認發生錯誤";
		}
	});	
}
