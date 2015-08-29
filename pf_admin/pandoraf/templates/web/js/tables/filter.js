/**
 * 后台分类过滤项js
 * @author HYZ
 */

/**
 * 更新过滤项所有缓存
 */
function updateFilterCache(){
	if(confirm('This operation may take a long time!Please wait before any tips appear!')){
		var data = 'com=filter&t=updateFilterCache';
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
 * 更新过滤项值所有缓存
 */
function updateFilterValueCache(){
	if(confirm('This operation may take a long time!Please wait before any tips appear!')){
		var data = 'com=filter&t=updateFilterValueCache';
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