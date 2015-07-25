$(document).ready(function(){	
	var p=0; 
	$(function(){ 
	     $("#startbtn").click(function(){ 
	         lottery(); 
	    	 });      
	    }); 
	   
	function lottery(){ 
	     //角度 
        var a = 90; 
        //奖项 
         p = 1; 
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

