<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title>通讯商城登入注册页</title> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}"></link>
		<link rel="stylesheet" href="{{asset('css/home/login.css')}}"></link>
		<script src="{{asset('js/jquery-1.11.0.js')}}"></script>
		<script src="{{asset('js/bootstrap.js')}}"></script>
		<script src="{{asset('js/home/login.js')}}"></script>
</head>
<body style="background: #fff url({{asset('img/home/login/1.jpg')}})  no-repeat;background-size: 100% 800px;">
<h1><a href="index">通讯商城</a></h1>

<div class="login" style="margin-top:50px;">
    
    <div class="header">
        <div class="switch" id="switch"><a class="switch_btn" id="switch_qlogin" href="javascript:void(0);" tabindex="7">快速登录</a>
			<a class="switch_btn_focus" id="switch_login" href="javascript:void(0);" tabindex="8">快速注册</a><div class="switch_bottom" id="switch_bottom" style="position: absolute; width: 70px; left: 154px;"></div>
        </div>
    </div>    
  
    
    <div class="web_qr_login" id="web_qr_login" style="display: none; height: 280px;">    
            <!--登录-->
            <div class="web_login" id="web_login">
               <div class="login-box">
			<div class="login_form">
				<form action="validlogin" name="loginform" accept-charset="utf-8" id="login_form" class="loginForm" method="post">
				{{csrf_field()}}
				<input type="hidden" name="did" value="0"/>
               <input type="hidden" name="to" value="log"/>
                <div class="uinArea" id="uinArea">
                <label class="input-tips" for="u">帐号：</label>
                <div class="inputOuter" id="uArea">
                    <input type="text" id="u" name="uname" class="inputstyle"/>
                </div>
                </div>
                <div class="error">
                @if ($errors->has('uname')) 
                <span>{{$errors->get('uname')[0]}}</span>
				@endif
				</div>	
                <div class="pwdArea" id="pwdArea">
               <label class="input-tips" for="p">密码：</label> 
               <div class="inputOuter" id="pArea">
                    <input type="password" id="p" name="password" class="inputstyle"/>
                </div>
                </div>
                <div class="error">
                @if ($errors->has('password'))
                <span>{{$errors->get('password')[0]}}<span>
				@endif
				@if(!empty(session('error')))
				<span>{{session('error')}}<span>
				@endif
				</div>
               <div class="volide" id="volide">
                 <label class="input-tips" for="y" style="width: 80px;">验证码 ：</label> 
                 <input type="text" id="p" name="loginimg" class="inputstyle1"/>
                 <img class="img"  id="loginimg" src="{{URL('home/loginImg/1')}}"/>
               </div>
				<div class="error">
				<span><span>
				</div>
                <div style="padding-left:50px;margin-top:20px;"><input type="submit" value="登 录" style="width:150px;" class="button_blue"/></div>
              </form>              
           </div>
            	</div>               
            </div>
            <!--登录end-->
  </div>

  <!--注册-->
    <div class="qlogin" id="qlogin" style="display: block;height: 380px;">
   
    <div class="web_login"><form name="form2" id="regUser" accept-charset="utf-8"  method="post">
	     {{csrf_field()}}
        <ul class="reg_form" id="reg-ul">
                <li>
                	
                    <label for="user"  class="input-tips2">用户名：</label>
                    <div class="inputOuter2">
                        <input type="text" id="user" name="uname" maxlength="16" class="inputstyle2"/>
                    </div>
                    
                </li>
                <div class="error1">
                 
                <span id="unameer"></span>
			
                </div>
              
                <li>
                <label for="passwd" class="input-tips2">密码：</label>
                    <div class="inputOuter2">
                        <input type="password" id="passwd"  name="password" maxlength="15" class="inputstyle2"/>
                    </div>
                    
                </li>
                <div class="error1">
                
                <span id="pwder"></span>
			
                </div>
                <li>
                <label for="passwd2" class="input-tips2">确认密码：</label>
                    <div class="inputOuter2">
                        <input type="password" id="passwd2" name="password_confirmation" maxlength="16" class="inputstyle2" />
                    </div>
      				
                </li>
                <div class="error1">
                  
                <span class="userCue" id="pwdser"></span>
		
                </div>
                <li>
                	 <label for="passwd2" class="input-tips2">验证码：</label>
		                 <input type="text" id="p" name="p" class="inputstyle1"/>
		                 <img class="img" id="reginimg" src="{{URL('home/loginImg/1')}}"/>
                </li>
                <div class="error1">
                @if(!empty(session('error')))
				<span>{{session('error')}}<span>
				@endif
				</div>
                <li>
                    <div class="inputArea">
                        <input type="button" id="reg"  style="margin-top:10px;margin-left:85px;" class="button_blue" value="同意注册"/>
                    </div>
                </li>
                <div class="cl"></div>
           </ul>
    </form>
    </div>
   
    
    </div>
    <!--注册end-->
</div>
<div class="jianyi">*推荐使用ie8或以上版本ie浏览器或Chrome内核浏览器访问本站</div>
</body></html>
