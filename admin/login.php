<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>登入</title>
<link href="css/access.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
function login(){
	if($("#mid").val()==""){
		alert("請輸入您的用戶名")
		return;	
	}
	if($("#pw").val()==""){
		alert("請輸入您的密碼")
		return;	
	}
	if($('#captcha_code').val()==""){
		alert("請輸入驗證碼")
		return;	
	}
	$.ajax({
		url: 'login_check.php',
		data: { mid: $("#mid").val(), pw: $("#pw").val(),captcha_code: $('#captcha_code').val() },
		type: 'POST',
		success: function(back){
			// alert("+"+back+"+");
			var aa = $.trim( String(back) );
// console.debug (aa);
// return false;			
			if(aa == "success"){				
				window.location.assign("default.php?lang=1");
			} else {
				alert(back);
				$("#pw").val("");
				$('#captcha_code').val("")
				document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false
			}
		},
		error: function(){
			alert("發生錯誤，請重試或洽資訊人員");
			$("#pw").val("");
		}
	});}

$( document ).ready(function() {
	$(".betsubmit").click(login);
	$("#mid").keydown(function(event){
		if( event.keyCode == "13" ){
			$("#pw").focus();
		}
	});
	$("#pw").keydown(function(event){
		if (event.keyCode == "13"){
			login();
		}
	});
	$("#captcha_code").keydown(function(event){
		if (event.keyCode == "13"){
			login();
		}
	});
	
});
</script>
</head>

<body>
<div class="wrap"> 
  <!--header start-->
  <div class="header">
    <div class="h_main">
      <h1><img src="images/logo.png" alt="LOGO" /></h1>
    </div>
  </div>
  <!--header end-->
  
  <div class="admin_content">
    <h2 class="login">帳戶登入</h2>
    <table width="100%" border="0" class="t_log">
      <tr>
        <th scope="row">用戶名</th>
        <td><div class="inp">
            <input type="text" id="mid" name="mid"  >
          </div></td>
      </tr>
      <tr>
        <th scope="row">密&nbsp;&nbsp;&nbsp;&nbsp;碼</th>
        <td><div class="inp">
            <input type="password" id="pw" name="pw">
          </div></td>
      </tr>
      <tr>
        <th scope="row">驗證碼</th>
        <td valign="middle"><div class="inp cha">
            <input class="cha" type="text" name="captcha_code" id="captcha_code" placeholder=""  />
          </div>
          <img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" width="88" style="float:right" /></td>
      </tr>
      <tr>
        <td colspan="2" scope="row" align="center"><div class="betsubmit">登錄</div></td>
      </tr>
    </table>
  </div>
</div>
</body>
</html>