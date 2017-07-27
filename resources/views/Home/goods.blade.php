@extends('Layouts.home_layouts')
@section('meta')
<meta name="_token" content="{{ csrf_token() }}"/>
@endsection
@section('title','商品详情')
@section('css')
<link rel="stylesheet" href="{{asset('css/home/goods.css')}}"></link>
@endsection
@section('js')
<script src="{{asset('js/home/goods1.js')}}"></script>
@endsection
@section('content')
<div class="ct-main">
			<div class="container-fluid">
				<div class="ct-main-left col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<div class="img">
						<img src="{{$goodsInfo->img_path1}}" />
					</div>
				</div>
				<div class="ct-main-right col-lg-8 col-md-8 col-sm-8 col-xs-8">
					<p id="ginfogname" class="title">{{$goodsInfo->gname}}</p>
					<div class="goodssrow">
						<span class="goodssrow-font1">商品描述</span>
						@if($goodsInfo->descript!=null)
						<span class="goodssrow-font2">{{$goodsInfo->descript}}</span>
						@else
						<span class="goodssrow-font2">暂无</span>
						@endif
					</div>
					<div class="goodssrow">
						<span class="goodssrow-font1">快递费</span>
						<span class="goodssrow-font2">￥</span>
						<span>0.00</span>
					</div>
					<div class="goodssrow">
						<span class="goodssrow-font1">原价</span>
						<span class="goodssrow-font2">￥</span>
						<span id="ginfoprice" class="goodssrow-font3">{{$goodsInfo->price}}</span>
					</div>
					<div class="goodssrow">
						<span class="goodssrow-font1">折扣价</span>
						<span class="goodssrow-font4">￥</span>
						<span id="ginfodiscount" class="goodssrow-font5">{{$goodsInfo->discount*$goodsInfo->price}}</span>
					</div>
					<input id="ginfogid" type="hidden" value="{{$goodsInfo->gid}}" />
					<input id="ginfoimg" type="hidden" value="{{$goodsInfo->img_path}}" />
					<div class="goodssrow">
						<span class="goodssrow-font1 count">数量</span>
						<div class="input-group">
						  <span class="input-group-addon deccount">-</span>
						  <input type="text" id="ginfocount" name="count" class="form-control" maxlength="2" value="1">
						  <span class="input-group-addon addcount">+</span>
						</div>
					</div>
					<div class="goodssrow">
						<span class="goodssrow-font1">库存</span>
						<span class="goodssrow-font4 kucount">{{$goodsInfo->num}}</span>
						<span class="goodssrow-font1">件</span>
					</div>
					<div class="action">
						<a href="javascript:void(0)" id="goodspay" class="btn btn-success">确认购买</a>
						<a href="javascript:void(0)" id="ginfocart" class="btn btn-danger"><span class="glyphicon glyphicon-shopping-cart"></span>加入购物车</a>
						<a href="javascript:void(0)" class="btn btn-info addcollect">收藏商品</a>
						
					</div>
				</div>
			</div>
		</div>
		<div class="goodsdetail">
			<ul id="myTab" class="nav nav-tabs">
				<li class="active">
					<a href="#detail" data-toggle="tab">商品详情</a>
				</li>
				<li>
					<a href="#evaluate" data-toggle="tab">商品评价</a>
				</li>
				<li>
					<a href="#messages" data-toggle="tab">给商家留言</a>
				</li>
			</ul>
			<div id="myTabContent" class="tab-content">
				<div class="tab-pane fade in active" id="detail">
					<div class="container-fluid">
						<div class="detail">
							<ul>
								<li><span>所属类别：</span><span>{{$goodsType->cname}}类</span></li>
								@foreach($goodsAttrVal as $gattr)
								<li><span>{{$gattr->attrname->title}}：</span><span>{{$gattr->value}}</span></li>
								@endforeach
							</ul>
						</div>
					</div>
					<div style="width: 85%;margin-top: 30px;">
						@if(!empty($goodsInfo->img_path2))
						<img src="{{$goodsInfo->img_path2}}" width="100%"/>
						@endif
						@if(!empty($goodsInfo->img_path3))
						<img src="{{$goodsInfo->img_path3}}" width="100%"/>
						@endif
					</div>
				</div>
				<div class="tab-pane fade" id="evaluate">
					<div class="evaluates">
						<div class="evaluates-head">
							<span class="evaluates-head-font1">共有</span>
							<span class="evaluates-head-font2">{{count($evaluate)}}</span>
							<span class="evaluates-head-font1">人评价了商品</span>
							<span class="evaluates-head-font3">好评</span>
							<span class="evaluates-head-font2">{{count($evaluategoods)}}</span>
							<span class="evaluates-head-font3">中评</span>
							<span class="evaluates-head-font2">{{count($evaluatezgoods)}}</span>
							<span class="evaluates-head-font3">差评</span>
							<span class="evaluates-head-font2">{{count($evaluatengoods)}}</span>
						</div>
						@foreach($evaluate as $el)
						<div class="evaluates-user">
							<div class="evaluates-user-head">
								<?php $uname1=mb_substr($el->user->uname,0,1) ?>
								<?php $uname2=substr($el->user->uname,-2) ?>	
								<span>{{$uname1.'***'.$uname2}}</span>
								<span class="glyphicon glyphicon-comment"></span>
								<span>{{$el->evatime}}</span>
								@if($el->evascore==0)
								<span class="glyphicon glyphicon-heart"></span>
								@endif
								@if($el->evascore==1)
								<span class="red glyphicon glyphicon-heart"></span>
								@endif
								@if($el->evascore==2)
								<span class="red glyphicon glyphicon-heart"></span>
								<span class="red glyphicon glyphicon-heart"></span>
								@endif
								@if($el->evascore==3)
								<span class="red glyphicon glyphicon-heart"></span>
								<span class="red glyphicon glyphicon-heart"></span>
								<span class="red glyphicon glyphicon-heart"></span>
								@endif
								@if($el->evascore==4)
								<span class="red glyphicon glyphicon-heart"></span>
								<span class="red glyphicon glyphicon-heart"></span>
								<span class="red glyphicon glyphicon-heart"></span>
								<span class="red glyphicon glyphicon-heart"></span>
								@endif
								@if($el->evascore==5)
								<span class="red glyphicon glyphicon-heart"></span>
								<span class="red glyphicon glyphicon-heart"></span>
								<span class="red glyphicon glyphicon-heart"></span>
								<span class="red glyphicon glyphicon-heart"></span>
								<span class="red glyphicon glyphicon-heart"></span>
								@endif
							</div>
							<div class="evaluates-user-ct">
								<span>{{$el->evadescript}}</span>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				<div class="tab-pane fade" id="messages">
					<div class="container-fluid">
						<div class="admin-message">
							@foreach($admin as $ad)
							<a href="{{URL('home/message')}}/{{$ad->admin_id}}" target="_blank" class="btn btn-primary"><span class="glyphicon glyphicon-headphones"></span>{{$ad->nickname}}</a>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	
</div>
@endsection


