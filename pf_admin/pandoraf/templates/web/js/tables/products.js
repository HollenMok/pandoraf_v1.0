/**
 * 后台产品管理js
 * @author HYZ
 */


/**
 * 更新所有产品缓存
 */
function updateProductsCache(){
	if(confirm('This operation may take a long time!Please wait before any tips appear!')){
		var data = 'com=products&t=updateProductsCache';
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
 * 为产品添加分类
 */
function addCategory(products_id){
	
	var cats = new Array();
	var cat_path = '';
	var i = 0;
	
	//获取选择的分类
	$("select[name='cats[]']").each(function(){
		if($(this).children("option:selected").val()){
			cats[i] = $(this).children("option:selected").val();
			i++;
		}
	});
	
	if(cats == ''){
		alert('Please select category first!');
		return false;
	}else{
		cat_path = cats.join('-');
		var data = 'com=products&t=addCategory&products_id='+products_id+'&cat_path='+cat_path;
		$.ajax({
			type:'get',
			dataType:'json',
			url: 'index.php',
			data: data,
			success:function(res){
				if(res.err == -1){
					alert('Category already exist!');
				}else{
					if(!res.err){
						$('#exist_category').html($('#exist_category').html() + res.html);
					}else{
						alert('Sql Error!');
					}
				}
			}
		});
	}
	
}

/**
 * 删除产品绑定分类
 * @param products_id 产品id
 * @param cid 分类id
 */
function removeCategory(obj, products_id, cid){
	var data = 'com=products&t=removeCategory&products_id='+products_id+'&cid='+cid;
	$.ajax({
		type:'get',
		url: 'index.php',
		data: data,
		success:function(res){
			if(res){
				$(obj).parent().remove();
				alert('Success!');
			}else{
				alert('Remove category failed!');
			}
		}
	});
}

/**
 * 标记产品预订为已处理
 * @param obj 当前操作对象
 * @book_id 预订id
 */
function processedProductsBook(Img, book_id){
	if(confirm('Are you sure to process this item?')){
		var data = 'com=products&t=processedProductsBook&book_id='+book_id;
		$.ajax({
			type:'get',
			url: 'index.php',
			data: data,
			success:function(res){
				$(Img).attr('src', 'templates/default/images/buttons/publish.png');
				$(Img).attr('title', 'Processed');
				$(Img).attr('alt', 'Processed');
				$(Img).removeAttr('onclick');
				$(Img).removeAttr('style');
			}
		});
	}
}

/**
 * 改变属性项
 */
function changeFilter(obj){
	
	var filter_id = $(obj).val();
	
	var data = 'com=products&t=changeFilter&filter_id='+filter_id;
	
	$.ajax({
		type:'get',
		url: 'index.php',
		data: data,
		success:function(html){
			$('#book_filter_value').html(html);
		}
	});
}

/**
 * 添加产品属性到产品预订
 */
function addAttrToProductsBook(book_id){
	
	var filter_value_id = $('#book_filter_value').val();
	var filter_value = $('#book_filter_value option:selected').text();
	
	if(!filter_value_id){
		alert('Please select filter value first!');
		return false;
	}
	
	var data = 'com=products&t=addAttrToProductBook&book_id='+book_id+'&filter_value_id='+filter_value_id+'&filter_value='+filter_value;
	
	$.ajax({
		type:'get',
		url: 'index.php',
		data: data,
		success:function(html){
			if(html){
				$('#exist_products_book_attr').after(html);
			}else{
				alert('Attribute already exists!');
			}
		}
	});
	
}

/**
 * 删除产品预订的产品属性
 */
function removemProductsBookAttr(obj, book_attr_id){
	
	if(confirm('Are you sure to remove this attribute?')){
		
		var data = 'com=products&t=removemProductsBookAttr&id='+book_attr_id;
		
		$.ajax({
			type:'get',
			url: 'index.php',
			data: data,
			success:function(res){
				if(res){
					$(obj).parent().remove();
					alert('Success!');
				}else{
					alert('Failed');
				}
			}
		});
	}
}

/**
 * 为产品添加过滤项值
 */
function addFilterToProducts(pid, sku){

	var filter_id = $('#book_filter').val();
	var filter_name = $('#book_filter option:selected').text();

	var filter_value_id = $('#book_filter_value').val();
	var filter_value_name = $('#book_filter_value option:selected').text();

	if(!filter_value_id){
		alert('Please select filter value first!');
		return false;
	}

	var data = 'com=products&t=addFilterToProducts&pid='+pid+'&sku='+sku+'&filter_id='+filter_id+'&filter_name='+filter_name+'&filter_value_id='+filter_value_id+'&filter_value_name='+filter_value_name;
	
	$.ajax({
		type:'get',
		url: 'index.php',
		data: data,
		success:function(html){
			if(html){
				$('#exist_products_filter').after(html);
			}else{
				alert('Filter already exists!');
			}
		}
	});
}

/**
 * 移除产品过滤项值
 */
function removemProductsFilter(obj, id){

	if(confirm('Are you sure to remove this filter?')){
		
		var data = 'com=products&t=removemProductsFilter&id='+id;
		
		$.ajax({
			type:'get',
			url: 'index.php',
			data: data,
			success:function(res){
				if(res){
					$(obj).parent().remove();
					alert('Success!');
				}else{
					alert('Failed');
				}
			}
		});
	}
}