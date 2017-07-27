$(function(){
	$('.messbtn').click(function(){
		if($('#mess-send').val().length==0){
			$('.messeror').html('发送的信息不能为空！');
			return false;
		}
		$(this).attr('disabled','disabled');
		$('#form').submit();
	})
})
