@extends('Layouts.admin_layouts')
@section('meta')
<meta name="_token" content="{{ csrf_token() }}"/>
@endsection
@section('js')
<script src="{{asset('js/admin/goods.js')}}"></script>
@endsection
@section('title','商品管理/增改商品')
@section('ct-right')
<ol class="breadcrumb">
					  <li>商品管理</li>
					  <li class="active">增改商品</li>
					</ol>
				 {!! Form::open( [ 'url' => ['admin/goodsImg'], 'method' => 'POST', 'id' => 'imgupload', 'files' => true ] ) !!}
					<input type="file"  id="imgpathval" name="imgpath" style="display:none;">
				 {!! Form::close() !!}
				 {!! Form::open( [ 'url' => ['admin/goodsImg'], 'method' => 'POST', 'id' => 'img1upload', 'files' => true ] ) !!}
					<input type="file"  id="imgpathval1" name="imgpath" style="display:none;">
				 {!! Form::close() !!}
				 {!! Form::open( [ 'url' => ['admin/goodsImg'], 'method' => 'POST', 'id' => 'img2upload', 'files' => true ] ) !!}
					<input type="file"  id="imgpathval2" name="imgpath" style="display:none;">
				 {!! Form::close() !!}
				 {!! Form::open( [ 'url' => ['admin/goodsImg'], 'method' => 'POST', 'id' => 'img3upload', 'files' => true ] ) !!}
					<input type="file"  id="imgpathval3" name="imgpath" style="display:none;">
				 {!! Form::close() !!}
				 @if(!isset($editList))
				 {!! Form::open( [ 'url' => ['admin/goods'], 'method' => 'POST', 'id' => 'addgoods_form' ] ) !!}		
				<!--	<form id="addgoods_form" method="post" action="{{URL('admin/goods')}}">-->
					{{csrf_field()}}
				    <div class="addgoods">
				    	<div class="addgoods-div">
				    		<label for="goodsname"><span class="xing">*</span>商品名:</label>
				    		<input type="text" id="goodsname" name="gname" class="form-control goodsname-text" maxlength="50" placeholder="商品名称字数最多为50个字">
				    		<span class="gnameer"></span>
				    	</div>
				    	<div class="addgoods-div">
				    		<label><span class="xing">*</span>商品主类型:</label>
				    		<select class="form-control goods-type" id="addcid">
				    			@foreach($cate as  $ca)
							  <option value="{{$ca->cid}}">{{$ca->cname}}</option>
							  	@endforeach
								</select>
								<label><span class="xing">*</span>商品子类型:</label>
							<select class="form-control goods-type" name="cid" id="addzcid">
				    			@foreach($zcate as  $zc)
							  <option value="{{$zc->cid}}">{{$zc->cname}}</option>
							  	@endforeach
								</select>
								<a href="{{URL('admin/category')}}">添加商品类别</a>
				    	</div>
				    	<div class="addgoods-line lefts">
				    		<label for="goodscprice"><span class="xing">*</span>成本价格:</label>
				    		<input type="text" id="tprice" name="tprice" class="form-control price"  placeholder="0.00" />
				    	</div>
				    	<div class="addgoods-line">
				    		<label for="goodsprice"><span class="xing">*</span>销售价格(单价):</label>
				    		<input type="text" id="price" name="price" class="form-control price" placeholder="0.00" />
				    	</div>
				    	<div class="addgoods-line">
				    		<label for="discount">折扣:</label>
				    		<input type="text" id="discount" name="discount" class="form-control price"  placeholder="0.0"/>
				    	</div>
				    	<div class="addgoods-line">
				    		<label for="goodsnum"><span class="xing">*</span>库存:</label>
				    		<input type="number" name="num" id="num" class="form-control price" placeholder=">=1" />
				    		<span class="error" style="color: red;"></span>
				    	</div><br/>
				    	<div class="addgoods-div">
				    		<label><span class="xing">*</span>商品图片:</label>
								<input class="form-control file" name="img_path" id="img_path" placeholder="图片大小必须小于2M且必须为图片格式" readonly="readonly" type="text">
								<a class="btn btn-info" id="imgbtn" href="javascript:void(0)">上传照片</a>
				    		<span class="imgpather"></span>
				    	</div>
				    	<div class="addgoods-div">
				    		<label><span class="xing">*</span>附加详情图1:</label>
								<input class="form-control file" name="img_path1" id="img_path1" placeholder="图片大小必须小于2M且必须为图片格式"  readonly="readonly" type="text">
								<a class="btn btn-info" id="imgbtn1" href="javascript:void(0)">上传照片</a>
				    		<span class="imgpather1"></span>
				    	</div>
				    	<div class="addgoods-div">
				    		<label>附加详情图2:</label>
								<input class="form-control file" name="img_path2" id="img_path2"   placeholder="图片大小必须小于2M且必须为图片格式" readonly="readonly"  type="text">
								<a class="btn btn-info" id="imgbtn2" href="javascript:void(0)">上传照片</a>
				    		<span class="imgpather2"></span>
				    	</div>
				    	<div class="addgoods-div">
				    		<label>附加大图:</label>
								<input class="form-control file" name="img_path3" id="img_path3" placeholder="图片大小必须小于2M且必须为图片格式" readonly="readonly"  type="text">
								<a class="btn btn-info" id="imgbtn3" href="javascript:void(0)">上传照片</a>
				    		<span class="imgpather3"></span>
				    	</div>
				    	<div class="goods-div2">
								<div class="container-fluid" id="specdiv" >
									@foreach($cateone->attr as $attr)
									<div class="col-xs-3 kuai">
										<label><span class="xing">*</span>{{$attr->title}}:</label>
						    		<select name="{{$attr->attr_id}}"  class="form-control  spec">
						    			<option value="0">请选择</option>
						    			@foreach($attr->attrValues as $attrval)
										  <option value="{{$attrval->avid}}">{{$attrval->value}}</option>
											@endforeach
										</select>
				      		</div>
				      		@endforeach
				      		<div class="col-xs-3 kuai a">
				      	<a href="{{URL('admin/spec')}}" style="line-height: 34px;">添加商品规格</a>
				      	</div>
				      </div>
	     			</div>
				    	<div class="addgoods-div">
				    		<label for="goodsdiscrpt" class="goodsdiscrpt">商品描述:</label>
				    		<textarea class="form-control" id="descript" name="descript" rows="3" cols="30" maxlength="100" placeholder="字数限制在100字以内"></textarea>
				    		<span class="sepcer"></span>
				    	</div>
				    	<div class="tijiao">
				    		<button class="btn btn-success" id="submits"  >添加商品</button>
				    		<button class="btn btn-primary" id="resets" type="reset" >重置商品</button>
				    	</div>
				    </div>
				   <!--</form>-->
				    {!! Form::close() !!}
				    @else
				    <form id="addgoods_form" method="post" action="{{URL('admin/goods')}}/{{$editList->gid}}">
					{{csrf_field()}}
					<input type="hidden" name="_method" value="put" />
				    <div class="addgoods">
				    	<div class="addgoods-div">
				    		<label for="goodsname"><span class="xing">*</span>商品名:</label>
				    		<input type="text" id="goodsname" value="{{$editList->gname}}" name="gname" class="form-control goodsname-text" maxlength="50" placeholder="商品名称字数最多为50个字">
				    		<span class="gnameer"></span>
				    	</div>
				    	<div class="addgoods-div">
				    		<label><span class="xing">*</span>商品主类型:</label>
				    		<select class="form-control goods-type" id="addcid">
				    			@foreach($cate as  $ca)
						    			 @if($cid->parentid==$ca->cid)
						    		<option value="{{$ca->cid}}" selected="selected">{{$ca->cname}}</option>
						    			 	@else
									  <option value="{{$ca->cid}}">{{$ca->cname}}</option>
									  	 @endif
							  	@endforeach
								</select>
								<label><span class="xing">*</span>商品子类型:</label>
							<select class="form-control goods-type" name="cid" id="addzcid">
				    			@foreach($cates as  $cas)
							  <option value="{{$cas->cid}}">{{$cas->cname}}</option>
							  	@endforeach
								</select>
								<a href="{{URL('admin/category')}}">添加商品类别</a>
				    	</div>
				    	<div class="addgoods-line lefts">
				    		<label for="goodscprice"><span class="xing">*</span>成本价格:</label>
				    		<input type="text" id="tprice" value="{{$editList->tprice}}" name="tprice" class="form-control price"  placeholder="0.00" />
				    	</div>
				    	<div class="addgoods-line">
				    		<label for="goodsprice"><span class="xing">*</span>销售价格(单价):</label>
				    		<input type="text" id="price" value="{{$editList->price}}" name="price" class="form-control price" placeholder="0.00" />
				    	</div>
				    	<div class="addgoods-line">
				    		<label for="discount">折扣:</label>
				    		<input type="text" id="discount" value="{{$editList->discount}}" name="discount" class="form-control price"  placeholder="0.0"/>
				    	</div>
				    	<div class="addgoods-line">
				    		<label for="goodsnum"><span class="xing">*</span>库存:</label>
				    		<input type="number" id="num" name="num" value="{{$editList->num}}" class="form-control price" placeholder=">=1" />
				    		<span class="error" style="color: red;"></span>
				    	</div><br/>
				    	<div class="addgoods-div">
				    		<label><span class="xing">*</span>商品图片:</label>
								<input class="form-control file" value="{{$editList->img_path}}" name="img_path" id="img_path" placeholder="图片大小必须小于2M且必须为图片格式" readonly="readonly" type="text">
								<a class="btn btn-info" id="imgbtn" href="javascript:void(0)">上传照片</a>
				    		<span class="imgpather"></span>
				    	</div>
				    	<div class="addgoods-div">
				    		<label><span class="xing">*</span>附加详情图1:</label>
								<input class="form-control file" value="{{$editList->img_path1}}" name="img_path1" id="img_path1" placeholder="图片大小必须小于2M且必须为图片格式"  readonly="readonly" type="text">
								<a class="btn btn-info" id="imgbtn1" href="javascript:void(0)">上传照片</a>
				    		<span class="imgpather1"></span>
				    	</div>
				    	<div class="addgoods-div">
				    		<label>附加详情图2:</label>
								<input class="form-control file"  value="{{$editList->img_path2}}"  name="img_path2" id="img_path2"   placeholder="图片大小必须小于2M且必须为图片格式" readonly="readonly"  type="text">
								<a class="btn btn-info" id="imgbtn2" href="javascript:void(0)">上传照片</a>
				    		<span class="imgpather2"></span>
				    	</div>
				    	<div class="addgoods-div">
				    		<label>附加大图:</label>
								<input class="form-control file" value="{{$editList->img_path3}}" name="img_path3" id="img_path3" placeholder="图片大小必须小于2M且必须为图片格式" readonly="readonly"  type="text">
								<a class="btn btn-info" id="imgbtn3" href="javascript:void(0)">上传照片</a>
				    		<span class="imgpather3"></span>
				    	</div>
				    	<div class="goods-div2">
								<div class="container-fluid" id="specdiv" >
								
									@foreach($attrName as $attr)
									<div class="col-xs-3 kuai">
										<label><span class="xing">*</span>{{$attr->title}}:</label>
							    		<select name="{{$attr->attr_id}}"  class="form-control  spec">
							    						<option value="0">请选择</option>
							    			@foreach($attr->attrValues as $val)
							    				<?php $is=true; ?>
							    				@foreach($attrval as $atval)	
							    				  @if($val->avid==$atval->avid)
							    						<option value="{{$val->avid}}" selected="selected">{{$val->value}}</option>
							    					<?php $is=false; ?>
							    					<?php break; ?>
											  		@endif
													@endforeach
													@if($is)
													<option value="{{$val->avid}}">{{$val->value}}</option>
													@endif
												@endforeach
											</select>
				      		</div>
				      		
				      	@endforeach
				      		<div class="col-xs-3 kuai a">
				      	<a href="{{URL('admin/spec')}}" style="line-height: 34px;">添加商品规格</a>
				      	</div>
				      </div>
	     			</div>
				    	<div class="addgoods-div">
				    		<label for="goodsdiscrpt" class="goodsdiscrpt">商品描述:</label>
				    		<textarea class="form-control" value="{{$editList->descript}}" id="descript" name="descript" rows="3" cols="30" maxlength="100" placeholder="字数限制在100字以内"></textarea>
				    		<span class="sepcer"></span>
				    	</div>
				    	<div class="tijiao">
				    		<button class="btn btn-success" type="button"  id="submits" >修改商品</button>
				    		<button class="btn btn-danger" type="button" id="editcancel" >取消</button>
				    	</div>
				    </div>
				    </form>
				    @endif
@endsection
@section('goods-in')
    in
@endsection
@section('goods')
    style="color:#ff0000;"
@endsection
@section('goods-add')
    style="color:#ff0000;"
@endsection

