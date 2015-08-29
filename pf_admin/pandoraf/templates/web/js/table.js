/**
 *	公用列表模型JS
 */



$(function(){
	//初始化排序
	ModTable.initSort();
	
	//初始化分页操作
	ModTable.initPage();
	
	//初始化搜索按钮事件
	ModTable.initSearchBtn();
	
	//初始化重置按钮
	ModTable.initResetBtn();
	
	//初始化列表设置状态操作
	ModTable.initSetStatus();
	
	//初始化列表删除操作
 	ModTable.initRemove();
	
	//初始化列表删除操作(删除失败时给错误提示)
 	ModTable.initItemRemove();
	
	//判断延迟加载数据处理
	if(ModTable.getDelayLoad()){
		ModTable.loadData(1);	
	}
});



var ModTable = {};


/**
 *	数据加载中标识,用于防止重复加载数据
 */
ModTable.isLoading = false;

/**
 *	列表加载数据提示图片路径
 */
ModTable.loadImg = '<img src="templates/default/images/buttons/ajax_loader.gif" />';


/**
 *	排序键值
 */
ModTable.sortKey = null;

/**
 *	排序类型
 */
ModTable.sortType = null;


/**
 *	列表批量选择
 */
ModTable.selectAll=function(obj){
	var checked = $(obj).attr('checked');
	checked = (checked == 'checked') ? true : false;
	$('.selectAll:gt(0)').attr('checked', checked);
}


/**
 *	判断是否是延迟加载数据
 */
ModTable.getDelayLoad=function(){
	var delay = $('#delay_load_data').val();
	return delay;
}


/**
 *	列表公用激活/隐藏操作
 */
ModTable.setStatus = function(Img){
	var activeImg = Img.attr('activeImg') ? Img.attr('activeImg') : '/images/icon_status_green.gif';
	var inactiveImg = Img.attr('inactiveImg') ? Img.attr('inactiveImg') :'/images/icon_status_red.gif';
	var com = Img.attr('com');
	var task = Img.attr('task');
	var status = Img.attr('status');
	var pkey = Img.attr('pkey');
	var pval = Img.attr('pval');
	
	if(status == 1){
		status = 0;
		Img.attr('src', ModTable.rootPath+inactiveImg);
		Img.attr('title', 'Inactive');
		Img.attr('alt', 'Inactive');
		Img.attr('status', status);
	}else{
		status = 1;
		Img.attr('src', ModTable.rootPath+activeImg);
		Img.attr('title', 'Active');
		Img.attr('alt', 'Active');
		Img.attr('status', status);
	}
	
	var data = 'com='+com+'&t='+task+'&status='+status;
	data += '&'+pkey+'='+pval;
	
	$.ajax({
		type:'get',
		url: 'index.php',
		data: data,
		success:function(res){
			
		}
	});
}

/**
 *	列表公用修改 add by HYZ
 */
ModTable.editStatus = function(obj){
	var com = obj.attr('com');
	var task = obj.attr('task');
	var value = obj.attr('value');
	var pkey = obj.attr('pkey');
	var pval = obj.attr('pval');
	var tipname = obj.attr('tipname');
	//提示类型，默认为tips，在页面显示提示，可设置该属性为alert提示
	var tipmethod = obj.attr('tipmethod') ? obj.attr('tipmethod') : 'tips';
	//限制输入类型，设置value_type值为int时仅限输入数字（需要可扩展）
	var value_type = obj.attr('value_type');
	
	//判断输入是否为有效数字
	if(value_type == 'int'){
		if(isNaN(value)){
			document.getElementById("table_form").reset();;
			alert('Invalid Number! Please check!');
			return false;
		}
	}
	
	var data = 'com='+com+'&t='+task+'&value='+value;
	data += '&'+pkey+'='+pval;
	
	if(tipmethod == 'tips'){
		if(tipname){
			$('#update_tips_'+tipname+'_'+pval).html('setting...');
		}else{
			$('#update_tips_'+pval).html('setting...');
		}
	}
	
	$.ajax({
		type:'get',
		url: 'index.php',
		data: data,
		success:function(res){
			if(tipmethod == 'tips')
				if(tipname){
					$('#update_tips_'+tipname+'_'+pval).html(res);
				}else{
					$('#update_tips_'+pval).html(res);
				}
			else{
				alert(res);
			}
		}
	});
}

/**
 *	列表公删除操作
 */
ModTable.remove = function(Img){
	var com = Img.attr('com');
	var task = Img.attr('task');
	var pkey = Img.attr('pkey');
	var pval = Img.attr('pval');
	
	var data = 'com='+com+'&t='+task;
	data += '&'+pkey+'='+pval;
	
	var isConfirm = confirm('Are you sure remove it?');
	
	if(!isConfirm){
		return false;	
	}
	
	Img.parent().parent().remove();
	
	$.ajax({
		type:'get',
		url: 'index.php',
		data: data,
		success:function(res){
			
		}
	});
}

/**
 *	列表删除操作(删除失败时给错误提示)
 */
ModTable.itemRemove = function(Img){
	var com = Img.attr('com');
	var task = Img.attr('task');
	var pkey = Img.attr('pkey');
	var pval = Img.attr('pval');
	
	var data = 'com='+com+'&t='+task;
	data += '&'+pkey+'='+pval;
	
	var isConfirm = confirm('Are you sure remove it?');
	
	if(!isConfirm){
		return false;	
	}
	
	
	$.ajax({
		type:'get',
		url: 'index.php',
		data: data,
		success:function(res){
			if(res == 'success'){
				Img.parent().parent().remove();
			}else{
				alert(res);
			}
		}
	});
}

/**
 *	初始化列表设置状态操作
 */
ModTable.initSetStatus = function(){
	$('.setStatus').each(function(){
		$(this).css('cursor', 'pointer');							  
	});
	$('.setStatus').bind('click', function(){
		ModTable.setStatus($(this));									   
	});
	$('.editStatus').bind('blur', function(){
		ModTable.editStatus($(this));									   
	});
}


/**
 *	初始化列表删除操作
 */
ModTable.initRemove = function(){
	$('.removeData').each(function(){
		$(this).css('cursor', 'pointer');							  
	});
	$('.removeData').bind('click', function(){
		ModTable.remove($(this));									   
	});
}

/**
 *	初始化列表删除操作(删除失败时给错误提示)
 */
ModTable.initItemRemove = function(){
	$('.itemRemove').each(function(){
		$(this).css('cursor', 'pointer');							  
	});
	$('.itemRemove').bind('click', function(){
		ModTable.itemRemove($(this));									   
	});
}


/**
 *	初始化搜索按钮事件
 */
ModTable.initSearchBtn = function(){
	$('.searchBtn').bind('click', function(){
		ModTable.loadData(1);									   
	});
}


/**
 *	初始化重置按钮事件
 */
ModTable.initResetBtn = function(){
	$('.resetBtn').bind('click', function(){
		ModTable.reset();							   
	});
}

/**
 *	搜索项重置
 */
ModTable.reset = function(){
	$('#search-box .search_options').each(function(){
		var type = $(this).attr('type');
		var ops = $(this).find('option').length;
		if(type == 'text'){
			$(this).val('');
		}else if(type == 'radio' || type == 'checkbox'){
			$(this).removeAttr('checked');
		}else if(ops){
			$(this).find('option').each(function(){
				$(this).removeAttr('selected');								 
			});
		}
	});	
}


/**
 *	初始化排序字段
 */
ModTable.initSort = function(){
	var table = $('#adminlist');
	table.find('thead').find('th').each(function(){
		var sortType = $(this).attr('sort_type');
		var sortKey = $(this).attr('key');
		if(typeof(sortType) != 'undefined' && typeof(sortKey) != 'undefined'){
			$(this).toggleClass(sortType);
		}							 
	});
	
	//设置排序事件
	$('.sort_desc, .sort_asc').bind('click', function(){
		ModTable.toSort(this);										
	});
}


/**
 *	初始化分页操作
 */
ModTable.initPage = function(){
	var page = ModTable.getPage();
	var total_page = ModTable.getTotalPage();
	
	if(total_page <= 1){
		$('#page_info .has').toggleClass('off');
		$('#page_info .has').toggleClass('has');
	}else{
		if(page > 1 && page < total_page){
			$('#page_info .next span').attr('class','has');
			$('#page_info .end span').attr('class','has');
			$('#page_info .prev span').attr('class','has');
			$('#page_info .start span').attr('class','has');
		}else if(page >= total_page){
			$('#page_info .next span').attr('class','off');
			$('#page_info .end span').attr('class','off');
			$('#page_info .prev span').attr('class','has');
			$('#page_info .start span').attr('class','has');
		}else{
			$('#page_info .next span').attr('class','has');
			$('#page_info .end span').attr('class','has');
			$('#page_info .prev span').attr('class','off');
			$('#page_info .start span').attr('class','off');
		}
	}
	
	$('#page_info .end').bind('click', function(){
		ModTable.endPage();								
	});
	
	$('#page_info .next').bind('click', function(){
		ModTable.nextPage();								
	});
	
	$('#page_info .prev').bind('click', function(){
		ModTable.prevPage();								
	});
	
	$('#page_info .start').bind('click', function(){
		ModTable.goPage(1, true);								
	});
	
}



/**
 *	列表排序
 */
ModTable.toSort = function(obj){
	if(ModTable.isLoading){
		return false;	
	}
	
	var sortType = $(obj).attr('sort_type');
	var sortKey = $(obj).attr('key');
	
	var nextSort = sortType == 'sort_desc' ? 'sort_asc' : 'sort_desc';
	
	$(obj).toggleClass(sortType);
	$(obj).toggleClass(nextSort);
	
	$(obj).attr('sort_type', nextSort);
	
	$('#sortKey').val(sortKey);
	$('#sortType').val(sortType);
	
	ModTable.sortKey = sortKey;
	ModTable.sortType = sortType;
	
	ModTable.loadData(1);
}


/**
 *	更改每页显示数据数
 */
ModTable.changePageSize = function(){
	ModTable.goPage(1);	
}


/**
 *	设置总数据条数
 */
ModTable.setTotalRecords = function(number){
	$('#total_records').html(parseInt(number));
}


/**
 *	设置总页数
 */
ModTable.setTotalPage = function(page){
	$('#page_queue_total').html(parseInt(page));
}


/**
 *	获取总页数
 */
ModTable.getTotalPage = function(){
	return parseInt($('#page_queue_total').html());	
}


/**
 *	设置当前页
 */
ModTable.setPage = function(page){
	$('#page_queue_now').html(parseInt(page));
}


/**
 *	获取当前页
 */
ModTable.getPage = function(){
	return parseInt($('#page_queue_now').html());	
}


/**
 *	翻哪一页数据
 */
ModTable.goPage = function(page, vailidatePage){
	if(ModTable.isLoading || typeof(page) == 'undefined'){
		return false;	
	}
	if(typeof(vailidatePage) == 'undefined'){
		vailidatePage = false;	
	}
	
	page = parseInt(page);
	var total_page = ModTable.getTotalPage();
	var current_page = ModTable.getPage();
	if(page > total_page || page <= 0 || (current_page == page && vailidatePage)){
		return false;	
	}
	ModTable.setPage(page);
	ModTable.loadData(page);
}


/**
 *	翻前页
 */
ModTable.endPage = function(){
	//当前页
	var total_page = ModTable.getTotalPage();
	ModTable.goPage(total_page, true);
}

/**
 *	翻前页
 */
ModTable.prevPage = function(){
	//当前页
	var page = ModTable.getPage();
	ModTable.goPage(page - 1, true);
}


/**
 *	翻后页
 */
ModTable.nextPage = function(){
	//当前页
	var page = ModTable.getPage();
	ModTable.goPage(page + 1, true);
}


/**
 *	列表查询操作
 */
ModTable.loadData = function(page, sortKey, sortType){
	if(ModTable.isLoading){
		return false;	
	}
	
	var com = $('#com').val();
	var task = $('#task').val();
	var data = 'com='+com+'&t='+task;
	var table = $('#adminlist');
	
	//验证调用组件是否存在
	if(typeof(com) == 'undefined' || com.length <= 0){
		return false;
	}
	
	//配置排序键值
	if(typeof(sortKey) == 'undefined'){
		var sortKey = $('#sortKey').val();
	}
	//配置排序类型
	if(typeof(sortType) == 'undefined'){
		var sortType = $('#sortType').val();
	}
	
	//配置到全局
	ModTable.sortKey = sortKey;
	ModTable.sortType = sortType;
	
	//配置排序参数
	data += '&sortKey='+sortKey;
	data += '&sortType='+sortType;
	
	//设置ajax查询
	data += '&ajaxQuery=1';
	
	//配置分页参数
	if(typeof(page) != 'undefined'){
		data += '&page='+page;
	}
	
	//获取搜索参数
	var search_data = ModTable.getSearchOptions();
	data += search_data;
	
	//提示数据正在加载中
	ModTable.loadMessage(ModTable.loadImg);
	
	//设置数据正在加载中
	ModTable.isLoading = true;
	
	$.ajax({
		type:'get',
		url: 'index.php',
		dataType: 'json',
		data: data,
		success:function(res){
			//设置数据加载完成
			ModTable.isLoading = false;
			
			if(res.error){
				ModTable.loadMessage(res.contents);
			}else if(res.contents.length > 0 && !res.error){
				table.find('tbody').html(res.contents);
				
			}else{
				ModTable.loadMessage('No data find...');
			}
			
			ModTable.setPage(res.page);
			ModTable.setTotalPage(res.total_page);
			ModTable.setTotalRecords(res.total_records);
			ModTable.initPage();
			
			//初始化列表设置状态操作
			ModTable.initSetStatus();
			
			//初始化列表删除操作
 			ModTable.initRemove();
		}
	});
}




/**
 *	获取搜索项值
 */
ModTable.getSearchOptions = function(){
	var data = '';
	$('.search_options').each(function(){
		var name = $(this).attr('name');
		var value = $(this).val();
		var type = $(this).attr('type');
		if(type == 'checkbox' || type == 'radio'){
			if($(this).attr('checked')){
				data += '&'+name+'='+value;	
			}	
		}else{
			if(value){
				data += '&'+name+'='+value;		
			} 
		}
	});	
	return data;
}


/**
 *	加载提示信息
 */
ModTable.loadMessage = function(contents){
	var table = $('#adminlist');
	var colsNum = $('#fieldCounts').val();
	
	table.find('tbody').html('<tr><td colspan="'+colsNum+'" style="text-align:center">'+contents+'</td></tr>');
}


/**
 *	获取批量操作的ID号
 */
ModTable.getTableIDs = function(){
	var check_inputs = $('.selectAll:checked');
	var pkey = $('#primaryKey').val();
	var data = '';
	
	$('.selectAll:checked').each(function(){
		var val = $(this).val();
		if(val){
			data += '&'+pkey+'[]='+val;
		}
	});
	
	return data;
}