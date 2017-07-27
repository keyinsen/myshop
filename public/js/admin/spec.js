$(function(){
	var removeid='';
	//添加类别的类别名称不能为空！
 $('#spec_submit').click(function(){
 	
 	if($('#specname').val().length==0){
 		$('.specnameer').html('规格名称不能为空！');
 		$(this).removeAttr('disabled','disabled');
 		return false;
 	}
 	$(this).attr('disabled','disabled');
 	$('#specs-cancel').attr('disabled','disabled');
 	$('#spec_reset').attr('disabled','disabled');
 	$('#spec_form').submit();
 })
 
 //点击取消修改的时候刷新页面
	$('#specs-cancel').click(function(){
		window.location.href="http://localhost/ShopProject/public/admin/sepc";
	})
 
 //删除
	$('.caremove').click(function(){
		removeid=$(this).parent().parent().find('.attr_id').html();
		$('#SpecModal').modal({
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
	$('#spec_succ').click(function(){
		
		$.ajax({
			type:"post",
			url:"http://localhost/ShopProject/public/admin/spec/del",
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
				window.location.href="http://localhost/ShopProject/public/admin/spec";
				
			}
		});
	})
	
	$('.allremove').click(function(){
		var isture=true;
		for(var i=0;i<$('.ischeckbox').length;i++){
			if($('.ischeckbox').eq(i).is(':checked')){
				
				if(isture){
					removeid+=$('.ischeckbox').eq(i).parent().parent().find('.attr_id').html();
					isture=false;
				}else{
					removeid+='_'+$('.ischeckbox').eq(i).parent().parent().find('.attr_id').html();
				}
			}
		}
		
		//如果筛选删除的时候没有选中任何管理员信息，判断执行
	 if(removeid.length==0){
	 	$('#SpecfailModal').modal({
        				keyboard: true
    					})
	 	}else{
	 		$('#SpecModal').modal({
        				keyboard: true
    					})
	 	}
		
	})
	
	$('#spec_cancel').click(function(){
		removeid='';
	})
})
