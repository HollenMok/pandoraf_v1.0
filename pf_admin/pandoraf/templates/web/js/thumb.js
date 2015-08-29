/**
 * 生成缩略图操作
 * @author HYZ
 */
function makeThumb(obj){

	var skus = $(obj).parent().find('textarea[name=skus]').val();

	var data = 'com=thumb&t=makeThumb&skus='+skus;
	$.ajax({
		type:'get',
		url: 'index.php',
		data: data,
		beforeSend: function(){
			ZCommon.addLoading();
		},
		success:function(msg){
			ZCommon.removeLoading();
			$('#tips').html(msg);
		}
	});
}