@extends('Layouts.admin_layouts')
@section('title','商品管理/商品详情')
@section('ct-right')
<ol class="breadcrumb">
					  <li>商品管理</li>
					  <li><a href="{{URL('admin/goods')}}">商品信息</a></li>
					  <li>商品详情</li>
				</ol>
				<div class="goodsimg">
								<img src="{{$goodsone->img_path}}" alt="..."  class="img-rounded">
								<span>前台商品外部显示的图片</span>
							</div>
				<div class="goods-div">
					<label>商品编号:</label>
      			<span>{{$goodsone->gid}}</span>
				</div>
				<div class="goods-div">
					<label>商品名:</label>
      			<span>{{$goodsone->gname}}</span>
				</div>
				<div class="goods-div">
					<label>所属类别:</label>
      			<span>{{$goodsone->categorys->cname}}</span>
				</div>
				<div class="goods-div">
					<label>商品状态:</label>
					@if($goodsone->status==1)
      			<span style="color: green;">已上架</span>
      			@else
      			<span style="color: red;">未上架</span>
      			@endif
				</div>
				<div class="goods-div">
					<label>上架时间:</label>
					@if(empty($goodsone->store_time))
      			<span>无</span>
      		@else
      			<span>{{$goodsone->store_time}}</span>
      		@endif
				</div>
				<div class="goods-div2">
					<div class="container-fluid" >
						<div class="col-xs-3"style="padding: 0px;">
							<label>成本价:</label>
		      		<span>{{$goodsone->tprice}}</span>
	      		</div>
	      		<div class="col-xs-3"style="padding: 0px;">
							<label>单价:</label>
		      		<span>{{$goodsone->price}}</span>
	      		</div>
	      		<div class="col-xs-3"style="padding: 0px;">
							<label>折扣:</label>
		      		<span>{{$goodsone->discount}}</span>
	      		</div>
	      		<div class="col-xs-3"style="padding: 0px;">
							<label>库存:</label>
		      		<span>{{$goodsone->num}}</span>
	      		</div>
	      	</div>
	     </div>
				<div class="goodsdescript">
					<label>商品描述:</label>
					@if(empty($goodsone->descript))
      			<span>无描述</span>
      			@else
      			<span>{{$goodsone->descript}}</span>
      		@endif
				</div>
			<div class="goods-div2">
					<div class="container-fluid" >
						@foreach($goodattrval as $ga)
						<div class="col-xs-3"style="padding: 0px;">
							<label>{{$ga->attrname->title}}:</label>
		      		<span>{{$ga->value}}</span>
	      		</div>
	      		@endforeach
	      	</div>
	     </div>
@endsection
@section('goods-in')
    in
@endsection
@section('goods')
    style="color:#ff0000;"
@endsection
@section('goods-is')
    style="color:#ff0000;"
@endsection


