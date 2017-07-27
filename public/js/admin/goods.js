$(function(){
	$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
});
	var numreg = /^\d+$/;
	var discount=/^1$|(0\.[1-9]{1})$/;
	var pricereg=/^\d+(\.[0-9]{1,2})?$/
	
	//动态加载规格
		$('#addcid').change(function(){
			var cid=$(this).find('option:selected').val();
			$.ajax({
				type:"get",
				url:"http://localhost/ShopProject/public/admin/spec/"+cid,
				async:true,
				success:function(resp){
					if(resp.status==1){
						$('#addzcid').empty();
						$('#specdiv').empty();
						var options='';
						for(var i=0;i<resp.zcate.length;i++){
							options=options+"<option  value='"+resp.zcate[i]['cid']+"'>"+resp.zcate[i]['cname']+"</option>";
						}
						$('#addzcid').append(options);
						for(var i=0;i<resp.attr.length;i++){
							var div=$('<div>').addClass('col-xs-3').addClass('kuai');
							var label=$('<label>').html(resp.attr[i]['title']+':');
							var span=$('<span>').addClass('xing').html('*');
							var select=$('<select>').attr('name',resp.attr[i]['attr_id']).addClass('form-control').addClass('spec');
							var option=$('<option>').attr('value','0').html('请选择');
							select.append(option);
							label.prepend(span);
							div.append(label).append(select);
							$('#specdiv').append(div);
						}
					}
				}
			});
			//console.log('aa');
		})
		
		$(document).on('click','.spec',function(){
			if($(this).find('option').length==1){
				var attr_id=$(this).attr('name');
				var mythis=$(this);
				$.ajax({
					type:"get",
					url:"http://localhost/ShopProject/public/admin/specval/"+attr_id,
					async:true,
					success:function(resp){
						//mythis.css('height','33px');
						//mythis.css('height','35px');
					if(resp.status==1){
						var option='';
						//mythis.empty();
						
						for(var i=0;i<resp.attrval.length;i++){
							
							option=option+"<option  value='"+resp.attrval[i]['avid']+"'>"+resp.attrval[i]['value']+"</option>";
							//option.after()
							//mythis.append(<option  value='"+resp.attrval[i]['avid']+"'>"+resp.attrval[i]['value']+"</option>);
						}
						mythis.append(option);						
					}
					}
				});
			}
		})
	//动态加载
	  //商品名称不能为空！
	  $('#goodsname').blur(function(){
	  	 if($('#goodsname').val().length==0){
	  	 	$('.gnameer').html('商品名不能为空！');
	  	 	return false;
	  	 }else{
	  	 	$('.gnameer').html('');
	  	 }
	  });
	  
	  //商品成本
	  $('#tprice').blur(function(){
	  	 if($('#tprice').val().length==0){
	  	 	$('.error').html('成本价格不能放空！');
	  	 	return false;
	  	 }else{
	  	 	$('.error').html('');
	  	 }
	  	 if(parseInt($('#tprice').val())<=0){
	  	 	$('.error').html('成本价格不能低于0');
	  	 	return false;
	  	 }else{
	  	 	$('.error').html('');
	  	 }
	  	 if(!pricereg.test($('#tprice').val())){
	  	 	$('.error').html('成本价格只能保留2位小数');
	  	 	return false;
	  	 }else{
	  	 	$('.error').html('');
	  	 }
	  	 if(parseInt($('#tprice').val())>999999){
	  	 	$('.error').html('价格过大');
	  	 	return false;
	  	 }else{
	  	 	$('.error').html('');
	  	 }
	  });
	  
	  //商品单价
	  $('#price').blur(function(){
	  	 if($('#price').val().length==0){
	  	 	$('.error').html('单价不能放空！');
	  	 	return false;
	  	 }else{
	  	 	$('.error').html('');
	  	 }
	  	 if(parseInt($('#price').val())<=0){
	  	 	$('.error').html('单价不能低于0');
	  	 	return false;
	  	 }else{
	  	 	$('.error').html('');
	  	 }
	  	 if(!pricereg.test($('#price').val())){
	  	 	$('.error').html('单价只能保留2位小数');
	  	 	return false;
	  	 }else{
	  	 	$('.error').html('');
	  	 }
	  	 if(parseInt($('#price').val())>999999){
	  	 	$('.error').html('单价过大');
	  	 	return false;
	  	 }else{
	  	 	$('.error').html('');
	  	 }
	  });
	  
	  //商品折扣
	  $('#discount').blur(function(){
	  	if($('#discount').val().length==0){
	  	 	$('.error').html('折扣不能放空！');
	  	 	return false;
	  	 }else{
	  	 	$('.error').html('');
	  	 }
	  	 if(!discount.test($('#discount').val())){
	  	 	$('.error').html('折扣必须在0.1到1之间');
	  	 	return false;
	  	 }else{
	  	 	$('.error').html('');
	  	 }
	  });
	  
	  //商品 库存
	  $('#num').blur(function(){
	  	 if($('#num').val().length==0){
	  	 	$('.error').html('库存不能放空！');
	  	 	return false;
	  	 }else{
	  	 	$('.error').html('');
	  	 }
	  	 if(parseInt($('#num').val())<=0){
	  	 	$('.error').html('库存不能低于0');
	  	 	return false;
	  	 }else{
	  	 	$('.error').html('');
	  	 }
	  });
	  
	  var options = {
            success:imgResponse,
            error:errors,
            dataType: 'json'
        };
	  // 商品图片上传--------------------------------
	  $('#imgbtn').click(function(){
	  	$('#imgpathval').click();
	  })
	  $('#imgpathval').change(function(){
	  	   $('#imgupload').ajaxForm(options).submit();
	  })
	  function errors(){
	  	$('.imgpather').html('必须是图片格式！');
	  }
	  function imgResponse(response){
	  	if(response.success == false)
        {
        } else {
            $('#img_path').attr('value',response.img);
        } 
	  }
	 // 商品图片上传--------------------------------
	 
	 // 附加详情图1--------------------------------
	 var options1 = {
            success:imgResponse1,
            error:errors1,
            dataType: 'json'
        };
	  $('#imgbtn1').click(function(){
	  	$('#imgpathval1').click();
	  })
	  $('#imgpathval1').change(function(){
	  	   $('#img1upload').ajaxForm(options1).submit();
	  })
	  function errors1(){
	  	$('.imgpather1').html('必须是图片格式！');
	  }
	  function imgResponse1(response){
	  	if(response.success == false)
        {
        } else {
            $('#img_path1').attr('value',response.img);
        } 
	  }
	 // 附加详情图1--------------------------------
	 
	 // 附加详情图2--------------------------------
	 var options2 = {
            success:imgResponse2,
            error:errors,
            dataType: 'json'
        };
	  $('#imgbtn2').click(function(){
	  	$('#imgpathval2').click();
	  })
	  $('#imgpathval2').change(function(){
	  	   $('#img2upload').ajaxForm(options2).submit();
	  })
	  function errors2(){
	  	$('.imgpather2').html('必须是图片格式！');
	  }
	  function imgResponse2(response){
	  	if(response.success == false)
        {
        } else {
            $('#img_path2').attr('value',response.img);
        } 
	  }
	 // 附加详情图2--------------------------------
	 
	 // 大图--------------------------------
	 var options3 = {
            success:imgResponse3,
            error:errors3,
            dataType: 'json'
        };
	  $('#imgbtn3').click(function(){
	  	$('#imgpathval3').click();
	  })
	  $('#imgpathval3').change(function(){
	  	   $('#img3upload').ajaxForm(options3).submit();
	  })
	  function errors3(){
	  	$('.imgpather3').html('必须是图片格式！');
	  }
	  function imgResponse3(response){
	  	if(response.success == false)
        {
        } else {
            $('#img_path3').attr('value',response.img);
        } 
	  }
	 // 大图--------------------------------
	 
	 //表单提交
	 $('#submits').click(function(){
	 	//商品名称
	 	if($('#goodsname').val().length==0){
	  	 	$('.gnameer').html('商品名不能为空！');
	  	 	$(this).removeAttr('disabled','disabled');
	  	 	return false;
	  	 }else{
	  	 	$('.gnameer').html('');
	  	 }
	  	 
	  	 //成本
	  	  if($('#tprice').val().length==0){
	  	 	$('.error').html('成本价格不能放空！');
	  	 	$(this).removeAttr('disabled','disabled');
	  	 	return false;
	  	 }else{
	  	 	$('.error').html('');
	  	 }
	  	 if(parseInt($('#tprice').val())<=0){
	  	 	$('.error').html('成本价格不能低于0');
	  	 	$(this).removeAttr('disabled','disabled');
	  	 	return false;
	  	 }else{
	  	 	$('.error').html('');
	  	 }
	  	 if(!pricereg.test($('#tprice').val())){
	  	 	$('.error').html('成本价格只能保留2位小数');
	  	 	$(this).removeAttr('disabled','disabled');
	  	 	return false;
	  	 }else{
	  	 	$('.error').html('');
	  	 }
	  	 if(parseInt($('#tprice').val())>999999){
	  	 	$('.error').html('价格过大');
	  	 	$(this).removeAttr('disabled','disabled');
	  	 	return false;
	  	 }else{
	  	 	$('.error').html('');
	  	 }
	  	 //单价
	  	 if($('#price').val().length==0){
	  	 	$('.error').html('单价不能放空！');
	  	 	$(this).removeAttr('disabled','disabled');
	  	 	return false;
	  	 }else{
	  	 	$('.error').html('');
	  	 }
	  	 if(parseInt($('#price').val())<=0){
	  	 	$('.error').html('单价不能低于0');
	  	 	$(this).removeAttr('disabled','disabled');
	  	 	return false;
	  	 }else{
	  	 	$('.error').html('');
	  	 }
	  	 if(!pricereg.test($('#price').val())){
	  	 	$('.error').html('单价只能保留2位小数');
	  	 	$(this).removeAttr('disabled','disabled');
	  	 	return false;
	  	 }else{
	  	 	$('.error').html('');
	  	 }
	  	 if(parseInt($('#price').val())>999999){
	  	 	$('.error').html('单价过大');
	  	 	$(this).removeAttr('disabled','disabled');
	  	 	return false;
	  	 }else{
	  	 	$('.error').html('');
	  	 }
	  	 //折扣
	  	 if($('#discount').val().length==0){
	  	 	$('.error').html('折扣不能放空！');
	  	 	$(this).removeAttr('disabled','disabled');
	  	 	return false;
	  	 }else{
	  	 	$('.error').html('');
	  	 }
	  	 if(!discount.test($('#discount').val())){
	  	 	$('.error').html('折扣必须在0.1到1之间');
	  	 	$(this).removeAttr('disabled','disabled');
	  	 	return false;
	  	 }else{
	  	 	$('.error').html('');
	  	 }
	  	 //库存
	  	  if($('#num').val().length==0){
	  	 	$('.error').html('库存不能放空！');
	  	 	return false;
	  	 }else{
	  	 	$('.error').html('');
	  	 }
	  	 if(parseInt($('#num').val())<=0){
	  	 	$('.error').html('库存不能低于0');
	  	 	$(this).removeAttr('disabled','disabled');
	  	 	return false;
	  	 }else{
	  	 	$('.error').html('');
	  	 }
	  	 
	  	 //图片1
	  	 if($('#img_path').val().length==0){
	  	 	$('.imgpather').html('需要上传图片！');
	  	 	$(this).removeAttr('disabled','disabled');
	  	 	return false;
	  	 }else{
	  	 	$('.imgpather').html('');
	  	 }
	  	 
	  	 //图片2
	  	 if($('#img_path1').val().length==0){
	  	 	$('.imgpather1').html('需要上传图片！');
	  	 	$(this).removeAttr('disabled','disabled');
	  	 	return false;
	  	 }else{
	  	 	$('.imgpather1').html('');
	  	 }
	  	 
	  	 for(var i=0;i<$('.spec').length;i++){
	  	 	if($('.spec').eq(i).val()==0){
	  	 		$('.specer').html('你把参数信息选填完整！');
	  	 		$(this).removeAttr('disabled','disabled');
	  	 		return false;
	  	 	}
	  	 }
	  	 
	  	 //提交
	  	 
	  	//console.log('aa');
	  	$(this).attr('disabled','true');
	  	$('#resets').attr('disabled','true');
	  	$('#editcancel').attr('disabled','true');
	  	 $('#addgoods_form').submit();
	  	 
	  	
	 })
	 
	 //修改商品信息，点击取消 回到商品信息界面
	$('#editcancel').click(function(){
		
		window.location.href="http://localhost/ShopProject/public/admin/goods";
	})
})
