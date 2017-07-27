@extends('Layouts.admin_layouts')
@section('title','安全设置/密码修改')
@section('ct-right')
<ol class="breadcrumb">
					  <li>账户管理</li>
					  <li class="active">安全设置</li>
					</ol>
				    <form name="form1" action="safe" method="post">
				    	{{csrf_field()}}
							<div class="adminsafe">
								<label for="password"><span class="xing">*</span>原始密码</label>
      							<input type="password" name="pwd" class="form-control" id="inputPassword" placeholder="Password">
      							 @if ($errors->has('pwd'))
      							<span>{{$errors->get('pwd')[0]}}</span>
      							@endif
      							<p>请输入你的登入密码</p>
							</div>
							<div class="adminsafe">
								<label for="newsafe"><span class="xing">*</span>新密码</label>
      							<input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
      							@if ($errors->has('password'))
      							<span>{{$errors->get('password')[0]}}</span>
      							@endif
      							<p>6-16 个字符，需使用字母、数字或符号组合，不能使用纯数字、纯字母、纯符号</p>
							</div>
							<div class="adminsafe">
								<label for="newsafe"><span class="xing">*</span>重复新密码</label>
      							<input type="password" name="password_confirmation" class="form-control" id="inputPassword" placeholder="Password">
      							@if(!empty(session('safeerror')))
      							<span>{{session('safeerror')}}</span>
      							@endif
      							<p>请再次输入新密码</p>
							</div>

							
							<div class="safe-btn">
								<input class="btn btn-success" type="submit" value="提交" />
								<input class="btn btn-danger" type="reset" value="重置" />
							</div>
							
						</form>
@endsection
@section('zhgl-in')
    in
@endsection
@section('zhgl')
    style="color:#ff0000;"
@endsection
@section('zhgl-safe')
    style="color:#ff0000;"
@endsection
