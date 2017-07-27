@extends('Layouts.user_layouts')
@section('title','密码修改')
@section('head')
@parent           
@show
@section('ct-right')
  <div class="ct-right-head">
						密码修改
					</div>
					<div class="ct-right-main">
						<form name="form1" method="post" action="{{URL('home/pwdEdit')}}">
							{{csrf_field()}}
							<div class="usersafe">
								<label for="password"><span class="xing">*</span>原始密码</label>
      							<input type="password" name="pwd"  class="form-control" id="inputPassword" placeholder="Password">
      							@if ($errors->has('pwd')) 
      							<span>{{$errors->get('pwd')[0]}}</span>
      							@endif
      							<p>请输入你的登入密码</p>
							</div>
							<div class="usersafe">
								<label for="newsafe"><span class="xing">*</span>新密码</label>
      							<input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
      							
      							<p>密码长度只能是6位到16位之间,只能包含数字、字母和下划线</p>
							</div>
							<div class="usersafe">
								<label for="newsafe"><span class="xing">*</span>重复新密码</label>
      							<input type="password" name="password_confirmation" class="form-control" id="inputPassword" placeholder="Password">
      							@if ($errors->has('password')) 
      							<span>{{$errors->get('password')[0]}}</span>
      							@else
      							@if(!empty(session('pwderror')))
      							<span>{{session('pwderror')}}</span>
      							@endif
      							@endif
      							<p>请再次输入新密码</p>
							</div>
							<!--<div class="usersafe">
								<label for="Quesafe"><span class="xing">*</span>密保问题</label>
								<div class="que">你的大学学校叫什么？</div>
							</div>-->
							<!--<div class="usersafe-text">
      							<input type="text" class="form-control Quetext" id="Quesafe" placeholder="Security Question">
      							<span>错误信息</span>
      							<p>需要密保问题答案</p>
							</div>-->
							<!--<div class="usersafe" style="margin-top: 0px;">
      							<label for="newsafe"><span class="xing">*</span>验证码</label>
      							<input type="text" style="width: 100px;height: 30px;" class="form-control" id="voidtext" >
      							<img src=""  class="voidimg" id="voidimg">
      							<span>错误信息</span>
      							<p>请输入验证码</p>
							</div>-->
							<div class="safe-btn">
								<input class="btn btn-success" type="submit" value="提交" />
								<input class="btn btn-danger" type="reset" value="重置" />
							</div>							
						</form>
					</div>
@endsection
@section('safe')
    style="background-color: #FFFFFF; border-right: #FFFFFF;"
@endsection
