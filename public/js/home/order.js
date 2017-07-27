$(function(){
	var gid='';
	var recid_gid='';
	var rec_id='';
	
	for(var i=0;i<$('.cart_gid').length;i++){
		gid+='_'+$('.cart_gid').eq(i).html();
	}

	//选择收货地址
	$('.address-ct').click(function(){
		$(this).css('border','1px solid #ff0000');
		$(this).find('span').css('font-weight','bold');
		$(this).find('a').css('visibility','visible');
		$('.address-ct').not($(this)).css('border','1px solid #cccccc');
		$('.address-ct').not($(this)).find('span').css('font-weight','normal');
		rec_id=$(this).find('.rec_id').html();
//		$('.address-ct').not($(this)).find('a').css('visibility','hidden');
	})
	
	//不显示顶部的购物车信息
	$('.shopli').mouseover(function(){
		$('.shopli').css('background','none');
		$('.shop').css('display','none');
	})
	
	//通过购物车创建的订单事件 
	$('#order_submit').one('click',function(){
		recid_gid=rec_id+gid;
		//console.log(recid_gid);
		$(this).attr('disabled','disabled');
		var mess=$('#order_mess').val();
		if(rec_id!=''){
			$.ajax({
			type:"get",
			url:"create",
			async:true,
			data:{
				recid_gid:recid_gid,
				mess:mess
			},
			success:function(resp){
				if(resp.status==-1){
					$('#myModal2').find('.modal-body').css('color','red');
					$('#myModal2').find('.modal-body').html('购物车里商品名为：'+resp.mess+'  库存不足');
					$('#order_submit').attr('disabled','disabled');
					$('#myModal2').modal({
        				keyboard: true
    				})
				}
				if(resp.status==1){
					window.location.href="http://localhost/ShopProject/public/home/order/index";
				}
				
			}
			
		});
		}else{
			
			$('#myorderModal').modal({
        				keyboard: true
    				})
		}
		
		
	});
	
	//通过商品详情直接购买商品创建的订单事件 
	$('#order_goods_submit').one('click',function(){
		$gid=$('.cart_gid').eq(0).html()
		$num=$('#gnum').html();
		recid_g_n=rec_id+gid+'_'+$num;
		//console.log(recid_gid);
		$(this).attr('disabled','disabled');
		var mess=$('#order_mess').val();
		if(rec_id!=''){
			$.ajax({
			type:"get",
			url:"gcreate",
			async:true,
			data:{
				recid_g_n:recid_g_n,
				mess:mess
			},
			success:function(resp){
				if(resp.status==-1){
					$('#myModal2').find('.modal-body').css('color','red');
					$('#myModal2').find('.modal-body').html('购物车里商品名为：'+resp.mess+'  库存不足');
					$('#order_submit').attr('disabled','disabled');
					$('#myModal2').modal({
        				keyboard: true
    				})
				}
				if(resp.status==1){
					window.location.href="http://localhost/ShopProject/public/home/order/index";
				}
				
			}
			
		});
		}else{
			
			$('#myorderModal').modal({
        				keyboard: true
    				})
		}
//		
		
	});
		
	$('#order_succ').click(function(){
		 window.location.reload();
	})
})
