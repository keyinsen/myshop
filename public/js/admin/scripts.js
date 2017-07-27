
jQuery(document).ready(function() {

    $('.page-container form').submit(function(){
        var username = $(this).find('.username').val();
        var password = $(this).find('.password').val();
        if(username == '') {
            $(this).find('.error1').html('账号不能为空!');
            $(this).find('.error1').fadeIn('fast', function(){
                $(this).parent().find('.username').focus();
            });
            return false;
        }
        if(password == '') {
             $(this).find('.error2').html('密码不能为空!');
            $(this).find('.error2').fadeIn('fast', function(){
                $(this).parent().find('.password').focus();
            });
            return false;
        }
        //console.log($('#valiimg').val().length);
        if($('#valiimg').val().length==0){
        	 $(this).find('.error3').html('验证码不能为空!');
        	 return false;
        }
    });

    $('.page-container form .username, .page-container form .password').keyup(function(){
        $(this).parent().find('.error').fadeOut('fast');
    });

});
