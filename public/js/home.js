$(function(){
	var valid1=false;
	var valid2=false;
	var islogin=false;
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
		$(e.target).attr('disabled','disabled');
		var gid=$(e.target).parent().parent().find('input:hidden').val();
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
							window.location.href="http://localhost/ShopProject/public/home/index";
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
	
	function successs($data){
		//console.log($data[0].uname);
		$('.head-left').find('.glyphicon').remove();
		$('.head-left').find('#is_regster').remove();
		$('.head-left').find('#is_login').remove();
		$('.head-left').prepend('<a href="http://localhost/ShopProject/public/home/outLogin">退出</a>');
		$('.head-left').prepend('<span>会员，欢迎进入商城!</span>');
		$('.head-left').prepend('<a href="http://localhost/ShopProject/public/home/uperinfo/'+$data[0].uid+'">'+$data[0].uname+'</a>');
		$('.head-left').prepend('<span>你好,</span>');
		$('#message').prepend('<span class="glyphicon glyphicon-envelope"></span>');
		//$('#myModal').removeClass('fade');
		$('#myModal').modal('hide');
		

	}
	
	$('#uname').blur(function(){
		if($('#uname').val().length==0){
			$('#modal-body-uname-error').html('账号不能为空');
		}else{
			$('#modal-body-uname-error').html('');
		}
	})
	
	$('#pwd').blur(function(){
		if($('#pwd').val().length==0){
			$('#modal-body-pwd-error').html('密码不能为空');
		}else{
			$('#modal-body-pwd-error').html('');
		}
	})
	
	$('#pwd').focus(function(){
		$('#modal-body-error').html('');
	})
	
	$('#uname').focus(function(){
		$('#modal-body-error').html('');
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
	
	
	//点击添加购物车事件是否判断是否登入，再进行添加到购物车
	$('.cart').click(function(e){
		//console.log('a');
		addCart(e);
//		if(!islogin){
//		$.ajax({
//			type:"get",
//			url:"http://localhost/ShopProject/public/home/valogin",
//			async:true,
//			success:function(reps){
//				if(reps.status==1){
//					islogin=true;
//					$(this).attr('disabled','disabled');
//					
//					addCart(e);
//				}else{
//					$('#myModal').modal({
//        				keyboard: true
//    					})
//				}
//			}
//		});
//		}else{
//			$(this).attr('disabled','disabled');
//			addCart(e);
//		}
	})
	
	//添加商品到购物车
	function addCart(e){
		//添加的商品信息是否在主页界面显示
		var is_cart=true;
		var carcount=$('#carts').find('.red').html();
		var carcount1=$('.cart-sum').find('.red').html();
		var gid=$(e.target).parent().find(':hidden').val();
		var gname=$(e.target).parent().find('.a-img').find('.font1').html();
		var img_path=$(e.target).parent().find('.a-img').find('img').attr('src');
		var price=$(e.target).parent().find('.font3').find('span').html();
		var discount=($(e.target).parent().find('.font5').find('span').html())/price;
		//console.log(discount);
		var tr=$('#carttable').find('tr');
		//console.log(tr);
//			if(tr.length==0){
//				$('.shop').append($('<table>').attr('id','carttable'));
//				$('.emptys').css('display','none');
//				$('.cart-sum').css('display','block');
//				$('.shop-cart').css('display','block');
//			}
			for(var i=0;i<tr.length;i++){
				if(tr.eq(i).find('td').eq(0).find(':hidden').val()==gid){
					var count=tr.eq(i).find('td').eq(4).find('span').html();
					tr.eq(i).find('td').eq(4).find('span').html('');
					if(parseInt(count)+1<20){
					tr.eq(i).find('td').eq(4).find('span').html(parseInt(count)+1);
					}else{
						tr.eq(i).find('td').eq(4).find('span').html(parseInt(count));
					}
					is_cart=false;
					
				}
			}
				if((tr.length<5)&&is_cart){
				
					var tr=$('<tr>');
					var addgidtd=$('<td>').append($('<input>').prop('value',gid).prop('type','hidden'));
					var addimgtd=$('<td>').append($('<img>').prop('src',img_path));
					
					var addgnametd=$('<td>').html(gname.length > 6 ? gname.substring(0,8) + '...' : gname);
					//var addpricetd=$('<td>').html('￥'+price);
					var addpricetd=$('<td>').html('￥'+price*discount);
					var addnumtd=$('<td>').html('X').append($('<span>').html('1'));
					var addremotd=$('<td>').append($('<a>').prop('href','javascript:void(0);').addClass('remove').html('删除').click(removeCartItem));
					tr.append(addgidtd);
					tr.append(addimgtd);
					tr.append(addgnametd);
					tr.append(addpricetd);
					tr.append(addnumtd);
					tr.append(addremotd);
					$('#carttable').prepend(tr);
					$('#carts').find('.red').html(++carcount);
					$('.cart-sum').find('.red').html(++carcount1);
				
		}
			
		//$('#myModal2').modal('show');
		//console.log('aa');
		$.ajax({
			type:"get",
			url:"http://localhost/ShopProject/public/home/ajaxAddGoods",
			async:true,
			data:{
				gid:gid,
				gname:gname,
				img_path:img_path,
				price:price,
				discount:discount
			},
			success:function(reps){
				if(reps.status==1){
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
					$('#myModal2').find('.modal-body').css('color','green');
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
	

	
	//删除购物车商品信息
	$('.remove').click(removeCartItem);
	function removeCartItem(e){
		//$(e.target).parent().find(':hidden').val();
		var gid=$(e.target).parents('tr').find('td').eq(0).find(':hidden').val();
		console.log(gid);
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
});
