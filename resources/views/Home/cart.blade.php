@extends('Layouts.home_layouts')
@section('meta')
<meta name="_token" content="{{ csrf_token() }}"/>
@endsection
@section('title','我的购物车')
@section('css')
<link rel="stylesheet" href="{{asset('css/home/Cart.css')}}"></link>
@endsection
@section('js')
<script src="{{asset('js/home/Cart.js')}}"></script>
<script src="{{asset('js/home.js')}}"></script>
@endsection
@section('content')
		<div class="ct-main">
			@if(count($cartList)!=0)
			<table>
				<tbody>
					<tr>
						<th></th>
						<th></th>
						<th>商品图片</th>
						<th>商品名称</th>
						<th>单价(元)</th>
						<th>数量</th>
						<th>小结(元)</th>
						<th>操作</th>
					</tr>
					@foreach($cartList as $cl)
					<tr>
						<td><input type="hidden" value="{{$cl->gid}}" /></td>
						<td><input type="checkbox" class="cartcheck" name=""  value="{{$cl->cart_id}}" /></td>
						<td><img src="{{$cl->img_path}}"/></td>
						<td><a href="{{URL('home/goodsinfo')}}/{{$cl->gid}}">{{$cl->gname}}</a></td>
						<td>
							<span class="font1 cartprice">{{$cl->price*$cl->discount}}</span>
							<p class="font2 cartprice2">{{$cl->price}}</p>
						</td>
						<td>
							<div class="input-group">
							  <span class="input-group-addon deccount">-</span>
							  <input  type="text" maxlength="2" class="ginfocount form-control" value="{{$cl->num}}">
							  <span class="input-group-addon addcount">+</span>
							</div>
							<div style="color:#FF0000;font-size: 8px;">限购20件</div>
						</td>
						<td>
							<span class="cartxj font3">{{$cl->price*$cl->discount*$cl->num}}</span>
							<p>节省<span class="font4 cartxj2">{{$cl->price*$cl->num-$cl->price*$cl->discount*$cl->num}}</span></p>
						</td>
						<td>
							<a href="javascript:void(0)" class="btn btn-danger cartremove">删除</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<div class="tr"></div>
			<div class="foot">
				<input type="checkbox" class="cartAllcheck" name="" value="" />全选
				<div class="right">
					<span class="right-font1">共</span>
					<span id="jian" class="right-font2">0</span>
					<span class="right-font1">件商品</span>
					<span class="right-font3">商品应付总额:</span>
					<span class="right-font4">￥</span>
					<span id="carttotal" class="right-font4">0</span>
					<a href="javascript:void(0)" disabled="disabled" id="zbtn" class="btn btn-success">去结算</a>
				</div>
			</div>
			@else
			<div class="goodsnot">
				<span>你的购物车没有任何人商品，请赶紧去添加自己喜欢的商品哦</span>
			</div>
			@endif
		</div>
		<div class="modal fade" id="mycartModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body"><span class="glyphicon glyphicon-remove"></span>你确定要删除商品信息？</div>
             <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="cartremove" data-dismiss="modal">确定</button>
                <button type="button" class="btn btn-success" id="cartcancel" data-dismiss="modal">取消</button>
            </div>
        </div><!-- /.modal-content --> 
    </div><!-- /.modal -->
</div>
<div class="modal fade" id="mycartModel2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body"><span class="glyphicon glyphicon-remove"></span></div>
             <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="cartremove" data-dismiss="modal">确定</button>
                <button type="button" class="btn btn-success" id="cartcancel" data-dismiss="modal">取消</button>
            </div>
        </div><!-- /.modal-content --> 
    </div><!-- /.modal -->
</div>
@endsection
