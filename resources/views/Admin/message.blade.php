@extends('Layouts.admin_layouts')
@section('title','消息管理/用户留言')
@section('ct-right')
<ol class="breadcrumb">
					  <li>消息管理</li>
					  <li>用户留言</li>
					</ol>
					<div class="my-mess">
					<ul id="myTab" class="nav nav-tabs">
							<li class="active">
								<a href="#my-mess" data-toggle="tab">用户消息</a>
							</li>
						</ul>
						<div id="myTabContent" class="tab-content">
							<div class="tab-pane fade in active" id="my-mess">
								<div class="mess-table">
									@if(count($mess)!=0)
									<table>
										<tbody>
											<tr>
												<th>编号</th>
												<th>发送者账号</th>
												<th></th>
												<th>操作</th>
											</tr>
											<?php $is=true; ?>
											<?php for($i=0;$i<count($mess);$i++): ?>
											@if($is)
											<tr>
												<td>{{$mess[$i]->mid}}</td>
												<td>{{$mess[$i]->sendname}}</td>
												@if($mess[$i]->state==0)
												<td><span class="font">有此人未读留言消息!</span></td>
												@else
												<td><span>没有新的留言消息</span></td>
												@endif
												<td>
													<a href="{{URL('admin/message')}}/{{$mess[$i]->sendid}}" class="btn btn-info" style="border-radius: 0px;display: inline-block;">查看</a>
													<form method="post" action="{{URL('admin/message',$mess[$i]->sendid)}}" style="display: inline-block;">
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
												<td>{{$mess[$i]->sendname}}</td>
												@if($mess[$i]->state==0)
												<td><span class="font">有此人未读留言消息!</span></td>
												@else
												<td><span>没有新的留言消息</span></td>
												@endif
												<td>
													<a href="{{URL('admin/message')}}/{{$mess[$i]->sendid}}" class="btn btn-info" style="border-radius: 0px;display: inline-block;">查看</a>
													<form method="post" action="{{URL('admin/message',$mess[$i]->sendid)}}" style="display: inline-block;">
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
@section('mess')
    style="color:#ff0000;"
@endsection