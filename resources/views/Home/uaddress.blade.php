@extends('Layouts.user_layouts')
@section('js')
<script src="{{asset('js/PCASClass.js')}}"></script>
<script src="{{asset('js/home/user/uaddress.js')}}"></script>

@endsection
@section('title','收货地址')
@section('head')
@parent           
@show
@section('ct-right')
<div class="ct-right-head">
						收货地址管理
					</div>
					<div class="ct-right-main">
						
						
						@if(!isset($editAddress))
						<span class="address-font">新增收货地址</span>
						<form method="post" id="address_form" action="{{URL('home/address')}}">
							{{csrf_field()}}
							<input type="hidden" name="rec_id"  id="rec_id">
							<div class="address-div">
								<label for="address-name"><span class="xing">*</span>收件人姓名:</label>
      							<input type="text" maxlength="8" name="recname" class="form-control" id="address-name">
      							<span class="as_nameerror"></span>
							</div>
							<div class="address-div">
								<label for="address-lists"><span class="xing">*</span>收货地址:</label>
      							<select id="address-province" name="province" class="form-control address-list1">
								  
								 
								</select>
								<select id="address-city" name="city" class="form-control address-list2">
								  							 
								</select>
								<select id="address-county" name="county" class="form-control address-list3">
								  
								</select>
      							<span class="as_listerror"></span>
							</div>
							<div class="address-div">
								<label for="address-detail" class="address-detail-t"><span class="xing">*</span>详细地址:</label>
      							<textarea class="form-control  address-detail" name="detail" id="address-detail" rows="3"></textarea>
      							<span class="as_detailerror"></span>
							</div>
							<div class="address-div">
								<label for="address-code"><span class="xing">*</span>邮编:</label>
      							<input type="text" class="form-control" maxlength="6" name="postcode" id="address-code" style="width: 80px;">
      							<span class="as_codeerror"></span>
							</div>
							<div class="address-div">
								<label for="address-tel"><span class="xing">*</span>手机号码:</label>
      							<input type="text" name="tel" maxlength="11" class="form-control" id="address-tel">
      							<span class="as_telerror"></span>
							</div>
							<div class="address-div">
								<label for="address**"></label>
      							<button id="address_submit" type="button"  class="btn btn-success">保存收货地址</button></div>
      							</form>
      							@else
      							<span class="address-font">修改收货地址<a href="{{URL('home/address')}}">(添加收货地址)</a></span>
      							<form method="post" id="address_form" action="{{URL('home/address')}}/{{$editAddress->rec_id}}">
							{{csrf_field()}}
							<input type="hidden" name="_method" value="put">
							<div class="address-div">
								<label for="address-name"><span class="xing">*</span>收件人姓名:</label>
      							<input type="text" maxlength="8" name="recname" value="{{$editAddress->recname}}" class="form-control" id="address-name">
      							<span class="as_nameerror"></span>
							</div>
							<div class="address-div">
								<label for="address-lists"><span class="xing">*</span>收货地址:</label>
      							<select id="address-province" name="province" class="form-control address-list1">
								  
								</select>
								<select id="address-city" name="city" class="form-control address-list2">
									
								</select>
								<select id="address-county" name="county" class="form-control address-list3">
								 
								</select>
      							<span class="as_listerror"></span>
							</div>
							<div class="address-div">
								<label for="address-detail" class="address-detail-t"><span class="xing">*</span>详细地址:</label>
      							<textarea  class="form-control   address-detail" name="detail" id="address-detail" rows="3">{{$editAddress->detail}}</textarea>
      							<span class="as_detailerror"></span>
							</div>
							<div class="address-div">
								<label for="address-code"><span class="xing">*</span>邮编:</label>
      							<input value="{{$editAddress->postcode}}" type="text" class="form-control" maxlength="6" name="postcode" id="address-code" style="width: 80px;">
      							<span class="as_codeerror"></span>
							</div>
							<div class="address-div">
								<label for="address-tel"><span class="xing">*</span>手机号码:</label>
      							<input value="{{$editAddress->tel}}" type="text" name="tel" maxlength="11" class="form-control" id="address-tel">
      							<span class="as_telerror"></span>
							</div>
							<div class="address-div">
								<label for="address**"></label>
      							<button id="address_submit" type="button" class="btn btn-success">修改收货地址</button>
      							<button id="address_cancel" type="button" class="btn btn-danger" >取消</button></div>
      							</form>
      							@endif
						<div class="address-font">已保存的地址</div>
					<!--	<p class="bg-danger">最多只能保存10条有效的收货地址哦</p>-->
						@if(count($addressList)!=0)
						<div class="address-table">
							<table>
								<tbody>
									<tr>
										<th></th>
										<th>收货人</th>
										<th>收货地址</th>
										<th>手机号码</th>
										<th>邮编</th>
										<th>操作</th>
									</tr>
									@foreach($addressList as $addre)
									<tr>
										<td><input type="hidden" value="{{$addre->rec_id}}"/></td>
										<td>{{$addre->recname}}</td>
										<td>({{$addre->province}}{{$addre->city}}{{$addre->county}}){{$addre->detail}}</td>
										<td>{{$addre->tel}}</td>
										<td>{{$addre->postcode}}</td>
										<td><a  href="{{URL('home/address')}}/{{$addre->rec_id}}/edit">修改</a> <a class="addressdel" href="javascript:void(0)">删除</a></td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						@else
						<div style="width: 100%; margin-top: 20px; text-align: center;">你还没有可用的收货地址</div>
						@endif
					</div>
					<div class="modal fade" id="MyaddressModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				            </div>
				            <div class="modal-body">你确定要删除当前选择的收货地址？<span class="glyphicon glyphicon-remove"></span></div>
				             <div class="modal-footer">
				                <button type="button" id="address_succ" class="btn btn-danger" data-dismiss="modal">确定</button>
				                <button type="button" id="address_cancel" class="btn btn-info" data-dismiss="modal">取消</button>
				            </div>
			        	</div><!-- /.modal-content --> 
			    	</div><!-- /.modal -->
				</div>
@endsection
@section('address')
    style="background-color: #FFFFFF; border-right: #FFFFFF;"
@endsection



