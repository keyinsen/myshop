$(function(){
	//var textreg=/[A-Za-z0-9_\-\u4e00-\u9fa5]{5,100}/;
	var array1={};
		
	$('#evaluate_st').click(function(){
		var gid=$('.goodsdetail').find('.gid');
		var texts=$('.goodsdetail').find('.text')
//		//var radios=$('.goodsdetail').find('.radio');
//		console.log(gid.length)
//		
		for(var i=0 ;i<gid.length;i++){
			var array2={};
			//console.log(gid.eq(i).val())
			if((texts.eq(i).val().length<5)||(texts.eq(i).val().length>100)){
				$('.error').html('评价的内容在5个字到100个字！');
				array1={};
				array2={};
				return false;
			}
			//console.log(radios.eq(i).val());
			if($('.blankRadio'+gid.eq(i).val()).val().length==0){
				$('.error').html('请为商品打分！');
				array1={};
				array2={};
				return false;
			}
			
			array2['radio']=$('.blankRadio'+gid.eq(i).val()+':checked').val();
			array2['text']=texts.eq(i).val();
			array2['gid']=gid.eq(i).val();
			//console.log(array2)
			array1[i]=array2;
			//console.log(array1)
		}
		//console.log(array1);
		$(this).attr('disabled','disabled');
		$.ajax({
			type:"post",
			url:"http://localhost/ShopProject/public/home/evaluate/save",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			},
			async:true,
			data:{
				data:array1
			},
			success:function(resp){
				if(resp.status==1){
					$('#evaluateModal').modal({
        				keyboard: true
    					})
				}
			}
		});
	})
	
	$('#eva_succ').click(function(){
		window.location.href='http://localhost/ShopProject/public/home/order/index';
	})
	
	$('.cancel').click(function(){
		window.location.href='http://localhost/ShopProject/public/home/order/index';
	})
})
