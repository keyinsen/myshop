@extends('Layouts.admin_layouts')
@section('meta')
<meta name="_token" content="{{ csrf_token() }}"/>
@endsection
@section('js')
<script src="{{asset('js/admin/spec.js')}}"></script>
@endsection
@section('title','商品管理/商品规格')
@section('ct-right')
<ol class="breadcrumb">
					  <li>商品管理</li>
					  <li class="active">商品规格</li>
					</ol>
				    <span class="admin-font">增改商品规格</span>
				    @if(!isset($editList))
						<form id="spec_form" action="{{URL('admin/spec')}}"  method="post" >
							{{csrf_field()}}
							<div class="spec-div">
								<label><span class="xing">*</span>商品类别:</label>
      							<select class="form-control spec-list" name="cid">
      								@foreach($cate as $c)
								  <option value="{{$c->cid}}">{{$c->cname}}</option>
											@endforeach
								</select>
							</div>
							<div class="spec-div">
								<label for="specname"><span class="xing">*</span>规格名称:</label>
      							<input type="text" name="title" class="form-control" id="specname">
      							<span class="specnameer"></span>
							</div>
							<div class="spec-div">
								<label for="***"></label>
      							<button id="spec_submit" type="button"  class="btn btn-success">添加规格</button>
      							<button type="reset" id="spec_reset" class="btn btn-danger">重置</button>
							</div>
						</form>
						@else
						<form id="spec_form" action="{{URL('admin/spec')}}/{{$editList->attr_id}}"  method="post" >
							{{csrf_field()}}
							<input type="hidden" name="_method"  value="put" />
							<div class="spec-div">
								<label><span class="xing">*</span>商品类别:</label>
      							<select class="form-control spec-list" name="cid">
      								@foreach($cate as $c)
      								@if($editList->cid==$c->cid)
								  <option value="{{$c->cid}}" selected="selected">{{$c->cname}}</option>
								  		@else
								  <option value="{{$c->cid}}">{{$c->cname}}</option>
								  @endif
											@endforeach
								</select>
							</div>
							<div class="spec-div">
								<label for="specname"><span class="xing">*</span>规格名称:</label>
      							<input type="text" name="title" value="{{$editList->title}}" class="form-control" id="specname">
      							<span class="specnameer"></span>
							</div>
							<div class="spec-div">
								<label for="***"></label>
      							<button id="spec_submit" class="btn btn-success">修改规格</button>
										<button id="specs-cancel" class="btn btn-danger">取消</button>
							</div>
						</form>
						@endif
						<div class="admin-font">已存在的商品规格</div>
						@if(count($specList)!=0)
						<div class="spec-table">
							<table>
								<tbody>
									<tr>
										<th><input type="checkbox" class="allcheckbox"/></th>
										<th>编号</th>
										<th>规格名称</th>
										<th>所属类别</th>
										<th>操作</th>
									</tr>
									@foreach($specList as $spec)
									<tr>
										
										<td><input type="checkbox" class="ischeckbox"/></td>
										<td class="attr_id">{{$spec->attr_id}}</td>
										<td>{{$spec->title}}</td>
										<td>{{$spec->category->cname}}</td>
										<td><a class="btn btn-success btnpro" href="{{URL('admin/spec')}}/{{$spec->attr_id}}/edit">修改</a> <a class="btn btn-danger btnpro caremove" href="javascript:void(0)">删除</a></td>
									</tr>
									@endforeach
								</tbody>
							</table>
							<div class="allbtn">
								<a href="#" class="btn btn-danger allremove">筛选删除</a>
							</div>
							<div class="fenye">
								{!! $specList->render() !!}
							</div>
						</div>
						@else
						<div style="text-align: center;">没有任何规格信息</div>
						@endif
						<div class="modal fade" id="SpecfailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop='static' aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				            </div>
				            <div class="modal-body">你并没有选择任何规格信息，无法筛选删除！<span class="glyphicon glyphicon-remove"></span></div>
				             <div class="modal-footer">
				                <button type="button" id="spec_fail" class="btn btn-danger" data-dismiss="modal">确定</button>
				            </div>
			        	</div><!-- /.modal-content --> 
			    	</div><!-- /.modal -->
			    	  </div>
						<div class="modal fade" id="SpecModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop='static' aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				               
				            </div>
				            <div class="modal-body">你确定要删除此规格？(PS:删除后,对应属于此规格的属性值全部清空，关联商品也不在拥有此规格)<span class="glyphicon glyphicon-remove"></span></div>
				             <div class="modal-footer">
				                <button type="button" id="spec_succ" class="btn btn-danger" data-dismiss="modal">确定</button>
				                <button type="button" id="spec_cancel" class="btn btn-success" data-dismiss="modal">取消</button>
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
@section('goods-spec')
    style="color:#ff0000;"
@endsection


