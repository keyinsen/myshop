$(function(){
	var unamereg=/^[A-Za-z0-9_]{6,13}$/;
	var nickreg=/^[A-Za-z0-9_\-\u4e00-\u9fa5]{2,10}$/;
	var pwdreg=/^[A-Za-z0-9_]{6,17}$/;
	var agereg=/^[1-9]{1}[0-9]{0,2}$/
	var meailreg=/\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}/;
	var telreg=/0?(13|14|15|18)[0-9]{9}/;
	var removeid='';

	//昵称
	$('#usnickname').blur(function(){
		if($(this).val().length==0){
			$('#user-nicker').html('用户昵称不能放空！');
			return;
		}else{
			$('#user-nicker').html('');
			
		}
		if(!nickreg.test($(this).val())){
			$('#user-nicker').html('昵称不能有特殊字符,必须为2位到10位');
			return;
		}else{
			$('#user-nicker').html('');
		
		}
		})
	$('#uage').blur(function(){
		if($(this).val().length!=0){
			if(!agereg.test($(this).val())){
			$('#user-ageer').html('年龄格式错误');
				return;
			}else{
				$('#user-ageer').html('');
			
			}
			if(parseInt($(this).val())>125){
				$('#user-ageer').html('超出正常年龄范围');
				return;
			}else{
				$('#user-ageer').html('');
			}
		}else{
			$('#user-ageer').html('');
		}
		
		})
	
		//账户
		$('#usuname').blur(function(){
		if($(this).val().length==0){
			$('#user-nameer').html('账号不能放空！');
			return;
		}else{
			$('#user-nameer').html('');
			
		}
		
		if(!unamereg.test($(this).val())){
			$('#user-nameer').html('账号长度只能是6位到13位之间,只能包含数字、字母和下划线');
			return;
		}else{
			$('#user-nameer').html('');
		
		}
	})
		
		//密码
		$('#uspwd').blur(function(){
		
		if($(this).val().length==0){
			$('#user-pwder').html('密码不能放空！');
			return;
		}else{
			$('#user-pwder').html('');
		
		}
		if(!pwdreg.test($(this).val())){
			$('#user-pwder').html('密码由数组、字母组成,6到17位');
			return;
		}else{
			$('#user-pwder').html('');
		
		}
	})
	
	//确认密码
	$('#uspwds').blur(function(){
		
		if($(this).val()!=$('#uspwd').val()){
			$('#user-pwdser').html('确认密码与重复密码不一致！');
			return;
		}else{
			$('#user-pwdser').html('');
		}
		
	})
	
	
	//邮箱
		$('#email').blur(function(){
		if($(this).val().length!=0){
			if(!meailreg.test($(this).val())){
			$('#user-emailer').html('邮箱格式错误');
			return;
		}else{
			$('#user-emailer').html('');
		
		}
		}else{
			$('#user-emailer').html('');
		}
		
	})
		
		//手机号码
		$('#tel').blur(function(){
		if($(this).val().length!=0){
			if(!telreg.test($(this).val())){
			$('#user-teler').html('手机号码格式错误');
			return;
		}else{
			$('#user-teler').html('');
		
		}
		}else{
			$('#user-teler').html('');
		}
		
	})
	
	//新增用户基本信息
	$('#user-submit').click(function(){
		if($('#usnickname').val().length==0){
			$('#user-nicker').html('昵称不能放空！');
			return;
		}else{
			$('#user-nicker').html('');
		
		}
		if(!nickreg.test($('#usnickname').val())){
			$('#user-nicker').html('昵称不能有特殊字符,必须为2位到8位');
			return;
		}else{
			$('#user-nicker').html('');
		
		}
		
		if($('#uage').val().length!=0){
			if(!nickreg.test($('#uage').val())){
			$('#user-ageer').html('正常年龄格式错误');
				return;
			}else{
				$('#user-ageer').html('');
			
			}
			if(parseInt($('#uage').val())>125){
				$('#user-ageer').html('超出正常年龄范围');
				return;
			}else{
				$('#user-ageer').html('');
			}
		}
		
		if($('#usuname').val().length==0){
			$('#user-nameer').html('账号不能放空！');
			return;
		}else{
			$('#user-nameer').html('');
			
		}
		if(!unamereg.test($('#usuname').val())){
			$('#user-nameer').html('账号长度只能是6位到13位之间,只能包含数字、字母和下划线');
			return;
		}else{
			$('#user-nameer').html('');
		
		}
		
		
		
		
		if($('#uspwd').val().length==0){
			$('#user-pwder').html('密码不能放空！');
			return;
		}else{
			$('#user-pwder').html('');
		
		}
		if(!pwdreg.test($('#uspwd').val())){
			$('#user-pwder').html('密码由数组、字母组成,6到17位');
			return;
		}else{
			$('#user-pwder').html('');
		
		}
		
		
		if($('#uspwd').val()!=$('#uspwds').val()){
			$('#user-pwdser').html('确认密码与重复密码不一致！');
			return;
		}else{
			$('#user-pwdser').html('');
		}
				
		if($('#email').val().length!=0){
			if(!meailreg.test($('#email').val())){
			$('#user-emailer').html('邮箱格式错误');
			return;
		}else{
			$('#user-emailer').html('');
		
		}
		}
		
		if($("#tel").val().length!=0){
			if(!telreg.test($("#tel").val())){
			$('#user-teler').html('手机号码格式错误');
			return;
		}else{
			$('#user-teler').html('');
		
		}
		}
		$(this).attr('disabled','true');
		$('#user-cancels').attr('disabled','true');
		$('#user-cancel').attr('disabled','true');
		$('#us_form').submit();
		
	})
	
	
	//删除
	$('.usremove').click(function(){
		removeid=$(this).parent().parent().find('.uid').html();
		$('#UserModal').modal({
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
	$('#user_succ').click(function(){
		$(this).attr('disabled','true');
		$('#user_cancel').attr('disabled','true');
		$.ajax({
			type:"post",
			url:"http://localhost/ShopProject/public/admin/user/del",
			async:true,
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			},
			data:{
				removeid:removeid
			},
			success:function(resp){
				if(resp.status==1){
					
					window.location.href="http://localhost/ShopProject/public/admin/user";
				}
				removeid='';
			}
		});
	})
	
	
	//筛选删除
	$('.allremove').click(function(){
		var isture=true;
		for(var i=0;i<$('.ischeckbox').length;i++){
			if($('.ischeckbox').eq(i).is(':checked')){
				
				if(isture){
					removeid+=$('.ischeckbox').eq(i).parent().parent().find('.uid').html();
					isture=false;
				}else{
					removeid+='_'+$('.ischeckbox').eq(i).parent().parent().find('.uid').html();
				}
			}
		}
		
		//如果筛选删除的时候没有选中任何管理员信息，判断执行
	 if(removeid.length==0){
	 	$('#UserfailModal').modal({
        				keyboard: true
    					})
	 	}else{
	 		$('#UserModal').modal({
        				keyboard: true
    					})
	 	}
		
	})
	
	//取消之后 清除之前选择的用户id
	$('#user_cancel').click(function(){
		removeid='';
	})
	

})
