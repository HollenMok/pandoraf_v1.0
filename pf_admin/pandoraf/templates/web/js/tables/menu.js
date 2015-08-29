/**
 *	后台菜单管理列表JS
 */

var MenuList = {};



/**
 *	批量更新菜单排序
 */
MenuList.batchUpdateSort=function(btn){
	$(btn).hide();
	MenuList.showMessage(btn);
	
	var data = 'com=menus&t=batchUpdateSort';
	var sorts = $('.menu_sort');
	sorts.each(function(){
		var mid = $(this).attr('mid');
		var this_sort = $(this).val();
		data += '&mids[]='+mid;
		data += '&sorts[]='+this_sort;
	});
	
	
	$.ajax({
		type:'get',
		url: 'index.php',
		data: data,
		success:function(res){
			MenuList.cancelMessage();
			$(btn).show();
		}
	});
	
}


/**
 *	Ajax操作提示
 */
MenuList.showMessage=function(target){
	$(target).append('<span id="menu_list_msg" style="color:#CC0000">Updating...</span>');
}


/**
 *	取消Ajax操作提示
 */
MenuList.cancelMessage=function(target){
	$('#menu_list_msg').remove();
}


