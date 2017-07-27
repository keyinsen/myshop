@extends('Layouts.user_layouts')
@section('title','退货退款')
@section('head')
@parent           
@show
@section('ct-right')
<div class="ct-right-head">
	退货退款
</div>
<div class="after-sales">
	<ul id="myTab" class="nav nav-tabs">
		<li class="active">
			<a href="#after-salesall" data-toggle="tab">全部信息</a>
		</li>

	</ul>
	<div id="myTabContent" class="tab-content">
		<div class="tab-pane fade in active" id="after-salesall">
			<div class="sales-table">
				<table>
					<tbody>
						<tr>
							<th><input type="checkbox" /></th>
							<th>编号</th>
							<th>申请时间</th>
							<th>商品信息</th>
							<th>退货退款理由</th>
							<th>状态</th>
							<th>操作</th>
						</tr>
						<tr>
							<td><input type="checkbox" /></td>
							<td>1</td>
							<td>2016-09-18 13:45:23</td>
							<td>苹果6plus</td>
							<td>拍错</td>
							<td>拒绝退款</td>
							<td>
								<a href="#" class="red">删除</a>
							</td>
						</tr>
						<tr>
							<td><input type="checkbox" /></td>
							<td>1</td>
							<td>1</td>
							<td>苹果6plus</td>
							<td>拍错</td>
							<td>退款中</td>
							<td>
								<a href="#" class="red">取消退款</a>
							</td>
						</tr>
					</tbody>

				</table>
				<div class="allbtn">
					<a href="#" class="btn btn-danger">筛选删除</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('after_sales')
    style="background-color: #FFFFFF; border-right: #FFFFFF;"
@endsection



