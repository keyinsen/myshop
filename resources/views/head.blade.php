<div class="head"><!--head-->
						<ul class="head-right">
							<li>
								<a id="order"  href="{{URL('home/order/index')}}">我的订单</a>
							</li>
							<li>
								<a id="collect" href="javascript:void(0)"><span class="glyphicon glyphicon-star"></span>收藏夹</a>
							</li>
							<li class="shopli">
								<a id="carts" href="javascript:void(0)"><span class="glyphicon glyphicon-shopping-cart"></span>购物车<span class="red">0</span></a>
								<div class="shop">
									<div class="shop-row">
										<img src="{{asset('img/home/index/1466131264367.png')}}">
										<span class="span1"><a href="#">商品名称</a></span>
										<span class="red">￥</span><span class="span2">120</span><span>x</span><span>1</span>
										<span class="span3"><a href="#">删除</a></span>
									</div>
									<div class="shop-row">
										<img src="{{asset('img/home/index/1466131264367.png')}}">
										<span class="span1"><a href="#">商品名称</a></span>
										<span class="red">￥</span><span class="span2">1200.00</span><span>x</span><span>1</span>
										<span class="span3"><a href="#">删除</a></span>
									</div>
									<div class="cart-sum">
									<span class="span4">总计:</span><span class="red">2</span><span class="span4">件商品</span>
									</div>
									<a class="shop-cart" href="#">去购物车结算</a>
								</div>
							</li>
						</ul>
				<div class="head-left">
					@if(!empty(session('USER')))
					<span>你好,</span>
					<a href="{{URL('home/uperinfo')}}">{{session('USER')['uname']}}</a>
					<span>会员，欢迎进入商城！</span>
					<a id="is_login" value="1" href="{{URL('home/outLogin')}}">退出</a>
					@else
					<span class="glyphicon glyphicon-user"></span>
					<a id="is_regster" href="{{URL('home/login')}}">注册</a>
					<span class="glyphicon glyphicon-log-in"></span>
					<a id="is_login" value="0" href="{{URL('home/login')}}">登入</a>
					@endif
					<button class="btn btn-default" id="message" type="button">
  						<span class="glyphicon glyphicon-envelope"></span>消息<span class="red">0</span>
					</button>
				</div>
</div><!--head-->
