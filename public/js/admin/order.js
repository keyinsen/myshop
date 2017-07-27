$(function(){
	var oid='';
	//发货
	$('.sendgoods').click(function(){
		
		 oid=$(this).parent().find('input:hidden').val();
		$(this).attr('disabled','disabled');
		$.ajax({
			type:"get",
			url:"order/sendGoods",
			async:true,
			data:{
				oid:oid
			},
			success:function(resp){
				if(resp.status==1){
					$('#SendModal').modal({
        				keyboard: true
    				})
				}else{
					alert('发货失败');
					window.location.reload();
				}
				
			}
		});
	})
	
	//签收
	$('.sign').click(function(){
		
		oid=$(this).parent().find('input:hidden').val();
		$(this).attr('disabled','disabled');
		$.ajax({
			type:"get",
			url:"order/Sign",
			async:true,
			data:{
				oid:oid
			},
			success:function(resp){
				if(resp.status==1){
					window.location.reload();
				}else{
					alert('签收失败');
					window.location.reload();
				}
				
			}
		});
	})
	
	//订单删除
	
	$('.remove').click(function(){
		
		 oid=$(this).parent().find('input:hidden').val();
		$('#RmoveOrderModal').modal({
        				keyboard: true
    				})
		$(this).attr('disabled','disabled');
		
	})
	
	$('#remove_succ').click(function(){
		$.ajax({
			type:"get",
			url:"order/del",
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
	})
	
	$('#remove_cancel').click(function(){
		oid='';
		window.location.reload();
	})
	
	$('#send_succ').click(function(){
		window.location.reload();
	})
})
