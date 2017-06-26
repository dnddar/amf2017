$(function(){
	$(".menu li a").click(function(){
		var _this=$(this);
		if(_this.next("ul").length>0){
			if(_this.next().is(":visible")){
				//隱藏子選單並替換符號
				_this.html(_this.html().replace("▼","?")).next().hide();
			}else{
				//開啟子選單並替換符號
				_this.html(_this.html().replace("?","▼")).next().show();
			}
			//關閉連結
			return false;
		}
	});
	//消除連結虛線框
	$("a").focus( function(){
		$(this).blur();
	});
});
