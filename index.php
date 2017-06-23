<?php
	require_once("include.php");

	$lang = $_GET['lang'];
	if(empty($lang)){
		$lang=1;
	}
	if($lang==1){
		$langName = "中文";
	}else{
		$langName = "English";
	}


	//speaker
	$speaker_rows = array();
	$sql_speaker = "SELECT * FROM lecturers where `show`=1 and lang=$lang ORDER BY `order`, `id` DESC";
	$result_speaker = qury_sel($sql_speaker, $conn);
	while($r = mysqli_fetch_assoc($result_speaker)) {
    	$speaker_rows[] = $r;
	}
	$json_speaker = json_encode($speaker_rows);

	//news
	$news_rows = array();
	$sql_news = "SELECT * FROM news where lang=$lang ORDER BY `created_at` DESC";
	$result_news = qury_sel($sql_news, $conn);
	while($r = mysqli_fetch_assoc($result_news)) {
    	$news_rows[] = $r;
	}
	$json_news = json_encode($news_rows);


	//csr
	/*$csr_rows = array();
	$sql_csr = "SELECT * FROM csr where lang=$lang ORDER BY `id` DESC limit 3";
	$result_csr = qury_sel($sql_csr, $conn);

	while($r = mysqli_fetch_assoc($result_csr)) {
    	$csr_rows[] = $r;
	}
	$json_csr = json_encode($csr_rows);*/

	//album
	$album_rows = array();
	$album_ary = array();
	$sql_album = "SELECT * FROM album ORDER BY  `order`, `id` DESC limit 9";
	$result_album = qury_sel($sql_album, $conn);

	while($r = mysqli_fetch_assoc($result_album)) {
    	$album_rows[] = $r;
		$album_ary[] = "pic/album/".$r["image"];
	}
	$json_album = json_encode($album_ary);

	if($lang==2){
		$countdown = "";
		$day = "";
		$hh="Asian MICE Forum 2017";
		$t1 = "Introduction";
		$t2 = "Agenda";
		$t3 = "Speakers";
		$t4 = "Registration";
		$t5 = "News";
		$t6 = "CSR";
		$t7 = "Album";
		$t8 = "History";
		$t9 = "Links";
		$t10="International<br>Organizations";
		$t11="Domestic<br>Association";
		$t12="Government<br>Promote Unit";
		$t13="International<br>Press";
		$t14="Partner";

		$t1_1 = "The New Era of Experiencing and Sharing";
		$t1_2 = "FOCUS";
		$t1_3 = "Speakers";

		$t1_1_2 = "The 11th annual Asian MICE Forum (AMF 2017) is themed“The New Era of Experiencing and Sharing”, invites speakers from the world's most important MICE organizations, such as UFI, ICCA and SITE award winners. In addition, MICE experts around the world will join the event to share their thoughts and experiences.";
		$t1_2_2 = "<li>2025 MICE Outlook</li>
<li>Inside of Big Data Marketing in MICE</li>
<li>Best Practices of Incentive Travel in Asia</li>
<li>Legacy of Heineken Experience®</li>
<li>Story of Sapporo Snow Festival</li>";
		$t1_3_2 = "<li>Managing Director of UFI</li>
<li>President of SITE</li>
<li>The 25 Most Influential People in Meeting Industry—Experience Design Master</li>
<li>Winners of ICCA SITE and UFI Awards</li>
<li>Forbes Asia’s Top 50 Woman- Ms. Shenan Chuang</li>
<li>Top Leader of Creative Event Marketing in Asia</li>";

		$t4_1='
            <div class="apply_wordTT">
			<p>2017 AMF registration can only be paid by electronic transfer directly into the Organizer\'s bank account. Once all required information is entered and the form successfully mailed to amf@taitra.org.tw, a confirmation message with electronic transfer account will be sent to the email address you specified (please complete the payment within 3 days) as soon as the registration has been processed.</p>
    <div class="apply_info">
        <h5 class="i3">September 07 - 08 , 2017</h5>
        <h5 class="i4">Taipei International Convention Center</h5>
    </div>

</div>
<div class="apply_word00">
    <div class="apply_word01"> <span class="apply_w2">Registration Fee (for oversea participants): </span><span class="apply_w3">USD$ 300 (approx. NTD$10,000). Includes two-day program, refreshment breaks, and lunchbox on September 8. (Group Rate at USD$200 each person: 3 or more than 3 registrants must be from the same company and registered at the same time.)</span><br></div>

    <div class="apply_word01"> <span class="apply_w2">Registration Deadline: </span><span class="apply_w3">August 30, 2017</span></div>
    <div class="apply_word01"><span class="apply_w3">Cancellations will not be refunded. Participants must acquire all necessary travel documents.</span><br></div>
    <div class="apply_word01"><span class="apply_w3">To register, modify information, or change participants after completing the registration process, please email <a href="mailto:amf@taitra.org.tw">amf@taitra.org.tw</a> or contact <a href="tel:+886 2 27255200">+886 2 27255200 ext.3525</a> Ms. Sherry Yang.</span><br></div>
</div>
          ';

	}else{
		$countdown = "";
		$day = "";
		$hh="第12屆亞洲會展產業論壇";
		$t1 = "活動簡介";
		$t2 = "議程資訊";
		$t3 = "講師資訊";
		$t4 = "活動報名";
		$t5 = "新聞中心";
		$t6 = "公益活動";
		$t7 = "活動照片";
		$t8 = "精彩回顧";
		$t9 = "友善連結";
		$t10="國際會展組織";
		$t11="國內會展協會";
		$t12="政府會展推廣單位";
		$t13="國際媒體";
		$t14="合作夥伴";

		$t1_1 = "創新會展．翻轉城市";
		$t1_2 = "本屆焦點";
		$t1_3 = "講師介紹";

		$t1_1_2 = "由經濟部國際貿易局委託外貿協會辦理的「亞洲會展產業論壇」（Asian MICE Forum 2017），今年將於9月6日至7日首度移師高雄。本屆以「創新會展‧翻轉城市」為主軸，邀請IAEE主席、IMEX國際總監、西班牙火祭節、福岡博多咚打鼓海港祭、奧美互動行銷公司董事總經理張志浩、智威湯遜廣告公司董事總經理鄧博文、Info Salons董事總經理顧學斌、Accupass執行長羅子文等全球會展協會重量級代表及全球創意行銷高手，引進第一手會展流行新知，帶您掌握創意活動的致勝關鍵。";
		$t1_2_2 = "<li>2015亞洲創意節「最佳創意獎」得主</li>
<li>西班牙火祭節魅力風潮</li>
<li>博多咚打鼓海港祭經典傳承</li>
<li>NEXT! 亞洲會展新脈動</li>
<li>數位會展科技新體驗</li>";
		$t1_3_2 = "<li>國際展覽暨活動協會-IAEE 2018年主席</li>
<li>全球最大獎勵旅遊展-IMEX Group</li>
<li>創意會議設計翹楚- Mindmeeting創辦人</li>
<li>智威湯遜廣告(JWT)董事總經理</li>
<li>Info Salons董事總經理</li>
<li>Accupass執行長</li>";

		$t4_1='
		<div class="apply_wordTT">
	    <h3>報名注意事項</h3>
	    <div class="apply_info">
	      <h5 class="i3">September 06 - 07 , 2017</h5>
	      <h5 class="i4">高雄展覽館304會議室</h5>
	    </div>
	  </div>
	  <div class="apply_word00">
	    <!--<div class="apply_word01"> <span class="apply_w2">購票網址: </span><span class="apply_w3"><a style="color:#FCFA76" target="_blank" href="https://www.accupass.com/event/shareregister/1607190947581090877667">點此購票</a></span></div>-->
	    <div class="apply_word01"> <span class="apply_w2">報名費用：</span><span class="apply_w3">每人新臺幣1,300元整 。</span><br>
	      <span class="apply_w3">（包含9月6日、9月7日會議茶點及9月6日午餐）。</span>
	    </div>
	    <div class="apply_word01"><span class="apply_w3">2017年8月10日前報名享早鳥優惠每人新台幣1,100元整。</span></div>
	    <div class="apply_word01"> <span class="apply_w2">報名截止日期：</span><span class="apply_w3">2017年8月31日（本活動恕不受理現場報名。）</span></div>
	    <div class="apply_word01"><span class="apply_w3">退票申請於2017年8月31日前辦理，逾期恕不受理退票。（本論壇委託「活動通」辦理退票事宜，退票時將酌收票面金額10%的退票手續費，退款金額＝票面金額－10%手續費。）</span><br>
	    </div>
	    <div class="apply_word01"><span class="apply_w3">若無法瀏覽報名資訊，請移至報名網站。</span><br>
	    </div>
	    <div class="accu"><span class="apply_w3">本活動透過<a href="http://www.accupass.com/go/2017amf" target="_blank"><img src="images/accupass.png"></a>報名。</span><br>
	    </div>
			<div class="apply_word01"> <span class="apply_w2">住宿資訊：</span><span class="apply_w3">飯店優惠均由各飯店自行提供，本會不收取任何訂房手續費，也不負擔任何在飯店發生的費用。<br>
所有費用，皆由飯店直接跟入住客人收取。</span>
	    </div>
	  </div>';

	}


?>
<!doctype html>
<html>
      <head>
      <meta charset="utf-8">
      <title>2017年第十二屆亞洲會展產業論壇</title>
      <meta name="description" content="「2017亞洲會展產業論壇(AMF)」即將於9月6日至7日在高雄(TICC)登場！將邀請國際重量級會展領袖及活動籌辦高手齊聚一堂，攜手引領會展新浪潮！" />
<meta name="keywords" content="亞洲會展產業論壇、AMF、會展、論壇、TICC" />
      <meta name="viewport" content="width=device-width; initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
      <link href="css/reset.css" rel="stylesheet" type="text/css">
      <link href="css/amf.css" rel="stylesheet" type="text/css">
      <link href='https://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="css/swiper.css">
      <link type="text/css" href="css/jquery.jscrollpane.css" rel="stylesheet" media="all" />
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
      <script src="js/jquery.cookie.js"></script>
      <script src="js/swiper.min.js"></script>
      <link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
      <script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
      <script type="text/javascript" src="js/jquery.jscrollpane.min.js"></script>
      <script type="text/javascript" src="js/jquery.mousewheel.min.js"></script>
      <script>
	  	//var csr_ary = eval(<?=$json_csr?>)
		var speaker_ary = eval(<?=$json_speaker?>)
		var news_ary = eval(<?=$json_news?>)
		var album_ary = eval(<?=$json_album?>)
		var lang = <?=$lang?>;
		var menu_open = false
         $( document ).ready(function() {

			 initDay()
			 //initAlbum()
			 //setCsrPage()

			 $("a.btn_close").click(function(){
				 closePopwin()
			 })

			 $("a[rel^='prettyPhoto']").prettyPhoto({
				show_title: false,
                social_tools:false
			 });

			 $('nav .menu li a.go').click(function(event){
				event.preventDefault();
				 var arch = $(this).attr("href")
				 var top = $(arch).offset().top;
				 $('html, body').animate({
					scrollTop: top
				},800, 'easeInOutCubic');

				if(menu_open==true){
					closeMenu();
				}
				return false;
			})
			$('a.join').click(function(event){
				event.preventDefault();
				 var arch = $(this).attr("href")
				 var top = $(arch).offset().top;
				 $('html, body').animate({
					scrollTop: top
				},800, 'easeInOutCubic');


				return false;
			})
			$(".footer_top a").click(function(event){
				event.preventDefault();
				 var arch = $(this).attr("href")
				 var top = $(arch).offset().top;
				 $('html, body').animate({
					scrollTop: top
				},800, 'easeInOutCubic');

				return false;
			})


			$(".photolist li a").each(function(index, element) {
                var photostyle = "background-image:url("+album_ary[index]+"); background-size:cover; background-position:center;"
				$(this).attr("style",photostyle)
            });

           var swiper = new Swiper('.swiper-container', {
				paginationClickable: true,
				nextButton: '.swiper-button-next',
				prevButton: '.swiper-button-prev',
				autoplay: 5000
			});
			$("a.go_en").click(function(){
				goEn()
			})

			$("a.go_ch").click(function(){
				goEn()
			})

			$("a.day1").click(function(){
				$(".ss_day1").css("display","block")
				$(".ss_day2").css("display","none")
			})
			$("a.day2").click(function(){
				$(".ss_day1").css("display","none")
				$(".ss_day2").css("display","block")
			})

			 $(".pages a").each(function(index, element) {
				 $(this).click(function(){
					resetPage($(this),index)
				 })
			 })

			 $('ul.sublink li a').hover(
               function () {
				  var str_img = $(this).find("img").attr("src").split(".png")
				  var new_strimg =str_img[0]+"_on"+str_img[1]+".png"
                  $(this).find("img").attr("src",new_strimg)
               },

               function () {
				  var str_img = $(this).find("img").attr("src").split("_on.png")
				  var new_strimg =str_img[0]+str_img[1]+".png"
                  $(this).find("img").attr("src",new_strimg)
               }
            );

			$(".speaker_block").click(function(){
				var cur = $(this).attr("data-cur")
				showPopwin("speaker",cur)
			})

			$(".show_more a").click(function(){
				var cur = $(this).attr("data-cur")
				showPopwin("news",cur)
			})

			$(".menuicon").click(function(){
				menu_open=true
				$("nav").css("display","block")
				$(".menumask").css("display","block")
				$(".menumask").click(function(){
				 	closeMenu()
			 	})
			})
			$(".menu_close").click(function(){
				closeMenu()
			})

			$(".domore a").click(function(){
				var status = $(this).attr("data-status")
				if(status=="close"){
					$(this).attr("data-status","open")
					$("ul.photolist li.size3").css("display","block")
					$("ul.photolist li.size4").css("display","block")
					$("ul.photolist li.size5").css("display","block")
				}else{
					$(this).attr("data-status","close")
					$("ul.photolist li.size3").css("display","none")
					$("ul.photolist li.size4").css("display","none")
					$("ul.photolist li.size5").css("display","none")
				}
			})

         });
		 function initPage(){
			switch(lang) {
			 case 1:
			 break
			 case 2:
			 break
			}
		 }

		 function showPopwin(_type,cur){
			 $(".mask").css("display","block")
			 $(".popwin").css("display","block")
			 if(_type=="news"){
				 $(".block.news").css("display","block")
				 $(".block.speaker").css("display","none")
				 initNews(cur)
			 }else{
				 $(".block.news").css("display","none")
				 $(".block.speaker").css("display","block")
				 initSpeaker(cur)
			 }
			 $(".popwin").scrollTop(0);
			 $(".mask").click(function(){
				 closePopwin()
			 })
		 }
		 function initSpeaker(cur){
			 var ary = speaker_ary[cur]
			 $(".popwin .spic img").attr("src", "pic/lecturers/"+ary["image"])
			 $(".popwin .smain h2").html(ary["name"])
			 $(".popwin .smain h3").html(ary["title"])
			 $(".popwin .smain .sintro").html(ary["info"])
			 fixPos()
		 }
		 function initNews(cur){
			 var ary = news_ary[cur]
			 var str_list=""
			 var len = news_ary.length
			 if(len>=3){
				len=3
			 }
			 for(var i=0;i<len;i++){
				str_list+="<li><a data-cur=\""+i+"\">"+news_ary[i]["title"]+"</a><span>"+news_ary[i]["created_at"].substr(0,10)+"</span></li>"
			 }
			 $(".news_list ul").html(str_list)
			 $(".popwin .block.news .spic img").attr("src", "pic/news/"+ary["image"])
			 $(".popwin .nmain h2 span.title").html(ary["title"])
			 $(".popwin .nmain h2 span.date").html(ary["created_at"].substr(0,10))
			 $(".popwin .nmain .sintro").html(ary["content"])
 		 	 initNewsList()
			 fixPos()
		 }
		 function initNewsList(){
			$(".news_list ul li a").click(function(){
				var cur = $(this).attr("data-cur")
				showPopwin("news",cur)
		    })
		 }
		 function closeMenu(){
			 menu_open=false
			 $("nav").css("display","none")
			 $(".menumask").css("display","none")
		 }
		 function closePopwin(){
			 $(".mask").css("display","none")
			 $(".popwin").css("display","none")

		 }
		 function initDay(){
			var a = new Date().getTime()
        	var b = new Date("2017-09-07").getTime()
        	var c = 24*60*60*1000
	        var diffDays = Math.floor((Math.abs((a - b)/(c))));

			//$("#countdownday").html(diffDays)
		 }

		 function resetPage(obj, num){
			 $(".pages a").each(function(index, element) {
                $(this).removeClass("on");
            });
			obj.addClass("on")

			/*$('.content.csr').animate({
				opacity: 0,
			  	}, 300 , function() {
					initCsr(num)
				}
			)*/
		 }

		 function goEn(){
			 $("span.nowlang").html("English")
		 }

		 function goCh(){
			 $("span.nowlang").html("中文")
		 }
		 /*function setCsrPage(){
			 var len = csr_ary.length
			 var str = ""
			 for(var i=0;i<len; i++){
				if(i==0){
				 str+="<a class=\"on\"></a>"
				}else{
				 str+="<a></a>"
				}
			 }
			 $(".pages").html(str)
			 initCsr(0)
		 }
		 function initCsr(num){
			 var ary = csr_ary[num]
			 $(".csr_title").html(ary["title"])
			 $(".csr_date").html(ary["created_at"].substr(0,10))
			 if(ary["rights"]==""){
				 $(".csr_rights").css("display","none")
			 }else{
				 $(".csr_rights").css("display","inline-block")
			 	$(".csr_rights").html(ary["rights"])
			 }
			 $(".csr_pcont").html(ary["content"])
			 $(".content.csr").css("background","url(pic/csr/"+ary["image"]+") no-repeat center")

			 $(".content.csr").css("background-size","cover")
			 fadeIn()
		 }
		 function fadeIn(){
			 $('.content.csr').animate({
				opacity: 1,
			  	}, 500)
		 }*/

		 function fixPos(){
			 var ph = $(".popwin").height();
			 var newpos = (ph/2)*(-1)

			 var vh = $( window ).height();

			 $(".popwin").css("margin-top",newpos)

		 }

		 function openLink(_url){
			 window.open(_url, '_blank');
		 }
      </script>
      <script>

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){

  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),

  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)

  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');



  ga('create', 'UA-85607955-1', 'auto');

  ga('send', 'pageview');



</script>
      </head>
      <body>

<header>
        <div class="wrap">
    <div class="logo"><a href="index.php"><img src="images/AMF-logo.png"></a></div>
    <div class="menuicon"><img src="images/menu_icon.png"></div>
    <nav>
    <div class="menu_close"><img src="images/window_x.png"></div>
            <ul class="menu">
        <li><a href="#intro" class="go">
          <?=$t1?>
          </a></li>
        <li><a href="#schedule" class="go">
          <?=$t2?>
          </a></li>
        <li><a href="#speaker" class="go">
          <?=$t3?>
          </a></li>
        <li><a href="#apply" class="go">
          <?=$t4?>
          </a></li>
        <li class="secd"> <a href="#news" class="go">
          <?=$t5?>
          </a>
              </li>
							<li>
								<a href="#news" class="go">
				          <?=$t8?>
				          </a>
								<ul class="submenu">
            <li class="sub2"><a href="#photo" class="go">
              <?=$t7?>
              </a></li>
          </ul>
							</li>
							<li><a href="#news" class="go">
			          <?=$t9?>
			          </a></li>
        <li class="fb"><a href="https://www.facebook.com/asianmiceforum?fref=ts" target="_blank"><img src="images/facebook.png"></a></li>
        <li class="lang"><span class="nowlang">
          <?=$langName?>
          </span>
                <ul class="sublang">
            <li><a href="index.php?lang=2" class="go_en">English</a></li>
            <li><a href="index.php?lang=1" class="go_ch">中文</a></li>
          </ul>
              </li>
      </ul>
          </nav>
  </div>
      </header>
<div class="banner" id="top">
        <div class="bannermask"></div>
        <div class="banner_word">
    	<div class="toptitle"><img src="images/banner_text.png" alt=""></div>
    <!--<div class="date"><span class="first">2017</span> <span>09</span><span>07</span> <span class="dash">08</span></div>-->
    <div class="day"><span class="word">
      <?=$countdown?>
      </span><span class="number" id="countdownday"> </span><span class="word">
      <?=$day?>
      </span></div>
    <a class="join" href="#apply">
          <?=$t4?>
          </a> </div>
        <div class="banner_bar">
    <ul class="clearfix">
            <li class="b1"><span>LOCATION</span>台北國際會議中心101會議室</li>
            <li class="b2"><span>REGISTRATION FEE</span>每人新台幣1,300元整</li>
            <li class="b3"><span>SPEAKER</span>28 speakers</li>
          </ul>
  </div>
        <div class="swiper-container">
    <div class="swiper-wrapper">
            <div class="swiper-slide p1"></div>
            <div class="swiper-slide p2"></div>
            <div class="swiper-slide p3"></div>
          </div>
    <div class="swiper-button-next swiper-button-white"></div>
    <div class="swiper-button-prev swiper-button-white"></div>
  </div>
      </div>
<section class="content intro" id="intro">
        <div class="wrap intro">
    <h2 class="t2">
            <?=$t1?>
          </h2>
    <div class="intro_main clearfix">
            <div class="intro_block">
        <div class="intro_pic"><img src="images/photo2_1.png"></div>
        <div class="intro_words">
                <h3>
            <?=$t1_1?>
          </h3>
                <p>
            <?=$t1_1_2?>
          </p>
              </div>
      </div>
            <div class="intro_block">
        <div class="intro_pic"><img src="images/photo2_2.png"></div>
        <div class="intro_words">
                <h3>
            <?=$t1_2?>
          </h3>
                <ul class="bbul">
            <?=$t1_2_2?>
          </ul>
              </div>
      </div>
            <div class="intro_block">
        <div class="intro_pic"><img src="images/photo2_3.png"></div>
        <div class="intro_words">
                <h3>
            <?=$t1_3?>
          </h3>
                <ul class="bbul">
            <?=$t1_3_2?>
          </ul>
              </div>
      </div>
          </div>
  </div>
      </section>
<section class="content schedule" id="schedule">
        <div class="wrap schedule">
    <h2 class="t3">
            <?=$t2?>
          </h2>
    <div class="schedule_main clearfix">
            <div class="ss_day1">
        <div class="schedule_menu clearfix">
                <div class="schedule_day on"><a class="day1">
                  <p>DAY 1</p>
                  <p class="date">2017/09/06</p>
                  </a> </div>
                <div class="schedule_x"><img src="images/day_x.png"></div>
                <div class="schedule_day"><a class="day2">
                  <p>DAY 2</p>
                  <p class="date">2017/09/07</p>
                  </a> </div>
              </div>
        <table class="schedule1">
                <?php
		 $sql_day1 = "SELECT * FROM meeting_items where lang=$lang and start_date='2017-09-06'  ORDER BY `start_time`";
		 $result_schedule1 = qury_sel($sql_day1, $conn);
              while($data = mysqli_fetch_assoc($result_schedule1)){
				  $start_time = substr($data["start_time"], 0, -3);
				  $end_time = substr($data["end_time"], 0, -3);
				  $time = $start_time." - ".$end_time;
		?>
                <tr>
            <th><p class="w1">
                <?=$time?>
              </p></th>
            <td><p class="w2">
                <?=$data["title"]?>
              </p>
                    <div class="w3 s">
                <?php
            if(!empty($data["subtitle"])){
				echo $data["subtitle"].'<br><br>';
			}
			?>
                <?php
            if(!empty($data["content"])){
				echo $data["content"];
			}
			?>
              </div></td>
          </tr>
                <?
			  }
	?>
              </table>
      </div>
            <div class="ss_day2">
        <div class="schedule_menu clearfix">
                <div class="schedule_day"><a class="day1">
                  <p>DAY 1</p>
                  <p class="date">2017/09/06</p>
                  </a> </div>
                <div class="schedule_x"><img src="images/day_x.png"></div>
                <div class="schedule_day on"><a class="day2">
                  <p>DAY 2</p>
                  <p class="date">2017/09/07</p>
                  </a> </div>
              </div>
        <table class="schedule1">
                <?php
		 $sql_day2 = "SELECT * FROM meeting_items where lang=$lang and start_date='2017-09-07'  ORDER BY `start_time`";
		 $result_schedule2 = qury_sel($sql_day2, $conn);
              while($data = mysqli_fetch_assoc($result_schedule2)){
				  $start_time = substr($data["start_time"], 0, -3);
				  $end_time = substr($data["end_time"], 0, -3);
				  $time = $start_time." - ".$end_time;
		?>
                <tr>
            <th><p class="w1">
                <?=$time?>
              </p></th>
            <td><p class="w2">
                <?=$data["title"]?>
              </p>
                    <div class="w3 s">
                <?php
            if(!empty($data["subtitle"])){
				echo $data["subtitle"].'<br><br>';
			}
			?>
                <?php
            if(!empty($data["content"])){
				echo $data["content"];
			}
			?>
              </div></td>
          </tr>
                <?
			  }
	?>
              </table>
      </div>
          </div>
  </div>
      </section>
<section class="content speaker" id="speaker">
        <div class="wrap intro">
    <h2 class="t4">
            <?=$t3?>
          </h2>
    <div class="speaker_main clearfix">
            <?
	$len = count($speaker_rows);
	for($i=0;$i<$len;$i++){
		$data=$speaker_rows[$i];
	?>
            <div class="speaker_block" data-cur="<?=$i?>"><a data-id="<?=$data["id"]?>">
              <div class="speaker_pic">
              <div class="pic"><img src="pic/lecturers/<?=$data["image"]?>"></div>
              <div class="show_panel"></div>
            </div>
              <div class="speaker_words">
              <?=$data["name"]?>
            </div>
              </a> </div>
            <?
	}
	?>
          </div>
  </div>
      </section>
<section class="content apply" id="apply">
        <div class="wrap apply">
    <h2 class="t5">
            <?=$t4?>
          </h2>
    <div class="apply_block">
            <?=$t4_1?>
          </div>
  </div>
      </section>
<section class="content news" id="news">
        <div class="wrap intro news">
    <h2 class="t6">
            <?=$t5?>
          </h2>
    <div class="news_main clearfix">
            <?php

	$len = count($news_rows);
	for($i=0;$i<$len;$i++){
		$data=$news_rows[$i];
		 $date = $data["created_at"];
		 $day = date("d", strtotime($date));
		 $mon = date("M", strtotime($date));
		 //echo $mon.":".$day;
	?>
            <div class="news_block">
        <div class="news_pic">
                <div class="news_picBG1" style="background:url(pic/news/<?=$data["image"]?>) no-repeat center; background-size:cover"></div>
                <div class="news_picDATE"> <span class="day">
                  <?=$day?>
                  </span> <span class="mon">
                  <?=$mon?>
                  </span> </div>
              </div>
        <div class="news_words">
                <h4>
            <?=$data["title"]?>
          </h4>
                <div class="new_content">
            <?=$data["content"]?>
          </div>

              </div>
              <div class="show_more"><a data-cur="<?=$i?>"></a></div>
      </div>
            <?php
			  }
	  ?>
          </div>
  </div>
      </section>
<section class="content photo" id="photo">
        <div class="wrap photo clearfix">
    <h2 class="t7">
            <?=$t7?>
          </h2>
    <ul class="photolist">
            <li> <a href="<?=$album_ary[0]?>" rel="prettyPhoto[gallery1]">
              <div class="cover1"></div>
              </a></li>
            <li> <a href="<?=$album_ary[1]?>" rel="prettyPhoto[gallery1]">
              <div class="cover1"></div>
             </a></li>
            <li> <a href="<?=$album_ary[2]?>" rel="prettyPhoto[gallery1]">
              <div class="cover1"></div>
              </a></li>
          </ul>
    <ul class="photolist">
            <li> <a href="<?=$album_ary[3]?>" rel="prettyPhoto[gallery1]">
              <div class="cover1"></div>
              </a></li>
            <li class="size2"> <a href="<?=$album_ary[4]?>" rel="prettyPhoto[gallery1]">
              <div class="cover1"></div>
              </a></li>
          </ul>
    <ul class="photolist top clearfix">
            <li class="size3"> <a href="<?=$album_ary[5]?>" rel="prettyPhoto[gallery1]">
              <div class="cover1"></div>
              </a></li>
            <li class="f1 size4"> <a href="<?=$album_ary[6]?>" rel="prettyPhoto[gallery1]">
              <div class="cover1"></div>
              </a></li>
            <li class="f1 size5"> <a href="<?=$album_ary[7]?>" rel="prettyPhoto[gallery1]">
              <div class="cover1"></div>
              </a></li>
            <li class="f2 size5"> <a href="<?=$album_ary[8]?>" rel="prettyPhoto[gallery1]">
              <div class="cover1"></div>
              </a></li>
          </ul>
  </div>
  <div class="domore">
  <a data-cur="photo" data-status="close"></a>
  </div>
      </section>
<section class="content review" id="review">
        <div class="wrap photo">
        <h2 class="t8">
    <?=$t8?>
  </h2>
        <div class="review_main clearfix">
    <div class="review_block"><a href="http://2016.amf.com.tw" target="_blank">
      <div class="review_cover1">
        <div class="review_coverWORD">VIEW<br>
          2015<br>
          WEBSITE</div>
      </div>
      <div class="review_pic1"><img src="images/review_1_1.jpg"></div>
      <div class="review_color1">
        <p class="amf">AMF</p>
        <p class="year">2015</p>
      </div>
      <div class="review_pic2"><img src="images/review_1_2.jpg"></div>
      </a> </div>
    <div class="review_block"><a href="http://2015.amf.com.tw" target="_blank">
      <div class="review_cover1 sec">
        <div class="review_coverWORD">VIEW<br>
          2014<br>
          WEBSITE</div>
      </div>
      <div class="review_pic1"><img src="images/review_2_1.jpg"></div>
      <div class="review_color1 sec">
        <p class="amf">AMF</p>
        <p class="year">2014</p>
      </div>
      <div class="review_pic2"><img src="images/review_2_2.jpg"></div>
      </a> </div></div>
  </div>
      </section>
<!--<section class="content csr" id="csr">
        <h2 class="t9">
    <?=$t6?>
  </h2>
        <div class="csr_main">
    <div class="wrap photo clearfix">
            <h2 class="csr_title">國內會展介 認養稻田</h2>
            <ul class="csr_top">
        <li class="date csr_date">July 24 , 2017</li>
        <li class="rights csr_rights">中時電子報</li>
      </ul>
            <div class="clear"></div>
            <div class="csr_pcont"> </div>
          </div>
    <div class="pages clearfix"><a class="on"></a><a></a><a></a></div>
  </div>
</section>-->
<section class="content link" id="link">
        <div class="link_top">
    <h2 class="t10">
            <?=$t9?>
          </h2>
  </div>
        <div class="wrap apply">
    <div class="link_block">
            <ul class="linklist clearfix">
        <li>
                <h2>
            <?=$t10?>
          </h2>
                <ul class="sublink">
            <li><a href="http://www.ufi.org/" target="_blank"><img src="images/link01_ufi.png" ></a></li>
            <li><a href="http://www.iccaworld.com/" target="_blank"><img src="images/link02_icca.png" ></a></li>
            <li><a href="http://www.afeca.net/afeca/" target="_blank"><img src="images/link03_afeca.png" ></a></li>
            <li><a href="https://www.businesseventsthailand.com/" target="_blank"><img src="images/link11_TCEB.png" ></a></li>
          </ul>
              </li>
        <li>
                <h2>
            <?=$t11?>
          </h2>
                <ul class="sublink">
            <li><a href="http://www.texco.org.tw/" target="_blank"><img src="images/link04_teca.png" ></a></li>
            <li><a href="http://taiwanconvention.org.tw/index.aspx" target="_blank"><img src="images/link05_tcca.png" ></a></li>
          </ul>
              </li>
        <li>
                <h2>
            <?=$t12?>
          </h2>
                <ul class="sublink">
            <li><a href="http://www.trade.gov.tw/" target="_blank"><img src="images/link06_boft.png" ></a></li>
            <li><a href="http://www.taitra.org.tw/" target="_blank"><img src="images/link07_taitra.png" ></a></li>
            <li><a href="http://www.meettaiwan.com/" target="_blank"><img src="images/link08_mt.png" ></a></li>
          </ul>
              </li>
        <li>
                <h2>
            <?=$t13?>
          </h2>
                <ul class="sublink p4">
            <li><a href="http://www.ttgmice.com/" target="_blank"><img src="images/link09_ttg.png" ></a></li>
            <li><a href="http://www.ttgassociations.com/" target="_blank"><img src="images/link10_ttga.png" ></a></li>
          </ul>
              </li>
              <li>
                <h2>
            <?=$t14?>          </h2>
                <ul class="sublink p4">
            <li><a href="https://www.accupass.com/" target="_blank"><img src="images/link12_accupass.png" ></a></li>
          </ul>
              </li>
      </ul>
          </div>
  </div>
      </section>
<section class="content contact" id="contact">
        <div class="wrap contact">
        <div class="contact_main clearfix">
    <div class="contact_block">
            <div class="contact_icon"><img src="images/icon_11_1.png"></div>
            <div class="contact_word">
        <p>FACEBOOK</p>
        <a href="https://www.facebook.com/asianmiceforum?fref=ts" target="_blank">
              <p class="info">AMF 亞洲會展產業論壇</p>
              </a> </div>
          </div>
    <div class="contact_block">
            <div class="contact_icon"><img src="images/icon_11_2.png"></div>
            <div class="contact_word">
        <p>E-MAIL</p>
        <a href="mailto:amf@taitra.org.tw">
              <p class="info">amf@taitra.org.tw</p>
              </a> </div>
          </div>
    <div class="contact_block">
            <div class="contact_icon"><img src="images/icon_11_3.png"></div>
            <div class="contact_word">
        <p>TELEPHONE</p>
        <p class="infoT"><a href="tel:02-2725-5200">02-2725-5200</a> #3525 / 3526</p>
      </div>
          </div>
  </div>
      </section>
<footer>
        <div class="footer_main clearfix">
    <div class="footer_block">
            <p>主辦單位</p>
            <a href="http://www.trade.gov.tw/" target="_blank"><img src="images/link06_boft.png"></a></div>
    <div class="footer_block">
            <p>執行單位</p>
            <a href="http://www.taitra.org.tw/" target="_blank"><img src="images/link07_taitra.png"></a></div>
    <div class="footer_block app">
            <p>APP下載</p>
            <a href="https://itunes.apple.com/us/app/amf-2017/id1146674709?l=zh&ls=1&mt=8" target="_blank"><img src="images/link_appstore.png"></a> <a href="https://play.google.com/store/apps/details?id=com.taitra.amf2017" target="_blank"><img src="images/link_googleplay.png"></a></div>
    <div class="footer_top"><a href="#top"><img src="images/TOPbutton_off.png"></a></div>
  </div>
        <div class="cy">Copyright © Asian MICE Forum 2017 . All rights Reserved.</div>
      </footer>
<div class="mask"></div>
<div class="menumask"></div>
<div class="popwin"> <a class="btn_close"><img src="images/window_x.png"></a>
        <div class="block speaker clearfix">
    <div class="spic"><img src="images/speaker_pic_05.png"></div>
    <div class="smain">
            <h2>Mr. Arun Madhok</h2>
            <h3>執行長<br>
        新達城新加坡會議與博覽中心</h3>
            <hr>
            <div class="sintro"></div>
          </div>
  </div>
        <div class="block news clearfix">
    <div class="spic"><img src="pic/news/FxadXifJfeUCChoLUEER.jpg"></div>
    <div class="news_list">
            <h2>NEWS</h2>
            <ul>
        <li><a href=""> 「2015年亞洲會展產業論壇」9/24-25 台北登場 </a><span>September 24 , 2017</span></li>
        <li><a href=""> 「2015年亞洲會展產業論壇」9/24-25 台北登場 </a><span>September 24 , 2017</span></li>
        <li><a href=""> 「2015年亞洲會展產業論壇」9/24-25 台北登場 </a><span>September 24 , 2017</span></li>
      </ul>
          </div>
    <div class="clear"></div>
    <div class="nmain">
            <div class="nicon"><img src="images/icon_news_title.png"></div>
            <h2><span class="date">September 24 , 2017</span><span class="title">「2015年亞洲會展產業論壇」9/24-25 台北登場</span></h2>
            <div class="clear"></div>
            <div class="sintro"></div>
          </div>
  </div>
      </div>
</body>
</html>
