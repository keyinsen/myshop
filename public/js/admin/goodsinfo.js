$(function(){
	var removeid='';
  $('.shelves').click(function(){
  	var gid=$(this).parent().parent().find('.gid').html();
  	//console.log(gid);
  	$.ajax({
  		type:"get",
  		url:"http://localhost/ShopProject/public/admin/goods/shelves",
  		data:{
  			gid:gid
  		},
  		async:true,
  		success:function(resp){
  			if(resp.status==1){
  				$('#shelvesModal').modal({
        				keyboard: true
    					})
  				
  			}
  		}
  	});
  })
  
  $('#shelves_succ').click(function(){
  	window.location.href='http://localhost/ShopProject/public/admin/goods';
  });
  
  //删除
	$('.goodsmove').click(function(){
		removeid=$(this).parent().parent().find('.gid').html();
		$('#GoodsModal').modal({
        				keyboard: true
    					})
	})
	
	
	//筛选删除
	$('.allcheckbox').click(function(){
		if($(this).is(':checked')){
			$('.ischeckbox').prop('checked','checked');
			
		}else{
			$('.ischeckbox').removeAttr('checked');
		}
		
	})
	
	$('.ischeckbox').click(function(){
		$('.allcheckbox').removeAttr('checked');
	})
	
	
	//执行删除
	$('#goods_succ').click(function(){
		
		$.ajax({
			type:"post",
			url:"http://localhost/ShopProject/public/admin/goods/del",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			},
			async:true,
			data:{
				removeid:removeid
			},
			success:function(resp){
				if(resp.status!=1){
					alert(resp.mess);
				}
				window.location.href="http://localhost/ShopProject/public/admin/goods";
				
			}
		});
	})
	
	$('.allremove').click(function(){
		var isture=true;
		for(var i=0;i<$('.ischeckbox').length;i++){
			if($('.ischeckbox').eq(i).is(':checked')){
				
				if(isture){
					removeid+=$('.ischeckbox').eq(i).parent().parent().find('.gid').html();
					isture=false;
				}else{
					removeid+='_'+$('.ischeckbox').eq(i).parent().parent().find('.gid').html();
				}
			}
		}
		
		//如果筛选删除的时候没有选中任何管理员信息，判断执行
	 if(removeid.length==0){
	 	$('#GoodsfailModal').modal({
        				keyboard: true
    					})
	 	}else{
	 		$('#GoodsModal').modal({
        				keyboard: true
    					})
	 	}
		
	})
	
	$('#goods_cancel').click(function(){
		removeid='';
	})
  
})
