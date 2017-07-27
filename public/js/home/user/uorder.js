$(function(){
	var oid='';
	
	//执行是否购买操作
	$('.orderpay').click(function(){
		oid=$(this).parent().find(':hidden').val();
		//console.log(oid);
		$('#orderModal').modal({
        				keyboard: true
    					})
	})
	
	//执行是否取消订单操作
	$('.cancelorderpay').click(function(){
		oid=$(this).parent().find(':hidden').val();
		//console.log(oid)
		//console.log(oid);
		$('#cancelorderModal').modal({
        				keyboard: true
    					})
	})
	
	//订单取消执行操作
	$('#ordercancels').click(function(){
		//console.log(oid);
		if(oid!=''){
			
			$.ajax({
				type:"get",
				url:"http://localhost/ShopProject/public/home/order/oCancel",
				async:true,
				data:{oid:oid},
				success:function(resp){
					if(resp.status==1){
						$('#resulttext').html(resp.mess);
						$('#resulttext').removeClass().addClass('glyphicon glyphicon-ok-circle');
						$('#resulttext').css('color','green');
						$('#orderresultModal').modal({
        				keyboard: true
    					})
					}
					if(resp.status==-1){
						$('#resulttext').html(resp.mess);
						$('#resulttext').removeClass().addClass('glyphicon glyphicon-remove-circle');
						$('#resulttext').css('color','red');
						$('#orderresultModal').modal({
        				keyboard: true
    					})
					}
				}
			});
		}
		
	})
	
	//执行支付订单操作
	$('#order_success').click(function(){
		if(oid!=''){
			$.ajax({
				type:"get",
				url:"pay",
				async:true,
				data:{oid:oid},
				success:function(resp){
					if(resp.status==1){
						$('#resulttext').html(resp.mess);
						$('#resulttext').removeClass().addClass('glyphicon glyphicon-ok-circle');
						$('#resulttext').css('color','green');
						$('#orderresultModal').modal({
        				keyboard: true
    					})
					}
					if(resp.status==0){
						$('#resulttext').html(resp.mess);
						$('#resulttext').removeClass().addClass('glyphicon glyphicon-remove-circle');
						$('#resulttext').css('color','red');
						$('#orderresultModal').modal({
        				keyboard: true
    					})
					}
					if(resp.status==-1){
						$('#resulttext').html(resp.mess);
						$('#resulttext').removeClass().addClass('glyphicon glyphicon-remove-circle');
						$('#resulttext').css('color','red');
						$('#orderresultModal').modal({
        				keyboard: true
    					})
					}
				}
			});
		}
	})
	
	//询问是否删除订单
	$('.orderdel').click(function(){
		oid=$(this).parent().find(':hidden').val();
		$('#orderdelModal').modal({
        				keyboard: true
    					})
	})
	
	//执行订单删除
	$('#delorder').click(function(){
		if(oid!=''){
			$.ajax({
				type:"get",
				url:"del",
				async:true,
				data:{oid:oid},
				success:function(resp){
					if(resp.status==1){
						$('#resulttext').html(resp.mess);
						$('#resulttext').removeClass().addClass('glyphicon glyphicon-ok-circle');
						$('#resulttext').css('color','green');
						$('#orderresultModal').modal({
        				keyboard: true
    					})
					}
					if(resp.status==0){
						$('#resulttext').html(resp.mess);
						$('#resulttext').removeClass().addClass('glyphicon glyphicon-remove-circle');
						$('#resulttext').css('color','red');
						$('#orderresultModal').modal({
        				keyboard: true
    					})
					}
					if(resp.status==-1){
						$('#resulttext').html(resp.mess);
						$('#resulttext').removeClass().addClass('glyphicon glyphicon-remove-circle');
						$('#resulttext').css('color','red');
						
						$('#orderresultModal').modal({
        				keyboard: true
    					})
					}
				}
			});
		}
	})
	
	//确认收货 
	$('.recipient').click(function(){
		oid=$(this).parent().find(':hidden').val();
		$('#recipientModal').modal({
        				keyboard: true
    					})
	})
	
	//执行确认收货
	$('#recipient_succ').click(function(){
		if(oid!=''){
			$.ajax({
				type:"get",
				url:"http://localhost/ShopProject/public/home/order/recipient",
				async:true,
				data:{
					oid:oid
				},
				success:function(resp){
					if(resp.status==1){
						 window.location.reload();
					}
				}
			});
		}
	})
	
	//取消确认收货
	$('#recipient_can').click(function(){
		oid='';
	})
	
	
	//支付失败或者成功 重新加载
	$('#freashorder').click(function(){
		 window.location.reload();
	})
	
})
