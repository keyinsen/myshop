@extends('Layouts.user_layouts')
@section('js')
<script src="{{asset('js/home/user/uorder.js')}}"></script>
@endsection
@section('title','我的订单')
@section('ct-right')
<div class="ct-right-head">
						我的订单
					</div>
					<div class="ct-right-main">
						<div class="order-sogo">
							<form action="{{URL('home/order/search')}}" method="post">
								{{csrf_field()}}
								 <div class="input-group">
								 	  <input type="text" class="form-control" name="ocode" placeholder="输入你要查询的订单号">
								      <span class="input-group-btn" >
								        <button class="btn btn-default" type="submit">订单查询</button>
								      </span>						      
		    					</div><!-- /input-group -->
    						</form>
    						<a href="{{URL('home/order/index')}}">显示全部订单信息</a>
    					</div>
    					<ul id="myTab" class="nav nav-tabs">
							<li class="active">
								<a href="#orderall" data-toggle="tab">全部订单</a>
							</li>
							<li>
								<a href="#orderwait" data-toggle="tab">未付款</a>
							</li>
							<li>
								<a href="#orderalready"  data-toggle="tab">已付款</a>
							</li>
							<li>
								<a href="#ordercancel"  data-toggle="tab">已取消</a>
							</li>
							<li>
								<a href="#ordercomple"  data-toggle="tab">交易完成</a>
							</li>
						</ul>
						<div id="myTabContent" class="tab-content">
							<div class="tab-pane fade in active" id="orderall">
								@if(count($orderList)==0)
								<div class="order-fail">没有任何相关信息！</div>
								@else
								<div class="order-table">
									<table>
										<tbody>
											<tr>
												<th>订单信息</th>
												<th>商品名</th>
												<th>订购的商品</th>
												<th>数量</th>
												<th>单价</th>
												<th>小计</th>
												<th>订单状态</th>
												<th>操作</th>
											</tr>
											@foreach($orderList as $ol)
											<?php $is=true ?>
												<?php $total=0 ?>
											@foreach($ol->orderDetail as $odl)
										
											<?php $total+=$odl->price*$odl->discount*$odl->num ?>
											@endforeach
											@foreach($ol->orderDetail as $odl)
											@if($is)
											<tr>
												<td rowspan="{{count($ol->orderDetail)}}"> 
													<div class="orderInfo">
														<span>订单号:</span>
														<span>{{$ol->ocode}}</span>
													</div>
												</td>
											
												<td>
													<a href="{{URL('home/goodsinfo')}}/{{$odl->gid}}" style="font-size: 13px;">{{$odl->gname}}</a>
												</td>
												<td><img src="{{$odl->imgpath}}"/></td>
												<td>{{$odl->num}}</td>
												<td>
													<div class="orderInfo">
														<span>￥{{$odl->price*$odl->discount}}</span>
														<p class="font">￥{{$odl->price}}</p>
													</div>
												</td>
												<td rowspan="{{count($ol->orderDetail)}}">
													<div class="orderInfo">
														<span>￥{{$total}}</span>
														<p>(免运费)</p>
													</div>
												</td>
												<td rowspan="{{count($ol->orderDetail)}}">{{$ol->orderStatus->status}}</td>
												<td rowspan="{{count($ol->orderDetail)}}">
													
													@if($ol->orderStatus->osid==1)
													<a href="{{URL('home/odetail/index')}}/{{$ol->oid}}">查看详情</a>
													<a class="orderpay" href="javascript:void(0)">点击付款</a>
													<a class="cancelorderpay" href="javascript:void(0)">取消订单</a>
													@endif
													@if(($ol->orderStatus->osid==2)&&(($ol->goodsStatus->gsid==2)||($ol->goodsStatus->gsid==3)))
													<a href="{{URL('home/odetail/index')}}/{{$ol->oid}}">查看详情</a>
													<a href="javascript:void(0)" class="recipient" style="background-color: deepskyblue;">确认收货</a>
													@endif
													@if(($ol->orderStatus->osid==2)&&($ol->goodsStatus->gsid==1))
													<a href="{{URL('home/odetail/index')}}/{{$ol->oid}}">查看详情</a>
													@endif
													@if($ol->orderStatus->osid==3)
													<a href="{{URL('home/odetail/index')}}/{{$ol->oid}}">查看详情</a>
													<a class="orderdel" href="javascript:void(0)" style="background-color: red;">删除订单</a>
													<span>订单已取消</span>
													@endif
													@if($ol->orderStatus->osid==4)
													<a href="{{URL('home/odetail/index')}}/{{$ol->oid}}">查看详情</a>
													<a href="{{URL('home/evaluate')}}/{{$ol->oid}}" class="btn btn-default" style="padding: 0px;width: 80px;">评价</a>
													<a class="orderdel" href="javascript:void(0)" >删除订单</a>
													<span>订单已完成</span>
													@endif
													<input type="hidden" value="{{$ol->oid}}" />
												</td>
											</tr>
											<?php $is=false ?>
											@else
											<tr>
												<td>
													<a href="{{URL('home/goodsinfo')}}/{{$odl->gid}}" style="font-size: 13px;">{{$odl->gname}}</a>
												</td>
												<td><img src="{{$odl->imgpath}}"/></td>
												<td>{{$odl->num}}</td>
												<td>
													<div class="orderInfo">
														<span>￥{{$odl->price*$odl->discount}}</span>
														<p class="font">￥{{$odl->price}}</p>
													</div>
												</td>												
											</tr>
											@endif
												@endforeach
											@endforeach
										</tbody>
									</table>
									<div style="width: 100%;text-align: center;">
										{!! $orderList->render()  !!}
									</div>
								</div>
								@endif
							</div>
							<div class="tab-pane fade" id="orderwait">
								@if(count($norderList)==0)
								<div class="order-fail">没有任何相关信息！</div>
								@else
								<?php $is1=true ?>
								<div class="order-table">
									@foreach($norderList as $ol)
											<?php $is=true ?>
											
											<?php $total=0 ?>
										@if($ol->orderStatus->osid==1)
										@if($is1)
									<table>
										<tbody>
											<tr>
												<th>订单信息</th>
												<th>商品名</th>
												<th>订购的商品</th>
												<th>数量</th>
												<th>单价</th>
												<th>小计</th>
												<th>订单状态</th>
												<th>操作</th>
											</tr>
											<?php $is1=false ?>
											@endif
											@foreach($ol->orderDetail as $odl)
										
											<?php $total+=$odl->price*$odl->discount*$odl->num ?>
											@endforeach
											@foreach($ol->orderDetail as $odl)
											@if($is)
											<tr>
												<td rowspan="{{count($ol->orderDetail)}}"> 
													<div class="orderInfo">
														<span>订单号:</span>
														<span>{{$ol->ocode}}</span>
													</div>
												</td>
											
												<td>
													<a href="{{URL('home/goodsinfo')}}/{{$odl->gid}}" style="font-size: 13px;">{{$odl->gname}}</a>
												</td>
												<td><img src="{{$odl->imgpath}}"/></td>
												<td>{{$odl->num}}</td>
												<td>
													<div class="orderInfo">
														<span>￥{{$odl->price*$odl->discount}}</span>
														<p class="font">￥{{$odl->price}}</p>
													</div>
												</td>
												<td rowspan="{{count($ol->orderDetail)}}">
													<div class="orderInfo">
														<span>￥{{$total}}</span>
														<p>(免运费)</p>
													</div>
												</td>
												<td rowspan="{{count($ol->orderDetail)}}">{{$ol->orderStatus->status}}</td>
												<td rowspan="{{count($ol->orderDetail)}}">
													@if($ol->orderStatus->osid==1)
													<a href="{{URL('home/odetail/index')}}/{{$ol->oid}}">查看详情</a>
													<a class="orderpay" href="javascript:void(0)">点击付款</a>
													<a class="cancelorderpay" href="javascript:void(0)">取消订单</a>
													@endif
													@if(($ol->orderStatus->osid==2)&&(($ol->goodsStatus->gsid==2)||($ol->goodsStatus->gsid==3)))
													<a href="{{URL('home/odetail/index')}}/{{$ol->oid}}">查看详情</a>
													<a href="javascript:void(0)" class="recipient" style="background-color: deepskyblue;">确认收货</a>
													@endif
													@if(($ol->orderStatus->osid==2)&&($ol->goodsStatus->gsid==1))
													<a href="{{URL('home/odetail/index')}}/{{$ol->oid}}">查看详情</a>
													@endif
													@if($ol->orderStatus->osid==3)
													<a href="{{URL('home/odetail/index')}}/{{$ol->oid}}">查看详情</a>
													<a class="orderdel" href="javascript:void(0)" style="background-color: red;">删除订单</a>
													<span>订单已取消</span>
													@endif
													@if($ol->orderStatus->osid==4)
													<a href="{{URL('home/odetail/index')}}/{{$ol->oid}}">查看详情</a>
													<a href="{{URL('home/evaluate')}}/{{$ol->oid}}" class="btn btn-default" style="padding: 0px;width: 80px;">评价</a>
													<a class="orderdel" href="javascript:void(0)" >删除订单</a>
													<span>订单已完成</span>
													@endif
													<input type="hidden" value="{{$ol->oid}}" />
												</td>
											</tr>
											<?php $is=false ?>
											@else
											<tr>
												<td>
													<a href="{{URL('home/goodsinfo')}}/{{$odl->gid}}" style="font-size: 13px;">{{$odl->gname}}</a>
												</td>
												<td><img src="{{$odl->imgpath}}"/></td>
												<td>{{$odl->num}}</td>
												<td>
													<div class="orderInfo">
														<span>￥{{$odl->price*$odl->discount}}</span>
														<p class="font">￥{{$odl->price}}</p>
													</div>
												</td>												
											</tr>
											@endif
												@endforeach
											@endif	
											@endforeach
										</tbody>
									</table>
									<div style="width: 100%;text-align: center;">
										{!! $norderList->render()  !!}
									</div>
								</div>
								@endif
							</div>
							<div class="tab-pane fade" id="orderalready">
								@if(count($rorderList)==0)
								<div class="order-fail">没有任何相关信息！</div>
								@else
								<?php $is1=true ?>
								<div class="order-table">
									@foreach($rorderList as $ol)
											<?php $is=true ?>
											
											<?php $total=0 ?>
										@if($ol->orderStatus->osid==2)
										@if($is1)
									<table>
										<tbody>
											<tr>
												<th>订单信息</th>
												<th>商品名</th>
												<th>订购的商品</th>
												<th>数量</th>
												<th>单价</th>
												<th>小计</th>
												<th>订单状态</th>
												<th>操作</th>
											</tr>
											<?php $is1=false ?>
											@endif
											@foreach($ol->orderDetail as $odl)
										
											<?php $total+=$odl->price*$odl->discount*$odl->num ?>
											@endforeach
											@foreach($ol->orderDetail as $odl)
											@if($is)
											<tr>
												<td rowspan="{{count($ol->orderDetail)}}"> 
													<div class="orderInfo">
														<span>订单号:</span>
														<span>{{$ol->ocode}}</span>
													</div>
												</td>
											
												<td>
													<a href="{{URL('home/goodsinfo')}}/{{$odl->gid}}" style="font-size: 13px;">{{$odl->gname}}</a>
												</td>
												<td><img src="{{$odl->imgpath}}"/></td>
												<td>{{$odl->num}}</td>
												<td>
													<div class="orderInfo">
														<span>￥{{$odl->price*$odl->discount}}</span>
														<p class="font">￥{{$odl->price}}</p>
													</div>
												</td>
												<td rowspan="{{count($ol->orderDetail)}}">
													<div class="orderInfo">
														<span>￥{{$total}}</span>
														<p>(免运费)</p>
													</div>
												</td>
												<td rowspan="{{count($ol->orderDetail)}}">{{$ol->orderStatus->status}}</td>
												<td rowspan="{{count($ol->orderDetail)}}">
													@if($ol->orderStatus->osid==1)
													<a href="{{URL('home/odetail/index')}}/{{$ol->oid}}">查看详情</a>
													<a class="orderpay" href="javascript:void(0)">点击付款</a>
													<a class="cancelorderpay" href="javascript:void(0)">取消订单</a>
													@endif
													@if(($ol->orderStatus->osid==2)&&(($ol->goodsStatus->gsid==2)||($ol->goodsStatus->gsid==3)))
													<a href="{{URL('home/odetail/index')}}/{{$ol->oid}}">查看详情</a>
													<a href="javascript:void(0)" class="recipient" style="background-color: deepskyblue;">确认收货</a>
													@endif
													@if(($ol->orderStatus->osid==2)&&($ol->goodsStatus->gsid==1))
													<a href="{{URL('home/odetail/index')}}/{{$ol->oid}}">查看详情</a>
													@endif
													@if($ol->orderStatus->osid==3)
													<a href="{{URL('home/odetail/index')}}/{{$ol->oid}}">查看详情</a>
													<a class="orderdel" href="javascript:void(0)" style="background-color: red;">删除订单</a>
													<span>订单已取消</span>
													@endif
													@if($ol->orderStatus->osid==4)
													<a href="{{URL('home/odetail/index')}}/{{$ol->oid}}">查看详情</a>
													<a href="{{URL('home/evaluate')}}/{{$ol->oid}}" class="btn btn-default" style="padding: 0px;width: 80px;">评价</a>
													<a class="orderdel" href="javascript:void(0)" >删除订单</a>
													<span>订单已完成</span>
													@endif
													<input type="hidden" value="{{$ol->oid}}" />
												</td>
											</tr>
											<?php $is=false ?>
											@else
											<tr>
												<td>
													<a href="{{URL('home/goodsinfo')}}/{{$odl->gid}}" style="font-size: 13px;">{{$odl->gname}}</a>
												</td>
												<td><img src="{{$odl->imgpath}}"/></td>
												<td>{{$odl->num}}</td>
												<td>
													<div class="orderInfo">
														<span>￥{{$odl->price*$odl->discount}}</span>
														<p class="font">￥{{$odl->price}}</p>
													</div>
												</td>												
											</tr>
											@endif
												@endforeach
											@endif	
											@endforeach
										</tbody>
									</table>
									<div style="width: 100%;text-align: center;">
										{!! $rorderList->render()  !!}
									</div>
								</div>
								@endif
							</div>
							<div class="tab-pane fade" id="ordercancel">
								@if(count($corderList)==0)
								<div class="order-fail">没有任何相关信息！</div>
								@else
								<?php $is1=true ?>
								<div class="order-table">
									@foreach($corderList as $ol)
											<?php $is=true ?>
											
											<?php $total=0 ?>
										@if($ol->orderStatus->osid==3)
										@if($is1)
									<table>
										<tbody>
											<tr>
												<th>订单信息</th>
												<th>商品名</th>
												<th>订购的商品</th>
												<th>数量</th>
												<th>单价</th>
												<th>小计</th>
												<th>订单状态</th>
												<th>操作</th>
											</tr>
											<?php $is1=false ?>
											@endif
											@foreach($ol->orderDetail as $odl)
										
											<?php $total+=$odl->price*$odl->discount*$odl->num ?>
											@endforeach
											@foreach($ol->orderDetail as $odl)
											@if($is)
											<tr>
												<td rowspan="{{count($ol->orderDetail)}}"> 
													<div class="orderInfo">
														<span>订单号:</span>
														<span>{{$ol->ocode}}</span>
													</div>
												</td>
											
												<td>
													<a href="{{URL('home/goodsinfo')}}/{{$odl->gid}}" style="font-size: 13px;">{{$odl->gname}}</a>
												</td>
												<td><img src="{{$odl->imgpath}}"/></td>
												<td>{{$odl->num}}</td>
												<td>
													<div class="orderInfo">
														<span>￥{{$odl->price*$odl->discount}}</span>
														<p class="font">￥{{$odl->price}}</p>
													</div>
												</td>
												<td rowspan="{{count($ol->orderDetail)}}">
													<div class="orderInfo">
														<span>￥{{$total}}</span>
														<p>(免运费)</p>
													</div>
												</td>
												<td rowspan="{{count($ol->orderDetail)}}">{{$ol->orderStatus->status}}</td>
												<td rowspan="{{count($ol->orderDetail)}}">
													@if($ol->orderStatus->osid==1)
													<a href="{{URL('home/odetail/index')}}/{{$ol->oid}}">查看详情</a>
													<a class="orderpay" href="javascript:void(0)">点击付款</a>
													<a class="cancelorderpay" href="javascript:void(0)">取消订单</a>
													@endif
													@if(($ol->orderStatus->osid==2)&&(($ol->goodsStatus->gsid==2)||($ol->goodsStatus->gsid==3)))
													<a href="{{URL('home/odetail/index')}}/{{$ol->oid}}">查看详情</a>
													<a href="javascript:void(0)" class="recipient" style="background-color: deepskyblue;">确认收货</a>
													@endif
													@if(($ol->orderStatus->osid==2)&&($ol->goodsStatus->gsid==1))
													<a href="{{URL('home/odetail/index')}}/{{$ol->oid}}">查看详情</a>
													@endif
													@if($ol->orderStatus->osid==3)
													<a href="{{URL('home/odetail/index')}}/{{$ol->oid}}">查看详情</a>
													<a class="orderdel" href="javascript:void(0)" style="background-color: red;">删除订单</a>
													<span>订单已取消</span>
													@endif
													@if($ol->orderStatus->osid==4)
													<a href="{{URL('home/odetail/index')}}/{{$ol->oid}}">查看详情</a>
													<a href="{{URL('home/evaluate')}}/{{$ol->oid}}" class="btn btn-default" style="padding: 0px;width: 80px;">评价</a>
													<a class="orderdel" href="javascript:void(0)" >删除订单</a>
													<span>订单已完成</span>
													@endif
													<input type="hidden" value="{{$ol->oid}}" />
												</td>
											</tr>
											<?php $is=false ?>
											@else
											<tr>
												<td>
													<a href="{{URL('home/goodsinfo')}}/{{$odl->gid}}" style="font-size: 13px;">{{$odl->gname}}</a>
												</td>
												<td><img src="{{$odl->imgpath}}"/></td>
												<td>{{$odl->num}}</td>
												<td>
													<div class="orderInfo">
														<span>￥{{$odl->price*$odl->discount}}</span>
														<p class="font">￥{{$odl->price}}</p>
													</div>
												</td>												
											</tr>
											@endif
												@endforeach
											@endif	
											@endforeach
										</tbody>
									</table>
									<div style="width: 100%;text-align: center;">
										{!! $corderList->render()  !!}
									</div>
								</div>
								@endif
							</div>
							<div class="tab-pane fade" id="ordercomple">
								@if(count($cmorderList)==0)
								<div class="order-fail">没有任何相关信息！</div>
								@else
								<?php $is1=true ?>
								<div class="order-table">
									@foreach($cmorderList as $ol)
											<?php $is=true ?>
											
											<?php $total=0 ?>
										@if($ol->orderStatus->osid==4)
										@if($is1)
									<table>
										<tbody>
											<tr>
												<th>订单信息</th>
												<th>商品名</th>
												<th>订购的商品</th>
												<th>数量</th>
												<th>单价</th>
												<th>小计</th>
												<th>订单状态</th>
												<th>操作</th>
											</tr>
											<?php $is1=false ?>
											@endif
											@foreach($ol->orderDetail as $odl)
										
											<?php $total+=$odl->price*$odl->discount*$odl->num ?>
											@endforeach
											@foreach($ol->orderDetail as $odl)
											@if($is)
											<tr>
												<td rowspan="{{count($ol->orderDetail)}}"> 
													<div class="orderInfo">
														<span>订单号:</span>
														<span>{{$ol->ocode}}</span>
													</div>
												</td>
											
												<td>
													<a href="{{URL('home/goodsinfo')}}/{{$odl->gid}}" style="font-size: 13px;">{{$odl->gname}}</a>
												</td>
												<td><img src="{{$odl->imgpath}}"/></td>
												<td>{{$odl->num}}</td>
												<td>
													<div class="orderInfo">
														<span>￥{{$odl->price*$odl->discount}}</span>
														<p class="font">￥{{$odl->price}}</p>
													</div>
												</td>
												<td rowspan="{{count($ol->orderDetail)}}">
													<div class="orderInfo">
														<span>￥{{$total}}</span>
														<p>(免运费)</p>
													</div>
												</td>
												<td rowspan="{{count($ol->orderDetail)}}">{{$ol->orderStatus->status}}</td>
												<td rowspan="{{count($ol->orderDetail)}}">
													@if($ol->orderStatus->osid==1)
													<a href="{{URL('home/odetail/index')}}/{{$ol->oid}}">查看详情</a>
													<a class="orderpay" href="javascript:void(0)">点击付款</a>
													<a class="cancelorderpay" href="javascript:void(0)">取消订单</a>
													@endif
													@if(($ol->orderStatus->osid==2)&&(($ol->goodsStatus->gsid==2)||($ol->goodsStatus->gsid==3)))
													<a href="{{URL('home/odetail/index')}}/{{$ol->oid}}">查看详情</a>
													<a href="javascript:void(0)" class="recipient" style="background-color: deepskyblue;">确认收货</a>
													@endif
													@if(($ol->orderStatus->osid==2)&&($ol->goodsStatus->gsid==1))
													<a href="{{URL('home/odetail/index')}}/{{$ol->oid}}">查看详情</a>
													@endif
													@if($ol->orderStatus->osid==3)
													<a href="{{URL('home/odetail/index')}}/{{$ol->oid}}">查看详情</a>
													<a class="orderdel" href="javascript:void(0)" style="background-color: red;">删除订单</a>
													<span>订单已取消</span>
													@endif
													@if($ol->orderStatus->osid==4)
													<a href="{{URL('home/odetail/index')}}/{{$ol->oid}}">查看详情</a>
													<a href="{{URL('home/evaluate')}}/{{$ol->oid}}" class="btn btn-default" style="padding: 0px;width: 80px;">评价</a>
													<a class="orderdel" href="javascript:void(0)" >删除订单</a>
													<span>订单已完成</span>
													@endif
													<input type="hidden" value="{{$ol->oid}}" />
												</td>
											</tr>
											<?php $is=false ?>
											@else
											<tr>
												<td>
													<a href="{{URL('home/goodsinfo')}}/{{$odl->gid}}" style="font-size: 13px;">{{$odl->gname}}</a>
												</td>
												<td><img src="{{$odl->imgpath}}"/></td>
												<td>{{$odl->num}}</td>
												<td>
													<div class="orderInfo">
														<span>￥{{$odl->price*$odl->discount}}</span>
														<p class="font">￥{{$odl->price}}</p>
													</div>
												</td>												
											</tr>
											@endif
												@endforeach
											@endif	
											@endforeach
										</tbody>
									</table>
									<div style="width: 100%;text-align: center;">
										{!! $cmorderList->render()  !!}
									</div>
								</div>
								@endif
							</div>
						</div>
					</div>
					 <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				                
				            </div>
				            <div class="modal-body"><span class="glyphicon glyphicon-question-sign"></span>你确定要购买此商品？</div>
				             <div class="modal-footer">
				                <button type="button" id="order_success" class="btn btn-success" data-dismiss="modal">购买</button>
				                <button type="button" id="order_cancel" class="btn btn-info" data-dismiss="modal">不买</button>
				            </div>
			        	</div><!-- /.modal-content --> 
			    	</div><!-- /.modal -->
				</div>
				<!--取消订单-->
				<div class="modal fade" id="cancelorderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				                
				            </div>
				            <div class="modal-body"><span class="glyphicon glyphicon-question-sign"></span>你确定要取消订单？</div>
				             <div class="modal-footer">
				                <button type="button" id="ordercancels" class="btn btn-success" data-dismiss="modal">确定</button>
				                <button type="button" id="order_notcancel" class="btn btn-info" data-dismiss="modal">我不</button>
				            </div>
			        	</div><!-- /.modal-content --> 
			    	</div><!-- /.modal -->
				</div>
				<!--余额不足、支付失败/支付成功-->
				<div class="modal fade" id="orderresultModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				               
				            </div>
				            <div class="modal-body"><span class="glyphicon glyphicon-remove-circle" id="resulttext"></span></div>
				             <div class="modal-footer">
				                <button type="button" id="freashorder" class="btn btn-success" data-dismiss="modal">确定</button>
				            </div>
			        	</div><!-- /.modal-content --> 
			    	</div><!-- /.modal -->
				</div>
				<!--确认收货-->
				<div class="modal fade" id="recipientModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				               
				            </div>
				            <div class="modal-body" style="color: blue; text-align: center;"><span class="glyphicon glyphicon-question-sign" id="resulttext">你确定商品已收到？</span></div>
				             <div class="modal-footer">
				                <button type="button" id="recipient_succ" class="btn btn-danger" data-dismiss="modal">确定</button>
				                <button type="button" id="recipient_can" class="btn btn-success" data-dismiss="modal">取消</button>
				            </div>
			        	</div><!-- /.modal-content --> 
			    	</div><!-- /.modal -->
				</div>
				<!--询问是否删除订单-->
				<div class="modal fade" id="orderdelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				               
				            </div>
				            <div class="modal-body"><span class="glyphicon glyphicon-question-sign" id="resulttext">你确定要删除订单信息？</span></div>
				             <div class="modal-footer">
				                <button type="button" id="delorder" class="btn btn-danger" data-dismiss="modal">确定</button>
				                <button type="button" id="delCancelorder" class="btn btn-success" data-dismiss="modal">取消</button>
				            </div>
			        	</div><!-- /.modal-content --> 
			    	</div><!-- /.modal -->
				</div>
@endsection
@section('order')
    style="background-color: #FFFFFF; border-right: #FFFFFF;"
@endsection
 
