$(function(){
	$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
});
	var is_pass=true;
	var nicknamereg=/^[\u4E00-\u9FA5A-Za-z0-9_]+$/;
	var emailreg=/\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}/;
	var telreg=/0?(13|14|15|18)[0-9]{9}/;
	var birth='';
	//出生年月
	/*
     * 生成级联菜单
     */
    var i=1945;
    var date = new Date();
    year = date.getFullYear();//获取当前年份
    var dropList;
    for(i;i<2010;i++){
        if(i == year){
            dropList = dropList + "<option value='"+i+"' selected>"+i+"</option>";
        }else{
            dropList = dropList + "<option value='"+i+"'>"+i+"</option>";
        }
    }
    
    $('select[name=year]').append(dropList);//生成年份下拉菜单
    var monthly;
    for(month=1;month<13;month++){
        monthly = monthly + "<option value='"+month+"'>"+month+"</option>";
    }
    $('select[name=month]').append(monthly);//生成月份下拉菜单
    var dayly;
    for(day=1;day<=31;day++){
        dayly = dayly + "<option value='"+day+"'>"+day+"</option>";
    }
    $('select[name=day]').append(dayly);//生成天数下拉菜单
    /*
     * 处理每个月有多少天---联动
     */
    $('select[name=month]').change(function(){
        var currentDay;
        var Flag = $('select[name=year]').val();
        var currentMonth = $('select[name=month]').val();
        switch(currentMonth){
            case "1" :
            case "3" :
            case "5" :
            case "7" :
            case "8" :
            case "10" :
            case "12" :total = 31;break;
            case "4" :
            case "6" :
            case "9" :
            case "11" :total = 30;break;
            case "2" :
                if((Flag%4 == 0 && Flag%100 != 0) || Flag%400 == 0){
                    total = 29;
                }else{
                    total = 28;
                }
            default:break;
        }
        for(day=1;day <= total;day++){
            currentDay = currentDay + "<option value='"+day+"'>"+day+"</option>";
        }
        $('select[name=day]').append(currentDay);//生成日期下拉菜单
        })
    
    //出生年月---------------------------------------------------
	
var options = {
            success:       showResponse,
            dataType: 'json'
        };	
	//上传图片
	$('#btn-touxiang').click(function(){
		$('#picpath').click();
		//$('.img').click();
		
	})
	$('#picpath').change(function(){
		 $('#uploads').ajaxForm(options).submit();
 });
 
 
 function showResponse(response)  {
        if(response.success == false)
        {
alert('图片上传发送错误');
        } else {
           // console.log(response.status);
            $('#uinfo_img').attr('src','http://localhost/ShopProject/public/img/dataimg/'+response.img);
			$('#upimg').attr('value','http://localhost/ShopProject/public/img/dataimg/'+response.img);
        } 
        }
 
 //用户信息保存
 
$('#uinfo_submit').click(function(){
	//console.log($('#nickname').val().length!=0);
	var is_email=true;
	var is_nickname=true;
	var is_tel=true;
	if($('#nickname').val().length!=0){
		if(!nicknamereg.test($('#nickname').val())){
			$('#nickerror').html('昵称只能是汉子、数字、英文、下划线组成！');
			is_email=false;
		}else{
			$('#nickerror').html('');
			is_email=true;
		}
		if($('#nickname').val().length>15){
			$('#nickerror').html('昵称长度小于15个字符');
			is_email=false;
		}else{
			$('#nickerror').html('');
			is_email=true;
		}
	}
	if($('#email').val().length!=0){
		if(!emailreg.test($('#email').val())){
			$('#emailerror').html('邮箱格式错误！');
			is_nickname=false;
		}else{
			$('#emailerror').html('');
			is_nickname=true;
		}
	}
	if($('#tel').val().length!=0){
		
		if(!telreg.test($('#tel').val())){
			$('#telerror').html('手机号码格式错误！');
			is_tel=false;
		}else{
			$('#telerror').html('');
			is_tel=true;
		}
	}
	
	if($('#year option:selected').val()==0||$('#month option:selected').val()==0||$('#day option:selected').val()==0){
		birth='';
	}else{
		birth=$('#year option:selected').val()+'-'+$('#month option:selected').val()+'-'+$('#day option:selected').val();
	}
	//console.log(birth);
	//console.log($('#year option:selected').val());
	if(is_email&&is_nickname&&is_tel){
		var nickname=$('#nickname').val();
		var email=$('#email').val();
		var tel=$('#tel').val();
		var memo=$('#memo').val();
		var gender=parseInt($('input[name="gender"]:checked').val());
		var image=$('#uinfo_img').attr('src');
		var age=$('#age').val();
		//console.log(image);
		$.ajax({
			type:"get",
			url:"http://localhost/ShopProject/public/home/editinfo",
			async:true,
			data:{
				nickname:nickname,
				email:email,
				tel:tel,
				memo:memo,
				gender:gender,
				image:image,
				birth:birth,
				age:age
			},
			success:function(resp){
				if(resp.status==1){
					 $('#uinfoModal').modal({
        				keyboard: true
    					})
				}else{
					alert('修改失败！');
				}
			}
		});
	}
});

$('#info_succ').click(function(){
	window.location.href='http://localhost/ShopProject/public/home/uperinfo';
})
 
})
