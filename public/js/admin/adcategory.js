$(function(){
 
 
 //添加类别的类别名称不能为空！
 $('#cate_submit').click(function(){
 	
 	if($('#category-zname').val().length==0){
 		$('#cateerror').html('子类别名称不能为空！');
 		//$(this).removeAttr('disabled','disabled');
 		return false;
 	}
 	
 	var value=$('#parentcate').find('option:selected').val();
 	if(parseInt(value)==0){
 		if($('#category-name').val().length==0){
 			$('#cateerror').html('顶级类别名称不能为空！');
 			//$(this).removeAttr('disabled','disabled');
 			return false;
 		}
 	}
 	$(this).attr('disabled','disabled');
 	$('#cate_form').submit();
 })
 
 $('#parentcate').change(function(){
 	var value=$(this).find('option:selected').val();
 	if(parseInt(value)==0){
 		$('.ding').css('display','block');
 	}else{
 		$('.ding').css('display','none');
 	}
 })
 
 
 //删除
	$('.caremove').click(function(){
		removeid=$(this).parent().parent().find('.cid').html();
		$('#CateModal').modal({
        				keyboard: true
    					})
	})
	
	
	//执行删除
	$('#cate_succ').click(function(){
		
		$.ajax({
			type:"get",
			url:"http://localhost/ShopProject/public/admin/category/del",
			async:true,
			data:{
				removeid:removeid
			},
			success:function(resp){
				if(resp.status!=1){
					alert(resp.mess);
					
				}
				removeid='';
				window.location.href="http://localhost/ShopProject/public/admin/category";
				
			}
		});
	})
	
	$('#cate_cancel').click(function(){
		removeid='';
	})
	
	$('#cate_cancels').click(function(){
		window.location.href="http://localhost/ShopProject/public/admin/category";
	})
	
})
