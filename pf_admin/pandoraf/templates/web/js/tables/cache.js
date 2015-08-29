/**
 * 缓存生成js
 * @author HYZ
 */

/**
 * 更新国家缓存操作
 */
function updateCountryCache(){
	if(confirm('This operation may take a long time!Please wait before any tips appear!')){
		var data = 'com=cache&t=updateCountryCache';
		$.ajax({
			type:'get',
			url: 'index.php',
			data: data,
			beforeSend: function(){
				ZCommon.addLoading();
			},
			success:function(res){
				ZCommon.removeLoading();
				if(res){
					alert('Update success!');
				}else{
					alert('Update failed!');
				}
			}
		});
	}
}

/**
 * 更新地区缓存操作
 */
function updateZoneCache(){
	if(confirm('This operation may take a long time!Please wait before any tips appear!')){
		var data = 'com=cache&t=updateZoneCache';
		$.ajax({
			type:'get',
			url: 'index.php',
			data: data,
			beforeSend: function(){
				ZCommon.addLoading();
			},
			success:function(res){
				ZCommon.removeLoading();
				if(res){
					alert('Update success!');
				}else{
					alert('Update failed!');
				}
			}
		});
	}
}

/**
 * 更新币种缓存操作
 */
function updateCurrencyCache(){
	if(confirm('This operation may take a long time!Please wait before any tips appear!')){
		var data = 'com=cache&t=updateCurrencyCache';
		$.ajax({
			type:'get',
			url: 'index.php',
			data: data,
			beforeSend: function(){
				ZCommon.addLoading();
			},
			success:function(res){
				ZCommon.removeLoading();
				if(res){
					alert('Update success!');
				}else{
					alert('Update failed!');
				}
			}
		});
	}
}

/**
 * 更新分类下产品总数缓存
 */
function updateCategoryProductsTotalCache(){
	if(confirm('This operation may take a long time!Please wait before any tips appear!')){
		var data = 'com=cache&t=updateCategoryProductsTotalCache';
		$.ajax({
			type:'get',
			url: 'index.php',
			data: data,
			beforeSend: function(){
				ZCommon.addLoading();
			},
			success:function(res){
				ZCommon.removeLoading();
				if(res){
					alert('Update success!');
				}else{
					alert('Update failed!');
				}
			}
		});
	}
}

/**
 * 更新前台汇率js
 */
function updateJsCurrencyHuiLv(){
	if(confirm('Are you sure to proceed it?')){
		var data = 'com=cache&t=jsCurrencyHuiLv';
		$.ajax({
			type:'get',
			url: 'index.php',
			data: data,
			beforeSend: function(){
				ZCommon.addLoading();
			},
			success:function(res){
				ZCommon.removeLoading();
				if(res){
					alert('Update success!');
				}else{
					alert('Update failed!');
				}
			}
		});
	}
}

/**
 * 更新所有产品特价数据缓存
 */
function loadAllProductSpecial(){
	if(confirm('This operation may take a long time!Please wait before any tips appear!')){
		var data = 'com=cache&t=loadAllProductSpecial';
		$.ajax({
			type:'get',
			url: 'index.php',
			data: data,
			beforeSend: function(){
				ZCommon.addLoading();
			},
			success:function(res){
				ZCommon.removeLoading();
				if(res){
					alert('Update success!');
				}else{
					alert('Update failed!');
				}
			}
		});
	}
}

/**
 * 清除首页静态缓存
 */
function clearIndexStaticCache(){
	if(confirm('Are you sure to proceed it?')){
		var data = 'com=cache&t=clearIndexStaticCache';
		$.ajax({
			type:'get',
			url: 'index.php',
			data: data,
			beforeSend: function(){
				ZCommon.addLoading();
			},
			success:function(res){
				ZCommon.removeLoading();
				if(res){
					alert('Clear success!');
				}else{
					alert('Clear failed!');
				}
			}
		});
	}
}

/**
 * 更新单一产品缓存及静态
 */
function updateProductCache(obj){

	var product = $.trim($(obj).siblings('input[name=prodcut]').val());

	if(product){
		var data = 'com=cache&t=updateProductCache&product='+product;
		$.ajax({
			type:'get',
			url: 'index.php',
			data: data,
			beforeSend: function(){
				ZCommon.addLoading();
			},
			success:function(res){
				ZCommon.removeLoading();
				if(res){
					alert('Update success!');
				}else{
					alert('Update failed!');
				}
			}
		});
	}else{
		alert('Please input Product ID or SKU first!');
	}
}

/**
 * 清除所有静态缓存
 */
function clearAllStaticCache(){
	if(confirm('Are you sure to proceed it?')){
		var data = 'com=cache&t=clearAllStaticCache';
		$.ajax({
			type:'get',
			url: 'index.php',
			data: data,
			beforeSend: function(){
				ZCommon.addLoading();
			},
			success:function(res){
				ZCommon.removeLoading();
				if(res){
					alert('Clear success!');
				}else{
					alert('Clear failed!');
				}
			}
		});
	}
}