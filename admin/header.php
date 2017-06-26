<?php

?>
<script type="text/javascript">
var lang = $.cookie("lang");
//alert(lang)
$( document ).ready(function() {
	$('#cssmenu').prepend('<div id="menu-button">Menu</div>');
	$('#cssmenu #menu-button').on('click', function(){
		var menu = $(this).next('ul');
		if (menu.hasClass('open')) {
			menu.removeClass('open');
		}
		else {
			menu.addClass('open');
		}
	});
	//$("#browser").treeview();
	$(".lang select").val(lang)
	
	$(".lang select").on('change', function() {
		var url= window.location.href; 
		var num = $(this).val()
		if(num!=lang){			
			if(lang==1){
				url = url.replace("lang=1", "lang=2"); 
				
			}else{
				url = url.replace("lang=2", "lang=1"); 
				
			}
			lang = num	
			$.cookie("lang",lang)
			location.href =url
		}
	});
})

</script>


<div class="header">
  <div class="header_top">
    <div class="wrapin">
      <div class="logo"><a href="default.php"><img src="images/logo.png" alt="9i8" /></a></div>
      <div class="rmenu">
        <div class="m_menu" id='cssmenu'>
          <ul>
            <li><a href="schedule.php">議程</a></li>
            <li><a href="speaker.php">講師清單</a></li>
            <li><a href="news.php">新聞中心</a></li>
            <li><a href="csr.php">公益活動</a></li> 
            <li><a href="photo.php">活動照片</a></li>           
            <li><a href="vote.php">投票</a></li>
            <li><a href="cards.php">電子名片</a></li>
          </ul>
        </div>
        <div class="lang"><select name="">
          <option value="1">中文</option>
          <option value="2">英文</option>
        </select></div>
        <div class="uid"> 管理員:<?=$_SESSION["mid"];?> <a href="logout.php" alt="登出" title="登出"><img src="images/logout.png" width="14" height="14"/></a></div>
      </div>
    </div>
  </div>
</div>
