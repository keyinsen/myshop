$(function(){
//点击登录的话
	$('#switch_qlogin').click(function(){

		$('#switch_login').removeClass("switch_btn_focus").addClass('switch_btn');
		$('#switch_qlogin').removeClass("switch_btn").addClass('switch_btn_focus');
		$('#switch_bottom').animate({left:'0px',width:'70px'});
		$('#qlogin').css('display','none');
		$('#web_qr_login').css('display','block');
		});

	//点击注册的话
	$('#switch_login').click(function(){
		$('#switch_login').removeClass("switch_btn").addClass('switch_btn_focus');
		$('#switch_qlogin').removeClass("switch_btn_focus").addClass('switch_btn');
		$('#switch_bottom').animate({left:'154px',width:'70px'});
		
		$('#qlogin').css('display','block');
		$('#web_qr_login').css('display','none');
		});
if(getParam("a")=='0')
{
	$('#switch_login').trigger('click');
}

	
	
function logintab(){
	scrollTo(0);
	$('#switch_qlogin').removeClass("switch_btn_focus").addClass('switch_btn');
	$('#switch_login').removeClass("switch_btn").addClass('switch_btn_focus');
	$('#switch_bottom').animate({left:'154px',width:'96px'});
	$('#qlogin').css('display','none');
	$('#web_qr_login').css('display','block');
	
}
//根据参数名获得该参数 pname等于想要的参数名 
function getParam(pname) { 
    var params = location.search.substr(1); // 获取参数 平且去掉？ 
    var ArrParam = params.split('&'); 
    if (ArrParam.length == 1) { 
        //只有一个参数的情况 
        return params.split('=')[1]; 
    } 
    else { 
         //多个参数参数的情况 
        for (var i = 0; i < ArrParam.length; i++) { 
            if (ArrParam[i].split('=')[0] == pname) { 
                return ArrParam[i].split('=')[1]; 
            } 
        } 
    } 
} 
//$url = "http://localhost/ShopProject/public/home/loginImg/";
//$url = $url+Math.ceil(Math.random()*10);
//$('#loginimg').attr('src',$url);
$('#loginimg').click(function(){
	$url = "http://localhost/ShopProject/public/home/loginImg/";
        $url = $url+Math.ceil(Math.random()*10);
	$(this).attr('src',$url);
})
$('#reginimg').click(function(){
	$url = "http://localhost/ShopProject/public/home/loginImg/";
        $url = $url+Math.ceil(Math.random()*10);
        $(this).attr('src',$url);
})
//$('#loginimg1').click(function(){
//	$url = "http://localhost/ShopProject/public/home/loginImg/";
//        $url = $url+Math.ceil(Math.random()*10);
//	$(this).attr('src',$url);
//})
var pwdmin = 6;
var regs = /^[A-Za-z0-9_]{6,17}$/;
var pwdreg = /^[A-Za-z0-9_]{6,17}$/;
var alge=true;
var passwdflag=true;
var passwdsflag=true;
	$('#user').blur(function(){
		alge=true;
		if ($('#user').val().length==0) {
			$('#unameer').html("用户名不能为空!");
			alge=false;
			return false;
		}
      	if (!regs.test($('#user').val())) {
			$('#unameer').html("用户名长度在6~16之间，只能包含数字、字母和下划线");
			alge=false;
			return false;
		}
      	if(alge){
			$('#unameer').html("<font color='green'>用户名合法</font>");
		}
      })
	
	
	$('#passwd').blur(function(){
		 passwdflag=true;
		if($('#passwd').val().length==0){
			$('#pwder').html("密码不能为空");
			passwdflag=false;
			return false;
		}
      	if(!pwdreg.test($('#passwd').val())){
			$('#pwder').html("密码长度在6~16之间，只能包含数字、字母和下划线");
			passwdflag=false;
			return false;
		}
      	if(passwdflag){
			$('#pwder').html("<font color='green'>密码格式正确！</font>");
			return false;
		}
      })
     
      $('#passwd2').blur(function(){
      	passwdsflag=true;
      	if($('#passwd2').val().length==0){
      		$('#pwdser').html("确认密码不能为空!");
			alge=false;
			return false;
      	}
      	if ($('#passwd2').val() != $('#passwd').val()) {
			$('#pwdser').html("两次密码不一致!");
			return false;
		}else{
			$('#pwdser').html("<font color='green'>两次密码一致！</font>");
			return false;
		}
      })
      
      $('#reg').click(function(){
      	if ($('#user').val().length==0) {
			$('#unameer').html("用户名不能为空!");
			alge=false;
			
		}
      	if($('#passwd').val().length==0){
			$('#pwder').html("密码不能为空");
			passwdflag=false;
			
		}
      	if($('#passwd2').val().length==0){
      		$('#pwdser').html("确认密码不能为空!");
			passwdsflag=false;
			
      	}
      	if(alge&&passwdflag&&passwdsflag){
      		$.ajax({
      			type:"post",
      			url:"validregis",
      			async:true,
      			data:$(regUser).serialize(),
      			success:function($resp){
      				if($resp.status==200){
      					alert('注册成功');
      					window.location.href=$resp.url;
      				}
      				if($resp.status==10000){
      					alert('用户名已被使用');
      					
      				}
      				if($resp.status==11000){
      					alert('验证码错误！手动刷新验证码后注册');
      					
      				}
      			}
      		});
      	}
      });
});