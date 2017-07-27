@extends('Layouts.home_layouts')
@section('title','商品评价')
@section('meta')
<meta name="_token" content="{{ csrf_token() }}"/>
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('css/home/evaluate.css')}}"></link>
@endsection
@section('js')
<script src="{{asset('js/home/evaluate.js')}}"></script>
@endsection
@section('content')
		<!--<div class="ct-main">
			<div class="container-fluid">
				<div class="ct-main-left col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<div class="img">
						<img src="../public/evaluate/img/aa.jpg" />
					</div>
				</div>
				<div class="ct-main-right col-lg-8 col-md-8 col-sm-8 col-xs-8">
					<p class="title">【直降200】Xiaomi/小米 小米手机5 全网通标准版 4g智能拍照手机</p>
					<div class="goodssrow">
						<span class="goodssrow-font1">原价</span>
						<span class="goodssrow-font2">￥</span>
						<span class="goodssrow-font3">1995</span>
					</div>
					<div class="goodssrow">
						<span class="goodssrow-font1">折扣价</span>
						<span class="goodssrow-font4">￥</span>
						<span class="goodssrow-font5">995.00</span>
					</div>
					<div class="goodssrow">
						<span class="goodssrow-font1">快递费</span>
						<span class="goodssrow-font2">￥</span>
						<span>0.00</span>
					</div>
					<div class="goodskey">
						<span class="goodssrow-font1">版本</span>
						<a href="javascript:void(0)">全网通4G版</a>
					</div>
					<div class="goodskey">
						<span class="goodssrow-font1">内存容量</span>
						<a href="javascript:void(0)">4G</a>
					</div>
					<div class="goodssrow">
						<span class="goodssrow-font1">购买时间</span>
						<span class="goodssrow-font2">2016-09-08 13:25:28</span>
						<span>0.00</span>
					</div>
				</div>
			</div>
		</div>-->
		@foreach($goodList as $gl)
<div class="goodsdetail">
	<input type="hidden" class="gid" value="{{$gl->gid}}"/>
	<div class="container-fluid">
		<div class="evaluate-ct col-xs-6">
			<span class="evaluate-ct-font">其他买家，需要你的建议哦</span>
			<label class="evaluate-after" for="evaluate-after">售后评价:</label>
			<textarea class="form-control text"  rows="3" cols="25" maxlength="100" placeholder="商品评价字数限制在100个字以内"></textarea>
			<label>为商品评分:</label>
			<div class="radio">
				<label>
					<input type="radio" name="blankRadio{{$gl->gid}}" class="blankRadio{{$gl->gid}}" value="0">
					<span class="glyphicon glyphicon-heart"></span> (0分 差评)
				</label>
				<label>
					<input type="radio" name="blankRadio{{$gl->gid}}"  class="blankRadio{{$gl->gid}}" value="1">
					<span class="red glyphicon glyphicon-heart"></span> (1分 一般)
				</label>
				<label>
					<input type="radio" name="blankRadio{{$gl->gid}}" class="blankRadio{{$gl->gid}}"  value="2">
					<span class="red glyphicon glyphicon-heart"></span>
					<span class="red glyphicon glyphicon-heart"></span> (2分 还行)
				</label>
				<label>
					<input type="radio" name="blankRadio{{$gl->gid}}" class="blankRadio{{$gl->gid}}"  value="3">
					<span class="red glyphicon glyphicon-heart"></span>
					<span class="red glyphicon glyphicon-heart"></span>
					<span class="red glyphicon glyphicon-heart"></span> (3分 中评)
				</label>
				<label>
					<input type="radio" name="blankRadio{{$gl->gid}}" class="blankRadio{{$gl->gid}}"  value="4">
					<span class="red glyphicon glyphicon-heart"></span>
					<span class="red glyphicon glyphicon-heart"></span>
					<span class="red glyphicon glyphicon-heart"></span>
					<span class="red glyphicon glyphicon-heart"></span> (4分 好评)
				</label>
				<label>
					<input type="radio" name="blankRadio{{$gl->gid}}" class="blankRadio{{$gl->gid}}" value="5">
					<span class="red glyphicon glyphicon-heart"></span>
					<span class="red glyphicon glyphicon-heart"></span>
					<span class="red glyphicon glyphicon-heart"></span>
					<span class="red glyphicon glyphicon-heart"></span>
					<span class="red glyphicon glyphicon-heart"></span> (5分 较好)
				</label>
			</div>
		</div>
		<div class="evaluate-right col-xs-6">
			<p class="title">{{$gl->gname}}</p>
			<div class="goodssrow">
				<span class="goodssrow-font1">原价</span>
				<span class="goodssrow-font2">￥</span>
				<span class="goodssrow-font3">{{$gl->price}}</span>
			</div>
			<div class="goodssrow">
				<span class="goodssrow-font1">折扣价</span>
				<span class="goodssrow-font4">￥</span>
				<span class="goodssrow-font5">{{$gl->price*$gl->discount}}</span>
			</div>
			<div class="goodssrow">
				<span class="goodssrow-font1">快递费</span>
				<span class="goodssrow-font2">￥</span>
				<span>0.00</span>
			</div>
		</div>
	</div>
</div>
@endforeach
<div style="width: 100%; text-align: center;color: red;height: 20px;" class="error"></div>
<div style="width: 100%; text-align: center;">
	<button class="btn btn-success" id="evaluate_st">提交评价</button>
	<button class="btn btn-danger cancel">取消</button>
</div>
<div class="modal fade" id="evaluateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop='static' aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				            </div>
				            <div class="modal-body" style="color: green;text-align: center;">评论成功！<span class="glyphicon glyphicon-ok"></span></div>
				             <div class="modal-footer">
				                <button type="button" id="eva_succ" class="btn btn-success" data-dismiss="modal">确定</button>
				            </div>
			        	</div><!-- /.modal-content --> 
			    	</div><!-- /.modal -->
			    	  </div>
@endsection

