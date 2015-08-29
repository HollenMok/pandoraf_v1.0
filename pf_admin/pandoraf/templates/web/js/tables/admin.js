/**
 * 后台管理员js
 */
 
function removeAdmin(Img, admin_id){
	
	if(!confirm('Are you sure remove it?')){
		return false;	
	}
	
	var data = 'com=admin&t=removeAdmin&admin_id='+admin_id;
	
	$.ajax({
		type:'get',
		url: 'index.php',
		data: data,
		success:function(res){
			if(res == -1){
				alert('You can\'t remove yourself!');
			}else{
				if(res){
					$(Img).parent().parent().remove();
					alert('Success!');
				}else{
					alert('Remove admin failed, an error has occur!');
				}
			}
		}
	});
}
