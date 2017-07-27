@extends('Layouts.home_layouts')
@section('title','订单详情')
@section('css')
<link rel="stylesheet" href="{{asset('css/home/orderDetail.css')}}"></link>
@endsection
@section('js')
<script src="{{asset('js/home/orderdetail.js')}}"></script>
<script src="{{asset('js/home.js')}}"></script>
@endsection
@section('content')
<div class="ct-main">
			<div class="order-state">
				<span class="font">订单号:</span>
				<span class="font1">{{$orderList->ocode}}</span>
				<?php $total=0 ?>
				@foreach($orderList->orderDetail as $odl)
										
				<?php $total+=$odl->price*$odl->discount*$odl->num ?>
				@endforeach
				<span class="font">订单金额:</span>
				<span class="font1">￥{{$total}}</span>
				<span class="font">订单状态:</span>
				<span class="font3">{{$orderList->orderStatus->status}}</span>
				<p>提示:如果有任何意见和问题请<a href="{{URL('home/message/1')}}">给商家留言</a></p>
				<div class="order-state-end">
					<span class="font4">订单创建成功时间:</span>
					<span class="time">{{$orderList->created_at}}</span>
					<span class="font4">支付时间:</span>
					@if(empty($orderList->paytime))
					<span class="time">暂无</span>
					@else
					<span class="time">{{$orderList->paytime}}</span>
					@endif
					<span class="font4">发货时间:</span>
					@if(empty($orderList->sendtime))
					<span class="time">暂无</span>
					@else
					<span class="time">{{$orderList->sendtime}}</span>
					@endif
					<span class="font4">成交时间:</span>
					@if(empty($orderList->comptime))
					<span class="time">暂无</span>
					@else
					<span class="time">{{$orderList->comptime}}</span>
					@endif
				</div>
			</div>
			<div class="order-address">
				<div class="order-address-hd">
					收货信息
				</div>
				<div class="order-address-ct">
					<p><span>收货地区:</span><span>{{$rec->province.' '.$rec->city.' '.$rec->county}}</span></p>
					<p><span>收货地址:</span><span>{{$rec->detail}}</span></p>
					<p><span>邮编:</span><span>{{$rec->postcode}}</span></p>
					<p><span>收货人姓名:</span><span>{{$rec->recname}}</span></p>
					<p><span>手机号码:</span><span>{{$rec->tel}}</span></p>
				</div>
			</div>
			<div class="order-wuliu">
				<div class="order-wuliu-hd">
					物流信息
				</div>
				<div class="order-wuliu-ct">
					<p><span>配送方式:</span><span>快递</span></p>
					<p><span>配送费:</span><span>￥0.0</span></p>
					<p><span>物流状态:</span><span class="font">{{$orderList->goodsStatus->status}}</span></p>
				</div>
			</div>
			<div class="order-detail">
				<div class="order-detail-hd">
					商品清单和结算信息
				</div>
				<div class="order-detail-ct">
					<table>
						<tr>
							<th>商品图片</th>
							<th>商品信息</th>
							<th>单价</th>
							<th>数量</th>
							<th>优惠</th>
							<th>小计</th>
						</tr>
						@foreach($orderList->orderDetail as $ord)
						<tr>
							<td><img src="{{$ord->imgpath}}"></td>
							<td>
								<a href="{{URL('home/goods/')}}/{{$ord->gid}}">{{$ord->gname}}</a>
								<p>
									<span>版本:全网通</span>
									<span>容量:32G</span>
								</p>
							</td>
							<td>￥{{$ord->price}}</td>
							<td>1</td>
							<td>(折扣)-{{$ord->price-$ord->price*$ord->discount}}</td>
							<td>￥{{$ord->price*$ord->discount}}</td>
						</tr>
						@endforeach
					</table>
					<div class="order-detail-ct-end">
						<div class="left">
							<span>订单备注:</span>
							@if(empty($orderList->message))
							<span>无留言消息</span>
							@else
							<span>{{$orderList->message}}</span>
							@endif
						</div>
						<div class="right">
							<p>
								<span class="font">商品总金额:</span>
								<span class="font1">￥{{$total}}</span>
							</p>
							<p>
								<span class="font">运费:</span>
								<span class="font1">￥0.0</span>
							</p>
							<p class="bold">
								<span class="font">总额:</span>
								<span class="font2">￥{{$total}}</span>
							<p>
						</div>
					</div>
				</div>
				
			</div>
		</div>
@endsection

