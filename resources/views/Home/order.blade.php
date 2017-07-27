@extends('Layouts.home_layouts')
@section('title','我的订单')
@section('css')
<link rel="stylesheet" href="{{asset('css/home/order.css')}}"></link>
@endsection
@section('js')
<script src="{{asset('js/home/order.js')}}"></script>
<script src="{{asset('js/home.js')}}"></script>
@endsection
@section('content')
<div class="ct-main">
			<div class="address">
				<div class="address-head">
					<span>选择确认收货地址</span>
					<a href="{{URL('home/address')}}">管理收货地址</a>
				</div>
				@if(count($addressList)!=0)
				@foreach($addressList as $addrerow)
				<div class="address-ct">
					<span class="rec_id" style="display: none;">{{$addrerow->rec_id}}</span>
					<span>{{$addrerow->province}}</span>
					<span>{{$addrerow->city}}</span>
					<span>{{$addrerow->county}}</span>
					<span>{{$addrerow->detail}}</span>
					<span>(</span>
					<span>{{$addrerow->recname}}</span>
					<span>收)</span>
					<span class="font">{{$addrerow->tel}}</span>
				</div>
				@endforeach
				@else
				<div class="notaddress">你没有任何可选择的地址请先点击右上角管理收货地址进行添加新地址</div>
				@endif
				<!--<button type="button" id="addressbtn" class="btn btn-success">+使用新增地址</button>-->
			</div>
			<div class="goodstime">
				<div class="goodstime-head"><span>送货时间</span></div>
				<div class="goodstime-ct">
					<span>由官方商城发货，下单24小时内发货</span>
				</div>
			</div>
			<div class="goodsinfo">
				<div class="goodsinfo-head"><span>确认订单信息</span></div>
				<div class="goods-title">
					<div>商品图片</div>
					<div>商品信息</div>
					<div>数量</div>
					<div>单价</div>
					<div>小计</div>
				</div>
				<?php $tatal=0 ?>
				@foreach($cartArray as $cart)
				<div class="goods-ct">
					<span class="cart_gid" style="display: none;">{{$cart->gid}}</span>
					<div class="img">
						<img src="{{$cart->img_path}}" />
					</div>
					<div class="a-span">
						<a href="{{URL('home/goodsinfo')}}/{{$cart->gid}}">{{$cart->gname}}</a>
					</div>
					@if(isset($num))
					<span class="num" id="gnum">{{$num}}</span>
					@else
					<span class="num">{{$cart->num}}</span>
					@endif
					<div class="price">
						<span>￥{{$cart->price*$cart->discount}}</span>
						<p>￥{{$cart->price}}</p>
					</div>
					@if(isset($num))
					<?php $tatal+=$cart->price*$cart->discount*$num ?>
					<span class="zprice">￥{{$cart->price*$cart->discount*$num}}</span>
					@else
					<?php $tatal+=$cart->price*$cart->discount*$cart->num ?>
					<span class="zprice">￥{{$cart->price*$cart->discount*$cart->num}}</span>
					@endif
				</div>
				@endforeach
				<div class="goodsend">
					<span class="liuyan">给商家留言:</span>
					<input type="text" id="order_mess" maxlength="30" placeholder="字数30个字以内"/>
					<span class="price">￥0.0</span>
					<span class="pricename">配送方式:快递</span>   	
				</div>
			</div>
		</div>
		<div class="goodssubmit">
			<div class="text">
				<div class="text-left">
					<span class="font">共</span>
					<span class="font1">{{count($cartArray)}}</span>
					<span class="font">件商品,总金额为:</span>
				</div>
				<div class="text-right">
					<span class="font3">￥{{$tatal}}</span>
				</div>
			</div>
			<div class="text">
				<div class="text-left">
					<span class="font">总运费:</span>
				</div>
				<div class="text-right">
					<span class="font3">￥0.0</span>
				</div>
			</div>
			<div class="text">
				<div class="text-left">
					<span class="font">应付总金额:</span>
				</div>
				<div class="text-right">
					<span class="font4">￥{{$tatal}}</span>
				</div>
			</div>
			
		</div>
		<div class="goodssubmit-end">
			<a href="{{URL('home/cart')}}">返回修改购物车</a>
			@if(isset($num))
			<div class="btns">
				<button type="button" id="order_goods_submit" class="btn btn-success">提交订单</button>
			</div>
			@else
			<div class="btns">
				<button type="button" id="order_submit" class="btn btn-success">提交订单</button>
			</div>
			@endif
		</div>
		<div class="modal fade" id="myorderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-body">请选择收货地址!<span class="glyphicon glyphicon-info-sign"></span></div>
				             <div class="modal-footer">
				                <button type="button" id="order_succ" class="btn btn-default" data-dismiss="modal">确定</button>
				            </div>
			        	</div><!-- /.modal-content --> 
			    	</div><!-- /.modal -->
				</div>
				<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-body"><span class="glyphicon glyphicon-info-sign"></span></div>
				             <div class="modal-footer">
				                <button type="button" id="order_succ" class="btn btn-default" data-dismiss="modal">确定</button>
				            </div>
			        	</div><!-- /.modal-content --> 
			    	</div><!-- /.modal -->
				</div>
@endsection












