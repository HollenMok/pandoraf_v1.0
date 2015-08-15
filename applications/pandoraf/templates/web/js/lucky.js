$(document).ready(function(){	
	var p=0; 
	$(function(){ 
		var customersId =0; 
		var isPrizeAvailable =0;
	     $("#startbtn").click(function(){ 
	    	 isPrizeAvailable = parseInt($('#isPrizeAvailable').val());
		     customersId = parseInt($('#customersId').val());
		     if(customersId){
		    	
		    	 lottery(); 
		     }else{
		    	 alert('please register first!');
		     }
	         
	    	 });  
	     $("#register").click(function(){
	    	 register();
	     });
	    }); 
	   
	function register(){
	  	var email = $("#email").val();
    	var password = $("#password").val();
    	var rePassword = $("#rePassword").val();
    	$.ajax({
    		type:'post' ,
    		url:'index.php?com=lucky&t=register',  
    		dataType: 'json',
    		data:{'email':email,'password':password},
    		success:function(res){
    			customersId = res; 
    			if(res){
    				$('#customersId').val(customersId);
    				alert('succeed in registering,ready to play lucky compass!');
    				$('.sign_right').html('<h1><span >Congratulation, success in registering!</span></h1>');
    				$('#login').html('<a href="/index.php?com=lucky&t=logout">Logout</a>');
    			}
    		}
    	});
	}  
	
	function lottery(){ 
		$.ajax({
			type:'post',
			url:'index.php?com=lucky&t=lucky',
			dataType:'json',
			success:function(res){
			     //角度 
		        var a = res.angle; 
		         //奖项 
	             p = res.prize; 
	            var rid = res.rid; 
		        $("#startbtn").rotate({ 
		        	//转动时间间隔（转动速度） 
		            duration:3000,
		            //起始角度
		            angle: 0, 
		           //转动角度，10圈+a
		            animateTo:3600+a,
		            //动画扩展 
		            easing: $.easing.easeOutSine, 
		            //回调函数 
		            callback: function(){
		            alert("congratulation,prize"+p+" !");        
		            } 
		        }); 
			}
		});

	} 
});

