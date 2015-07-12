$(document).ready(function(){
	$('#signin').click(function(){
		var email =   $('#email').val();
		var password =   $('#password').val();
		alert('welcome '+email+'!');
        $.ajax({
        	type:'post',
        	url:'index.php?com=account&t=login',
        	dataType:'json',
        	data:{'email':email,'password':password},
        	error:function(){
        		alert('wrong!');
        		return false;
        	},
        	success:function(result){
        		
        	}
        });
		
	});	
});





