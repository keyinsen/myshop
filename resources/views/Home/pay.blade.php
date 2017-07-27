<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>支付成功</title>
		<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}"></link>
		<link rel="stylesheet" href="{{asset('css/home/pay.css')}}"></link>
		<script src="{{asset('js/jquery-1.11.0.js')}}"></script>
		<script src="{{asset('js/bootstrap.js')}}"></script>
		<script src="{{asset('js/home/pay.js')}}"></script>
	</head>
	<body>

		<div class="ct-main">
			<div class="paycuss">
				<span class="font">支付成功!</span>
				
			</div>
			<div class="payfail">
				<span class="font">支付失败!你的余额不足...</span>
			</div>
			<span class="font1">3</span>
			<span >秒后跳转至我的订单界面</span>
			<a href="">马上跳转...</a>
		</div>
		<div class="end"><!--end-->
			<div class="img">
			<img src="{{asset('img/home/index/promise.jpg')}}" />
			</div>
			<div class="endtitle">通讯商城</div>
		</div><!--end-->
	</body>
</html>

