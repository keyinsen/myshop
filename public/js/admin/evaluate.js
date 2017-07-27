$(function(){

	var removeid='';

	
	//点击取消修改或者新增的时候刷新页面
	$('#evaluate-cancel').click(function(){
		window.location.href="http://localhost/ShopProject/public/admin/evaluate";
	})
	
	//删除
	$('.evremove').click(function(){
		removeid=$(this).parent().parent().find('.eva_id').html();
		$('#EvaluateModal').modal({
        				keyboard: true
    					})
	})
	
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
	$('#evaluate_succ').click(function(){
		
		
		$.ajax({
			type:"post",
			url:"http://localhost/ShopProject/public/admin/evaluate/del",
			async:true,
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			},
			data:{
				removeid:removeid
			},
			success:function(resp){
				if(resp.status==1){
					window.location.href="http://localhost/ShopProject/public/admin/evaluate";
				}
				removeid='';
			}
		});
	})
	
	$('.allremove').click(function(){
		var isture=true;
		for(var i=0;i<$('.ischeckbox').length;i++){
			if($('.ischeckbox').eq(i).is(':checked')){
				
				if(isture){
					removeid+=$('.ischeckbox').eq(i).parent().parent().find('.eva_id').html();
					isture=false;
				}else{
					removeid+='_'+$('.ischeckbox').eq(i).parent().parent().find('.eva_id').html();
				}
			}
		}
		
		//如果筛选删除的时候没有选中任何用户评价信息，判断执行
	 if(removeid.length==0){
	 	$('#EvaluatefailModal').modal({
        				keyboard: true
    					})
	 	}else{
	 		$('#EvaluateModal').modal({
        				keyboard: true
    					})
	 	}
		
	})
	
	$('#evaluate_cancel').click(function(){
		removeid='';
	})
	
	
	
})
