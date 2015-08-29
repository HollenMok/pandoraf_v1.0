/**
 * excel导出Customer
 */
function excelCustomer(){
	var com = 'customer';
	var count = excelCount('excelCount',com); 
	if(count > 0){
		var $d = $( "#dialog-message" );
		$d.dialog( 'option' , 'title' , 'Export INFO' );
		var url = 'index.php?com=customer&t=excelCustomer'+ModTable.getSearchOptions()+'&page_size='+count;
		if(count > 10000){
			$d.dialog( 'option' , 'buttons' ,{"确认导出": function(){
				window.open(url);
				$d.dialog("close");
			}});
			$d.html( '导出Customer总数为'+count+'；导出大量数据会给服务器增加压力，请点确认导出！' );
			$d.dialog( 'open' );
			return false
		}
		window.open(url);
	}else{
		alert('没有符合的Customer数据');
	}
	return false
}

/**
 * 获取当前搜索条件的Customer总数
 * @param {String} task
 * @param {String} com
 */
function excelCount(task,com){
	var count = 0;
	if(!task){
		alert('task参数错误');
		return false
	}
	if(!com){
		alert('com参数错误');
		return false
	}
	var data = 'com='+com+'&t='+task;
	//获取搜索参数
	var searchData = ModTable.getSearchOptions();
	$.ajax({
		async : false,
		url : 'index.php',
		type : 'get',
		data : data+searchData,
		dataType : 'text',
		success : function(res){
			count = Number(res);
		}
	})
	return count
}
