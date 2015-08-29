/**
 * 后台管理管理js
 * @author HYZ
 */


/**
 * 更新所有广告缓存
 */
function updateBannerCache(){
	if(confirm('This operation may take a long time!Please wait before any tips appear!')){
		var data = 'com=banner&t=updateBannerCache';
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
 * 为广告添加绑定分类
 */
function addCategory(bid){
	
	//广告已经绑定的分类id集
	var cats = $('#banner_category').val();
	var cat_arr = cats.split(",");
	
	//当前添加的分类id
	var cid = '';
	
	//获取选择的最后分类
	$("select[name='cats[]']").each(function(){
		if($(this).children("option:selected").val()){
			cid = $(this).children("option:selected").val();
			
		}
	});
	
	if(cat_arr.indexOf(cid) > -1){
		alert('Category already exist!');
		return false;
	}
	
	var data = 'com=banner&t=addCategory&bid='+bid+'&cid='+cid;
	
	$.ajax({
		type:'get',
		dataType:'json',
		url: 'index.php',
		data: data,
		success:function(res){
			
			if(!res.err){
				if(cats){
					cats += ','+cid;
				}else{
					cats = cid;
				}
				
				$('#banner_cat_path').after(res.html);
				$('#banner_category').val(cats);
			}else{
				alert('Sql Error!');
			}
		}
	});
	
}

/**
 * 删除广告绑定分类
 */
function removeCategory(obj, bid, cid){
	var data = 'com=banner&t=removeCategory&bid='+bid+'&cid='+cid;
	$.ajax({
		type:'get',
		dataType:'json',
		url: 'index.php',
		data: data,
		success:function(res){
			if(!res.err){
				$(obj).parent().remove();
				$('#banner_category').val(res.cats);
				alert('Success!');
			}else{
				alert('Remove category failed!');
			}
		}
	});
}