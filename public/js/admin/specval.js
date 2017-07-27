$(function(){
	var removeid='';
	//在添加规格中，获取页面刚刷新后的第一个默认选中的类别对应的规格
	var addcid=$('#addcid').find('option:selected').val();
	var editid=$('#editcid').find('option:selected').val();
	
	//添加
	if(addcid){
		$.ajax({
			type:"get",
			url:"http://localhost/ShopProject/public/admin/category/ajaxCate",
			async:true,
			data:{addcid:addcid},
			success:function(resp){
			if(resp.status==1){
				addSpec(resp.attrname);
			}else{
				alert('此类别没有规格');
				//console.log();
			}
			}
		});
	}
	
	//找到对应类的规格进行动态添加
	function addSpec(data){
		$('#attr_id').empty();
		for (var i=0 ; i<data.length;i++) {
			
			$('#attr_id').append($('<option>').attr('value',data[i].attr_id).html(data[i].title));
		}
	}
	
	
	//在添加规格参数信息中，需要运用ajax来进行选择类别对应的规格
	if(editid){
		$.ajax({
			type:"get",
			url:"http://localhost/ShopProject/public/admin/category/ajaxCate",
			async:true,
			data:{addcid:addcid},
			success:function(resp){
			if(resp.status==1){
				addSpec(resp.attrname);
			}else{
				//$('#attr_id').empty();
				alert('没有此类别的规格');
			}
			}
		});
	}
	
	//找到对应类的规格进行动态添加
	function addSpec(data){
		$('#attr_id').empty();
		for (var i=0 ; i<data.length;i++) {
			
			$('#attr_id').append($('<option>').attr('value',data[i].attr_id).html(data[i].title));
		}
	}
	
	//选择类别 ajax 加载不同的类
	$('#addcid').change(function(){
		addcid=$(this).find('option:selected').val();
		$.ajax({
			type:"get",
			url:"http://localhost/ShopProject/public/admin/category/ajaxCate",
			async:true,
			data:{addcid:addcid},
			success:function(resp){
			if(resp.status==1){
				addSpec(resp.attrname);
			}else{
				$('#attr_id').empty();
				alert('没有此类别的规格');
			}
			}
		});
	})
	
	
	//添加类别的类别名称不能为空！
 $('#spec_submit').click(function(){
 	
 	if($('#specname').val().length==0){
 		$('.specnameer').html('规格名称不能为空！');
 		return false;
 	}
 	
 	$('#spec_submit').attr('disabled','disabled');
 	$('#specs-cancel').attr('disabled','disabled');
 	$('#specval_form').submit();
 })
 
 
 $('#cid').change(function(){
 	
 })
 
 //点击取消修改的时候刷新页面
	$('#specs-cancel').click(function(){
		window.location.href="http://localhost/ShopProject/public/admin/sepcval";
	})
 
 //删除
	$('.caremove').click(function(){
		removeid=$(this).parent().parent().find('.avid').html();
		$('#SpecvalModal').modal({
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
	$('#specval_succ').click(function(){
		
		$.ajax({
			type:"post",
			url:"http://localhost/ShopProject/public/admin/specval/del",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			},
			async:true,
			data:{
				removeid:removeid
			},
			success:function(resp){
				if(resp.status==1){
					window.location.href="http://localhost/ShopProject/public/admin/specval";
				}
				if(resp.status==-1){
					alert('所要删除的规格值不存在或者发生错误');
					window.location.href="http://localhost/ShopProject/public/admin/specval";
				}
				if(resp.status==-2){
					alert('所要删除的商品规格值不存在或者发生错误');
					window.location.href="http://localhost/ShopProject/public/admin/specval";
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
					removeid+=$('.ischeckbox').eq(i).parent().parent().find('.avid').html();
					isture=false;
				}else{
					removeid+='_'+$('.ischeckbox').eq(i).parent().parent().find('.avid').html();
				}
			}
		}
		
		//如果筛选删除的时候没有选中任何管理员信息，判断执行
	 if(removeid.length==0){
	 	$('#SpecvalfailModal').modal({
        				keyboard: true
    					})
	 	}else{
	 		$('#SpecvalModal').modal({
        				keyboard: true
    					})
	 	}
		
	})
	
	$('#spec_cancel').click(function(){
		removeid='';
	})
})
