$(function(){
	
	var anamereg=/^[A-Za-z0-9_]{6,17}$/;
	var nickreg=/^[A-Za-z0-9_\-\u4e00-\u9fa5]{2,8}$/;
	var pwdreg=/^[A-Za-z0-9_]{6,17}$/;
	var removeid='';
	
	
	$('#admin-aname').blur(function(){
		if($(this).val().length==0){
			$('#admin-anameer').html('账号不能放空！');
			return;
		}else{
			$('#admin-anameer').html('');
			
		}
		
		if(!anamereg.test($(this).val())){
			$('#admin-anameer').html('账号长度只能是6位到16位之间,只能包含数字、字母和下划线');
			return;
		}else{
			$('#admin-anameer').html('');
		
		}
	})
	
	$('#admin-nick').blur(function(){
		
		if($(this).val().length==0){
			$('#admin-nicker').html('昵称不能放空！');
			return;
		}else{
			$('#admin-nicker').html('');
		
		}
		if(!nickreg.test($(this).val())){
			$('#admin-nicker').html('昵称不能有特殊字符,必须为2位到8位');
			return;
		}else{
			$('#admin-nicker').html('');
		
		}
	})
	
	$('#admin-pwd').blur(function(){
		
		if($(this).val().length==0){
			$('#admin-pwder').html('密码不能放空！');
			return;
		}else{
			$('#admin-pwder').html('');
		
		}
		if(!pwdreg.test($(this).val())){
			$('#admin-pwder').html('密码由数组、字母组成,6到17位');
			return;
		}else{
			$('#admin-pwder').html('');
		
		}
	})
	
	$('#admin-pwds').blur(function(){
		
		if($(this).val()!=$('#admin-pwd').val()){
			$('#admin-pwdser').html('确认密码与重复密码不一致！');
			return;
		}else{
			$('#admin-pwdser').html('');
		}
		
	})
	
	
	//点击修改 或者新增
	$('#manage-submit').click(function(){
		if($('#admin-aname').val().length==0){
			$('#admin-anameer').html('账号不能放空！');
			return;
		}else{
			$('#admin-anameer').html('');
			
		}
		if(!anamereg.test($('#admin-aname').val())){
			$('#admin-anameer').html('账号长度只能是6位到16位之间,只能包含数字、字母和下划线');
			return;
		}else{
			$('#admin-anameer').html('');
		
		}
		
		
		if($('#admin-nick').val().length==0){
			$('#admin-nicker').html('昵称不能放空！');
			return;
		}else{
			$('#admin-nicker').html('');
		
		}
		if(!nickreg.test($('#admin-nick').val())){
			$('#admin-nicker').html('昵称不能有特殊字符,必须为2位到8位');
			return;
		}else{
			$('#admin-nicker').html('');
		
		}
		
		if($('#admin-pwd').val().length==0){
			$('#admin-pwder').html('密码不能放空！');
			return;
		}else{
			$('#admin-pwder').html('');
		
		}
		if(!pwdreg.test($('#admin-pwd').val())){
			$('#admin-pwder').html('密码由数组、字母组成,6到17位');
			return;
		}else{
			$('#admin-pwder').html('');
		
		}
		
		
		if($('#admin-pwds').val()!=$('#admin-pwd').val()){
			$('#admin-pwdser').html('确认密码与重复密码不一致！');
			return;
		}else{
			$('#admin-pwdser').html('');
		}
		$(this).attr('disabled','true');
		$('#manage-form').submit();
		
	})
	
	//点击取消修改或者新增的时候刷新页面
	$('#manage-cancel').click(function(){
		window.location.href="http://localhost/ShopProject/public/admin/manage";
	})
	
	//删除
	$('.remove').click(function(){
		removeid=$(this).parent().parent().find('.admin_id').html();
		$('#ManageModal').modal({
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
	$('#manage_succ').click(function(){
		
		$(this).attr('disabled','true');
		$('#manage_cancel').attr('disabled','true');
		$.ajax({
			type:"post",
			url:"http://localhost/ShopProject/public/admin/manage/del",
			async:true,
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			},
			data:{
				removeid:removeid
			},
			success:function(resp){
				if(resp.status==1){
					window.location.href="http://localhost/ShopProject/public/admin/manage";
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
					removeid+=$('.ischeckbox').eq(i).parent().parent().find('.admin_id').html();
					isture=false;
				}else{
					removeid+='_'+$('.ischeckbox').eq(i).parent().parent().find('.admin_id').html();
				}
			}
		}
		
		//如果筛选删除的时候没有选中任何管理员信息，判断执行
	 if(removeid.length==0){
	 	$('#ManagefailModal').modal({
        				keyboard: true
    					})
	 	}else{
	 		$('#ManageModal').modal({
        				keyboard: true
    					})
	 	}
		
	})
	
	$('#manage_cancel').click(function(){
		removeid='';
	})
	
	
	
})
