@extends('Layouts.admin_layouts')
@section('meta')
<meta name="_token" content="{{ csrf_token() }}"/>
@endsection
@section('js')
<script src="{{asset('js/admin/goodsinfo.js')}}"></script>
@endsection
@section('title','商品管理/商品信息')
@section('ct-right')
<ol class="breadcrumb">
					  <li>商品管理</li>
					  <li class="active">商品信息</li>
					</ol>
					<div class="admin-goods1">
						<form method="post" action="{{URL('admin/goods/searchgoods')}}">
								{{csrf_field()}}
						 <div class="input-group">
						 	  <input type="text" name="goodsname" class="form-control" placeholder="输入商品名称或者编号">
						      <span class="input-group-btn" >
						        <button class="btn btn-default" type="submit">商品查询</button>
						      </span>						      
    					</div><!-- /input-group -->
    				</form>
    				<a href="{{URL('admin/goods')}}" style="color: green;font-weight: bold;">显示全部商品</a>
    			</div>
					<div class="goodsInfo">
					<ul id="myTab" class="nav nav-tabs">
							<li class="active">
								<a href="#goodsAll-me" data-toggle="tab">全部商品</a>
							</li>
							<li >
								<a href="#goodsInfo-me" data-toggle="tab">正在出售的商品</a>
							</li>
							<li>
								<a href="#goodsrely-me" data-toggle="tab">准备出售的商品</a>
							</li>
							<!--<li>
								<a href="#goodsInfo-you" data-toggle="tab">库存不足的商品</a>
							</li>-->
						</ul>
						<div id="myTabContent" class="tab-content">
							<div class="tab-pane fade in active" id="goodsAll-me">
								@if(count($goodsAll)!=0)
								<div class="goodsInfo-table">
									<table>
										<tbody>
											<tr>
												<th><input type="checkbox" class="allcheckbox"/></th>
												<th>编号</th>
												<th>商品名</th>
												<th>商品类别</th>
												<th>库存</th>
												<th>成本价</th>
												<th>单价</th>
												<th>折扣</th>
												<th>出售价</th>
												<th>操作</th>
											</tr>
											@foreach($goodsAll as $gl)
											<tr>
												<td><input type="checkbox" class="ischeckbox"/></td>
												<td class="gid">{{$gl->gid}}</td>
												<td>{{$gl->gname}}</td>
												<td>{{$gl->categorys->cname}}</td>
												<td>{{$gl->num}}</td>
												<td>{{$gl->tprice}}</td>
												<td>{{$gl->price}}</td>
												<td>{{$gl->discount}}</td>
												<td>{{$gl->price*$gl->discount}}</td>
												<td>
													@if($gl->status==0)
													<a href="javascript:void(0)" class="btn btn-primary btnpro shelves">上架</a>
													@endif
													<a href="{{URL('admin/goods')}}/{{$gl->gid}}" class="btn btn-info btnpro">详情</a>
													<a href="{{URL('admin/goods')}}/{{$gl->gid}}/edit" class="btn btn-success btnpro">修改</a>
													<a href="javascript:void(0)" class="btn btn-danger btnpro goodsmove">删除</a>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
									<div class="allbtn">
									<button class="btn btn-danger allremove">筛选删除</button>
								</div>
								<div class="fenye">
						
									{!! $goodsAll->render() !!}
								</div>
								</div>
								@else
								<div style="text-align: center;margin-top: 20px;">没有任何商品信息</div>
								@endif
							</div>
							<div class="tab-pane fade" id="goodsInfo-me">
								@if(count($goodsList)!=0)
								<div class="goodsInfo-table">
									<table>
										<tbody>
											<tr>
												<th><input type="checkbox" class="allcheckbox"/></th>
												<th>编号</th>
												<th>商品名</th>
												<th>商品类别</th>
												<th>库存</th>
												<th>成本价</th>
												<th>单价</th>
												<th>折扣</th>
												<th>出售价</th>
												<th>操作</th>
											</tr>
											@foreach($goodsList as $gl)
											<tr>
												<td><input type="checkbox" class="ischeckbox"/></td>
												<td class="gid">{{$gl->gid}}</td>
												<td><a href="{{URL('home/goodsinfo')}}/{{$gl->gid}}" target="_blank">{{$gl->gname}}</a></td>
												<td>{{$gl->categorys->cname}}</td>
												<td>{{$gl->num}}</td>
												<td>{{$gl->tprice}}</td>
												<td>{{$gl->price}}</td>
												<td>{{$gl->discount}}</td>
												<td>{{$gl->price*$gl->discount}}</td>
												<td>
													@if($gl->status==0)
													<a href="javascript:void(0)" class="btn btn-primary btnpro shelves">上架</a>
													@endif
														<a href="{{URL('admin/goods')}}/{{$gl->gid}}" class="btn btn-info btnpro">详情</a>
													<a href="{{URL('admin/goods')}}/{{$gl->gid}}/edit" class="btn btn-success btnpro">修改</a>
													<a href="javascript:void(0)" class="btn btn-danger btnpro goodsmove">删除</a>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
									<div class="allbtn">
									<button class="btn btn-danger allremove">筛选删除</button>
								</div>
								<div class="fenye">
									
									{!! $goodsList->render() !!}
								</div>
								</div>
								@else
								<div style="text-align: center;margin-top: 20px;">没有在出售的商品信息</div>
								@endif
							</div>
							<div class="tab-pane fade" id="goodsrely-me">
								@if(count($ngoodsList)!=0)
								<div class="goodsInfo-table">
									<table>
										<tbody>
									<tr>
												<th><input type="checkbox" class="allcheckbox"/></th>
												<th>编号</th>
												<th>商品名</th>
												<th>商品类别</th>
												<th>库存</th>
												<th>成本价</th>
												<th>单价</th>
												<th>折扣</th>
												<th>出售价</th>
												<th>操作</th>
											</tr>
											@foreach($ngoodsList as $ngl)
											<tr>
												<td><input type="checkbox" class="ischeckbox"/></td>
												<td class="gid">{{$ngl->gid}}</td>
												<td>{{$ngl->gname}}</td>
												<td>{{$ngl->categorys->cname}}</td>
												<td>{{$ngl->num}}</td>
												<td>{{$ngl->tprice}}</td>
												<td>{{$ngl->price}}</td>
												<td>{{$ngl->discount}}</td>
												<td>{{$ngl->price*$ngl->discount}}</td>
												<td>
													@if($ngl->status==0)
													<a href="javascript:void(0)" class="btn btn-primary btnpro shelves">上架</a>
													@endif
													<a href="{{URL('admin/goods')}}/{{$ngl->gid}}" class="btn btn-info btnpro">详情</a>
													<a href="#" class="btn btn-success btnpro">修改</a>
													<a href="#" class="btn btn-danger btnpro">删除</a>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
									<div class="allbtn">
									<button class="btn btn-danger allremove">筛选删除</button>
								</div>
								<div class="fenye">
									{!! $ngoodsList->render() !!}
								</div>
							</div>
							@else
								<div style="text-align:center;margin-top: 20px;">没有可以准备出售的商品信息</div>
								@endif
						</div>
							<div class="tab-pane fade" id="goodsInfo-you">
								@if(count($kuList)!=0)
								<div class="goodsInfo-table">
									<table>
										<tbody>
									<tr>
												<th><input type="checkbox" class="allcheckbox"/></th>
												<th>编号</th>
												<th>商品名</th>
												<th>商品类别</th>
												<th>库存</th>
												<th>成本价</th>
												<th>单价</th>
												<th>折扣</th>
												<th>出售价</th>
												<th>操作</th>
											</tr>
											@foreach($kuList as $ngl)
											<tr>
												<td><input type="checkbox" class="ischeckbox"/></td>
												<td class="gid">{{$ngl->gid}}</td>
												<td>{{$ngl->gname}}</td>
												<td>{{$ngl->categorys->cname}}</td>
												<td>{{$ngl->num}}</td>
												<td>{{$ngl->tprice}}</td>
												<td>{{$ngl->price}}</td>
												<td>{{$ngl->discount}}</td>
												<td>{{$ngl->price*$ngl->discount}}</td>
												<td>
													@if($ngl->status==0)
													<a href="javascript:void(0)" class="btn btn-primary btnpro shelves">上架</a>
													@endif
													<a href="{{URL('admin/goods')}}/{{$ngl->gid}}" class="btn btn-info btnpro">详情</a>
													<a href="#" class="btn btn-success btnpro">修改</a>
													<a href="#" class="btn btn-danger btnpro">删除</a>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
									<div class="allbtn">
									<button class="btn btn-danger allremove">筛选删除</button>
								</div>
								<div class="fenye">
									{!! $kuList->render() !!}
								</div>
							</div>
							@else
								<div style="text-align:center;margin-top: 20px;">没有库存不足的商品信息</div>
								@endif
						</div>
					</div>	
			</div>
			<div class="modal fade" id="shelvesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"   data-backdrop='static' aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				               
				            </div>
				            <div class="modal-body">商品上架成功！<span class="glyphicon glyphicon-ok"></span></div>
				             <div class="modal-footer">
				                <button type="button" id="shelves_succ" class="btn btn-success" data-dismiss="modal">确定</button>
				 
				            </div>
			        	</div><!-- /.modal-content --> 
			    	</div><!-- /.modal -->
			    </div>
			    <div class="modal fade" id="GoodsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop='static' aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				               
				            </div>
				            <div class="modal-body" style="color: red;text-align: center;">你确定要删除选中的商品信息？<span class="glyphicon glyphicon-remove"></span></div>
				             <div class="modal-footer">
				                <button type="button" id="goods_succ" class="btn btn-danger" data-dismiss="modal">确定</button>
				                <button type="button" id="goods_cancel" class="btn btn-success" data-dismiss="modal">取消</button>
				            </div>
			        	</div><!-- /.modal-content --> 
			    	</div><!-- /.modal -->
			    </div>
			    <div class="modal fade" id="GoodsfailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop='static' aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				            </div>
				            <div class="modal-body" style="color: red;text-align: center;">你并没有选择任何商品信息，无法筛选删除！<span class="glyphicon glyphicon-remove"></span></div>
				             <div class="modal-footer">
				                <button type="button" id="goods_fail" class="btn btn-success" data-dismiss="modal">确定</button>
				            </div>
			        	</div><!-- /.modal-content --> 
			    	</div><!-- /.modal -->
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


