$(function(){
	var islogin=false;
	var countreg=/^[1-9]{1}[0-9]{0,1}$/;
	var kucunot=$('.kucount').html();
	var count=0;
	var gid=parseInt($('#ginfogid').val());
	//console.log(gid);
	
	//消息的事件
	$('#message').click(function(){
		$.ajax({
			type:"get",
			url:"http://localhost/ShopProject/public/home/valogin",
			async:true,
			success:function(reps){
				if(reps.status==1){
					window.location.href='http://localhost/ShopProject/public/home/message'
				}else{
					 $('#myModal').modal({
        				keyboard: true
    					})
				}
			}
		});
	});
	
	//我的订单事件
	$('#order').click(function(){
		$.ajax({
			type:"get",
			url:"http://localhost/ShopProject/public/home/valogin",
			async:true,
			success:function(reps){
				if(reps.status==1){
					window.location.href='http://localhost/ShopProject/public/home/order/index'
				}else{
					 $('#myModal').modal({
        				keyboard: true
    					})
				}
			}
		});
	});
	
	//我的收藏夹事件
	$('#collect').click(function(){
		$.ajax({
			type:"get",
			url:"http://localhost/ShopProject/public/home/valogin",
			async:true,
			success:function(reps){
				if(reps.status==1){
					window.location.href='http://localhost/ShopProject/public/home/collect'
				}else{
					 $('#myModal').modal({
        				keyboard: true
    					})
				}
			}
		});
	});
	
	//添加商品收藏,先判断是否登入
$('.addcollect').click(function(e){
		$.ajax({
			type:"get",
			url:"http://localhost/ShopProject/public/home/valogin",
			async:true,
			success:function(reps){
				if(reps.status==1){
					islogin=true;
					addcollect(e);
					
				}else{
					 $('#myModal').modal({
        				keyboard: true
    					})
				}
			}
		});
	})
	
	function addcollect(e){
		//alert('a');
		
		var gid=$('#ginfogid').val();
		//console.log(gid)
		$.ajax({
			type:"get",
			url:"http://localhost/ShopProject/public/home/collect/add",
			async:true,
			data:{
				gid:gid
			},
			success:function(resp){
				if(resp.status==1){
					$('#myModal3').find('.modal-body').empty();
					$('#myModal3').find('.modal-body').html('商品已成功添加到 收藏夹！！')
					$('#myModal3').modal({
        				keyboard: true
    					})
				}
				if(resp.status==2){
					$('#myModal3').find('.modal-body').empty();
					$('#myModal3').find('.modal-body').css('color','red')
					$('#myModal3').find('.modal-body').html('此商品你已经添加过')
					$('#myModal3').modal({
        				keyboard: true
    					})
				}
			}
		});
	}
	
	//过滤非数字
	$('#ginfocount').keyup(function(){
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

	})
	
	//购物车事件
	$('#carts').click(function(){

		$.ajax({
			type:"get",
			url:"http://localhost/ShopProject/public/home/valogin",
			async:true,
			success:function(reps){
				if(reps.status==1){
					window.location.href="http://localhost/ShopProject/public/home/cart";
				}else{
					 $('#myModal').modal({
        				keyboard: true
    					})
				}
			}
		});
	});
	
	
	
	$('#ginfocount').blur(function(){
		var count=$(this).val();
		if(!countreg.test(count)){
			$(this).val(1);
		}else{
			if(parseInt(count)>parseInt(kucunot)){
				$(this).val(kucunot);
			}
		}
		
	})
	$('.addcount').click(function(){
		count=$('#ginfocount').val();		
		if(parseInt(count)<parseInt(kucunot)){
		$('#ginfocount').val(++count)
		
		}
	})
	
	$('.deccount').click(function(){
		count=$('#ginfocount').val();
		if(parseInt(count)>1){
		$('#ginfocount').val(--count);
		
		}
	
	})
	
	//在商品详情中点击添加购物车事件是否判断是否登入，再进行添加到购物车
	$('#ginfocart').click(function(){
		//alert('a');exit;
		addginfoCart();
//		if(!islogin){
//		$.ajax({
//			type:"get",
//			url:"http://localhost/ShopProject/public/home/valogin",
//			async:true,
//			success:function(reps){
//				if(reps.status==1){
//					islogin=true;
//					addginfoCart();
//				}else{
//					 
//				}
//			}
//		});
//		}else{
//			
//		}
	})
	
	//在商品详情添加商品到购物车
	function addginfoCart(){
		//添加的商品信息是否在主页界面显示
		var is_cart=true;
		var carcount=$('#carts').find('.red').html();
		var carcount1=$('.cart-sum').find('.red').html();
		var gid=parseInt($('#ginfogid').val());
		var gname=$('#ginfogname').html();
		var img_path=$('#ginfoimg').val();
		var price=$('#ginfoprice').html();
		var discount=$('#ginfodiscount').html()/price;
		var num=$('#ginfocount').val();
		//console.log(discount);
		var tr=$('#carttable').find('tr');
				for(var i=0;i<tr.length;i++){
					
				if(parseInt(tr.eq(i).find('td').eq(0).find(':hidden').val())==parseInt(gid)){
					var count=tr.eq(i).find('td').eq(4).find('span').html();
					tr.eq(i).find('td').eq(4).find('span').html('');
					if(parseInt(count)+parseInt(num)<=20){
					tr.eq(i).find('td').eq(4).find('span').html(parseInt(count)+parseInt(num));
					}else{
						tr.eq(i).find('td').eq(4).find('span').html(parseInt(count));
					}
					is_cart=false;
					//console.log('aaa');
				}
			}
				if((tr.length<5)&&is_cart){
				
					var tr=$('<tr>');
					var addgidtd=$('<td>').append($('<input>').prop('value',gid).prop('type','hidden'));
					var addimgtd=$('<td>').append($('<img>').prop('src',img_path));
					var addgnametd=$('<td>').html(gname.length > 6 ? gname.substring(0,13) + '...' : gname);
					//var addpricetd=$('<td>').html('￥'+price);
					var addpricetd=$('<td>').html('￥'+price*discount);
					var addnumtd=$('<td>').html('X').append($('<span>').html(num));
					var addremotd=$('<td>').append($('<a>').prop('href','javascript:void(0);').addClass('remove').html('删除').click(removeCartItem));
					tr.append(addgidtd);
					tr.append(addimgtd);
					tr.append(addgnametd);
					tr.append(addpricetd);
					tr.append(addnumtd);
					tr.append(addremotd);
					$('#carttable').append(tr);
					$('#carts').find('.red').html(++carcount);
					$('.cart-sum').find('.red').html(++carcount1);
				
		}
				//console.log('aa');
		//$('#myModal2').modal('show');
		$.ajax({
			type:"get",
			url:"http://localhost/ShopProject/public/home/ajaxginfoAddGoods",
			async:true,
			data:{
				gid:gid,
				gname:gname,
				img_path:img_path,
				price:price,
				discount:discount,
				num:num
			},
			success:function(reps){
				if(reps.status==1){
					$('#myModal2').find('.modal-body').css('color','green');
					$('#myModal2').find('.modal-body').html('商品成功添加到购物车！');
					$('#myModal2').modal({
        				keyboard: true
    					})
				}
				if(reps.status==-2){
					$('#myModal2').find('.modal-body').css('color','red');
					$('#myModal2').find('.modal-body').html(reps.mess);
					$('#myModal2').modal({
        				keyboard: true
    					})
				}
				if(reps.status==-3){
					$('#myModal2').find('.modal-body').css('color','red');
					$('#myModal2').find('.modal-body').html(reps.mess);
					$('#myModal2').modal({
        				keyboard: true
    					})
				}
				if(reps.status==2){
					$('#myModal2').find('.modal-body').html('商品成功添加到购物车！');
					$('#myModal2').modal({
        				keyboard: true
    					})
				}
				if(reps.status==-100){
					$('#myModal2').find('.modal-body').css('color','red');
					$('#myModal2').find('.modal-body').html(reps.mess);
					$('#myModal2').modal({
        				keyboard: true
    					})
				}
				if(reps.status==-1){
					$('#myModal').modal({
        				keyboard: true
    					})
				}
			}
		});
	}
	
	//模态框登入界面的提交登入按钮
	$('#modal-submit').click(function(){
		if($('#uname').val().length==0){			
			valid1=false;
		}else{
			$('#modal-body-uname-error').html('');
			valid1=true;
		}
		
		if($('#pwd').val().length==0){
			valid2=false;
		}else{
			$('#modal-body-pwd-error').html('');
			valid2=true;
		}
		
		if(valid1&&valid2){
			$data=$('#ajaxform').serialize();
				if(validateInput()) {
				$.ajax({
					type:"post",
					url:"http://localhost/ShopProject/public/home/ajaxvalidlogin",
					async:true,
					data:$data,
					success:function(resp){
						if(resp.staus==-1){
							$('#modal-body-error').html('密码或者账号错误！');
						}
						if(resp.staus==1){
							window.location.href="http://localhost/ShopProject/public/home/goodsinfo/"+gid;
							//successs(resp.data);
						}
					}
				});
			}else{
				$('#modal-body-error').html('密码或者账号错误!');
			}
		}else{
				$('#modal-body-error').html('密码或者账号不为空!');
			}
		
	})
	
	function validateInput(){
		var pass=true;
		var uname=$('#uname').val();
		var pwd=$('#pwd').val();
		var reguname=/^[A-Za-z0-9_@\.]{6,17}$/;
		var regpws=/^[A-Za-z0-9_]{6,17}$/;
		if(!reguname.test(uname)){
			return pass=false;
		}
		if(!reguname.test(pwd)){
			return pass=false;
		}
		return true;
	}
	
	//删除购物车商品信息
	$('.remove').click(removeCartItem);
	function removeCartItem(e){
		//$(e.target).parent().find(':hidden').val();
		var gid=$(e.target).parents('tr').find('td').eq(0).find(':hidden').val();
		//console.log(gid);
		$(e.target).parents('tr').remove();
		var carcount=$('#carts').find('.red').html();
		var carcount1=$('.cart-sum').find('.red').html();
		$('#carts').find('.red').html(--carcount);
		$('.cart-sum').find('.red').html(--carcount1);
		$.ajax({
			type:"get",
			url:"http://localhost/ShopProject/public/home/ajaxDelete",
			async:true,
			data:{
				gid:gid
			},
			success:function(reps){
				if(reps.status==1){
					console.log('删除成功！');
				}else{
					console.log(reps);
				}
			}
		});
	}
	
	//购买商品按钮到提交订单界面
	$('#goodspay').click(function(){
		var gid=$('#ginfogid').val();ginfocount
		var newnum=$('#ginfocount').val();
		$(this).attr('disabled','disabled');
		$.ajax({
			type:"get",
			url:"http://localhost/ShopProject/public/home/cart/kucun",
			async:true,
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			},
			data:{
				data:gid+'_'+newnum
			},
			success:function(resp){
				//console.log(resp)
				if(resp.status==1){
					window.location.href="http://localhost/ShopProject/public/home/order/gshow?"+gid+'='+newnum;
				}
				if(resp.status==-1){
					$('#myModal2').find('.modal-body').css('color','red');
					$('#myModal2').find('.modal-body').html('购物车里商品名为：'+resp.mess+'  库存不足');
					$('#goodspay').removeAttr("disabled");
					$('#myModal2').modal({
        				keyboard: true
    					})
				}
			}
		});
		
	})
})
