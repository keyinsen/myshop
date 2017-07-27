@extends('Layouts.admin_layouts')
@section('js')
<script src="{{asset('js/admin/order.js')}}"></script>
@endsection
@section('title','订单管理/用户订单')
@section('ct-right')
<ol class="breadcrumb">
					  <li>订单管理</li>
					  <li class="active">用户订单</li>
					</ol>
				    <div class="order-sogo">
				    	<form method="post" action="{{URL('admin/order/checkorder')}}">
				    		{{csrf_field()}}
						<div class="input-group" >
						 	  <input type="text" name="orderid" class="form-control" placeholder="输入你要查询的订单号">
						      <span class="input-group-btn">
						        <button class="btn btn-default" type="submit">订单查询</button>
						      </span>						      
    					</div><!-- /input-group -->
    					</form>
    					<a href="{{URL('admin/order')}}" style="color: green;font-weight: bold;">显示全部订单</a>
    					</div>
    					<ul id="myTab" class="nav nav-tabs">
							<li class="active">
								<a href="#orderall" data-toggle="tab">全部订单</a>
							</li>
							<li>
								<a href="#orderwait" data-toggle="tab">等待付款</a>
							</li>
							<li>
								<a href="#orderalready"  data-toggle="tab">待发货</a>
							</li>
							<!--<li>
								<a href="#ordersign"  data-toggle="tab">待签收</a>
							</li>-->
							<li>
								<a href="#ordercancel"  data-toggle="tab">已取消</a>
							</li>
							<li>
								<a href="#ordercomple"  data-toggle="tab">交易完成</a>
							</li>
						</ul>
						<div id="myTabContent" class="tab-content">
							<div class="tab-pane fade in active" id="orderall">
								<div class="order-table">
									@if(count($orderList)!=0)
									<table>
										<tbody>
											<tr>
												<th>订单号</th>
												<th>用户Id</th>
												<th>商品名</th>
												<th>数量</th>
												<th>单价</th>
												<th>折扣价</th>
												<th>小计</th>
												<th>订单状态</th>
												<th>物流状态</th>
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
												<td rowspan="{{count($ol->orderDetail)}}"><span>{{$ol->ocode}}</span><br/>
													<span class="font1">[{{$ol->created_at}}]</span>
												</td>
												<td rowspan="{{count($ol->orderDetail)}}">{{$ol->uid}}</td>
												<td><span class="font">{{$odl->gname}}</span></td>
												<td>{{$odl->num}}</td>
												<td>{{$odl->price}}</td>
												<td>{{$odl->price*$odl->discount}}</td>
												<td rowspan="{{count($ol->orderDetail)}}">{{$total}}</td>
												@if($ol->orderStatus->osid==1||$ol->orderStatus->osid==3)
												<td rowspan="{{count($ol->orderDetail)}}" style="color: red;">{{$ol->orderStatus->status}}</td>
												@else
												<td rowspan="{{count($ol->orderDetail)}}" style="color: green;">{{$ol->orderStatus->status}}</td>
												@endif
												@if($ol->goodsStatus->gsid==1)
												<td rowspan="{{count($ol->orderDetail)}}" style="color: red;">{{$ol->goodsStatus->status}}</td>
												@else
												<td rowspan="{{count($ol->orderDetail)}}" style="color: green;">{{$ol->goodsStatus->status}}</td>
												@endif
												<td rowspan="{{count($ol->orderDetail)}}">
													<input type="hidden" value="{{$ol->oid}}" />
													<a href="{{URL('admin/order')}}/{{$ol->oid}}" class="btncss btn btn-info">订单详情</a>
													@if(($ol->orderStatus->osid==2)&&($ol->goodsStatus->gsid==1))
													<a href="javascript:void(0)" class="btncss btn btn-primary sendgoods">发货</a>
													@endif
													@if($ol->orderStatus->osid==4||$ol->orderStatus->osid==3)
													<a href="javascript:void(0)" class="btncss btn btn-danger remove">删除订单</a>
													@endif
												</td>
											</tr>
											<?php $is=false ?>
											@else
											<tr>
												<td><span class="font">{{$odl->gname}}</span></td>
												<td>{{$odl->num}}</td>
												<td>{{$odl->price}}</td>
												<td>{{$odl->price*$odl->discount}}</td>
											</tr>
											@endif
										@endforeach
									@endforeach
										</tbody>
									</table>
									<div style="width: 100%; text-align: center;">
										@if(count($orderList)!=1&&count($orderList)!=0)
										{!! $orderList->render() !!}
										@endif
									</div>
									@else
										<div class="order-fail">没有任何相关信息！</div>
									@endif
									
								</div>
							</div>
							<div class="tab-pane fade" id="orderwait">
								<div class="order-table">
									@if(count($norderList)!=0)
										<table>
										<tbody>
											<tr>
												<th>订单号</th>
												<th>用户Id</th>
												<th>商品名</th>
												<th>数量</th>
												<th>单价</th>
												<th>折扣价</th>
												<th>小计</th>
												<th>订单状态</th>
												<th>物流状态</th>
												<th>操作</th>
											</tr>
											@foreach($norderList as $ol)
											<?php $is=true ?>
												<?php $total=0 ?>
											@foreach($ol->orderDetail as $odl)
										
											<?php $total+=$odl->price*$odl->discount*$odl->num ?>
											@endforeach
											@foreach($ol->orderDetail as $odl)
											@if($is)
											<tr>
												<td rowspan="{{count($ol->orderDetail)}}"><span>{{$ol->ocode}}</span><br/>
													<span class="font1">[{{$ol->created_at}}]</span>
												</td>
												<td rowspan="{{count($ol->orderDetail)}}">{{$ol->uid}}</td>
												<td><span class="font">{{$odl->gname}}</span></td>
												<td>{{$odl->num}}</td>
												<td>{{$odl->price}}</td>
												<td>{{$odl->price*$odl->discount}}</td>
												<td rowspan="{{count($ol->orderDetail)}}">{{$total}}</td>
												@if($ol->orderStatus->osid==1||$ol->orderStatus->osid==3)
												<td rowspan="{{count($ol->orderDetail)}}" style="color: red;">{{$ol->orderStatus->status}}</td>
												@else
												<td rowspan="{{count($ol->orderDetail)}}" style="color: green;">{{$ol->orderStatus->status}}</td>
												@endif
												@if($ol->goodsStatus->gsid==1)
												<td rowspan="{{count($ol->orderDetail)}}" style="color: red;">{{$ol->goodsStatus->status}}</td>
												@else
												<td rowspan="{{count($ol->orderDetail)}}" style="color: green;">{{$ol->goodsStatus->status}}</td>
												@endif
												<td rowspan="{{count($ol->orderDetail)}}">
													<input type="hidden" value="{{$ol->oid}}" />
														<a href="{{URL('admin/order')}}/{{$ol->oid}}" class="btncss btn btn-info">订单详情</a>
													@if(($ol->orderStatus->osid==2)&&($ol->goodsStatus->gsid==1))
													<a href="javascript:void(0)" class="btncss btn btn-primary sendgoods">发货</a>
													@endif
												
													@if($ol->orderStatus->osid==4||$ol->orderStatus->osid==3)
													<a href="javascript:void(0)" class="btncss btn btn-danger remove">删除订单</a>
													@endif
												</td>
											</tr>
											<?php $is=false ?>
											@else
											<tr>
												<td><span class="font">{{$odl->gname}}</span></td>
												<td>{{$odl->num}}</td>
												<td>{{$odl->price}}</td>
												<td>{{$odl->price*$odl->discount}}</td>
											</tr>
											@endif
										@endforeach
									@endforeach
										</tbody>
									</table>
									<div style="width: 100%; text-align: center;">
										{!! $norderList->render() !!}
									</div>
										@else
										<div class="order-fail">没有任何相关信息！</div>
									@endif
									
								</div>
							</div>
							<div class="tab-pane fade" id="orderalready">
								<div class="order-table">
									@if(count($worderList)!=0)
										<table>
										<tbody>
											<tr>
												<th>订单号</th>
												<th>用户Id</th>
												<th>商品名</th>
												<th>数量</th>
												<th>单价</th>
												<th>折扣价</th>
												<th>小计</th>
												<th>订单状态</th>
												<th>物流状态</th>
												<th>操作</th>
											</tr>
											@foreach($worderList as $ol)
											<?php $is=true ?>
												<?php $total=0 ?>
											@foreach($ol->orderDetail as $odl)
										
											<?php $total+=$odl->price*$odl->discount*$odl->num ?>
											@endforeach
											@foreach($ol->orderDetail as $odl)
											@if($is)
											<tr>
												<td rowspan="{{count($ol->orderDetail)}}"><span>{{$ol->ocode}}</span><br/>
													<span class="font1">[{{$ol->created_at}}]</span>
												</td>
												<td rowspan="{{count($ol->orderDetail)}}">{{$ol->uid}}</td>
												<td><span class="font">{{$odl->gname}}</span></td>
												<td>{{$odl->num}}</td>
												<td>{{$odl->price}}</td>
												<td>{{$odl->price*$odl->discount}}</td>
												<td rowspan="{{count($ol->orderDetail)}}">{{$total}}</td>
												@if($ol->orderStatus->osid==1||$ol->orderStatus->osid==3)
												<td rowspan="{{count($ol->orderDetail)}}" style="color: red;">{{$ol->orderStatus->status}}</td>
												@else
												<td rowspan="{{count($ol->orderDetail)}}" style="color: green;">{{$ol->orderStatus->status}}</td>
												@endif
												@if($ol->goodsStatus->gsid==1)
												<td rowspan="{{count($ol->orderDetail)}}" style="color: red;">{{$ol->goodsStatus->status}}</td>
												@else
												<td rowspan="{{count($ol->orderDetail)}}" style="color: green;">{{$ol->goodsStatus->status}}</td>
												@endif
												<td rowspan="{{count($ol->orderDetail)}}">
													<input type="hidden" value="{{$ol->oid}}" />
														<a href="{{URL('admin/order')}}/{{$ol->oid}}" class="btncss btn btn-info">订单详情</a>
													@if(($ol->orderStatus->osid==2)&&($ol->goodsStatus->gsid==1))
													<a href="javascript:void(0)" class="btncss btn btn-primary sendgoods">发货</a>
													@endif
													@if($ol->orderStatus->osid==4||$ol->orderStatus->osid==3)
													<a href="javascript:void(0)" class="btncss btn btn-danger remove">删除订单</a>
													@endif
												</td>
											</tr>
											<?php $is=false ?>
											@else
											<tr>
												<td><span class="font">{{$odl->gname}}</span></td>
												<td>{{$odl->num}}</td>
												<td>{{$odl->price}}</td>
												<td>{{$odl->price*$odl->discount}}</td>
											</tr>
											@endif
										@endforeach
									@endforeach
										</tbody>
									</table>
									<div style="width: 100%; text-align: center;">
										{!! $worderList->render() !!}
									</div>
										@else
										<div class="order-fail">没有任何相关信息！</div>
									@endif
									
								</div>
							</div>
							<div class="tab-pane fade" id="ordersign">
								<div class="order-table">
									@if(count($rworderList)!=0)
										<table>
										<tbody>
											<tr>
												<th>订单号</th>
												<th>用户Id</th>
												<th>商品名</th>
												<th>数量</th>
												<th>单价</th>
												<th>折扣价</th>
												<th>小计</th>
												<th>订单状态</th>
												<th>物流状态</th>
												<th>操作</th>
											</tr>
											@foreach($rworderList as $ol)
											<?php $is=true ?>
												<?php $total=0 ?>
											@foreach($ol->orderDetail as $odl)
										
											<?php $total+=$odl->price*$odl->discount*$odl->num ?>
											@endforeach
											@foreach($ol->orderDetail as $odl)
											@if($is)
											<tr>
												<td rowspan="{{count($ol->orderDetail)}}"><span>{{$ol->ocode}}</span><br/>
													<span class="font1">[{{$ol->created_at}}]</span>
												</td>
												<td rowspan="{{count($ol->orderDetail)}}">{{$ol->uid}}</td>
												<td><span class="font">{{$odl->gname}}</span></td>
												<td>{{$odl->num}}</td>
												<td>{{$odl->price}}</td>
												<td>{{$odl->price*$odl->discount}}</td>
												<td rowspan="{{count($ol->orderDetail)}}">{{$total}}</td>
											@if($ol->orderStatus->osid==1||$ol->orderStatus->osid==3)
												<td rowspan="{{count($ol->orderDetail)}}" style="color: red;">{{$ol->orderStatus->status}}</td>
												@else
												<td rowspan="{{count($ol->orderDetail)}}" style="color: green;">{{$ol->orderStatus->status}}</td>
												@endif
												@if($ol->goodsStatus->gsid==1)
												<td rowspan="{{count($ol->orderDetail)}}" style="color: red;">{{$ol->goodsStatus->status}}</td>
												@else
												<td rowspan="{{count($ol->orderDetail)}}" style="color: green;">{{$ol->goodsStatus->status}}</td>
												@endif
												<td rowspan="{{count($ol->orderDetail)}}">
													<input type="hidden" value="{{$ol->oid}}" />
														<a href="{{URL('admin/order')}}/{{$ol->oid}}" class="btncss btn btn-info">订单详情</a>
													@if($ol->orderStatus->osid==4||$ol->orderStatus->osid==3)
													<a href="javascript:void(0)" class="btncss btn btn-danger remove">删除订单</a>
													@endif
													
												</td>
											</tr>
											<?php $is=false ?>
											@else
											<tr>
												<td><span class="font">{{$odl->gname}}</span></td>
												<td>{{$odl->num}}</td>
												<td>{{$odl->price}}</td>
												<td>{{$odl->price*$odl->discount}}</td>
											</tr>
											@endif
										@endforeach
									@endforeach
										</tbody>
									</table>
									<div style="width: 100%; text-align: center;">
										{!! $rworderList->render() !!}
									</div>
										@else
										<div class="order-fail">没有任何相关信息！</div>
									@endif
									
								</div>
							</div>
							<div class="tab-pane fade" id="ordercancel">
								<div class="order-table">
									@if(count($corderList)!=0)
										<table>
										<tbody>
											<tr>
												<th>订单号</th>
												<th>用户Id</th>
												<th>商品名</th>
												<th>数量</th>
												<th>单价</th>
												<th>折扣价</th>
												<th>小计</th>
												<th>订单状态</th>
												<th>物流状态</th>
												<th>操作</th>
											</tr>
											@foreach($corderList as $ol)
											<?php $is=true ?>
												<?php $total=0 ?>
											@foreach($ol->orderDetail as $odl)
										
											<?php $total+=$odl->price*$odl->discount*$odl->num ?>
											@endforeach
											@foreach($ol->orderDetail as $odl)
											@if($is)
											<tr>
												<td rowspan="{{count($ol->orderDetail)}}"><span>{{$ol->ocode}}</span><br/>
													<span class="font1">[{{$ol->created_at}}]</span>
												</td>
												<td rowspan="{{count($ol->orderDetail)}}">{{$ol->uid}}</td>
												<td><span class="font">{{$odl->gname}}</span></td>
												<td>{{$odl->num}}</td>
												<td>{{$odl->price}}</td>
												<td>{{$odl->price*$odl->discount}}</td>
												<td rowspan="{{count($ol->orderDetail)}}">{{$total}}</td>
												@if($ol->orderStatus->osid==1||$ol->orderStatus->osid==3)
												<td rowspan="{{count($ol->orderDetail)}}" style="color: red;">{{$ol->orderStatus->status}}</td>
												@else
												<td rowspan="{{count($ol->orderDetail)}}" style="color: green;">{{$ol->orderStatus->status}}</td>
												@endif
												@if($ol->goodsStatus->gsid==1)
												<td rowspan="{{count($ol->orderDetail)}}" style="color: red;">{{$ol->goodsStatus->status}}</td>
												@else
												<td rowspan="{{count($ol->orderDetail)}}" style="color: green;">{{$ol->goodsStatus->status}}</td>
												@endif
												<td rowspan="{{count($ol->orderDetail)}}">
													<input type="hidden" value="{{$ol->oid}}" />
													<a href="{{URL('admin/order')}}/{{$ol->oid}}" class="btncss btn btn-info">订单详情</a>
													@if($ol->orderStatus->osid==4||$ol->orderStatus->osid==3)
													<a href="javascript:void(0)" class="btncss btn btn-danger remove">删除订单</a>
													@endif
												</td>
											</tr>
											<?php $is=false ?>
											@else
											<tr>
												<td><span class="font">{{$odl->gname}}</span></td>
												<td>{{$odl->num}}</td>
												<td>{{$odl->price}}</td>
												<td>{{$odl->price*$odl->discount}}</td>
											</tr>
											@endif
										@endforeach
									@endforeach
										</tbody>
									</table>
									<div style="width: 100%; text-align: center;">
										{!! $corderList->render() !!}
									</div>
										@else
										<div class="order-fail">没有任何相关信息！</div>
									@endif
									
								</div>
							</div>
							<div class="tab-pane fade" id="ordercomple">
								<div class="order-table">
									@if(count($rorderList)!=0)
										<table>
										<tbody>
											<tr>
												<th>订单号</th>
												<th>用户Id</th>
												<th>商品名</th>
												<th>数量</th>
												<th>单价</th>
												<th>折扣价</th>
												<th>小计</th>
												<th>订单状态</th>
												<th>物流状态</th>
												<th>操作</th>
											</tr>
											@foreach($rorderList as $ol)
											<?php $is=true ?>
												<?php $total=0 ?>
											@foreach($ol->orderDetail as $odl)
										
											<?php $total+=$odl->price*$odl->discount*$odl->num ?>
											@endforeach
											@foreach($ol->orderDetail as $odl)
											@if($is)
											<tr>
												<td rowspan="{{count($ol->orderDetail)}}"><span>{{$ol->ocode}}</span><br/>
													<span class="font1">[{{$ol->created_at}}]</span>
												</td>
												<td rowspan="{{count($ol->orderDetail)}}">{{$ol->uid}}</td>
												<td><span class="font">{{$odl->gname}}</span></td>
												<td>{{$odl->num}}</td>
												<td>{{$odl->price}}</td>
												<td>{{$odl->price*$odl->discount}}</td>
												<td rowspan="{{count($ol->orderDetail)}}">{{$total}}</td>
												@if($ol->orderStatus->osid==1||$ol->orderStatus->osid==3)
												<td rowspan="{{count($ol->orderDetail)}}" style="color: red;">{{$ol->orderStatus->status}}</td>
												@else
												<td rowspan="{{count($ol->orderDetail)}}" style="color: green;">{{$ol->orderStatus->status}}</td>
												@endif
												@if($ol->goodsStatus->gsid==1)
												<td rowspan="{{count($ol->orderDetail)}}" style="color: red;">{{$ol->goodsStatus->status}}</td>
												@else
												<td rowspan="{{count($ol->orderDetail)}}" style="color: green;">{{$ol->goodsStatus->status}}</td>
												@endif
												<td rowspan="{{count($ol->orderDetail)}}">
													<input type="hidden" value="{{$ol->oid}}" />
													<a href="{{URL('admin/order')}}/{{$ol->oid}}" class="btncss btn btn-info">订单详情</a>
													@if($ol->orderStatus->osid==4||$ol->orderStatus->osid==3)
													<a href="javascript:void(0)" class="btncss btn btn-danger remove">删除订单</a>
													@endif
												</td>
											</tr>
											<?php $is=false ?>
											@else
											<tr>
												<td><span class="font">{{$odl->gname}}</span></td>
												<td>{{$odl->num}}</td>
												<td>{{$odl->price}}</td>
												<td>{{$odl->price*$odl->discount}}</td>
											</tr>
											@endif
										@endforeach
									@endforeach
										</tbody>
									</table>
									<div style="width: 100%; text-align: center;">
										{!! $rorderList->render() !!}
									</div>
										@else
										<div class="order-fail">没有任何相关信息！</div>
									@endif
									
								</div>
							</div>
						</div>
						<div class="modal fade" id="SendModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"   data-backdrop='static' aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				               
				            </div>
				            <div class="modal-body" style="color: green;text-align: center;">发货成功！<span class="glyphicon glyphicon-ok"></span></div>
				             <div class="modal-footer">
				                <button type="button" id="send_succ" class="btn btn-success" data-dismiss="modal">确定</button>
				            </div>
			        	</div><!-- /.modal-content --> 
			    	</div><!-- /.modal -->
			    </div>
			    <div class="modal fade" id="RmoveOrderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"   data-backdrop='static' aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				               
				            </div>
				            <div class="modal-body" style="color: red;text-align: center;">你确定要删除此订单？<span class="glyphicon glyphicon-remove"></span></div>
				             <div class="modal-footer">
				                <button type="button" id="remove_succ" class="btn btn-danger" data-dismiss="modal">确定</button>
				                <button type="button" id="remove_cancel" class="btn btn-success" data-dismiss="modal">取消</button>
				            </div>
			        	</div><!-- /.modal-content --> 
			    	</div><!-- /.modal -->
			    </div>
@endsection
@section('order')
    style="color:#ff0000;"
@endsection
