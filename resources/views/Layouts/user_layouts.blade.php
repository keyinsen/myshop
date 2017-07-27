<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
			@yield('meta')
		<title>@yield('title')</title>
		<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}"></link>		
		<link rel="stylesheet" href="{{asset('css/home/user/user.css')}}"></link>
		<link rel="stylesheet" href="{{asset('css/home/home.css')}}"></link>
		<script src="{{asset('js/jquery-1.11.0.js')}}"></script>
		<script src="{{asset('js/bootstrap.js')}}"></script>
		@yield('js')
		<script src="{{asset('js/home.js')}}"></script>
		<script src="{{asset('js/home/user/user.js')}}"></script>
	</head>
	<body>
	@section('head')
		@include('widgets.head')
		<div class="ct-top">
			<div class="ct-top1">
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<h2>通讯商城</h2>
			</div>
			@include('widgets.search')
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
            	<img src="{{asset('img/home/layouts/slogan.gif')}}">
            </div>
            </div>
        </div>
		<div class="ct-head">
			<ul class="ct-ul">
				<li class="li"></li>
				<li class="li"><a href="{{asset('home/index')}}">商城首页</a></li>
				<li class="li"><a href="{{asset('home/category/1')}}">商品分类</a></li>
			</ul>
		</div>
		@show
		<div class="ct-main">
			<div class="container-fluid">
				<div class="ct-left col-lg-2 col-md-2 col-sm-2 col-xs-2">
					<div class="touxiang">
					@include('widgets.usertouimg')
					</div>
					<div class="ct-left-meun" id="">
						<img src="{{asset('img/home/user/nav_title_bg.png')}}" />
						<span>账号管理</span>
					</div>
					<ul>
						<li @yield('perInfo')><a href="{{URL('home/uperinfo')}}"><span class="glyphicon glyphicon-user"></span>个人信息</a></li>
						<li @yield('safe')><a href="{{URL('home/pwd')}}"><span class="glyphicon glyphicon-cog"></span>密码修改</a></li>
						<li @yield('menory')><a href="{{URL('home/menory')}}"><span class="glyphicon glyphicon-usd"></span>账户余额</a></li>
						<li @yield('address')><a href="{{URL('home/address')}}"><span class="glyphicon glyphicon-pencil"></span>收货地址管理</a></li>
					</ul>
					<div class="ct-left-meun" id="">
						<img src="{{asset('img/home/user/nav_title_bg.png')}}" />
						<span>购物管理</span>
					</div>
					<ul>
						<li  @yield('order')><a href="{{URL('home/order/index')}}"><span class="glyphicon glyphicon-gift"></span>我的订单</a></li>
						<li @yield('collect')><a href="{{URL('home/collect')}}"><span class="glyphicon glyphicon-heart"></span>我的收藏</a></li>
					</ul>
					<div class="ct-left-meun" id="">
						<img src="{{asset('img/home/user/nav_title_bg.png')}}" />
						<span>评价管理</span>
					</div>
					<ul>
						<li @yield('evaluate')><a href="{{URL('home/evaluate')}}"><span class="glyphicon glyphicon-edit"></span>我的评价</a></li>
					</ul>
					<div class="ct-left-meun" id="">
						<img src="{{asset('img/home/user/nav_title_bg.png')}}" />
						<span>消息管理</span>
					</div>
					<ul>
						<li @yield('message')><a href="{{URL('home/message')}}">我的留言消息<span class="glyphicon glyphicon-comment"></span></a></li>
					</ul>
					<!--<div class="ct-left-meun" id="">
						<img src="{{asset('img/home/user/nav_title_bg.png')}}" />
						<span>售后管理</span>
					</div>
					<ul>
						<li @yield('after_sales')><a href="#"><span class="glyphicon glyphicon-log-out"></span>退货服务</a></li>
					</ul>-->
				</div>
				<div class="ct-right col-lg-10 col-md-10 col-sm-10 col-xs-10">
					 @yield('ct-right')
				</div>
			</div>
		</div>
		<div class="end"><!--end-->
			<img src="{{asset('img/home/index/promise.jpg')}}" />
			<div class="endtitle">通讯商城</div>
		</div><!--end-->
	</body>
</html>