@extends('Layouts.admin_layouts')
@section('meta')
<meta name="_token" content="{{ csrf_token() }}"/>
@endsection
@section('js')
<script src="{{asset('js/admin/evaluate.js')}}"></script>
@endsection
@section('title','评价管理/用户评价')
@section('ct-right')
<ol class="breadcrumb">
					  <li>评价管理</li>
					  <li>用户评价</li>
					</ol>
					<div class="evaluate">
					<ul id="myTab" class="nav nav-tabs">
							<li class="active">
								<a href="#evaluate-me" data-toggle="tab">用户的评价</a>
							</li>
						</ul>
						<div id="myTabContent" class="tab-content">
							<div class="tab-pane fade in active" id="evaluate-me">
								<div class="evaluate-table">
									@if(count($evaluate)!=0)
									<table>
										<tbody>
											<tr>
												<th><input type="checkbox" class="allcheckbox"/></th>
												<th>编号</th>
												<th>用户ID</th>
												<th>用户昵称/账户</th>
												<th>评价</th>
												<th>评价内容</th>
												<th>商品信息</th>
												<th>操作</th>
											</tr>
											@foreach($evaluate as $el)
											<tr>
												<td><input type="checkbox" class="ischeckbox"/></td>
												<td class="eva_id">{{$el->eva_id}}</td>
												<td>{{$el->uid}}</td>
												<td>
													@if(empty($el->user->nickname))
													{{$el->user->uname}}
													@else
													{{$el->user->nickname}}
													@endif
												</td>
												<td>{{$el->evascore}}</td>
												<td>
													<span class="font">{{$el->evadescript}}</span>
													<p class="time">[{{$el->evatime}}]</p>
												</td>
												<td><a href="{{URL('home/goodsinfo')}}/{{$el->goods->gid}}">{{$el->goods->gname}}</a></td>
												<td>
													<a href="javascript:void(0)" class="btn btn-danger evremove" style="border-radius: 0px;">删除</a>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
									<div class="manallbtn" >
										<a href="javascript:void(0)" class="btn btn-danger allremove" >筛选删除</a>
									</div>
									<div class="fenye">
									</div>
									@else
									<div style="width: 100%;margin-top: 20px;text-align: center;">没有用户对商品进行评价</div>
									@endif
								</div>
							</div>
							
					</div>	
			</div>
			<div class="modal fade" id="EvaluateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop='static' aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				               
				            </div>
				            <div class="modal-body" style="color: red;">你确定要删除当前选中的用户评价？<span class="glyphicon glyphicon-remove"></span></div>
				             <div class="modal-footer">
				                <button type="button" id="evaluate_succ" class="btn btn-danger" data-dismiss="modal">确定</button>
				                <button type="button" id="evaluate_cancel" class="btn btn-info" data-dismiss="modal">取消</button>
				            </div>
			        	</div><!-- /.modal-content --> 
			    	</div><!-- /.modal -->
			    </div>
			    	<div class="modal fade" id="EvaluatefailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop='static' aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				            </div>
				            <div class="modal-body"style="color: red;">你并没有选择任何可删除的评价信息<span class="glyphicon glyphicon-remove"></span></div>
				             <div class="modal-footer">
				                <button type="button" id="evaluate_fail" class="btn btn-danger" data-dismiss="modal">确定</button>
				            </div>
			        	</div><!-- /.modal-content --> 
			    	</div><!-- /.modal -->
			    	  </div>
@endsection

@section('evaluate')
    style="color:#ff0000;"
@endsection
