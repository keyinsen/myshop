@extends('Layouts.admin_layouts')
@section('meta')
<meta name="_token" content="{{ csrf_token() }}"/>
@endsection
@section('js')
<script src="{{asset('js/admin/manage.js')}}"></script>
@endsection
@section('title','账户管理/管理设置')
@section('ct-right')
<ol class="breadcrumb">
					  <li>账户管理</li>
					  <li class="active">管理设置</li>
					</ol>
				    <span class="admin-font">新增管理账户</span>
				    @if(isset($editList))
				    <form id="manage-form" action="{{URL('admin/manage')}}/{{$editList->admin_id}}" method="post">
							{{csrf_field()}}
							<input type="hidden" name="_method" value="put" />
							
							<div class="admin-div">
								<label for="admin-uname"><span class="xing">*</span>账号:</label>
      							<input type="text" name="aname" value="{{$editList->aname}}" class="form-control" id="admin-aname">
      							<span id="admin-anameer"></span>
							</div>
							<div class="admin-div">
								<label for="admin-nick"><span class="xing">*</span>昵称:</label>
      							<input type="text" name="nickname" value="{{$editList->nickname}}" class="form-control" id="admin-nick">
      							<span id="admin-nicker"></span>
							</div>
							
							<div class="admin-div">
								<label for="admin-pwd"><span class="xing">*</span>密码:</label>
      							<input type="text" name="password" value="{{$editList->password}}" class="form-control" id="admin-pwd">
      							<span id="admin-pwder"></span>
							</div>
							<div class="admin-div">
								<label for="admin-pwds"><span class="xing">*</span>重复密码:</label>
      							<input type="text" class="form-control" id="admin-pwds">
      							<span id="admin-pwdser"></span>
      							@if(empty(session('manageerror')))
      							<span id="admin-pwdser">{{session('manageerror')}}</span>
      							@endif
							</div>
							<div class="admin-div">
								<label for="address**"></label>
      							<button id="manage-submit" type="button" class="btn btn-success">保存管理账户</button>
      							<button id="manage-cancel" type="button" class="btn btn-danger">取消</button>
							</div>
						</form>
						@else
						<form id="manage-form" action="manage" method="post">
							{{csrf_field()}}
							<div class="admin-div">
								<label for="admin-uname"><span class="xing">*</span>账号:</label>
      							<input type="text" name="aname" class="form-control" id="admin-aname">
      							<span id="admin-anameer"></span>
							</div>
							<div class="admin-div">
								<label for="admin-nick"><span class="xing">*</span>昵称:</label>
      							<input type="text" name="nickname" class="form-control" id="admin-nick">
      							<span id="admin-nicker"></span>
							</div>
							
							<div class="admin-div">
								<label for="admin-pwd"><span class="xing">*</span>密码:</label>
      							<input type="password" name="password" class="form-control" id="admin-pwd">
      							<span id="admin-pwder"></span>
							</div>
							<div class="admin-div">
								<label for="admin-pwds"><span class="xing">*</span>重复密码:</label>
      							<input type="password" class="form-control" id="admin-pwds">
      							<span id="admin-pwdser"></span>
      							@if(!empty(session('manageerror')))
      							<span id="admin-pwdser">{{session('manageerror')}}</span>
      							@endif
							</div>
							<div class="admin-div">
								<label for="address**"></label>
      							<button id="manage-submit" type="button" class="btn btn-success">保存管理账户</button>
      							<button id="manage-cancel" type="button" class="btn btn-danger">取消</button>
							</div>
						</form>
						@endif
						<div class="admin-font">已存在的管理账户</div>
						@if(count($manageList)!=0)
						<div class="admins-tables">
							<table>
								<tbody>
									<tr>
										<th><input class="allcheckbox" type="checkbox"/></th>
										<th>编号</th>
										<th>管理员昵称</th>
										<th>管理员账户</th>
										<th>管理员密码</th>
										<th>角色</th>
										<th>操作</th>
									</tr>
									@foreach($manageList as $ma)
							
									@if($ma->deleted_at==1)
									<tr>
										<td style="color:red;"><input class="ischeckbox" type="checkbox"/></td>
										<td style="color:red;" class="admin_id">{{$ma->admin_id}}</td>
										<td style="color:red;">{{$ma->nickname}}</td>
										<td style="color:red;">{{$ma->aname}}</td>
										<td style="color:red;">{{$ma->password}}</td>
										<td style="color:red;">{{$ma->role->rname}}</td>
										<td style="color:red;"><a style="width: 70px;color: green;"  href="{{URL('admin/manage/huifu')}}/{{$ma->admin_id}}">恢复删除 </a> (已删除)</td>
									</tr>
									@else
									<tr>
										<td><input class="ischeckbox" type="checkbox"/></td>
										<td class="admin_id">{{$ma->admin_id}}</td>
										<td>{{$ma->nickname}}</td>
										<td>{{$ma->aname}}</td>
										<td>{{$ma->password}}</td>
										<td>{{$ma->role->rname}}</td>
										<td><a class="btn btn-success" href="{{URL('admin/manage')}}/{{$ma->admin_id}}/edit">修改</a> <a class="btn btn-danger remove"  href="javascript:void(0)">删除</a></td>
									</tr>
									@endif									
									
									@endforeach
								</tbody>
							</table>
							<div class="manallbtn" >
									<button class="btn btn-danger allremove">筛选删除</button>
								</div>
								@else
								<div style="text-align: center;">
									没有任何普通管理员的信息！
								</div>
								@endif
								<!--<div class="fenye">
									<nav>
									  <ul class="pagination">
									    <li><a href="#">&laquo;</a></li>
									    <li><a href="#">1</a></li>
									    <li><a href="#">2</a></li>
									    <li><a href="#">3</a></li>
									    <li><a href="#">4</a></li>
									    <li><a href="#">5</a></li>
									    <li><a href="#">&raquo;</a></li>
									  </ul>
									</nav>
								</div>-->
						</div>
						<div class="modal fade" id="ManageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop='static' aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				               
				            </div>
				            <div class="modal-body">你确定要删除当前选中的管理员？<span class="glyphicon glyphicon-remove"></span></div>
				             <div class="modal-footer">
				                <button type="button" id="manage_succ" class="btn btn-danger" data-dismiss="modal">确定</button>
				                <button type="button" id="manage_cancel" class="btn btn-info" data-dismiss="modal">取消</button>
				            </div>
			        	</div><!-- /.modal-content --> 
			    	</div><!-- /.modal -->
			    </div>
			    	<div class="modal fade" id="ManagefailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop='static' aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				            </div>
				            <div class="modal-body">你并没有选择任何管理员的信息，无法筛选删除！<span class="glyphicon glyphicon-remove"></span></div>
				             <div class="modal-footer">
				                <button type="button" id="manage_fail" class="btn btn-danger" data-dismiss="modal">确定</button>
				            </div>
			        	</div><!-- /.modal-content --> 
			    	</div><!-- /.modal -->
			    	  </div>
@endsection
@section('zhgl-in')
    in
@endsection
@section('zhgl')
    style="color:#ff0000;"
@endsection
@section('zhgl-gm')
    style="color:#ff0000;"
@endsection
