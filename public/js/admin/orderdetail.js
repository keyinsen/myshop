$(function(){
	var numreg = /^\d+$/;
	var discountreg=/^1$|(0\.[1-9]{1})$/;
	var pricereg=/^\d+(\.[0-9]{1,2})?$/
	var oid=$('#oid').val();
	$('.editorder').click(function(){
		var num=$(this).parent().find('.num').val();
		var price=$(this).parent().find('.price').val();
		var discount=$(this).parent().find('.discount').val();
		var gid=$(this).parent().find('.gid').val();
		//console.log(num);
		if(!numreg.test(num)){
			$(this).parent().find('.error').html('输入的商品数量要为整数');
			return false;
		}else{
			$(this).parent().find('.error').html('');
		}
		
		if(!pricereg.test(price)){
			$(this).parent().find('.error').html('输入的价格不符合格式');
			return false;
		}else{
			$(this).parent().find('.error').html('');
		}
		
		if(!discountreg.test(discount)){
			$(this).parent().find('.error').html('输入的商品折扣只能是0.1到1之间');
			return false;
		}else{
			$(this).parent().find('.error').html('');
		}
		$(this).attr('disabled','disabled');
		$.ajax({
			type:"get",
			url:"ajaxupdate",
			data:{
				oid:oid,
				gid:gid,
				num:num,
				price:price,
				discount:discount
			},
			async:true,
			success:function(resp){
				if(resp.status==1){
					window.location.reload();
				}
			}
		});
	})
	
	
})
