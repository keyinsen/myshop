<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		@yield('meta')
		<title>@yield('title')</title>
		<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}"></link>
		<link rel="stylesheet" href="{{asset('css/home/layouts/layouts.css')}}"></link>
		<link rel="stylesheet" href="{{asset('css/home/home.css')}}"></link>
		@yield('css')
		
		<script src="{{asset('js/jquery-1.11.0.js')}}"></script>
		<script src="{{asset('js/bootstrap.js')}}"></script>
		@yield('js')
		
		<script src="{{asset('js/home/layouts/layouts.js')}}"></script>
		
	</head>

	<body>
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
		 @yield('content')
		<div class="end"><!--end-->
			<img src="{{asset('img/home/index/promise.jpg')}}" />
			<div class="endtitle">通讯商城</div>
		</div><!--end-->
		@include('widgets.loginvalide')
		<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">商品已成功添加到购物车！！<span class="glyphicon glyphicon-thumbs-up"></span></div>
             <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">确定</button>
            </div>
        </div><!-- /.modal-content --> 
    </div><!-- /.modal -->
</div>
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body"style="color: green; text-align: center;">商品已成功添加到 收藏夹！！<span class="glyphicon glyphicon-ok"></span></div>
             <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">确定</button>
            </div>
        </div><!-- /.modal-content --> 
    </div><!-- /.modal -->
</div>
	</body>
</html>

