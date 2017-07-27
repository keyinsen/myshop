@extends('Layouts.admin_layouts')
@section('title','后台主页')
@section('ct-right')
<ol class="breadcrumb">
					  <li class="active">后台主页</li>
					</ol>
					<div style="width: 100%;min-width: 1000px;">
				  <div class="container-fluid">
						<div class="ct-right-box  col-lg-3 col-md-3 col-sm-3 col-xs-3">
							<div class="box box1">
								<span class="glyphicon glyphicon-comment tubiao"></span>
								<span class="font">未读信息:</span>
								<span class="font1">{{count($mess)}}</span>
								<a class="bttoms1" href="{{URL('admin/message')}}">
									<span>查看</span>
									<span class="glyphicon glyphicon-circle-arrow-right"></span>
								</a>
							</div>
						</div>
						<div class="ct-right-box  col-lg-3 col-md-3 col-sm-3 col-xs-3">
							<div class="box box2">
								<span class="glyphicon glyphicon-shopping-cart tubiao"></span>
								<span class="font">订单待发货:</span>
								<span class="font1">{{count($order)}}</span>
								<a class="bttoms2" href="{{URL('admin/order')}}">
									<span>查看</span>
									<span class="glyphicon glyphicon-circle-arrow-right"></span>
								</a>
							</div>
						</div>
						<div class="ct-right-box  col-lg-3 col-md-3 col-sm-3 col-xs-3">
							<div class="box box3">
								<span class="glyphicon glyphicon-user tubiao"></span>
								<span class="font">用户量:</span>
								<span class="font1">{{count($user)}}</span>
								<a class="bttoms3" href="{{URL('admin/user')}}">
									<span>查看</span>
									<span class="glyphicon glyphicon-circle-arrow-right"></span>
								</a>
							</div>
						</div>
				</div>
						<!--<div class="ct-right-box  col-lg-3 col-md-3 col-sm-3 col-xs-3">
							<div class="box box4">
								<span class="glyphicon glyphicon-usd tubiao"></span>
								<span class="font">累计收入</span>
								<span class="font1">200</span>
								<a class="bttoms4" href="#">
									<span>查看</span>
									<span class="glyphicon glyphicon-circle-arrow-right"></span>
								</a>
							</div>
						</div>-->
				  </div>
@endsection
@section('per')
    style="color:#ff0000;"
@endsection
