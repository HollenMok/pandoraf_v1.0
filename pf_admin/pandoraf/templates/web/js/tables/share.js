/**
 * 审核分享评论操作
 */
function approvedComment(obj, id){
	if(confirm('Are you sure to approve this comment?')){
		var data = 'com=share&t=approvedComment';
		data += '&id='+id;
		$.ajax({
			type:'get',
			url: 'index.php',
			data: data,
			success:function(res){
				if(res){
					$(obj).attr("src", "templates/default/images/buttons/publish.png");
					$(obj).removeAttr("onclick");
					$(obj).removeAttr("style", "cursor");
					$(obj).attr("title", "Approved");
					$(obj).attr("alt", "Approved");
				}else{
					alert('error!');
				}
			}
		});
	}
}

/**
 * 审核视频状态为通过
 */
function approvedVideo(obj, video_id,customers_id,products_id){

	if(confirm('Are you sure to approve this video?')){
		var data = 'com=share&t=approvedVideo';
		data += '&video_id='+video_id+'&customers_id='+customers_id+'&products_id='+products_id;
		// data += '&video_id='+video_id;
		$.ajax({
			type:'get',
			url: 'index.php',
			data: data,
			success:function(res){
				if(res){
					$(obj).parents('tr').find('td').eq(8).html('Succesful');
					$(obj).parent('td').html('');
				}else{
					alert('error!');
				}
			}
		});
	}
}

/**
 * 审核视频状态为失败
 */
function unapprovedVideo(obj, video_id){

	if(confirm('Are you sure to forbid this video?')){
		var data = 'com=share&t=unapprovedVideo';
		data += '&video_id='+video_id;
		$.ajax({
			type:'get',
			url: 'index.php',
			data: data,
			success:function(res){
				if(res){
					$(obj).parents('tr').find('td').eq(8).html('Unsuccesful');
					$(obj).parent('td').html('');
				}else{
					alert('error!');
				}
			}
		});
	}
}

/**
 * 审核图片状态为通过
 */
function approvedImage(obj, image_id,customers_id,products_id,add_time,send_email){

	if(confirm('Are you sure to approve this image?')){
		var data = 'com=share&t=approvedImage';
		data += '&image_id='+image_id+'&customers_id='+customers_id+'&products_id='+products_id+'&add_time='+add_time+'&send_email='+send_email;
		$.ajax({
			type:'get',
			url: 'index.php',
			data: data,
			success:function(res){
				if(res){
					$(obj).parents('tr').find('td').eq(7).html('Succesful');
					$(obj).parent('td').html('');
				}else{
					alert('error!');
				}
			}
		});
	}
}

/**
 * 审核图片状态为失败
 */
function unapprovedImage(obj, image_id){

	if(confirm('Are you sure to forbid this image?')){
		var data = 'com=share&t=unapprovedImage';
		data += '&image_id='+image_id;
		// data += '&image_id='+image_id+'&customers_id='+customers_id+'&products_id='+products_id;
		$.ajax({
			type:'get',
			url: 'index.php',
			data: data,
			success:function(res){
				if(res){
					$(obj).parents('tr').find('td').eq(7).html('Unsuccesful');
					$(obj).parent('td').html('');
				}else{
					alert('error!');
				}
			}
		});
	}
}