// JavaScript Document
$(function(){
	//扩展表单项初始化
	$('h3[class*="title"]').click(function(){
		$(this).toggleClass('pane-toggler');
		$(this).toggleClass('pane-open');
		$(this).next().toggle();
	});
	
	$('h3[class*="title"]').each(function(){
		$(this).toggleClass('pane-toggler');
		$(this).toggleClass('pane-open');
		$(this).next().toggle();
	});
	
	//搜索选项
	$('.formRadio').click(function(){
		var checked = $(this).attr('is_checked');
		$(this).parent().find('input').attr('is_checked', 0);
		if(checked == 0)
		{
			$(this).attr('checked', true);
			$(this).attr('is_checked', 1);
		}
		else if(checked == 1)
		{
			$(this).attr('checked', false);
			$(this).attr('is_checked', 0);
		}
	});
});

