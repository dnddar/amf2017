$(function(){
	$(".menu li a").click(function(){
		var _this=$(this);
		if(_this.next("ul").length>0){
			if(_this.next().is(":visible")){
				//���äl���ô����Ÿ�
				_this.html(_this.html().replace("��","?")).next().hide();
			}else{
				//�}�Ҥl���ô����Ÿ�
				_this.html(_this.html().replace("?","��")).next().show();
			}
			//�����s��
			return false;
		}
	});
	//�����s����u��
	$("a").focus( function(){
		$(this).blur();
	});
});
