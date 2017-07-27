@extends('Layouts.admin_layouts')
@section('title','售后服务')
@section('ct-right')
<ol class="breadcrumb">
					  <li>售后管理</li>
					  <li>退货退款</li>
					</ol>
					<div class="after-sales">
					<ul id="myTab" class="nav nav-tabs">
							<li class="active">
								<a href="#after-salesall" data-toggle="tab">全部信息</a>
							</li>
							<li >
								<a href="#after-sales" data-toggle="tab">待处理</a>
							</li>
							<li>
								<a href="#after-sales-realy" data-toggle="tab">已处理</a>
							</li>
						</ul>
						<div id="myTabContent" class="tab-content">
							<div class="tab-pane fade in active" id="after-salesall">
								<div class="sales-table">
									<table>
										<tbody>
											<tr>
												<th><input type="checkbox"/></th>
												<th>编号</th>
												<th>用户id</th>
												<th>用户昵称</th>
												<th>申请时间</th>
												<th>商品信息</th>
												<th>退货退款理由</th>
												<th>状态</th>
												<th>操作</th>
											</tr>
											<tr>
												<td><input type="checkbox"/></td>
												<td>1</td>
												<td>1</td>
												<td>乖乖欧尼</td>
												<td>2016-09-07 13:11:56</td>
												<td>苹果6plus</td>
												<td>拍错</td>
												<td>退款中</td>
												<td>
													<a href="#" class="green">同意</a>
													<a href="#" class="green">拒绝</a>
													<a href="#" class="red">删除</a>
												</td>
											</tr>
											<tr>
												<td><input type="checkbox"/></td>
												<td>1</td>
												<td>1</td>
												<td>乖乖欧尼</td>
												<td>2016-09-07 13:11:56</td>
												<td>苹果6plus</td>
												<td>拍错</td>
												<td>拒绝退款</td>
												<td>
													
													<a href="#" class="red">删除</a>
												</td>
											</tr>
										</tbody>
									</table>
									<div class="allbtn">
										<a href="#" class="btn btn-danger">筛选删除</a>
									</div>
									<div class="fenye">
										<nav>
										  <ul class="pagination">
										    <li><a href="#">&laquo;</a></li>
										    <li><a href="#">1</a></li>
										    <li><a href="#">2</a></li>
										    <li><a href="#">3</a></li>
										    <li><a href="#">4</a></li>
										    <li><a href="#">5</a></li>
										    <li><a href="#">&raquo;</a></li>
										  </ul>
										</nav>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="after-sales">
								
							</div>
							<div class="tab-pane fade" id="after-sales-realy">
								
							</div>
							
					</div>	
			</div>
@endsection
@section('after')
    style="color:#ff0000;"
@endsection


