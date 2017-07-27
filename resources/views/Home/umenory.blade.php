@extends('Layouts.user_layouts')
@section('title','账户余额')
@section('head')
@parent           
@show
@section('ct-right')
<div class="ct-right-head">
						账户余额
					</div>
					<div class="ct-right-main">
							<span class="menory-font1">当前账户可用余额</span>
							<span class="menory-font2">{{$userinfo->loan}}</span>
							<span class="menory-font1">元</span>
					</div>
@endsection
@section('menory')
    style="background-color: #FFFFFF; border-right: #FFFFFF;"
@endsection


