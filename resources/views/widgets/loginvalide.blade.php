<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">用户登入\<a href="{{URL('home/register')}}">用户注册</a></h4>
                
            </div>
            <div class="modal-body">
            	<form class="form" id="ajaxform">
            		{{csrf_field()}}
            		<div class="form-group">
					    <label for="firstname" class="col-sm-2 control-label">账号</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" name="uname" id="uname" placeholder="请输入账户或者邮箱">
					    </div>
				  	</div>
				  		<span class="error" id="modal-body-uname-error"></span>
				 	<div class="form-group">
					    <label for="lastname" class="col-sm-2 control-label">密码</label>
					    <div class="col-sm-10">
					      <input type="password" name="password" class="form-control" id="pwd" placeholder="请输入密码">
					    </div>
				  	</div>
				  		<span class="error" id="modal-body-pwd-error"></span>
				  	<span class="error" id="modal-body-error"></span>
				  	
            	</form>
            </div>
            <div class="modal-footer">
            	<button type="button" id="modal-submit" class="btn btn-success">登入</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>