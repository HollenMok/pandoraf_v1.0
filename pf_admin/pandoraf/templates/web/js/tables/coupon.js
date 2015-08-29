/**
 * 后台coupon js
 * @author lz
 */
function checkForm(){
	var length = $('#coupon_code').val().length;
	if($('input[name=is_exchange]').attr("checked")){
		var points = $('#exchange_points').val();
		if(points<=0){
			alert('Please enter exchange of points');
			return false;
		}
	}
	return true;
}
/**
 * 设置coupon的状态
 * @param filter_id 过滤项id
 * @param cid 分类id
 */
function setStatus(obj){
	var coupon_id = $(obj).attr('code_id');
	var status = $(obj).attr('status');
	if(coupon_id){
		var data = 'com=coupon&t=setStatus&coupon_id='+coupon_id+'&status='+status;
		$.ajax({
			type:'get',
			url: 'index.php',
			data: data,
			dataType: 'JSON',
			success:function(res){
				$(obj).attr('status',res.status);
				$(obj).attr('src',res.src);
			}
		});
	}else{
		alert('Invalid Operation!');
	}
}