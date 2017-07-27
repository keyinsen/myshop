@extends('Layouts.admin_layouts')
@section('meta')
<meta name="_token" content="{{ csrf_token() }}"/>
@endsection
@section('js')
<script src="{{asset('js/admin/specval.js')}}"></script>
@endsection
@section('title','商品管理/商品规格值信息')
@section('ct-right')
<ol class="breadcrumb">
					  <li>商品管理</li>
					  <li class="active">商品规格值信息</li>
					</ol>
				    <span class="admin-font">增改商品规格值</span>
				    @if(!isset($editList))
						<form id="specval_form" action="{{URL('admin/specval')}}"  method="post" >
							{{csrf_field()}}
							<div class="specval-div">
								<label><span class="xing">*</span>商品类别:</label>
      							<select class="form-control specval-list" id="addcid" name="cid">	
      								@foreach($cate as $c)
								  <option value="{{$c->cid}}">{{$c->cname}}</option>
											@endforeach
								</select>
							</div>
							<div class="specval-div">
								<label><span class="xing">*</span>选择规格:</label>
      					<select class="form-control specval-list" id="attr_id" name="attr_id">
      							
								</select>
							</div>
							<div class="specval-div">
								<label for="specname"><span class="xing">*</span>规格参数:</label>
      							<input type="text" name="value" class="form-control" id="specname">
      							<span class="specnameer"></span>
							</div>
							<div class="specval-div">
								<label for="***"></label>
      							<button id="spec_submit" class="btn btn-success">添加规格参数</button>
							</div>
						</form>
						@else
						<form id="specval_form" action="{{URL('admin/specval')}}/{{$editList->avid}}"  method="post" >
							{{csrf_field()}}
							<input type="hidden" name="_method"  value="put" />
							<div class="specval-div">
								<label><span class="xing">*</span>商品类别:</label>
      							<select class="form-control specval-list" id="editcid" name="cid">
      								@foreach($cate as $c)
      								@if($editList->attrname->category->cid==$c->cid)
								  <option value="{{$c->cid}}" selected="selected">{{$c->cname}}</option>
								  		@else
								  <option value="{{$c->cid}}">{{$c->cname}}</option>
								  @endif
											@endforeach
								</select>
							</div>
							<div class="specval-div">
								<label><span class="xing">*</span>商品规格:</label>
      					<select class="form-control specval-list" id="editattr_id" name="attr_id">
      						@foreach($editAttrList as $eal)
      							@if($eal->attr_id==$editList->attr_id)
      								<option value="{{$eal->attr_id}}" selected="selected">{{$eal->title}}</option>
      							@else
      								<option value="{{$eal->attr_id}}">{{$eal->title}}</option>
      							@endif
      						@endforeach		
								</select>
							</div>
							<div class="specval-div">
								<label for="specname"><span class="xing">*</span>规格名称:</label>
      							<input type="text" name="value" value="{{$editList->value}}" class="form-control" id="specname">
      							<span class="specnameer"></span>
							</div>
							<div class="specval-div">
								<label for="***"></label>
      							<button id="spec_submit" class="btn btn-success">保存商品规格</button>
										<button id="specs-cancel" class="btn btn-danger">取消</button>
							</div>
						</form>
						@endif
						<div class="admin-font" style="display: inline-block;">已存在的商品规格参数</div>
						<span style="color: red;">{{$specvalList->total()}}</span><span>条</span>
						@if(count($specvalList)!=0)
						<div class="specval-table">
							<table>
								<tbody>
									<tr>
										<th><input type="checkbox" class="allcheckbox"/></th>
										<th>编号</th>
										<th>规格参数</th>
										<th>所属规格</th>
										<th>所属类别</th>
										<th>操作</th>
									</tr>
									@foreach($specvalList as $specval)
									<tr>
										
										<td><input type="checkbox" class="ischeckbox"/></td>
										<td class="avid">{{$specval->avid}}</td>
										<td>{{$specval->value}}</td>
										<td>{{$specval->attrname->title}}</td>
										<td>{{$specval->attrname->category->cname}}</td>
										<td><a class="btn btn-success btnpro" href="{{URL('admin/specval')}}/{{$specval->avid}}/edit">修改</a> <a class="btn btn-danger btnpro caremove" href="javascript:void(0)">删除</a></td>
									</tr>
									@endforeach
								</tbody>
							</table>
							<div class="allbtn">
								<a href="#" class="btn btn-danger allremove">筛选删除</a>
							</div>
							<div class="fenye">
								{!! $specvalList->render() !!}
							</div>
						</div>
						@else
						<div style="text-align: center;">没有任何规格参数信息</div>
						@endif
						<div class="modal fade" id="SpecvalfailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop='static' aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				            </div>
				            <div class="modal-body">你并没有选中任何规格参数信息，无法筛选删除！<span class="glyphicon glyphicon-remove"></span></div>
				             <div class="modal-footer">
				                <button type="button" id="specval_fail" class="btn btn-danger" data-dismiss="modal">确定</button>
				            </div>
			        	</div><!-- /.modal-content --> 
			    	</div><!-- /.modal -->
			    	  </div>
						<div class="modal fade" id="SpecvalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop='static' aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				               
				            </div>
				            <div class="modal-body">你确定要删除此规格参数？(PS:删除后,对应拥有此参数的商品将不再拥有此参数了 )<span class="glyphicon glyphicon-remove"></span></div>
				             <div class="modal-footer">
				                <button type="button" id="specval_succ" class="btn btn-danger" data-dismiss="modal">确定</button>
				                <button type="button" id="specval_cancel" class="btn btn-success" data-dismiss="modal">取消</button>
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
@section('goods-specval')
    style="color:#ff0000;"
@endsection


