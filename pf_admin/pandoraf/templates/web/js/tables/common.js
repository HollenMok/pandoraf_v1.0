/**
 * 后台table公共js
 * @author HJW
 */

/**
 * 更新过滤项所有缓存
 */
function confirmAction(confirmMsg,ajaxUrl){
	if(!ajaxUrl){
		alert('error url');
	}
	if(!confirmMsg){
		var confirmMsg = '确定执行此操作？'; 
	}
	if(confirm(confirmMsg)){
		$.ajax({
			url: ajaxUrl,
			dataType: 'json',
			beforeSend: function(){
				ZCommon.addLoading();
			},
			success:function(res){
				ZCommon.removeLoading();
				if(!res.error){
					console.log(res);
					var msg = res.msg ? res.msg : 'success!';
					alert(msg);
				}else{
					alert(res.error);
				}
			}
		});
	}
}