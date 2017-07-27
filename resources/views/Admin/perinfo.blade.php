@extends('Layouts.admin_layouts')
@section('meta')
<meta name="_token" content="{{ csrf_token() }}"/>
@endsection
@section('js')
<script src="{{asset('js/admin/perinfos.js')}}"></script>
@endsection
@section('title','账户管理/个人设置')
@section('ct-right')
<ol class="breadcrumb">
					  <li>账户管理</li>
					  <li class="active">个人设置</li>
					</ol>
				   
				   {!! Form::open( [ 'url' => ['admin/file'], 'method' => 'POST', 'id' => 'upload', 'files' => true ] ) !!}
						
							<div class="touxiang1">
								<img src="{{$admininfo->image}}" alt="..."  class="img-rounded">
								<input type="file" name="picpath" id="picpaths" style="display:none;" required="required">
								<input name="path" type="hidden">
								<a class="btn btn-info" id="loadimg"   style="margin-top: 10px;">上传照片</a>
							</div>
						{!! Form::close() !!}	
						 <form name="form1" action="info"  method="post">
						 {{csrf_field()}}
							<div class="perinfo">
								<label for="nickname"></span>账号</label>
								<input type="hidden" name="image" id="upimg" value="{{$admininfo->image}}"/>
								<input type="text" id="email" value="{{$admininfo->aname}}"  readonly="readonly"/>
							</div>
							<div class="perinfo">
								<label for="nickname"><span class="xing"></span>昵称</label>
								<input type="text" value="{{$admininfo->nickname}}" name="nickname" id="nickname" />
								 @if ($errors->has('nickname'))
                <span id="nickerror">{{$errors->get('nickname')[0]}}<span>
								@endif
							</div>
							<div class="perinfo">
								<label for="nickname"><span class="xing"></span>角色</label>
								<input type="text"  readonly="readonly" value="{{$admininfo->role->rname}}" />
							</div>
							<div class="perinfo">
							<input class="btn btn-success" type="submit" value="确认保存" />
							</div>
						</form>
@endsection
@section('zhgl-in')
    in
@endsection
@section('zhgl')
    style="color:#ff0000;"
@endsection
@section('zhgl-she')
    style="color:#ff0000;"
@endsection
