<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix'=>'home','namespace'=>'Home'],function(){
    Route::get('text/{id}/{a}','TextController@index');
	//前台页面
	Route::get('index','IndexController@index');
	//登入页面
	Route::get('login','LoginController@index');
	//登入页面的验证码图片
	Route::get('loginImg/{id}','LoginController@loginImg');
	//注册页面的验证码图片
	Route::get('reginImg/{id}','RegisterController@reginImg');
	//退出登入
	Route::get('outLogin','LoginController@outLogin');
	//注册页面
	Route::get('register','RegisterController@index');
	//验证页面登入
	Route::post('validlogin','LoginController@validlogin');
	//验证页面注册
	Route::post('validregis','RegisterController@validregis');
	//类别页面[
	Route::get('category/{cid}','CategoryController@index');
	//类别详细页面
	Route::get('category','CategoryController@choose');
	//主页和分类验证是否登入
	Route::get('valogin','ValidateloginController@index');
	//主页和分类验证登入账号密码是否正确
	Route::post('ajaxvalidlogin','LoginController@ajaxvalidlogin');
	//删除购物车的商品信息
	Route::get('ajaxDelete','CartController@ajaxDelete');
	//商品详情
	Route::get('goodsinfo/{gid}','GoodsController@index');
	//商品详情
	Route::resource('search','SearchController@index');
	//验证账号是否已经登入
	Route::group(['middleware'=>'auth'],function(){
		//异步添加商品到购物车
		Route::get('ajaxAddGoods','CartController@ajaxAddGoods');
		//在商品详情页面，异步添加商品到购物车
		Route::get('ajaxginfoAddGoods','CartController@ajaxginfoAddGoods');
		//在商品详情页面，异步添加商品到购物车
		Route::get('cart','CartController@index');
		//通过购物车提交订单信息
		Route::get('order/show', 'OrderController@show');
		//通过购物车提交订单信息时候判断库存量
		Route::get('cart/kucun', 'CartController@kucun');
		//通过商品详情提交订单信息（主要为了显示给用户看）
		Route::get('order/gshow', 'OrderController@gshow');
		//通过商品详情创建订单信息（主要为了显示给用户看）
		Route::get('order/gcreate', 'OrderController@gcreate');
		//通过购物车创建订单信息
		Route::get('order/create', 'OrderController@create');
		
		//用户订单信息
		Route::get('order/index', 'OrderController@index');
		//订单搜索
		Route::post('order/search','OrderController@search');
		//用户订单详细信息
		Route::get('odetail/index/{oid}', 'OrderDetailController@index');
		//用户订单支付
		Route::get('order/pay', 'OrderController@pay');
		//用户执行订单取消操作
		Route::get('order/oCancel', 'OrderController@oCancel');
		//用户执行确认收货
		Route::get('order/recipient', 'OrderController@recipient');
		//用户执行订单删除操作
		Route::get('order/del', 'OrderController@del');
		//文件上传
		Route::post('file','FileUpdownController@index');
		//个人中心首页//用户信息界面
		Route::get('uperinfo','UserController@index');
		//个人中心首页//用户修改信息界面
		Route::get('editinfo','UserController@edit');
		//个人中心首页//密码修改界面
		Route::get('pwd','UserController@pwd');
		//个人中心首页//执行密码修改界面
		Route::post('pwdEdit','UserController@pwdEdit');
		//个人中心首页//个人账户
		Route::get('menory','UserController@menory');
		//个人中心首页//用户收货地址的地区（市）
		Route::get('city','AreaController@city');
		//个人中心首页//用户收货地址的地区（县/区）
		Route::get('county','AreaController@county');
		//用户收货地址资源路由
		Route::resource('address', 'RecaddressController');
		//用户收货地址删除
		Route::get('delAddress', 'RecaddressController@del');
		//用户评价保存
		Route::post('evaluate/save', 'EvaluateController@save');
		//用户评价管理
		Route::resource('evaluate', 'EvaluateController');
		//用户添加商品到收藏夹
		Route::get('collect/add', 'CollectController@add');
		//用户收藏夹
		Route::resource('collect', 'CollectController');
		//留言消息
		Route::resource('message', 'MessageController');
		
	});
});

//后台
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
	//登入页面
	Route::get('login','LoginController@index');
	//退出页面
	Route::get('out','OutLoginController@index');
	//登入验证码
	Route::get('loginImg/{id}','LoginController@loginImg');
	//登入验证
	Route::post('validlogin','LoginController@validlogin');
	Route::group(['middleware'=>'adauth'],function(){
		//后台主页
		Route::get('index','IndexController@index');
		//个人信息显示
		Route::get('perinfo','AdminController@index');
		//个人信息的头像上传
		Route::post('file','FileLoadController@index');
		//个人信息的修改
		Route::post('info','AdminController@perupdate');
		//个人密码的修改显示界面
		Route::get('persafe','AdminController@persafe');
		//个人密码的修改
		Route::post('safe','AdminController@safe');
		//商品信息管理
		//上架商品
		Route::get('goods/shelves','GoodsController@shelves');
		Route::post('goods/searchgoods','GoodsController@searchgoods');
		Route::post('goods/del','GoodsController@del');
		Route::resource('goods','GoodsController');
		//商品文件上传
		Route::post('goodsImg','FileLoadController@goodsImg');
		
		//订单更新ajaxupdate
		Route::get('order/ajaxupdate','OrderController@ajaxupdate');
		//订单发货
		Route::get('order/sendGoods','OrderController@sendGoods');
		//商品已签收
		Route::get('order/Sign','OrderController@Sign');
		//删除订单
		Route::get('order/del','OrderController@del');
		//订单信息
		Route::post('order/checkorder','OrderController@checkorder');
		//订单信息
		Route::resource('order','OrderController');
		//删除评价
		Route::post('evaluate/del','EvaluateController@del');
		//评价管理
		Route::resource('evaluate','EvaluateController');
		//用户留言消息
		Route::resource('message', 'MessageController');
		//对用户信息进行管理
		Route::post('user/searchuser','UserController@searchuser');
		Route::get('user/huifu/{id}','UserController@huifu');
		Route::post('user/del','UserController@del');
		Route::resource('user','UserController');
	});
		Route::group(['middleware'=>'admauth'],function(){
			//系统管理员对普通管理员的管理，修改、删除、添加
			Route::post('manage/del','ManageController@del');
			Route::get('manage/huifu/{id}','ManageController@huifu');
			Route::resource('manage','ManageController');
			
			//对类别进行管理
			Route::get('category/del','CategoryController@del');
			Route::get('category/ajaxCate','CategoryController@ajaxCate');
			Route::resource('category','CategoryController');
			//商品规格管理
			Route::post('spec/del','AttrController@del');
			Route::resource('spec','AttrController');
			//商品规格参数管理
			Route::post('specval/del','AttrValController@del');
			Route::resource('specval','AttrValController');
	});
	
});
