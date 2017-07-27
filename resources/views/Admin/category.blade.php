@extends('Layouts.admin_layouts')
@section('js')
<script src="{{asset('js/admin/adcategory.js')}}"></script>
@endsection
@section('title','商品管理/商品类别')
@section('ct-right')
				    @if(!isset($editList))
				    <ol class="breadcrumb">
				    <li>商品管理</li>
					  <li class="active">商品类别</li>
					</ol>
				    <span class="admin-font">新增商品类别</span>
				    
						<form id="cate_form" action="{{URL('admin/category')}}" method="post">
							{{csrf_field()}}
							<div class="category-div">
								<label for="category-name"><span class="xing">*</span>主类别名称:</label>
								<select class="form-control category-list" name="parentcate" id="parentcate">
									<option value="0">顶级类别</option>
									@foreach($cateparent as $cp)
									<option value="{{$cp->cid}}">{{$cp->cname}}</option>
								  @endforeach
								</select>
							</div>
							<div class="category-div ding">
								<label for="category-name"><span class="xing">*</span>顶级类别名称:</label>
      							<input type="text" class="form-control" name="cname" id="category-name">
      							
							</div>
							<div class="category-div">
								<label for="category-name"><span class="xing">*</span>子类别名称:</label>
      							<input type="text" class="form-control" name="zcname" id="category-zname">
      							<span id="cateerror"></span>
							</div>
							<div class="admin-div">
								<label for="address**"></label>
      							<button id="cate_submit" type="button" class="btn btn-success">新增商品类别</button>
							</div>
						</form>
						@else
						<ol class="breadcrumb">
					    <li>商品管理</li>
						  <li><a href="{{URL('admin/category')}}">商品类别</a></li>
						  <li>商品类别修改</li>
						</ol>
				    <span class="admin-font">修改商品类别</span>
						<form id="cate_form" action="{{URL('admin/category')}}/{{$editList->cid}}" method="post">
							{{csrf_field()}}
							<input type="hidden" name="_method" value="put" />
							<div class="category-div">
								<label for="category-name"><span class="xing">*</span>类别名称:</label>
      							<input type="text" class="form-control" value="{{$editList->cname}}" name="cname" id="category-name">
      							<span id="cateerror"></span>
							</div>
							<div class="admin-div">
								<label for="address**"></label>
      							<button id="cate_submit" type="button" class="btn btn-success">修改商品类别</button>
      							<button id="cate_cancels" type="button" class="btn btn-danger">取消</button>
							</div>
						</form>
						@endif
						<div class="admin-font">已存在的商品类别</div>
						@if(count($cateList)!=0)
						<div class="category-table">
							<table>
								<tbody>
									<tr>
										<th>编号</th>
										<th>类别名称</th>
										<th>所属类别</th>
										<th>操作</th>
									</tr>
									@foreach($cateList as $cl)
									<tr>
										<td class="cid">{{$cl->cid}}</td>
										<td>{{$cl->cname}}</td>
										<td>{{$cl->parentname}}</td>
										<td><a class="btn btn-success btnpro" href="{{URL('admin/category')}}/{{$cl->cid}}/edit">修改</a> 
											<!--<a class="btn btn-danger btnpro caremove" href="javascript:void(0)">删除</a></td>-->
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						@else
						<div style="margin-top: 10px;text-align: center;">没有任何类别信息</div>
						@endif
						<div class="modal fade" id="CateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"   data-backdrop='static' aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				               
				            </div>
				            <div class="modal-body">删除此类别会连同类别下的所有商品信息都删除，你确定？<span class="glyphicon glyphicon-remove"></span></div>
				             <div class="modal-footer">
				                <button type="button" id="cate_succ" class="btn btn-danger" data-dismiss="modal">确定</button>
				                <button type="button" id="cate_cancel" class="btn btn-info" data-dismiss="modal">取消</button>
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
@section('goods-type')
    style="color:#ff0000;"
@endsection


