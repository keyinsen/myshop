@extends('Layouts.home_layouts')

@section('title','留言消息')
@section('css')
<link rel="stylesheet" href="{{asset('css/home/user/user.css')}}"></link>
@endsection
@section('js')
<script src="{{asset('js/home.js')}}"></script>
<script src="{{asset('js/home/user/user.js')}}"></script>
<script src="{{asset('js/home/umessageui.js')}}"></script>
@endsection
@section('content')
		<div class="ct-main">
			<div class="message-record">
			<div class="message-head">
				<span>你与</span>
				<span class="message-head-font">官方商家({{$admin->nickname}})</span>
				<span>的留言消息</span>
				<a href="{{URL('home/message')}}" class="btn btn-success">我的留言消息</a>
			</div>
			<div class="admin-mess">
						<div class="mess-screen">
							@if(count($mess)!=0)
							@foreach($mess as $ms)
							<div class="admin-mess-div">
								<p>
									@if(($ms->sendid==$admin->aid)&&($ms->sendname==$admin->nickname))
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
			<div class="mess-submit">
				<form id="form" action="{{URL('home/message')}}" method="post">
					{{csrf_field()}}
					<input type="hidden" value="{{$admin->nickname}}" name="receivename" />
					<input type="hidden" value="{{$admin->admin_id}}" name="admin_id" />
					<input type="hidden" value="{{$admin->aid}}" name="receiveid" />
					<label for="mess-send">回复:</label>
					<textarea id="mess-send" class="form-control" name="mess" rows="3" cols="25" maxlength="150"></textarea>
					<span style="color: red;display: block;height: 20px;" class="messeror"></span>
					<button  type="button"  class="btn btn-primary messbtn">提交</button>
					<button type="reset" class="btn btn-danger">重置</button>
				</form>
			</div>
		</div>
		</div>
@endsection



