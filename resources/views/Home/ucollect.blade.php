@extends('Layouts.user_layouts')
@section('title','我的收藏')
@section('head')
@parent           
@show
@section('ct-right')
<div class="ct-right-head">
						收藏的商品
					</div>
						<div class="collect-font">您一共收藏了<span class="collect-font1">{{count($collect)}}</span>件商品</div>
						<div class="container-fluid">
						<div class="user-collect1">
							@if(count($collect)!=0)
							@foreach($collect as $ct)
							<div class="user-collect col-lg-3 col-md-3 col-sm-3 col-xs-3">
								<div class="user-collect2">
									<a class="user-collect-a" href="{{URL('home/goodsinfo')}}/{{$ct->goods->gid}}">
										<img  src="{{$ct->goods->img_path}}" />
										<span class="font1">{{$ct->goods->gname}}</span>
									</a><br />					
									<span class="red">￥</span><span class="font2">{{$ct->goods->price*$ct->goods->discount}}</span><br />	
									<form method="post" action="{{URL('home/collect',$ct->goods->gid)}}">
  	    								{{csrf_field()}}
  	     								<input type="hidden" name="_method" value="delete"/>
  	     								<button  type="submit" class="btn btn-danger" style="padding: 0px;border-radius: 0px;">取消收藏</button>
  	     							</form>						
								</div>
							</div>
							@endforeach
							@else
							<div style="width: 100%;text-align: center;">你没有收藏任何商品信息</div>
							@endif
						</div>
					</div><!--container-fluid-->
					<div class="navs">
					</div>
					</div>
					
				</div>
@endsection
@section('collect')
    style="background-color: #FFFFFF; border-right: #FFFFFF;"
@endsection



