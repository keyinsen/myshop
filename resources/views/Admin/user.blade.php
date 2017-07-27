@extends('Layouts.admin_layouts')
<!--删除的时候用到令牌-->
@section('meta')
<meta name="_token" content="{{ csrf_token() }}"/>
@endsection
@section('js')
<script src="{{asset('js/admin/aduser.js')}}"></script>
@endsection
@section('title','用户管理/用户信息')
@section('ct-right')
<ol class="breadcrumb">
					  <li>用户管理</li>
					  <li class="active">用户信息</li>
				</ol>
    				<span class="admin-font">用户信息</span>
					<div class="admin-user">
						<form method="post" action="{{URL('admin/user/searchuser')}}">
				    		{{csrf_field()}}
						 <div class="input-group">
						 	  <input type="text" name="user" class="form-control" placeholder="输入用户编号或者账户">
						      <span class="input-group-btn" >
						        <button class="btn btn-default" type="submit">查找用户</button>
						      </span>						      
    					</div><!-- /input-group -->
    					<a href="{{URL('admin/user')}}" style="color: green;font-weight: bold;">显示全部用户</a>
    					</form>
    				</div>
					<div class="admin-table">
							@if(count($userList)!=0)
								<table>
									<tbody>
										<tr>
											<th><input type="checkbox" class="allcheckbox" /></th>
											<th>编号</th>
											<th>上次登入</th>
											<th>用户昵称</th>
											<th>用户账号</th>
											<th>用户密码</th>
											<th>用户邮箱</th>
											<th>性别</th>
											<th>年龄</th>
											<th>手机号</th>
											<th>操作</th>
										</tr>
										@foreach($userList as $ul)
										<tr>
											<td>
												<!--<input type="checkbox" class="ischeckbox"/>-->
											</td>
											<td class="uid">{{$ul->uid}}</td>
											<td>{{$ul->lasttime}}</td>
											@if(empty($ul->nickname))
											<td style="color: red;">无</td>
											@else
											<td>{{$ul->nickname}}</td>
											@endif
											<td>{{$ul->uname}}</td>
											<td>{{$ul->password}}</td>
											@if(empty($ul->email))
											<td style="color: red;">无</td>
											@else
											<td>{{$ul->email}}</td>
											@endif
											<td>
													@if($ul->gender==1)
													男
													@else
													女
													@endif
											</td>
											<td>{{$ul->age}}</td>
											@if(empty($ul->tel))
											<td style="color: red;">无</td>
											@else
											<td>{{$ul->tel}}</td>
											@endif
											<td><a class="btn btn-success btnpro" href="{{URL('admin/user')}}/{{$ul->uid}}/edit">修改</a> 
												<!--<a class="btn btn-danger btnpro usremove" href="javascript:void(0)">删除</a>-->
												</td>
										</tr>
										<!--@if($ul->deleted_at==0)
										<tr>
											<td><input type="checkbox" class="ischeckbox"/></td>
											<td class="uid">{{$ul->uid}}</td>
											<td>{{$ul->lasttime}}</td>
											@if(empty($ul->nickname))
											<td style="color: red;">无</td>
											@else
											<td>{{$ul->nickname}}</td>
											@endif
											<td>{{$ul->uname}}</td>
											<td>{{$ul->password}}</td>
											@if(empty($ul->email))
											<td style="color: red;">无</td>
											@else
											<td>{{$ul->email}}</td>
											@endif
											<td>
													@if($ul->gender==1)
													男
													@else
													女
													@endif
											</td>
											<td>{{$ul->age}}</td>
											@if(empty($ul->tel))
											<td style="color: red;">无</td>
											@else
											<td>{{$ul->tel}}</td>
											@endif-->
											<!--<td><a class="btn btn-success btnpro" href="{{URL('admin/user')}}/{{$ul->uid}}/edit">修改</a> 
												<!--<a class="btn btn-danger btnpro usremove" href="javascript:void(0)">删除</a>-->
												<!--</td>
										</tr>
										@else
										<tr>
											<td style="color: red;"><input type="checkbox" class="ischeckbox"/></td>
											<td style="color: red;" class="uid">{{$ul->uid}}</td>
											<td style="color: red;">{{$ul->lasttime}}</td>
											@if(empty($ul->nickname))
											<td style="color: red;">无</td>
											@else
											<td style="color: red;">{{$ul->nickname}}</td>
											@endif
											<td style="color: red;">{{$ul->uname}}</td>
											<td style="color: red;">{{$ul->password}}</td>
											@if(empty($ul->email))
											<td style="color: red;">无</td>
											@else
											<td style="color: red;">{{$ul->email}}</td>
											@endif
											<td style="color: red;">
													@if($ul->gender==1)
													男
													@else
													女
													@endif
											</td>
											<td style="color: red;">{{$ul->age}}</td>
											@if(empty($ul->tel))
											<td style="color: red;">无</td>
											@else
											<td style="color: red;">{{$ul->tel}}</td>
											@endif
											<td><a style="width: 70px;color: green;"  href="{{URL('admin/user/huifu')}}/{{$ul->uid}}">恢复删除 </a></td>
										</tr>
										@endif-->
										@endforeach
									</tbody>
								</table>
								<!--<div class="userallbtn" >
										<button class="btn btn-danger allremove">筛选删除</button>
									</div>-->
									<div style="width: 100%; text-align: center;">
										{!! $userList->render() !!}
									</div>
										@else
										<div style="width: 100%; text-align: center;">没有相关用户信息</div>
										@endif
						</div>
						<div class="modal fade" id="UserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"   data-backdrop='static' aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				               
				            </div>
				            <div class="modal-body">你确定要删除当前选中的用户？<span class="glyphicon glyphicon-remove"></span></div>
				             <div class="modal-footer">
				                <button type="button" id="user_succ" class="btn btn-danger" data-dismiss="modal">确定</button>
				                <button type="button" id="user_cancel" class="btn btn-info" data-dismiss="modal">取消</button>
				            </div>
			        	</div><!-- /.modal-content --> 
			    	</div><!-- /.modal -->
			    </div>
			    	<div class="modal fade" id="UserfailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  data-backdrop='static'  aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				            </div>
				            <div class="modal-body">你并没有选择任何用户的信息，无法筛选删除！<span class="glyphicon glyphicon-remove"></span></div>
				             <div class="modal-footer">
				                <button type="button" id="user_fail" class="btn btn-success" data-dismiss="modal">确定</button>
				            </div>
			        	</div><!-- /.modal-content --> 
			    	</div><!-- /.modal -->
			    	  </div>
@endsection
@section('user')
    style="color:#ff0000;"
@endsection
@section('user-in')
    in
@endsection
@section('user-info')
    style="color:#ff0000;"
@endsection
