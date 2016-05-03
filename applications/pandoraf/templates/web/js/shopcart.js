

$(document).on("click","#paypalForm",function(){
	$('#checkoutSubmitForm').submit();
});

$(document).on("click","#prev",function(){
	var qty = parseInt($("#qty").val());
	var products_id = $("#products_id").val();
	if(qty>1){
		qty = qty - 1;
		$.ajax({
	     	data:{qty:qty,products_id:products_id},
		    dataType:'json',
		    type:'POST',
		    url:'index.php?com=shopcart&t=changeQty',
		    success:function(res){
		    	window.location.reload();
		    },
		    error:function(){
		    	alert("wrong!");
		    }
	   });
	}

});
$(document).on("click","#next",function(){
	var qty = parseInt($("#qty").val());
	var products_id = $("#products_id").val();
	if(qty<999){
		qty = qty + 1;
		$.ajax({
	     	data:{qty:qty,products_id:products_id},
		    dataType:'json',
		    type:'POST',
		    url:'index.php?com=shopcart&t=changeQty',
		    success:function(res){
		    	window.location.reload();
		    },
		    error:function(){
		    	alert("wrong!");
		    }
	   });
	}
});
$(document).on("keyup","#qty",function(){
	var qty = parseInt($("#qty").val());
	var products_id = $("#products_id").val();
	var reg = /^[0-9]$/;
	if(!reg.test(qty)){
		qty = 1;
	}
	$.ajax({
     	data:{qty:qty,products_id:products_id},
	    dataType:'json',
	    type:'POST',
	    url:'index.php?com=shopcart&t=changeQty',
	    success:function(res){
	    	window.location.reload();
	    },
	    error:function(){
	    	alert("wrong!");
	    }
   });
});