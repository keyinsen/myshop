@extends('Layouts.user_layouts')
@section('meta')
<meta name="_token" content="{{ csrf_token() }}"/>
@endsection
@section('js')
<script src="{{asset('js/home/user/uinfo.js')}}"></script>
<script src="{{asset('js/jquery.form.js')}}" type="text/javascript"></script>
@endsection
@section('title','个人信息')
@section('head')
@parent           
@show

@section('ct-right')
   <div class="ct-right-head">
						个人信息
					</div>
					<div class="ct-right-main">
							 {!! Form::open( [ 'url' => ['home/file'], 'method' => 'POST', 'id' => 'uploads', 'files' => true ] ) !!}
								
								<div class="touxiang1">

									<img src="{{$userinfo->image}}" id="uinfo_img" alt="..." class="img-rounded">
									<input type="file" name="picpath" id="picpath" style="display:none;">
									<input name="path" id="upimg" type="hidden">
									<button  class="btn btn-info" id="btn-touxiang" type="button"  style="margin-top: 10px;">上传照片</button>
									
							</div>
							{!! Form::close() !!}	
							<form id="info_form">
							<div class="perinfo">
								<label for="nickname">昵称</label>
								<input type="text" name="nickname" id="nickname" value="{{$userinfo->nickname}}" />
								<span id="nickerror"></span>
							</div>
							<div class="perinfo">
								<label for="email">Email</label>
								<input type="text" id="email" name="email" value="{{$userinfo->email}}" />
								<span id="emailerror"></span>
							</div>
							<div class="perinfo">
								<label for="age">年龄</label>
								<input type="number" id="age" name="age" maxlength="3" value="{{$userinfo->age}}" />
								<span id="ageerror"></span>
							</div>
							<div class="perinfo">
								<label for="nickname">Tel</label>
								<input type="text" id="tel" name="tel" value="{{$userinfo->tel}}" />
								<span id="telerror"></span>
							</div>
							<div class="perinfo">
								<label for="gender">性别</label>
								@if($userinfo->gender==1)
								<input type="radio" name="gender"  checked="checked" value="1"/>男
								<input type="radio" name="gender"  value="0" />女
								@else
								<input type="radio" name="gender" value="1"/>男
								<input type="radio" name="gender" checked="checked" value="0" />女
								@endif
							</div>
							<div class="perinfo">
								@if(!empty($userinfo->birth))
								<?php $str=explode('-',$userinfo->birth) ?>
								<label for="birth">出生年月</label>
								<select name="year" id="year">
								    <option selected="selected" value="{{$str[0]}}">{{$str[0]}}</option>
								</select>
								<select name="month" id="month">
									<option selected="selected" value="{{$str[1]}}">{{$str[1]}}</option>
								</select>
								<select name="day" id="day">
									<option selected="selected" value="{{$str[2]}}">{{$str[2]}}</option>
								</select>
								@else
								<label for="birth">出生年月</label>
								<select name="year" id="year">
								    <option selected="selected" value="0">年</option>
								</select>
								<select name="month" id="month">
									<option selected="selected" value="0">月</option>
								</select>
								<select name="day" id="day">
									<option selected="selected" value="0">日</option>
								</select>
								@endif
							</div>
							<div class="perinfo-mess">
								<label class="descript" for="descript">自我描述</label>
								<textarea rows="3" class="form-control" name="memo" id="memo" cols="20">{{$userinfo->memo}}</textarea>
							</div>
							<div class="perinfo">
							<a class="btn btn-success" href="javascript:void(0)" id="uinfo_submit"  >确认保存</a>
							</div>
							</form>
					</div>
					<div class="modal fade" id="uinfoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				            </div>
				            <div class="modal-body" style="color: green;text-align: center;">你的信息修改成功！！<span class="glyphicon glyphicon-thumbs-up"></span></div>
				             <div class="modal-footer">
				                <button type="button" id="info_succ" class="btn btn-default" data-dismiss="modal">确定</button>
				            </div>
			        	</div><!-- /.modal-content --> 
			    	</div><!-- /.modal -->
				</div>
@endsection
@section('perInfo')
    style="background-color: #FFFFFF; border-right: #FFFFFF;"
@endsection