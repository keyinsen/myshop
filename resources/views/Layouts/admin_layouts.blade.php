<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
			
			@yield('meta')
		<title>@yield('title')</title>
		<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}" />
		<link rel="stylesheet" href="{{asset('css/admin/admin.css')}}" />
		
	</head>
	<body>
		<div class="head">
			<div class="head-left">
				<a href="{{URL('home/index')}}"><span class="font">通讯</span><span>商城</span></a>
			</div>
				<ul class="user-menu">
					@include('widgets.adordermess')
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{session('Admin')['image']}}" /> {{session('Admin')['aname']}} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{URL('admin/perinfo')}}"><span class="glyphicon glyphicon-user"></span> 个人设置</a></li>
							<li><a href="{{URL('admin/persafe')}}"><span class="glyphicon glyphicon-cog"></span> 安全设置</a></li>
							<li><a href="{{URL('admin/out')}}"><span class="glyphicon glyphicon-log-out"></span> 退出</a></li>
						</ul>
					</li>
				</ul>
		</div>
		<div class="ct">
			<div class="container-fluid">
				<div class="ct-left col-lg-2 col-md-2 col-sm-2 col-xs-2">
					<div class="panel-group" id="accordion">
						<div class="panel panel-default">
					        <div class="panel-heading">
					            <h4 class="panel-title">
					                <a href="{{URL('admin/index')}}">
					                	<img src="{{asset('img/admin/nav_title_bg.png')}}" />
					                	<span class="glyphicon glyphicon-home" @yield('per')>个人主页</span>
					                </a>
					            </h4>
					        </div>
					    </div>
					    <div class="panel panel-default">
					        <div class="panel-heading">
					            <h4 class="panel-title">
					                <a data-toggle="collapse" data-parent="#accordion" 
					                href="#collapseOne">
					                	<img src="{{asset('img/admin/nav_title_bg.png')}}" />
					                	<span class="glyphicon glyphicon-cog" @yield('zhgl')>账户管理</span>
					                </a>
					            </h4>
					        </div>
					        <div id="collapseOne" class="panel-collapse collapse @yield('zhgl-in')">
					            <div class="panel-body">
					                <ul>
					                	<li><a href="{{URL('admin/perinfo')}}"  @yield('zhgl-she')>个人设置</a></li>
					                	<li><a href="{{URL('admin/persafe')}}"  @yield('zhgl-safe')>安全设置</a></li>
					                	@include('widgets.manage')
					                </ul>
					            </div>
					        </div>
					    </div>
					    <div class="panel panel-default">
					        <div class="panel-heading">
					            <h4 class="panel-title">
					                <a data-toggle="collapse" data-parent="#accordion" 
					                href="#collapseuser">
					                	<img src="{{asset('img/admin/nav_title_bg.png')}}" />
					                	<span class="glyphicon glyphicon-user" @yield('user')>用户管理</span>
					                </a>
					            </h4>
					        </div>
					        <div id="collapseuser" class="panel-collapse collapse @yield('user-in')">
					            <div class="panel-body">
					                <ul>
					                	<li><a href="{{URL('admin/user/create')}}"  @yield('user-add')>增改用户</a></li>
					                	<li><a href="{{URL('admin/user')}}"  @yield('user-info')>用户信息</a></li>
					                </ul>
					            </div>
					        </div>
					    </div>
					    <div class="panel panel-default">
					        <div class="panel-heading">
					            <h4 class="panel-title">
					                <a data-toggle="collapse" data-parent="#accordion" 
					                href="#collapseThree">
					               		<img src="{{asset('img/admin/nav_title_bg.png')}}" />
					                	<span class="glyphicon glyphicon-gift" @yield('goods')>商品管理</span>
					                </a>
					            </h4>
					        </div>
					        <div id="collapseThree" class="panel-collapse collapse @yield('goods-in')">
					            <div class="panel-body">
					               <ul>
					               	<li ><a href="{{URL('admin/goods')}}" @yield('goods-is')>商品信息</a></li>
					            	<li ><a href="{{URL('admin/goods/create')}}"  @yield('goods-add') >增改商品</a></li>
					            	@include('widgets.admincate')
					               </ul>
					            </div>
					        </div>
					    </div>
					    <div class="panel panel-default">
					        <div class="panel-heading">
					            <h4 class="panel-title">
					                <a href="{{URL('admin/order')}}">
					               		<img src="{{asset('img/admin/nav_title_bg.png')}}" />
					                	<span class="glyphicon glyphicon-save" @yield('order')>订单管理</span>
					                </a>
					            </h4>
					        </div>
					    </div>
					    <div class="panel panel-default">
					        <div class="panel-heading">
					            <h4 class="panel-title">
					                <a href="{{URL('admin/evaluate')}}">
					               		<img src="{{asset('img/admin/nav_title_bg.png')}}" />
					                	<span class="glyphicon glyphicon-edit" @yield('evaluate')>评价管理</span>
					                </a>
					            </h4>
					        </div>
					    </div>
					    <div class="panel panel-default">
					        <div class="panel-heading">
					            <h4 class="panel-title">
					                <a href="{{URL('admin/message')}}">
					               		<img src="{{asset('img/admin/nav_title_bg.png')}}" />
					                	<span class="glyphicon glyphicon-comment" @yield('mess')>用户留言消息</span>
					                </a>
					            </h4>
					        </div>
					    </div>
					    <!--<div class="panel panel-default">
					        <div class="panel-heading">
					            <h4 class="panel-title">
					                <a href="#">
					               		<img src="{{asset('img/admin/nav_title_bg.png')}}" />
					                	<span class="glyphicon glyphicon-transfer" @yield('after')>售后管理</span>
					                </a>
					            </h4>
					        </div>
					       
					    </div>-->
					</div>
				</div>
				<div class="ct-right col-lg-10 col-md-10 col-sm-10 col-xs-10">
					@yield('ct-right')
				</div>
			</div>
		</div>
		
		<script src="{{asset('js/jquery-1.11.0.js')}}"></script>
<!-- 		<script src="{{asset('js/jquery.ui.widget.js')}}"></script> -->
<!-- 		<script src="{{asset('js/jquery.iframe-transport.js')}}"></script> -->
		
<!-- 		<script src="{{asset('js/jquery.fileupload.js')}}"></script> -->
		<script src="{{asset('js/jquery.form.js')}}" type="text/javascript"></script>
		<script src="{{asset('js/admin/admin.js')}}"></script>
		@yield('js')
		<script src="{{asset('js/bootstrap.js')}}"></script>
	</body>
</html>

