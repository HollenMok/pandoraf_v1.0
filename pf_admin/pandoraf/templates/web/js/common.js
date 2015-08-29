/**
 *	公用JS
 */
 
$(function(){
	//初始化日期表单项
	$(".formCalendar").datepicker({
		showOn: 'button', 
		buttonImage: 'templates/default/images/calendar.png', 
		buttonImageOnly: true,
		changeYear: true,
		changeMonth:true,
		dateFormat: 'yy-mm-dd',
		dayNamesMin: ['日','一','二','三','四','五','六'],
		monthNamesShort:['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月']
	});
	
	$('.formTimeCalendar').datetimepicker({
		showOn: 'button', 
		buttonImage: 'templates/default/images/calendar.png', 
		buttonImageOnly: true,
		changeYear: true,
		changeMonth:true,
		dateFormat: 'yy-mm-dd',
		dayNamesMin: ['日','一','二','三','四','五','六'],
		monthNamesShort:['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
		timeFormat: 'HH:mm:ss',
		stepHour: 1,
		stepMinute: 1,
		stepSecond: 1
	});
});
 
var ZCommon = {};


/**
 *	通用验证表单上传文件
 */
ZCommon.validateFormUpload = function(){
	var hasFile = false;
	$('.validateFile').each(function(){
		if($(this).val().length > 0){
			hasFile = true;
			return false;
		}else{
			$(this).after('<label for="meigong" generated="true" class="error">This field is required.</label>');	
			return false;
		}	 
	});
	
	$('#admin_form').submit();
}


/**
 *	通用更改上传文件操作
 */
ZCommon.changeFile = function(obj){
	$(obj).next('.validateFile').val($(obj).val());
}

 
/**
 *	加载分类子类操作
 */
ZCommon.changeCat = function(obj, now_id){
	$(obj).nextAll().remove();
	var cid = $(obj).val();
	if(cid > 0){
		$(obj).after('<span>loading...</span>');
		var data = 'com=ajax&t=getCatSelect';
		data += '&cid='+cid+'&now_id='+now_id;
		$.ajax({
			type:'get',
			url: 'index.php',
			data: data,
			success:function(res){
				$(obj).nextAll().remove();
				$(obj).after(res);
				/*$(obj).nextAll().addClass('search_options');
				$(obj).nextAll().bind('change', function(){
					ZCommon.changeCat(this);										 
				});*/
			}
		});
	}
}


/**
 *	加载菜单子菜单操作
 */
ZCommon.changeMenu = function(obj, now_id){
	$(obj).nextAll().remove();
	var mid = $(obj).val();
	if(mid > 0){
		$(obj).after('<span>loading...</span>');
		var data = 'com=ajax&t=getMenuSelect';
		data += '&menu_id='+mid+'&now_id='+now_id;
		$.ajax({
			type:'get',
			url: 'index.php',
			data: data,
			success:function(res){
				$(obj).nextAll().remove();
				$(obj).after(res);
			}
		});
	}
}

/**
 * 改变语言操作
 */
ZCommon.changeLanguage = function(obj){

	var lang = $(obj).val();
	
	var re = /lang=/;
	var url = document.URL;
	if(re.test(url)){
		var patt=eval('/(lang=)([^&]*)/gi');
    	url = url.replace(patt, 'lang='+lang);
	}else{
		url += '&lang='+lang;
	}
	
	window.location.href = url;
	
}

/**
 * 加载提示框
 */
ZCommon.addLoading = function(obj){
	$('body').addClass('noscroll').append('<div class="module"><div class="modal_mask"></div><div class="modal_scroller"><div class="modal_container"></div></div></div>');
	$('.module .modal_mask').css("opacity","0.5");
}

/**
 * 关闭提示框
 */
ZCommon.removeLoading = function(obj){
	$('.module').remove();
	$('body').removeClass('noscroll');
}

/**
 *	加载文章分类子菜单操作
 */
ZCommon.changeArticleCat = function(obj, now_id, article_id){
	$(obj).nextAll().remove();
	var cat_id = $(obj).val();
	if(cat_id > 0){
		$(obj).after('<span>loading...</span>');
		var data = 'com=ajax&t=getArticleCatSelect';
		data += '&cat_id='+cat_id+'&now_id='+now_id+'&article_id='+article_id;
		$.ajax({
			type:'get',
			url: 'index.php',
			data: data,
			success:function(res){
				$(obj).nextAll().remove();
				$(obj).after(res);
			}
		});
	}
}

/**
 * 获取国家对应的省、洲
 */
ZCommon.getZonesFromCountry = function(obj){
	var country_id = $(obj).val();
	if(country_id > 0){
		$(obj).after('<span>loading...</span>');
		var data = 'com=ajax&t=getZonesFromCountry';
		data += '&country_id='+country_id;
		$.ajax({
			type:'get',
			url: 'index.php',
			data: data,
			success:function(res){
				$(obj).nextAll().remove();
				$('#yoins_zone').html(res);
			}
		});
	}
}