@extends('Layouts.user_layouts')
@section('title','我的评价')
@section('head')
@parent           
@show
@section('ct-right')
<div class="ct-right-head">
	我的评价
</div>
<div class="evaluate">
	<ul id="myTab" class="nav nav-tabs">
		<li class="active">
			<a href="#evaluate-me" data-toggle="tab">来自我的评价</a>
		</li>
	</ul>
	<div id="myTabContent" class="tab-content">
		<div class="tab-pane fade in active" id="evaluate-me">
			<div class="evaluate-table">
				@if(count($evaluate)!=0)
				<table>
					<tbody>
						<tr>
							<th>评价</th>
							<th>评价内容</th>
							<th>评价人</th>
							<th>商品信息</th>
							<th>操作</th>
						</tr>
						@foreach($evaluate as $el)
						<tr>
							<td>
								@if($el->evascore==0)
								<span class="glyphicon glyphicon-heart"></span>
								@endif
								@if($el->evascore==1)
								<span class="evaluate-font1 glyphicon glyphicon-heart"></span>
								@endif
								@if($el->evascore==2)
								<span class="evaluate-font1 glyphicon glyphicon-heart"></span>
								<span class="evaluate-font1 glyphicon glyphicon-heart"></span>
								@endif
								@if($el->evascore==3)
								<span class="evaluate-font1 glyphicon glyphicon-heart"></span>
								<span class="evaluate-font1 glyphicon glyphicon-heart"></span>
								<span class="evaluate-font1 glyphicon glyphicon-heart"></span>
								@endif
								@if($el->evascore==4)
								<span class="evaluate-font1 glyphicon glyphicon-heart"></span>
								<span class="evaluate-font1 glyphicon glyphicon-heart"></span>
								<span class="evaluate-font1 glyphicon glyphicon-heart"></span>
								<span class="evaluate-font1 glyphicon glyphicon-heart"></span>
								@endif
								@if($el->evascore==5)
								<span class="evaluate-font1 glyphicon glyphicon-heart"></span>
								<span class="evaluate-font1 glyphicon glyphicon-heart"></span>
								<span class="evaluate-font1 glyphicon glyphicon-heart"></span>
								<span class="evaluate-font1 glyphicon glyphicon-heart"></span>
								<span class="evaluate-font1 glyphicon glyphicon-heart"></span>
								@endif
								
							</td>
							<td>
								<span class="evaluate-font2">{{$el->evadescript}}</span>
								<p class="time">[{{$el->evatime}}]<p/>
							</td>
							<td>
								<span>(本人)</span>
							</td>
							<td>
								<a class="evaluate-a" href="{{URL('home/goodsinfo')}}/{{$el->goods->gid}}">{{$el->goods->gname}}</a>
								<span class="evaluate-price">{{$el->goods->price*$el->goods->discount}}</span>
								<span>元</span>
							</td>
							<td>
								<form method="post" action="{{URL('home/evaluate',$el->gid)}}">
  	    						{{csrf_field()}}
  	     						<input type="hidden" name="_method" value="delete"/>
  	     						<button  type="submit" class="btn btn-danger" style="border-radius: 0px;">删除</button>
  	     						</form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@else
				<div style="width: 100%;margin-top: 20px;text-align: center;">你没有任何对商品评价的信息</div>
				@endif
				
			</div>
		</div>
	</div>
</div>
@endsection
@section('evaluate')
    style="background-color: #FFFFFF; border-right: #FFFFFF;"
@endsection



