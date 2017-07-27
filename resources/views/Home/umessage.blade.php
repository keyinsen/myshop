@extends('Layouts.user_layouts')

@section('title','我的消息')
@section('head')
@parent           
@show
@section('ct-right')
<div class="ct-right-head">
						我的消息
					</div>
					<div class="my-mess">
					<ul id="myTab" class="nav nav-tabs">
							<li class="active">
								<a href="#my-mess" data-toggle="tab">我的消息</a>
							</li>
						</ul>
						<div id="myTabContent" class="tab-content">
							<div class="tab-pane fade in active" id="my-mess">
								<div class="mess-table">
									@if(count($mess)!=0)
									<table>
										<tbody>
											<tr>
												<th>留言编号</th>
												<th>发送者</th>
												<th></th>
												<th>操作</th>
											</tr>
											<?php $is=true; ?>
											<?php for($i=0;$i<count($mess);$i++): ?>
											@if($is)
											<tr>
												<td>{{$mess[$i]->mid}}</td>
												<td>{{$mess[$i]->sendname}}客服</td>
												@if($mess[$i]->state==0)
												<td><span class="font">有此人未读留言消息!</span></td>
												@else
												<td><span>没有新的留言消息</span></td>
												@endif
										
												<td>
													<a href="{{URL('home/message')}}/{{$mess[$i]->sendid}}" class="btn btn-info" style="border-radius: 0px;display: inline-block;">查看</a>
													<form method="post" action="{{URL('home/message',$mess[$i]->sendid)}}"style="display: inline-block;">
		  	    										{{csrf_field()}}
		  	     									<input type="hidden" name="_method" value="delete"/>
		  	     									<button  type="submit" class="btn btn-danger" style="border-radius: 0px;display: inline-block;">删除</button>
		  	     									</form>
												</td>
											</tr>
											<?php $is=false; ?>
											@else
											 @if($i<=count($mess))
												@if($mess[$i]->sendid!=$mess[$i-1]->sendid)
											<tr>
												<td>{{$mess[$i]->mid}}</td>
												<td>{{$mess[$i]->sendname}}客服</td>
												@if($mess[$i]->state==0)
												<td><span class="font">有此人未读留言消息!</span></td>
												@else
												<td><span>没有新的留言消息</span></td>
												@endif
												<td>
													<a href="{{URL('home/message')}}/{{$mess[$i]->sendid}}" class="btn btn-info" style="border-radius: 0px;display: inline-block;">查看</a>
													<form method="post" action="{{URL('home/message',$mess[$i]->sendid)}}" style="display: inline-block;">
		  	    										{{csrf_field()}}
		  	     									<input type="hidden" name="_method" value="delete"/>
		  	     									<button  type="submit" class="btn btn-danger" style="border-radius: 0px;display: inline-block;">删除</button>
		  	     									</form>
												</td>
											</tr>
												@endif
											 @endif
											@endif
											<?php endfor; ?>
										</tbody>
									</table>
									@else
									<div style="width: 100%;text-align: center;">无任何留言消息</div>
									@endif
								</div>
							</div>
							
					</div>	
			</div>
@endsection
@section('message')
    style="background-color: #FFFFFF; border-right: #FFFFFF;"
@endsection

