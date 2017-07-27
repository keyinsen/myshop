@extends('Layouts.admin_layouts')
@section('title','消息管理/留言记录')
@section('js')
<script src="{{asset('js/admin/messageui.js')}}"></script>
@endsection
@section('ct-right')
<ol class="breadcrumb">
					  <li>我的消息</li>
					  <li><a href="{{URL('admin/message')}}">用户留言消息列表</a></li>
					  <li>消息记录</li>
					</ol>
					<div class="admin-mess">
						<div class="admin-name">
							<span>与用户:<span class="green">{{$user->uname}}</span>的留言消息</span>
						</div>
						<div class="mess-screen">
							@if(count($mess)!=0)
							@foreach($mess as $ms)
							<div class="admin-mess-div">
								<p>
									@if(($ms->sendid==$user->uid)&&($ms->sendname==$user->uname))
									<span class="red">{{$ms->sendname}}</span>
									@else
									<span class="blue">{{$ms->sendname}}</span>
									@endif
									<span class="time">{{$ms->sendtime}}</span>
								</p>
								<span class="mess">{{$ms->ctmess}}</span>
							</div>
							@endforeach
							@endif							
						</div>
					</div>
					<div class="send">
						<form id="form" action="{{URL('admin/message')}}" method="post">
						{{csrf_field()}}
						<input type="hidden" value="{{$user->uname}}" name="receivename" />
						<input type="hidden" value="{{$user->uid}}" name="receiveid" />
						<label for="mess-send">回复:</label>
						<textarea id="mess-send" class="form-control" name="mess" rows="3" cols="25" maxlength="150"></textarea>
						<span style="color: red;display: block;height: 20px;" class="messeror"></span>
						<button  type="button"  class="btn btn-primary messbtn">提交</button>
						<button type="reset" class="btn btn-danger">重置</button>
				</form>
					</div>
@endsection
@section('mess')
    style="color:#ff0000;"
@endsection
