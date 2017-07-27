<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="utf-8">
        <title>通讯商城后台登入管理</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- CSS -->
       <!-- <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>-->
        <link rel="stylesheet" href="{{asset('css/admin/login/reset.css')}}">
        <link rel="stylesheet" href="{{asset('css/admin/login/supersized.css')}}">
        <link rel="stylesheet" href="{{asset('css/admin/login/style.css')}}">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>
    <body style="background: #fff url({{asset('img/admin/1.jpg')}})  no-repeat;background-size: 100% 800px;">

        <div class="page-container">
            <h1>通讯商城后台登入</h1>
            <form action="{{URL('admin/validlogin')}}" method="post">
            	{{csrf_field()}}
                <input type="text" name="uname" class="username" placeholder="用户名">
                	<div class="error1" style="margin-top: 10px;height: 10px;color: red;"></div>
                <input type="password" name="password" class="password" placeholder="密码">
                	<div class="error2" style="margin-top: 10px;height: 10px;color: red;"></div>
                	<input id="valiimg" value="{{session('valiimg')}}" type="text" name="valiimg" maxlength="5" style="width: 100px;">
                	<img id="img" src="{{URL('admin/loginImg/1')}}"  style="width: 100px;height: 40px;float: right;margin-top: 25px;margin-right: 25px;" />
                <div class="error3" style="margin-top: 10px;height: 10px;color: red;"></div>
                @if(!empty(session('aderror')))
				<div class="error3" style="margin-top: 10px;height: 10px;color: red;">{{session('aderror')}}</div>
				@endif
                <button type="submit">登入</button>
            </form>
        </div>
        <!-- Javascript -->
        <script src="{{asset('js/jquery-1.11.0.js')}}"></script>
        <script src="{{asset('js/admin/scripts.js')}}"></script>
        <script src="{{asset('js/admin/login.js')}}"></script>
    </body>

</html>


