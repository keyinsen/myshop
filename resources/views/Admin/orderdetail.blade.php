@extends('Layouts.admin_layouts')
@section('js')
<script src="{{asset('js/PCASClass.js')}}"></script>
<script src="{{asset('js/admin/orderdetail.js')}}"></script>
@endsection
@section('title','订单管理/订单详情')
@section('ct-right')
<ol class="breadcrumb">
					  <li>订单管理</li>
					  <li><a href="{{URL('admin/order')}}">用户订单</a></li>
					  <li>订单详情</li>
					</ol>
					<input type="hidden" value="{{$orderRow->oid}}" id="oid"/>
					<div class="orderDtail">
						<div class="order-div">
							<label>订单状态:</label>
							@if($orderRow->orderStatus->osid==1)
							<span class="red">{{$orderRow->orderStatus->status}}</span>
							@else
								<span class="green">{{$orderRow->orderStatus->status}}</span>
							@endif
								</div>
								<div class="order-div">
							<label>订单创建时间:</label>
							<span>{{$orderRow->created_at}}</span>
							<label>支付时间:</label>
							@if(empty($orderRow->paytime))
							<span>暂无</span>
							@else
							<span>{{$orderRow->paytime}}</span>
							@endif
							<label>发货时间:</label>
							@if(empty($orderRow->sendtime))
							<span>暂无</span>
							@else
							<span>{{$orderRow->sendtime}}</span>
							@endif
							<label>订单完成时间:</label>
							@if(empty($orderRow->comptime))
							<span class="red">未完成</span>
							@else
							<span>{{$orderRow->comptime}}</span>
							@endif
						</div>
						@foreach($orderRow->orderDetail as $odl)
							<div class="order-div">
								<label>商品名称:</label>
								<span>{{$odl->gname}}</span>
							</div>
							<div class="order-div">
								<input class="gid" type="hidden" value="{{$odl->gid}}" />
								<label >数量:</label>
								<input class="num" type="number"  value="{{$odl->num}}"/>件
								<label>单价:</label>
								<input class="price" type="number" name="price" value="{{$odl->price}}"/>
								<label>折扣:</label>
								<input class="discount" type="number" name="discount" value="{{$odl->discount}}"/>
								<button type="button"  class="btn btn-success editorder" style="padding: 0px;">修改</button>
								<span class="error" style="color: red;"></span>
							</div>
						@endforeach
						<div class="order-div">
							<label>物流状态:</label>
							@if($orderRow->goodsStatus->gsid==1)
							<span class="red">{{$orderRow->goodsStatus->status}}</span>
							@endif
							@if($orderRow->goodsStatus->gsid==2)
							<span class="green">{{$orderRow->goodsStatus->status}}</span>
							@endif
							@if($orderRow->goodsStatus->gsid==3)
							<span class="green">{{$orderRow->goodsStatus->status}}</span>
							@endif
							<label>配送方式:</label>
							<span>快递</span>
						</div>
						<div class="order-div">
							<label>收货人:</label>
							<span>{{$address->recname}}</span>
							<label>电话号码:</label>
							<span>{{$address->tel}}</span>
						</div>
						<div class="order-div">
							<label>收货地址:</label>
							<span>{{$address->province}}</span>
							<span>{{$address->city}}</span>
							<span>{{$address->county}}</span>
							<label>邮编:</label>
							<span>{{$address->postcode}}</span>
						</div>
						<div class="order-div">
							<label>详细地址:</label>
							<span>{{$address->detail}}</span>
						</div>
						<div class="order-div">
							<label>订单留言:</label>
							@if(empty($orderRow->message))
							<span>无留言消息</span>
							@else
							<span>{{$orderRow->message}}</span>
							@endif
						</div>
					</div>
@endsection
@section('order')
    style="color:#ff0000;"
@endsection