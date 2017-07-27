@extends('Layouts.home_layouts')
@section('title','商品分类')
@section('css')
<link rel="stylesheet" href="{{asset('css/home/Category.css')}}"></link>
@endsection
@section('js')
<script src="{{asset('js/home/Category.js')}}"></script>
<script src="{{asset('js/home.js')}}"></script>
@endsection
@section('content')
		<div class="content-main">
			<!--类别部分-->
			<div class="container-fluid">
				<div class="content-left col-lg-2  col-md-2 col-sm-2 col-xs-2">
					<!--左边类别列表-->
					@include('widgets.categorys')
				</div><!--content-left-->
				<div class="content-right col-lg-10 col-md-10 col-sm-10 col-xs-10">
					<div class="ct-right-up">
						<div class="ct-head1">
							@if(!empty($typename))	
							<span class="ct-head1-span">{{$typename['cname']}}</span>
							@endif
							<span class="font1">商品筛选</span>
							@if(is_object($goodsList)&&(!empty($goodsList)))
							<span>(共</span><span class="font">{{$goodsList->total()}}</span><span>件商品)</span>
							@else
							  @if($goodsData!=null)
							     <span>(共</span><span class="font">{{$goodsData['paginator']->total()}}</span><span>件商品)</span>
							  @endif
							@endif
						</div>
						<div class="ct-head2">
							<span>你筛选条件:</span>
							@if(!empty($chose))
							@foreach($chose as $ch)
							@if(empty($ch['url']))
							<a href="{{URL('home/category')}}/{{$ch['cid']}}">	
								<span>{{$ch['name']}}:</span><span class="red">{{$ch['value']}} </span><span class="glyphicon glyphicon-remove-circle"></span>
							</a>
							@else
							<a href="{{URL('home/category?')}}{{$ch['url']}}">	
								<span>{{$ch['name']}}:</span><span class="red">{{$ch['value']}} </span><span class="glyphicon glyphicon-remove-circle"></span>
							</a>
							@endif
							@endforeach
							@endif
						</div>
						@if($categoryType!=null)
						@foreach($categoryType as $cate)
							  	<ul class="ct-ul">
								<li>{{$cate->title}}:</li>
								@foreach($cate->attrValues as $attrvalue)
								@if(empty($_GET['page'])&&(!empty($_GET))&&(empty($_GET['key'])))						 
								    <li><a class="ct-ul-a" href="{{URL('home/category?')}}{{$strget}}&{{$cate->title}}={{$attrvalue->avid}}_{{$attrvalue->attr_id}}_{{$attrvalue->value}}_{{$cate->cid}}">{{$attrvalue->value}}</a></li>
								@else
								<li><a class="ct-ul-a" href="{{URL('home/category?')}}&{{$cate->title}}={{$attrvalue->avid}}_{{$attrvalue->attr_id}}_{{$attrvalue->value}}_{{$cate->cid}}">{{$attrvalue->value}}</a></li>
								@endif
								@endforeach
							</ul>	
						@endforeach
						@endif
					</div>
					<div class="ct-rt-bom-head">
						<a class="ct-rt-bom-head-a1 ct-rt-bom-head-a red" href="#">综合排序</a>
					</div><!--ct-rt-bom-head-->
					<div class="container-fluid">
						@if(count($goodsList)!=0)
						@if(!empty($goodsList))
					<ul class="shop col-lg-12 col-md-12 col-sm-12 col-xs-12">
					@foreach($goodsList as $row)
					<li class="shoplist col-lg-3 col-md-3 col-sm-3 col-xs-3">
						<input type="hidden" value="{{$row->gid}}" />				
						<a class="a-img" href="{{URL('home/goodsinfo')}}/{{$row->gid}}">
							<img class="col-lg-12 col-md-12 col-sm-12 col-xs-12" src="{{$row->img_path}}" />
							<span class="font1">{{$row->gname}}</span>
						</a><br />
						<div class="price-collect col-xs-6">
						<span class="font3">￥<span>{{$row->price}}</span></span>
						<span class="font5">￥<span>{{$row->price*$row->discount}}</span></span><br>	
						<a  href="javascript:void(0)" class="addcollect">收藏</a>
						</div>								
						<a class="cart col-xs-6" href="javascript:void(0)">加入购物车</a>
					</li>
					@endforeach
				</ul>					
						@endif
						@endif
						@if(!empty($goodsData))
						<ul class="shop col-lg-12 col-md-12 col-sm-12 col-xs-12">
					@foreach($goodsData['goodsData'] as $gl)
					<li class="shoplist col-lg-3 col-md-3 col-sm-3 col-xs-3">
						<input type="hidden" value="{{$gl->gid}}" />				
						<a class="a-img" href="{{URL('home/goodsinfo')}}/{{$gl->gid}}">
							<img class="col-lg-12 col-md-12 col-sm-12 col-xs-12" src="{{$gl->img_path}}" />
							<span class="font1">{{$gl->gname}}</span>
						</a><br />
						<div class="price-collect col-xs-6">
						<span class="font3">￥<span>{{$gl->price}}</span></span>
						<span  class="font5">￥<span>{{$gl->discount*$gl->price}}</span></span><br>	
						<a  href="javascript:void(0)" class="addcollect">收藏</a>
						</div>								
						<a class="cart col-xs-6" href="javascript:void(0)">加入购物车</a>
					</li>
				@endforeach
				</ul>
						@endif
					</div><!--container-fluid-->
					<div class="content-right-end">
						@if(is_object($goodsList))
						
							@foreach ($goodsList as $user)
	        				{{ $user->name }}
	   					    @endforeach
	   					 {!! $goodsList->render() !!}
   					    @else
   					     
   					     @if(!empty($goodsData))
	   					 {!! $goodsData['paginator']->render() !!}
	   					 @endif
   					@endif   					
					</div>
				</div><!--content-right-->
			</div>
			<!--container-fluid-->
		</div>
@endsection