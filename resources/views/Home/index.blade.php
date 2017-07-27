<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>通讯商城</title>
		<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}"></link>
		<link rel="stylesheet" href="{{asset('css/home/index/index.css')}}"></link>
		<link rel="stylesheet" href="{{asset('css/home/home.css')}}"></link>
		<script src="{{asset('js/jquery-1.11.0.js')}}"></script>
		<script src="{{asset('js/bootstrap.js')}}"></script>
		<script src="{{asset('js/home.js')}}"></script>
		<script src="{{asset('js/home/index/index.js')}}"></script>
	</head>

	<body>
		@include('widgets.head')
		<div class="container-fluid">
		<div class="content-top">
			
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<img src="{{asset('img/home/index/logo.png')}}" class="logo"/>
			<span class="font">做特卖的网站！</span>
			</div>
			@include('widgets.search')
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
            	<img src="{{asset('img/home/index/1466131264367.png')}}" class="img col-lg-4 col-md-4 col-sm-4 col-xs-4"/>
            	<img src="{{asset('img/home/index/1466131266290.png')}}" class="img col-lg-4 col-md-4 col-sm-4 col-xs-4"/>
            	<img src="{{asset('img/home/index/1466131268726.png')}}" class="img col-lg-4 col-md-4 col-sm-4 col-xs-4" />
            </div>
		</div><!--content-top-->
		 </div>
		<div class="container-fluid">
		<div class="content-menu1">
			<div class="content-menu">
				<ul>
					<li class="actives"><a href="category/1"><span class="glyphicon glyphicon-th-list"></span> 商品分类</a>
						<ul>
						@if(!empty($category))
							@foreach($category as $c)
							  @if($c->parentid==0)
								<li class="li">
									<a href="{{asset('home/category')}}/{{$c->cid}}">{{$c->cname}}</a>
									<div class="li-div">
									@foreach($category as $cate)									
										@if($c->cid==$cate->parentid)
											<a href="{{URL('home/category')}}/{{$cate->cid}}">{{$cate->cname}}</a>
										@endif
									@endforeach
									</div>
								</li>
							  @endif
							@endforeach
						@endif	
						</ul>
					</li>
				</ul>
			</div><!--content-menu-->
		</div><!--content-menu1-->
		</div>
		<div class="content-Carousel-div">
		<div class="content-Carousel">
			<div id="myCarousel" class="carousel slide">
			    <!-- 轮播（Carousel）指标 -->
			    <ol class="carousel-indicators">
			        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			        <li data-target="#myCarousel" data-slide-to="1"></li>
			        <li data-target="#myCarousel" data-slide-to="2"></li>
			    </ol>   
			    <!-- 轮播（Carousel）项目 -->
			    <div class="carousel-inner">
			        <div class="item active">
			            <img src="{{asset('img/home/index/0cb829f22ef52c018a49e98583856307e430d62c.jpg')}}" alt="First slide">
			        </div>
			        <div class="item">
			            <img src="{{asset('img/home/index/81a0e62855a3ea968c7716a4addbae77f0356d03.jpg')}}" alt="Second slide">
			        </div>
			        <div class="item">
			            <img src="{{asset('img/home/index/af2bff19770382043c31baf9f278dcb672dc9e26.jpg')}}" alt="Third slide">
			        </div>
			    </div>
			</div>
		</div><!--content-Carousel 轮播结束标签-->
		</div>
		<div class="content-main">
			<div class="head1">
				<div class="left">
				</div>
			<span>新特卖</span>
			<div class="right"></div>
			</div>
			<div class="container-fluid">
				<ul class="shop col-lg-12 col-md-12 col-sm-12 col-xs-12">
				@foreach($goodsList as $row)
					<li class="shoplist col-lg-2 col-md-2 col-sm-2 col-xs-2">
						<input type="hidden" value="{{$row->gid}}" />				
						<a class="a-img" href="{{URL('home/goodsinfo')}}/{{$row->gid}}">
							<img class="col-lg-12 col-md-12 col-sm-12 col-xs-12" src="{{$row->img_path}}" />
							<span class="font1">{{$row->gname}}</span>
						</a><br />
						<div class="price-collect col-xs-6">
						<span class="font3">￥<span>{{$row->price}}</span></span>
						<span class="font5">￥<span>{{$row->price*$row->discount}}</span></span>	
						<a  href="javascript:void(0)" class="addcollect" style="display: block;">收藏</a>
						</div>								
						<a class="cart col-xs-6" href="javascript:void(0)">加入购物车</a>
					</li>
				@endforeach
				</ul>
				</div>
		</div><!--content-main-->
		<div class="content-main">
			<div class="head2">
				<div class="left">
				</div>
			<span>热门推荐</span>
			<div class="right"></div>
			</div>		
			<div class="container-fluid">	
				<ul class="shop col-lg-12 col-md-12 col-sm-12 col-xs-12">
				@foreach($goodsList1 as $row)
					<li class="shoplist col-lg-2 col-md-2 col-sm-2 col-xs-2">
						<input type="hidden" value="{{$row->gid}}" />				
						<a class="a-img" href="{{URL('home/goodsinfo')}}/{{$row->gid}}">
							<img class="col-lg-12 col-md-12 col-sm-12 col-xs-12" src="{{$row->img_path}}" />
							<span class="font1">{{$row->gname}}</span>
						</a><br />	
						<div class="price-collect col-xs-6">
						<span class="font3">￥<span>{{$row->price}}</span></span>
						<span class="font5">￥<span>{{$row->price*$row->discount}}</span></span>	
						<a  href="javascript:void(0)" class="addcollect" style="display: block;">收藏</a>
						</div>
						<a class="cart col-xs-6" href="javascript:void(0)"><span class="glyphicon glyphicon-shopping-cart">加入购物车</a>
					</li>
				@endforeach
				</ul>
				</div>
		</div><!--content-main-->
		<div class="end"><!--end-->
			<img src="{{asset('img/home/index/promise.jpg')}}" />
			<div class="endtitle">通讯商城</div>
		</div><!--end-->
		@include('widgets.loginvalide')
		<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body" >商品已成功添加到购物车！！<span class="glyphicon glyphicon-thumbs-up"></span></div>
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
