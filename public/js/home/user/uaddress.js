$(function(){
	
	var asnamereg=/[A-Za-z0-9_\-\u4e00-\u9fa5]+/;
	var ascodereg=/\d{6}/;
	var astelreg=/0?(13|14|15|18)[0-9]{9}/;
	//城市下拉列表--------------------------------------------
	new PCAS('province','city','county');
//	$('#address-province').change(function(){
//		
//		if($(this).find('option:selected').val()!=0){
//			var area_id=$(this).find('option:selected').val();
//				$.ajax({
//				type:"get",
//				url:"http://localhost/ShopProject/public/home/city",
//				async:true,
//				data:{area_id:area_id},
//				success:function(resp){
//					$('#address-city').empty();
//					$('#address-city').append($('<option>').attr('value','0').html('市'));
//					for(var i=0;i<resp.city.length;i++){
//						$('#address-city').append($('<option>').attr('value',resp.city[i]['area_id']).html(resp.city[i]['arname']));
//					}
//				}
//			});
//
//			
//		}else{
//			$('#address-city').empty();
//			$('#address-city').append('<option value="0">市</option>');
//		}
//	})
//	
//	$('#address-city').change(function(){
//		
//		if($(this).find('option:selected').val()!=0){
//			var area_id=$(this).find('option:selected').val();
//				$.ajax({
//				type:"get",
//				url:"http://localhost/ShopProject/public/home/county",
//				async:true,
//				data:{area_id:area_id},
//				success:function(resp){
//					$('#address-county').empty();
//					$('#address-county').append($('<option>').attr('value','0').html('县/区'));
//					for(var i=0;i<resp.county.length;i++){
//						$('#address-county').append($('<option>').attr('value',resp.county[i]['area_id']).html(resp.county[i]['arname']));
//					}
//				}
//			});
//
//			
//		}else{
//			$('#address-county').empty();
//			$('#address-county').append('<option value="0">县/区</option>');
//		}
//	})
	//城市下拉列表--------------------------------------------
	//验证 添加或者修改地址 
	$('#address_submit').click(function(){
		if($('#address-name').val().length==0){
			$('.as_nameerror').html('收货人姓名不能为空！');
			return false
		}else{
			$('.as_nameerror').html('');
			
		}
		
		if(!asnamereg.test($('#address-name').val())){
			$('.as_nameerror').html('收货人姓名不合法');
			return false
		}else{
			$('.as_nameerror').html('');
			
		}
		
		if($('#address-detail').val().length==0){
			$('.as_detailerror').html('详细地址不能放空！');
			return false
		}else{
			$('.as_detailerror').html('');
			
		}
		
		if($('#address-province option:selected').val().length==0||$('#address-city option:selected').val().length==0||$('#address-county option:selected').val().length==0){
			$('.as_listerror').html('请完整的选择地区！');
			return false
		}else{
			
			$('.as_listerror').html('');
		}
		
		if($('#address-code').val().length==0){
			
			$('.as_codeerror').html('邮政编码不能放空！');
			return false
		}else{
			
			$('.as_codeerror').html('');
		}
		
		if(!ascodereg.test($('#address-code').val())){
			
			$('.as_codeerror').html('邮政编码格式错误！');
			return false
		}else{
			
			$('.as_codeerror').html('');
		}
		
		if(!astelreg.test($('#address-tel').val())){
			
			$('.as_telerror').html('手机号码格式错误！');
			return false
		}else{
			$('.as_telerror').html('');
		}
		if($('.address-table').find('table').find('tbody').find('tr').length-1>10){
			$('.as_telerror').html('你添加的地址信息已超过10条不能添加');
			return false
		}else{
			$('.as_telerror').html('');
		}
		
		
		$(this).attr('disabled','disabled');
		$('#address_cancel').attr('disabled','disabled');
		$('#address_form').submit();
	})
	
	var rec_id='';
	//删除收货地址
	$('.addressdel').click(function(){
		 rec_id=$(this).parent().parent().find('td').find(":hidden").val();
		$('#MyaddressModal').modal({
        				keyboard: true
    					})
	})
	
	$('#address_succ').click(function(){
		
		$.ajax({
			type:"get",
			url:"http://localhost/ShopProject/public/home/delAddress",
			data:{rec_id:rec_id},
			async:true,
			success:function(resp){
				//console.log(resp.status);
				if(resp.status==1){
					
					window.location.href="http://localhost/ShopProject/public/home/address";
				}else{
					console.log('删除失败！');
				}
			}
		});
	})
	
	//console.log()
	$('#address_cancel').click(function(){
		window.location.href="http://localhost/ShopProject/public/home/address";
	})
	
})
