$.extend({
//数量减少
qtyPrev: function(o){
	var $o = $(o);
	if($o.hasClass("gray")) return;
	var $input = $o.siblings(":text");
	$o.siblings("s").removeClass("active");				
	var num = parseInt($input.val());
	var maximum = parseInt($input.attr("maximum"));
	if(!(/(^[0-9]\d*$)/.test(num)) || !num  || num == 0){
		num = 1;
	}
	num -= 1;
	if(num == 0) num=1;
	if(num == 1) $o.addClass('gray');
	
	if(/(^[0-9]\d*$)/.test(maximum) && num < maximum){
		$o.siblings(".next").removeClass('gray');	
	}
	$input.val(num);	
  },
//数量增加 
qtyNext: function(o){
	var $o = $(o);
	if($o.hasClass("gray")) return;
	var $input = $o.siblings(":text");
	var maximum = parseInt($input.attr("maximum"));
	var clearStock = parseInt($input.attr("clearStock"));
	var num = parseInt($input.val());
	if(!(/(^[0-9]\d*$)/.test(num)) || !num  || num == 0){
		num = 1;
	}
	if(clearStock >0 && /(^[0-9]\d*$)/.test(maximum) && num >= maximum){//清货产品限制购买数量
		$o.siblings("s").addClass("active");
		setTimeout(function(){$o.siblings("s").removeClass("active");}, 2000);
		$input.val(maximum);
		$o.addClass('gray');
		if(maximum>1){$o.siblings(".prev").removeClass('gray');}
	}else{
		num += 1;
		if(num > 1){
			$o.siblings(".prev").removeClass('gray');
			if(num>99999) num=99999;
		}
		$input.val(num);
	}
 }
});

