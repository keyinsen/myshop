
$(function(){
	var total=$('#carttotal').html();
	//总结
	var smalltotal=0;
	//选择购买的商品件数
	var jian=0;
	var countreg=/^[1-9]{1}[0-9]{0,1}$/;
	var ginfocount=0;
	var deprice=0;
	//var is_
	
	$('.cartcheck').click(function(){
		
		if($(this).is(':checked')){
			smalltotal+=parseInt($(this).parent().parent().find('td').eq(6).find('.cartxj').html());
			++jian;
			$('#jian').html(jian);
			$('#zbtn').removeAttr('disabled');
		}else{
			if(smalltotal!=0){
				smalltotal-=parseInt($(this).parent().parent().find('td').eq(6).find('.cartxj').html());
				console.log(jian);
				jian=parseInt(jian)-1;
				
				$('#jian').html(jian);
				if(smalltotal==0){
					$('#zbtn').attr('disabled','disabled');
				}
			}
		}
		
		$('#carttotal').html(smalltotal);
	})
	$('.shopli').mouseover(function(){
		$('.shopli').css('background','none');
		$('.shop').css('display','none');
	})
	
	//过滤非数字
	$('.ginfocount').keyup(function(){
		var reg=/[1-9]\d*/;
		var count=$(this).val();
		if(!reg.exec(parseInt(count))){
			$(this).val(1);			
		}else{
			if(parseInt(count)>20){
				$(this).val(20);
			}
		}
		 if(isNaN($(this).val())){
			$(this).val(1);
		}
		count=$(this).val();
		//单价
		var goodsprice=parseInt($(this).parent().parent().parent().find('td').eq(4).find('.cartprice').html());
		//原价
		var goodsprice2=parseInt($(this).parent().parent().parent().find('td').eq(4).find('.cartprice2').html());
//		//总计
//		var goodszprice=parseInt($(this).parent().parent().parent().find('td').eq(6).find('.cartxj').html());
//		//节省
//		var goodszprice2=parseInt($(this).parent().parent().parent().find('td').eq(6).find('.cartxj2').html());
 		var checkboxs=$(this).parent().parent().parent().find('td').eq(1).find('.cartcheck');
 		//totals(checkboxs,goodsprice,count);
		$(this).parent().parent().parent().find('td').eq(6).find('.cartxj').html(goodsprice*count);
		$(this).parent().parent().parent().find('td').eq(6).find('.cartxj2').html(goodsprice2*count-goodsprice*count);

	})
	
	$('.ginfocount').focus(function(){
		count=$(this).val();
		var goodsprice=parseInt($(this).parent().parent().parent().find('td').eq(4).find('.cartprice').html());
		var checkboxs=$(this).parent().parent().parent().find('td').eq(1).find('.cartcheck');
		if(checkboxs.is(':checked')){
			checkboxs.removeAttr('checked','checked');
			--jian;
			$('#jian').html(jian);
			if(parseInt(smalltotal)!=0){
			 deprice=count*goodsprice;
			smalltotal=smalltotal-deprice;
				$('#carttotal').html(smalltotal);
			if(parseInt(smalltotal)==0){
						//console.log($('#carttotal').html());
						$('#zbtn').attr('disabled','disabled');
					}
				}else{
					$('#zbtn').attr('disabled','disabled');
				}
		}
	});
	
	

	
	//增加
	$('.addcount').click(function(){
		
		count=$(this).parent().parent().parent().find('td').eq(5).find('.ginfocount').val();
		//单价
		var goodsprice=parseInt($(this).parent().parent().parent().find('td').eq(4).find('.cartprice').html());
		//原价
		var goodsprice2=parseInt($(this).parent().parent().parent().find('td').eq(4).find('.cartprice2').html());
		//总计
		var goodszprice=parseInt($(this).parent().parent().parent().find('td').eq(6).find('.cartxj').html());
		//节省
		var goodszprice2=parseInt($(this).parent().parent().parent().find('td').eq(6).find('.cartxj2').html());
		//console.log(goodsprice2);
		var checkboxs=$(this).parent().parent().parent().find('td').eq(1).find('.cartcheck');
		//计算
		addtotals(checkboxs,goodsprice,count);
		
		
		if(parseInt(count)<20){
			//console.log(goodsprice+goodszprice);
		$(this).parent().parent().parent().find('td').eq(5).find('.ginfocount').val(++count);
		count=parseInt($(this).parent().parent().parent().find('td').eq(5).find('.ginfocount').val());
		//console.log(count);
		$(this).parent().parent().parent().find('td').eq(6).find('.cartxj').html(goodszprice+goodsprice);
		$(this).parent().parent().parent().find('td').eq(6).find('.cartxj2').html(goodsprice2*count-goodsprice*count);
		}
		
		
	})
	
	//减少
	$('.deccount').click(function(){
		count=$(this).parent().parent().parent().find('td').eq(5).find('.ginfocount').val();
		//单价
		var goodsprice=parseInt($(this).parent().parent().parent().find('td').eq(4).find('.cartprice').html());
		//原价
		var goodsprice2=parseInt($(this).parent().parent().parent().find('td').eq(4).find('.cartprice2').html());
		//总计
		var goodszprice=parseInt($(this).parent().parent().parent().find('td').eq(6).find('.cartxj').html());
		//节省
		var goodszprice2=parseInt($(this).parent().parent().parent().find('td').eq(6).find('.cartxj2').html());
		
		var checkboxs=$(this).parent().parent().parent().find('td').eq(1).find('.cartcheck');
		
		//计算
		 detotals(checkboxs,goodsprice,count);
		if(parseInt(count)>1){
		$(this).parent().parent().parent().find('td').eq(5).find('.ginfocount').val(--count);
		count=parseInt($(this).parent().parent().parent().find('td').eq(5).find('.ginfocount').val());
		$(this).parent().parent().parent().find('td').eq(6).find('.cartxj').html(goodszprice-goodsprice);
		$(this).parent().parent().parent().find('td').eq(6).find('.cartxj2').html(goodsprice2*parseInt(count)-goodsprice*parseInt(count));
		}
		
	
	})
	
	
	//点击 加的时候进行计算总价格
	function addtotals(checkboxs,goodsprice,count){
		if($('.cartAllcheck').is(':checked')){
			$('.cartAllcheck').removeAttr('checked','checked');
			$('.cartcheck').removeAttr('checked','checked');
			jian=0;
			$('#jian').html(jian);
			smalltotal=0;
			$('#carttotal').html(smalltotal);
			$('#zbtn').attr('disabled','disabled');
		}
		
		if(checkboxs.is(':checked')){
			//checkboxs.removeAttr('checked','checked');
			//--jian;
			//$('#jian').html(jian);
			
		if(parseInt(smalltotal)!=0){
			smalltotal=smalltotal+goodsprice;
			$('#carttotal').html(smalltotal);
			
			if(parseInt(smalltotal)==0){
				//console.log($('#carttotal').html());
				$('#zbtn').attr('disabled','disabled');
			}
		}else{
			$('#zbtn').attr('disabled','disabled');
		}
		}
	}
	//点击 加的时候进行计算总价格
	function detotals(checkboxs,goodsprice,count){
		if($('.cartAllcheck').is(':checked')){
			$('.cartAllcheck').removeAttr('checked','checked');
			$('.cartcheck').removeAttr('checked','checked');
			jian=0;
			$('#jian').html(jian);
			smalltotal=0;
			$('#carttotal').html(smalltotal);
			$('#zbtn').attr('disabled','disabled');
		}
		
		if(checkboxs.is(':checked')){
			//checkboxs.removeAttr('checked','checked');
			//--jian;
			//$('#jian').html(jian);
			if(count!=1){
				if(parseInt(smalltotal)!=0){
					smalltotal=smalltotal-goodsprice;
					$('#carttotal').html(smalltotal);
					
					if(parseInt(smalltotal)==0){
						//console.log($('#carttotal').html());
						$('#zbtn').attr('disabled','disabled');
					}
				}else{
					$('#zbtn').attr('disabled','disabled');
				}
			}
		
		}
	}
	
	//输入框输入商品数目的时候计算 
	function texttotal(checkboxs,goodsprice,count){
		if($('.cartAllcheck').is(':checked')){
			$('.cartAllcheck').removeAttr('checked','checked');
			$('.cartcheck').removeAttr('checked','checked');
			jian=0;
			$('#jian').html(jian);
			smalltotal=0;
			$('#carttotal').html(smalltotal);
			$('#zbtn').attr('disabled','disabled');
		}
		
		if(checkboxs.is(':checked')){
			checkboxs.removeAttr('checked','checked');
			--jian;
			$('#jian').html(jian);
			
		if(parseInt(smalltotal)!=0){
			smalltotal=smalltotal-goodsprice*count;
			$('#carttotal').html(smalltotal);
			
			if(parseInt(smalltotal)==0){
				console.log($('#carttotal').html());
				$('#zbtn').attr('disabled','disabled');
			}
		}else{
			$('#zbtn').attr('disabled','disabled');
		}
		}
	}
	
	//全选
	$('.cartAllcheck').click(function(){
		smalltotal=0;
		//console.log($('.cartcheck').parent().parent().find('td').eq(5).find('.cartxj').length);
		if($(this).is(':checked')){
			$('.cartcheck').prop('checked','checked');
			//console.log($('.cartcheck').parent().parent().find('.cartxj'));
			for(var i=0;i<$('.cartcheck').parent().parent().find('.cartxj').length;i++){
				//console.log($('.cartcheck').parent().parent().find('.cartxj').eq(i).html());
				smalltotal+=parseInt($('.cartcheck').parent().parent().find('.cartxj').eq(i).html());
			}
			//++jian;
			jian=$('.cartcheck').parent().parent().find('.cartxj').length;
			$('#jian').html(jian);
			$('#zbtn').removeAttr('disabled');
			$('#carttotal').html(smalltotal);
		}else{
			jian=0;
			
			$('#jian').html(0)
			$('.cartcheck').removeAttr('checked','checked');
			$('#carttotal').html(0);
			$('#zbtn').attr('disabled','disabled');
		}
		
		
	})
	
	//删除购物车的商品
	$('.cartremove').click(function(){
		var ethis=$(this);
		ethis.attr('disabled','disabled');
		var gid=ethis.parent().parent().eq(0).find(':hidden').val()		
		var tbody=ethis.parent().parent().parent();
		ethis.parent().parent().remove();
		if(tbody.children().length==1){
			$('.ct-main').empty();
			var div=$('<div>').addClass('goodsnot');
			var span=$('<span>你的购物车没有任何人商品，请赶紧去添加自己喜欢的商品哦</span>');
			$(div).append(span);
			$('.ct-main').append(div);
		}
		$.ajax({
			type:"get",
			url:"http://localhost/ShopProject/public/home/valogin",
			async:true,
			success:function(reps){
				if(reps.status==1){
					$.ajax({
							type:"get",
							url:"http://localhost/ShopProject/public/home/ajaxDelete",
							async:true,
							data:{
								gid:gid
							},
							success:function(resp){
								//
							}
					});
				}else{
					 $('#myModal').modal({
        				keyboard: true
    					})
				}
			}
		});
	})
	
	//结算 ，创建订单
	$('#zbtn').click(function(){
		var cartid_num='';
		var is_true=true;
		var gid_num='';
		for(var i=0;i<$('.cartcheck:checked').length;i++){
			if(is_true){
			cartid_num+=i+'='+$('.cartcheck:checked').eq(i).val()+'_'+$('.cartcheck:checked').eq(i).parent().parent().find('td').eq(5).find('.ginfocount').val();
			gid_num+=$('.cartcheck:checked').eq(i).parent().parent().find('input:hidden').val()+'_'+$('.cartcheck:checked').eq(i).parent().parent().find('td').eq(5).find('.ginfocount').val();
			is_true=false;
			//console.log($('.cartcheck:checked').eq(i).parent());
			}else{
			cartid_num+='&'+i+'='+$('.cartcheck:checked').eq(i).val()+'_'+$('.cartcheck:checked').eq(i).parent().parent().find('td').eq(5).find('.ginfocount').val();	
			gid_num+='&'+$('.cartcheck:checked').eq(i).parent().parent().find('input:hidden').val()+'_'+$('.cartcheck:checked').eq(i).parent().parent().find('td').eq(5).find('.ginfocount').val();
			}
		}
		console.log(gid_num);
		$(this).attr('disabled','disabled');
		$.ajax({
			type:"get",
			url:"http://localhost/ShopProject/public/home/cart/kucun",
			async:true,
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			},
			data:{
				data:gid_num
			},
			success:function(resp){
				//console.log(resp)
				if(resp.status==1){
					window.location.href="http://localhost/ShopProject/public/home/order/show?"+cartid_num;
				}
				if(resp.status==-1){
					$('#myModal2').find('.modal-body').css('color','red');
					$('#myModal2').find('.modal-body').html('购物车里商品名为：'+resp.mess+'  库存不足');
					$('#zbtn').removeAttr("disabled");
					$('#myModal2').modal({
        				keyboard: true
    					})
				}
			}
		});
		//
		
	})
	
	
})
