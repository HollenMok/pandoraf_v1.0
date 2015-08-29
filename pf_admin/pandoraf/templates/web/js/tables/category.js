/**
 * 后台产品分类js
 * @author HYZ
 */

$(function(){
	
	$("#add_categories_name_dialog").dialog({ 
		autoOpen: false,
		title: 'Add Remark',
		width: 430,
		height: 150
	});
});

/**
 * 新增分类名字弹框
 * @param cid 分类id
 * @param lang 语言项
 */
function addCategoryName(cid, lang)
{
	$('#add_categories_id').val(cid);
	$('#add_lang').html(lang);
	$("#add_categories_name_dialog").dialog('open');
}

/**
 * 保存对应语言的分类名字
 */
function saveAddCategoryName(){
	
	var category_name = $('#add_categories_name').val();
	
	if(category_name == ''){
		alert('Category Name could not be empty!');
		return false;
	}
	
	var cid = $('#add_categories_id').val();
	var lang = $('#add_lang').html();
	var data = 'com=category&t=saveAddCategoryName&categories_id='+cid+'&category_name='+category_name+'&lang='+lang;
	
	$.ajax({
		type:'get',
		//dataType: 'json',
		url: 'index.php',
		data: data,
		success:function(res){
			if(res){
				$("#add_categories_name_dialog").dialog('close');
				$('#categories_name_'+cid).html(category_name);
				alert('success!');
			}else{
				alert('failed!');
			}
		}
	});
}

/**
 * 更新所有分类缓存操作
 */
function updateCategoryCache(){
	if(confirm('This operation may take a long time!Please wait before any tips appear!')){
		var data = 'com=category&t=updateCategoryCache';
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
 * 新增分类绑定过滤项
 * @param cid 分类id
 */
function addFilter(cid){
	
	var filter_id = $('#filter_to_category').val();
	var filter_name = $("#filter_to_category").find("option:selected").text();
	if(filter_id){
		var data = 'com=category&t=addFilter&cid='+cid+'&filter_id='+filter_id;
		$.ajax({
			type:'get',
			url: 'index.php',
			data: data,
			success:function(res){
				if(res == -1){
					alert('Filter Already exist!');
				}
				else if(res){
					var html = '<p>— '+filter_name+' <a href="javascript:void(0)" onclick="removeFilter(this, '+filter_id+', '+cid+')">remove</a></p>';
					$('#category_to_filter').after(html);
					alert('Add filter success!');
				}else{
					alert('Add filter failed!');
				}
			}
		});
	}else{
		alert('Please select filter first!');
	}
}

/**
 * 删除分类绑定过滤项
 * @param filter_id 过滤项id
 * @param cid 分类id
 */
function removeFilter(obj, filter_id, cid){
	if(filter_id && cid){
		var data = 'com=category&t=removeFilter&cid='+cid+'&filter_id='+filter_id;
		$.ajax({
			type:'get',
			url: 'index.php',
			data: data,
			success:function(res){
				if(res){
					$(obj).parent().remove();
					alert('Remove Filter Success!');
				}else{
					alert('Remove Filter Failed!');
				}
			}
		});
	}else{
		alert('Invalid Operation!');
	}
}