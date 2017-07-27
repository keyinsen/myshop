@extends('Layouts.admin_layouts')
<!--删除的时候用到令牌-->
@section('meta')
<meta name="_token" content="{{ csrf_token() }}"/>
@endsection
@section('js')
<script src="{{asset('js/admin/aduser.js')}}"></script>
@endsection
@section('title','用户管理/用户信息增改')
@section('ct-right')
<ol class="breadcrumb">
					  <li>用户管理</li>
					  <li class="active">用户信息增改</li>
				</ol>
    				<span class="admin-font">增改用户基本信息</span>
    				@if(!isset($editList))
    				<form id="us_form" method="post" action="{{URL('admin/user')}}">
    					{{csrf_field()}}
    				<div class="perinfo">
								<label for="usnickname"><span class="xing">*</span>昵称</label>
								<input type="text" id="usnickname" name="nickname"/>
								<span id="user-nicker"></span>
						</div>
						<div class="perinfo">
								<label for="gender">性别</label>
								<select name="gender" class="form-control" style="width: 80px;display: inline-block;">
								  <option value="1">男</option>
								  <option value="2">女</option>
								</select>
						</div>
						<div class="perinfo">
								<label for="uage">年龄</label>
								<input type="number" maxlength="3"  id="uage" name="age" style="width: 50px;"/>
								<span id="user-ageer"></span>
						</div>
    				<div class="perinfo">
								<label for="usuname"><span class="xing">*</span>账号</label>
								<input type="text" id="usuname" name="uname"/>
								<span id="user-nameer"></span>
						</div>
						<div class="perinfo">
								<label for="uspwd"><span class="xing">*</span>密码</label>
								<input type="password" id="uspwd" name="password"/>
								<span id="user-pwder"></span>
						</div>
						<div class="perinfo">
								<label for="uspwds"><span class="xing">*</span>确认密码</label>
								<input type="password" id="uspwds"/>
								<span id="user-pwdser"></span>
						</div>
						<div class="perinfo">
								<label for="email">邮箱</label>
								<input type="text" id="email" name="email"/>
								<span id="user-emailer"></span>
						</div>
						<div class="perinfo">
								<label for="tel">手机号码</label>
								<input type="text" id="tel" name="tel"/>
								@if(!empty(session('userror')))
								<span id="user-teler">{{session('userror')}}</span>
								@else
								<span id="user-teler"></span>
								@endif
						</div>
						<div class="admin-div">
								<label for="**"></label>
      							<button id="user-submit" type="button" class="btn btn-success">保存新增</button>
      							<button id="user-cancel" type="reset" class="btn btn-danger">重置</button>
							</div>
							</form>
							@else
							<form id="us_form" method="post" action="{{URL('admin/user')}}/{{$editList->uid}}">
    					{{csrf_field()}}
    					<input type="hidden" value="put" name="_method" />
    				<div class="perinfo">
								<label for="usnickname"><span class="xing">*</span>昵称</label>
								<input type="text" id="usnickname" value="{{$editList->nickname}}" name="nickname"/>
								<span id="user-nicker"></span>
						</div>
						<div class="perinfo">
								<label for="gender">性别</label>
								<select name="gender" class="form-control" style="width: 80px;display: inline-block;">
									@if($editList->gender==1)
								  <option value="1" selected="selected">男</option>
								  <option value="2">女</option>
								  @else
								  <option value="1" >男</option>
								  <option value="2" selected="selected">女</option>
								  @endif
								</select>
						</div>
						<div class="perinfo">
								<label for="uage">年龄</label>
								<input type="number" maxlength="3" value="{{$editList->age}}"  id="uage" name="age" style="width: 50px;"/>
								<span id="user-ageer"></span>
						</div>
    				<div class="perinfo">
								<label for="usuname"><span class="xing">*</span>账号</label>
								<input type="text" id="usuname" value="{{$editList->uname}}" name="uname"/>
								<span id="user-nameer"></span>
						</div>
						<div class="perinfo">
								<label for="uspwd"><span class="xing">*</span>密码</label>
								<input type="text" id="uspwd" value="{{$editList->password}}" name="password"/>
								<span id="user-pwder"></span>
						</div>
						<div class="perinfo">
								<label for="uspwds"><span class="xing">*</span>确认密码</label>
								<input type="text" id="uspwds" value="{{$editList->password}}"/>
								<span id="user-pwdser"></span>
						</div>
						<div class="perinfo">
								<label for="email">邮箱</label>
								<input type="text" id="email" value="{{$editList->email}}" name="email"/>
								<span id="user-emailer"></span>
						</div>
						<div class="perinfo">
								<label for="tel">手机号码</label>
								<input type="text" id="tel" value="{{$editList->tel}}" name="tel"/>
								<span id="user-teler"></span>
								
						</div>
						<div class="admin-div">
								<label for="**"></label>
      							<button id="user-submit" type="button" class="btn btn-success">保存修改</button>
      							<button id="user-cancels"  class="btn btn-danger">取消</button>
							</div>
							</form>
							@endif
@endsection
@section('user')
    style="color:#ff0000;"
@endsection
@section('user-in')
    in
@endsection
@section('user-add')
    style="color:#ff0000;"
@endsection
