<div class="head"><!--head-->
						<ul class="head-right">
							<li>
								<a id="order" href="javascript:void(0)">我的订单</a>
							</li>
							<li>
								<a id="collect" href="javascript:void(0)"><span class="glyphicon glyphicon-star"></span>收藏夹</a>
							</li>
							<li class="shopli">
								<a id="carts" href="javascript:void(0)">
									<span class="glyphicon glyphicon-shopping-cart"></span>购物车
									@if(!empty(session('USER')))
										@if(count($cartList)!=0)
											<span class="red">{{count($cartList)}}</span>
										  @else
									  		<span class="red">0</span>
										@endif										
									  @else
									  <span class="red">0</span>
									@endif
									</a>
								
								<div class="shop">
									@if(!empty(session('USER')))
										<table id="carttable">
										 @if(count($cartList)!=0)
											@foreach($cartList as $cart)
											<tr>
												<td><input type="hidden" value="{{$cart->gid}}" /></td>
												<td><img src="{{$cart->img_path}}"/></td>
												<?php $str=$cart->gname ?>
												@if(strlen($str)>=5)
												<?php $str=mb_substr($str,0,8)?>
												<td>{{$str}}...</td>
												@else
												<td>{{$str}}</td>
												@endif
												<td>￥{{$cart->price*$cart->discount}}</td>
												<td>X<span>{{$cart->num}}</span></td>
												<td><a class="remove" href="javascript:void(0)">删除</a></td>
											</tr>
											@endforeach
											@endif
										</table>
										<div class="cart-sum">
										<span class="span4">这里显示你有:</span><span class="red">{{count($cartList)}}</span><span class="span4">种商品</span>
										</div>
										<a class="shop-cart"  href="{{URL('home/cart')}}">去购物车</a>
										
									@else
									<span>你的购物车空空！赶紧去选购吧....</span>
									@endif
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
					<a id="is_regster" href="{{URL('home/register')}}">注册</a>
					<span class="glyphicon glyphicon-log-in"></span>
					<a id="is_login" value="0" href="{{URL('home/login')}}">登入</a>
					@endif
					<button class="btn btn-default" id="message" type="button">
  						<span class="glyphicon glyphicon-envelope"></span>消息
  						@if($mess!=-1)
  						<span class="red">{{$mess}}</span>
  						@endif
					</button>
				</div>
</div><!--head-->
